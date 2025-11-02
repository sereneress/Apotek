<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriC extends Controller
{




    // 🔹 Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori' => 'required|unique:kategori,kode_kategori',
            'nama_kategori' => 'required',
        ]);

        Kategori::create([
            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('backend.pages.inventory.tabel')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // 🔹 Tampilkan form edit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('backend.pages.inventory.kategori_edit', compact('kategori'));
    }

    // 🔹 Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_kategori' => 'required|unique:kategori,kode_kategori,' . $id,
            'nama_kategori' => 'required',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate.');
    }

    // 🔹 Hapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
