<?php

namespace App\Http\Controllers\Gudang;


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