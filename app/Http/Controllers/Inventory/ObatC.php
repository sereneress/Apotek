<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatC extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|integer|min:0',
        ]);

        Obat::create([
            'nama' => $request->nama_obat,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);


        return redirect()->back()->with('success', 'Obat berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|integer|min:0',
        ]);

        $obat = Obat::findOrFail($id);

        $obat->update([
            'nama' => $request->nama_obat,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Data obat berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->back()->with('success', 'Data obat berhasil dihapus!');
    }
}
