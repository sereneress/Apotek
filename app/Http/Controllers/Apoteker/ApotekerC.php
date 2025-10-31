<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Apoteker;
use App\Models\People;
use App\Models\Role;

class ApotekerC extends Controller
{
  // 🔹 Tampilkan semua apoteker
  public function index()
  {
    $apotekers = Apoteker::with(['person', 'user'])->latest()->get();
    return view('backend.pages.people.apoteker.tabel', compact('apotekers'));
  }

  // 🔹 Simpan data apoteker baru
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:100',
      'sex' => 'required|in:L,P',
      'pob' => 'required|string|max:100',
      'dob' => 'required|date',
      'username' => 'required|string|max:100|unique:users,username',
      'email' => 'nullable|email|max:150|unique:users,email',
      'password' => 'required|confirmed|min:4',
      'employment_status' => 'required|string',
      'start_date' => 'required|date',
      'status' => 'required|string',
      'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    DB::beginTransaction();

    try {
      // ✅ 1. Upload gambar (kalau ada)
      $imagePath = $request->hasFile('profile_image')
        ? $request->file('profile_image')->store('profiles', 'public')
        : null;

      // ✅ 2. Buat apoteker
      $apoteker = Apoteker::create([
        'license_number' => $request->license_number,
        'employment_status' => $request->employment_status,
        'last_education' => $request->last_education,
        'shift' => $request->shift,
        'start_date' => $request->start_date,
        'profile_image' => $imagePath,
        'status' => $request->status,
      ]);

      // ✅ 3. Buat people (personable)
      $person = People::create([
        'name' => $request->name,
        'sex' => $request->sex,
        'pob' => $request->pob,
        'dob' => $request->dob,
        'personable_id' => $apoteker->id,
        'personable_type' => Apoteker::class,
      ]);

      // ✅ 4. Buat user (reference)
      $user = User::create([
        'person_id' => $person->id,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'reference_id' => $apoteker->id,
        'reference_type' => Apoteker::class,
      ]);


      // ✅ 5. Update relasi balik ke apoteker
      $apoteker->update([
        'person_id' => $person->id,
        'user_id' => $user->id,
      ]);

      // ✅ 6. Tambahkan role apoteker
      $role = Role::where('name', 'apoteker')->first();
      if ($role) {
        DB::table('role_user')->insert([
          'user_id' => $user->id,
          'role_id' => $role->id,
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      }

      DB::commit();
      return back()->with('success', 'Apoteker berhasil ditambahkan!');
    } catch (\Exception $e) {
      DB::rollBack();
      dd([
        'error_message' => $e->getMessage(),
        'error_line' => $e->getLine(),
        'error_file' => $e->getFile(),
        'trace' => collect($e->getTrace())->take(5),
      ]);
    }
  }

  // 🔹 Update Apoteker
  public function update(Request $request, $id)
  {
    $request->validate([
      // 🔹 People
      'name' => 'required|string|max:100',
      'sex' => 'required|in:L,P',
      'pob' => 'required|string|max:100',
      'dob' => 'required|date',

      // 🔹 User
      'username' => 'required|string|max:100|unique:users,username,' . $id . ',reference_id',
      'email' => 'nullable|email|max:150|unique:users,email,' . $id . ',reference_id',

      // 🔹 Apoteker
      'employment_status' => 'required|string',
      'start_date' => 'required|date',
      'status' => 'required|string',
      'last_education' => 'nullable|string|max:255',
      'shift' => 'nullable|string|max:50',
      'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    DB::beginTransaction();

    try {
      $apoteker = Apoteker::with(['person', 'user'])->findOrFail($id);

      // 🔹 Update gambar jika ada upload baru
      if ($request->hasFile('profile_image')) {
        if ($apoteker->profile_image) {
          Storage::disk('public')->delete($apoteker->profile_image);
        }
        $imagePath = $request->file('profile_image')->store('profiles', 'public');
      } else {
        $imagePath = $apoteker->profile_image;
      }

      // 🔹 Update Apoteker
      $apoteker->update([
        'license_number' => $request->license_number,
        'employment_status' => $request->employment_status,
        'last_education' => $request->last_education,
        'shift' => $request->shift,
        'start_date' => $request->start_date,
        'status' => $request->status,
        'profile_image' => $imagePath,
      ]);

      // 🔹 Update People
      $apoteker->person->update([
        'name' => $request->name,
        'sex' => $request->sex,
        'pob' => $request->pob,
        'dob' => $request->dob,
      ]);

      // 🔹 Update User
      $apoteker->user->update([
        'username' => $request->username,
        'email' => $request->email,
      ]);

      DB::commit();
      return back()->with('success', 'Apoteker berhasil diperbarui!');
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with('error', 'Gagal memperbarui apoteker: ' . $e->getMessage());
    }
  }


  // 🔹 Hapus apoteker
  public function destroy($id)
  {
    DB::beginTransaction();

    try {
      $apoteker = Apoteker::with(['person', 'user'])->findOrFail($id);

      // Hapus gambar
      if ($apoteker->profile_image) {
        Storage::disk('public')->delete($apoteker->profile_image);
      }

      // Hapus role_user
      DB::table('role_user')->where('user_id', $apoteker->user->id)->delete();

      // Hapus user, person, apoteker
      $apoteker->user?->delete();
      $apoteker->person?->delete();
      $apoteker->delete();

      DB::commit();
      return redirect()->back()->with('success', 'Apoteker berhasil dihapus.');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
    }
  }
}
