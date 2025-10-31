<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Kasir;
use App\Models\People;
use App\Models\Role;

class KasirC extends Controller
{
    // 🔹 Tampilkan semua kasir
    public function index()
    {
        $kasirs = Kasir::with(['person', 'user'])->latest()->get();
        return view('backend.pages.people.kasir.tabel', compact('kasirs'));
    }

    // 🔹 Simpan data kasir baru
    public function store(Request $request)
    {
        $request->validate([
            // 🔹 People
            'name' => 'required|string|max:100',
            'sex' => 'required|in:L,P',
            'pob' => 'required|string|max:100',
            'dob' => 'required|date',

            // 🔹 User
            'username' => 'required|string|max:100|unique:users,username',
            'email' => 'nullable|email|max:150|unique:users,email',
            'password' => 'required|confirmed|min:4',

            // 🔹 Kasir
            'employment_status' => 'required|string',
            'start_date' => 'required|date',
            'status' => 'required|string',
            'last_education' => 'nullable|string|max:255',
            'shift' => 'nullable|string|max:50',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // 🔹 Upload gambar
            $imagePath = $request->hasFile('profile_image')
                ? $request->file('profile_image')->store('profiles', 'public')
                : null;

            // 🔹 Buat Kasir dulu (tanpa person_id & user_id)
            $kasir = Kasir::create([
                'employment_status' => $request->employment_status,
                'last_education' => $request->last_education,
                'shift' => $request->shift,
                'start_date' => $request->start_date,
                'profile_image' => $imagePath,
                'status' => $request->status,
            ]);

            // 🔹 Buat People (polymorphic)
            $person = People::create([
                'name' => $request->name,
                'sex' => $request->sex,
                'pob' => $request->pob,
                'dob' => $request->dob,
                'personable_id' => $kasir->id,
                'personable_type' => Kasir::class,
            ]);

            // 🔹 Buat User (polymorphic reference)
            $user = User::create([
                'person_id' => $person->id,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'reference_id' => $kasir->id,
                'reference_type' => Kasir::class,
            ]);

            // 🔹 Update relasi balik ke Kasir
            $kasir->update([
                'person_id' => $person->id,
                'user_id' => $user->id,
            ]);

            // 🔹 Tambahkan role kasir
            $role = Role::where('name', 'kasir')->first();
            if ($role) {
                DB::table('role_user')->insert([
                    'user_id' => $user->id,
                    'role_id' => $role->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            return back()->with('success', 'Kasir berhasil ditambahkan!');
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


    // 🔹 Update Kasir
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

            // 🔹 Kasir
            'employment_status' => 'required|string',
            'start_date' => 'required|date',
            'status' => 'required|string',
            'last_education' => 'nullable|string|max:255',
            'shift' => 'nullable|string|max:50',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $kasir = Kasir::with(['person', 'user'])->findOrFail($id);

            // 🔹 Update gambar jika ada upload baru
            if ($request->hasFile('profile_image')) {
                if ($kasir->profile_image) {
                    Storage::disk('public')->delete($kasir->profile_image);
                }
                $imagePath = $request->file('profile_image')->store('profiles', 'public');
            } else {
                $imagePath = $kasir->profile_image;
            }

            // 🔹 Update Kasir
            $kasir->update([
                'employment_status' => $request->employment_status,
                'last_education' => $request->last_education,
                'shift' => $request->shift,
                'start_date' => $request->start_date,
                'status' => $request->status,
                'profile_image' => $imagePath,
            ]);

            // 🔹 Update People
            $kasir->person->update([
                'name' => $request->name,
                'sex' => $request->sex,
                'pob' => $request->pob,
                'dob' => $request->dob,
            ]);

            // 🔹 Update User
            $kasir->user->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);

            DB::commit();
            return back()->with('success', 'Kasir berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui kasir: ' . $e->getMessage());
        }
    }


    // 🔹 Hapus kasir
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $kasir = Kasir::with(['person', 'user'])->findOrFail($id);

            // Hapus gambar
            if ($kasir->profile_image) {
                Storage::disk('public')->delete($kasir->profile_image);
            }

            // Hapus role_user
            DB::table('role_user')->where('user_id', $kasir->user->id)->delete();

            // Hapus user, person, kasir
            $kasir->user?->delete();
            $kasir->person?->delete();
            $kasir->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Kasir berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }
}
