<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Gudang;
use App\Models\People;
use App\Models\Role;

class GudangC extends Controller
{
    // 🔹 Tampilkan semua data gudang
    public function index()
    {
        $gudangs = Gudang::with(['person', 'user'])->latest()->get();
        return view('backend.pages.people.gudang.tabel', compact('gudangs'));
    }

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
            'last_education' => 'nullable|string|max:255',
            'shift' => 'nullable|string|max:50',
            'warehouse_section' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'status' => 'required|string',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $imagePath = $request->hasFile('profile_image')
                ? $request->file('profile_image')->store('profiles', 'public')
                : null;

            // 1️⃣ Buat People dulu (belum tahu personable_id karena Gudang belum ada)
            $person = People::create([
                'name' => $request->name,
                'sex' => $request->sex,
                'pob' => $request->pob,
                'dob' => $request->dob,
            ]);

            // 2️⃣ Baru buat Gudang dengan person_id
            $gudang = Gudang::create([
                'person_id' => $person->id,
                'employment_status' => $request->employment_status,
                'last_education' => $request->last_education,
                'shift' => $request->shift,
                'warehouse_section' => $request->warehouse_section,
                'start_date' => $request->start_date,
                'profile_image' => $imagePath,
                'status' => $request->status,
            ]);

            // 3️⃣ Update People agar polymorphic ke Gudang
            $person->update([
                'personable_id' => $gudang->id,
                'personable_type' => Gudang::class,
            ]);

            // 4️⃣ Buat User
            $user = User::create([
                'person_id' => $person->id,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'reference_id' => $gudang->id,
                'reference_type' => Gudang::class,
            ]);

            // 5️⃣ Update Gudang dengan user_id
            $gudang->update(['user_id' => $user->id]);

            // 6️⃣ Tambahkan Role
            $role = Role::where('name', 'gudang')->first();
            if ($role) {
                DB::table('role_user')->insert([
                    'user_id' => $user->id,
                    'role_id' => $role->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            return back()->with('success', 'Data gudang berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage(), $e->getLine());
        }
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'sex' => 'required|in:L,P',
            'pob' => 'required|string|max:100',
            'dob' => 'required|date',
            'username' => 'required|string|max:100|unique:users,username,' . $id . ',reference_id',
            'email' => 'nullable|email|max:150|unique:users,email,' . $id . ',reference_id',
            'employment_status' => 'required|string|in:tetap,kontrak,magang',
            'last_education' => 'nullable|string|max:255',
            'shift' => 'nullable|string|max:50',
            'warehouse_section' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'status' => 'required|string|in:aktif,non-aktif',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $gudang = Gudang::with(['person', 'user'])->findOrFail($id);

            // 🔹 Ganti foto jika ada file baru
            $imagePath = $gudang->profile_image;
            if ($request->hasFile('profile_image')) {
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePath = $request->file('profile_image')->store('profiles', 'public');
            }

            // 🔹 Update data gudang
            $gudang->update([
                'employment_status' => $request->employment_status,
                'last_education' => $request->last_education,
                'shift' => $request->shift,
                'warehouse_section' => $request->warehouse_section,
                'start_date' => $request->start_date,
                'status' => $request->status,
                'profile_image' => $imagePath,
            ]);

            // 🔹 Update data person
            $gudang->person->update([
                'name' => $request->name,
                'sex' => $request->sex,
                'pob' => $request->pob,
                'dob' => $request->dob,
            ]);

            // 🔹 Update data user
            $gudang->user->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);

            DB::commit();
            return back()->with('success', 'Data petugas gudang berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui data gudang: ' . $e->getMessage());
        }
    }



    // 🔹 Hapus data gudang
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $gudang = Gudang::with(['person', 'user'])->findOrFail($id);

            if ($gudang->profile_image) {
                Storage::disk('public')->delete($gudang->profile_image);
            }

            DB::table('role_user')->where('user_id', $gudang->user->id)->delete();
            $gudang->user?->delete();
            $gudang->person?->delete();
            $gudang->delete();

            DB::commit();
            return back()->with('success', 'Data gudang berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data gudang: ' . $e->getMessage());
        }
    }
}
