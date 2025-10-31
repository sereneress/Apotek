<?php

namespace App\Http\Controllers\Gudang;

<<<<<<< HEAD
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

        $gudang = Gudang::create([
            'employment_status' => $request->employment_status,
            'last_education' => $request->last_education,
            'shift' => $request->shift,
            'warehouse_section' => $request->warehouse_section,
            'start_date' => $request->start_date,
            'profile_image' => $imagePath,
            'status' => $request->status,
        ]);

        $person = People::create([
            'name' => $request->name,
            'sex' => $request->sex,
            'pob' => $request->pob,
            'dob' => $request->dob,
            'personable_id' => $gudang->id,
            'personable_type' => Gudang::class,
        ]);

        $user = User::create([
            'person_id' => $person->id,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'reference_id' => $gudang->id,
            'reference_type' => Gudang::class,
        ]);

        $gudang->update([
            'person_id' => $person->id,
            'user_id' => $user->id,
        ]);

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



    // 🔹 Update data gudang
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'sex' => 'required|in:L,P',
            'pob' => 'required|string|max:100',
            'dob' => 'required|date',
            'username' => 'required|string|max:100',
            'email' => 'nullable|email|max:150',
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

            if ($request->hasFile('profile_image')) {
                if ($gudang->profile_image) {
                    Storage::disk('public')->delete($gudang->profile_image);
                }
                $imagePath = $request->file('profile_image')->store('profiles', 'public');
            } else {
                $imagePath = $gudang->profile_image;
            }

            $gudang->update([
                'employment_status' => $request->employment_status,
                'last_education' => $request->last_education,
                'shift' => $request->shift,
                'warehouse_section' => $request->warehouse_section,
                'start_date' => $request->start_date,
                'status' => $request->status,
                'profile_image' => $imagePath,
            ]);

            $gudang->person->update([
                'name' => $request->name,
                'sex' => $request->sex,
                'pob' => $request->pob,
                'dob' => $request->dob,
            ]);

            $gudang->user->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);

            DB::commit();
            return back()->with('success', 'Data gudang berhasil diperbarui!');
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
=======

use App\Http\Controllers\Controller;


class GudangC extends Controller
{
      public function index()
      {
          return view('backend.pages.people.gudang.tabel');
      }
    // public function view($id)
    // {
    //     $dokter = Dokter::with(['person', 'user'])->findOrFail($id);
    //     return view('backend.pages.people.dokter.view', compact('dokter'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_lengkap'  => 'required|string',
    //         'pob'           => 'required|string',
    //         'dob'           => 'required|date',
    //         'sex'           => 'required|in:laki-laki,perempuan',
    //         'username'      => 'required|string|unique:users,username',
    //         'email'         => 'required|email|unique:users,email',
    //         'password'      => 'required|string|min:6',
    //         'telepon'       => 'required|string',
    //         'spesialisasi'  => 'required|string',
    //         'no_sip'        => 'required|string',
    //         'jadwal_praktek' => json_encode($request->jadwal),
    //     ]);

    //     // 1. Simpan ke tabel people
    //     $person = Person::create([
    //         'name'           => $request->nama_lengkap,
    //         'dob'            => $request->dob,
    //         'pob'            => $request->pob,
    //         'sex'            => $request->sex,
    //         'reference_type' => Dokter::class,
    //         'reference_id'   => 0, // nanti diupdate
    //     ]);

    //     // 2. Simpan ke tabel dokter
    //     $dokter = Dokter::create([
    //         'person_id'      => $person->id,
    //         'sip'            => $request->no_sip,
    //         'spesialis'      => $request->spesialisasi,
    //         'no_telepon'     => $request->telepon,
    //         'status'         => $request->aktif == 1 ? 'aktif' : 'nonaktif',
    //         'jadwal_praktek' => json_encode($request->jadwal),
    //     ]);

    //     // 3. Update reference_id di people
    //     $person->update(['reference_id' => $dokter->id]);

    //     // 4. Simpan user
    //     $user = User::create([
    //         'person_id'      => $person->id,
    //         'username'       => $request->username,
    //         'email'          => $request->email,
    //         'password'       => bcrypt($request->password),
    //         'reference_type' => Dokter::class,
    //         'reference_id'   => $dokter->id,
    //     ]);

    //     $dokterRole = Role::where('name', 'dokter')->first();
    //     if ($dokterRole) {
    //         $user->roles()->syncWithoutDetaching([$dokterRole->id]);
    //     }

    //     return redirect()->route('dokter.table')->with('success', 'Dokter berhasil ditambahkan');
    // }

    // public function update(Request $r, $id)
    // {
    //     $dokter = Dokter::with(['user', 'person'])->findOrFail($id);

    //     $validated = $r->validate([
    //         'name'       => 'required|string',
    //         'sip'        => 'required|string',
    //         'no_telepon' => 'required|string',
    //         'status'     => 'required|in:aktif,nonaktif', // ✅ validasi sesuai enum
    //         'jadwal'     => 'nullable|array',
    //     ]);

    //     // Filter jadwal -> hanya simpan hari yang punya jam mulai & selesai
    //     $jadwalFiltered = collect($validated['jadwal'] ?? [])
    //         ->filter(fn($item) => !empty($item['mulai']) && !empty($item['selesai']))
    //         ->toArray();

    //     // Update dokter
    //     $dokter->update([
    //         'sip'            => $validated['sip'],
    //         'no_telepon'     => $validated['no_telepon'],
    //         'status'         => $validated['status'], // ✅ langsung ambil dari validated
    //         'jadwal_praktek' => json_encode($jadwalFiltered),
    //     ]);

    //     // Update data di tabel people
    //     $dokter->person->update([
    //         'name' => $validated['name'],
    //     ]);

    //     return redirect()->route('dokter.view', $dokter->id)
    //         ->with('success', 'Berhasil mengupdate data');
    // }

    // public function delete($id)
    // {
    //     $dokter = Dokter::findOrFail($id);

    //     // Hapus user terkait (jika ada)
    //     if ($dokter->user) {
    //         $dokter->user->delete();
    //     }

    //     // Hapus person terkait (jika ada)
    //     if ($dokter->person) {
    //         $dokter->person->delete();
    //     }

    //     // Hapus dokter
    //     $dokter->delete();

    //     return back()->with('success', 'Data dokter berhasil dihapus');
    // }
}
>>>>>>> c410e5a8316167bdf026754654ee687a9ffd4d35
