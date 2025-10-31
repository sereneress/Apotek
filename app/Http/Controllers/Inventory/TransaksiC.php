<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiObat;
use App\Models\Obat;
use App\Models\Kategori;
use App\Models\Supplier;

class TransaksiObatC extends Controller
{

    // 🔹 Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:transaksi_obat,kode_transaksi',
            'obat_id' => 'required|exists:obat,id',
            'kategori_id' => 'required|exists:kategori,id',
            'supplier_id' => 'required|exists:supplier,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date',
        ]);

        TransaksiObat::create([
            'kode_transaksi' => $request->kode_transaksi,
            'obat_id' => $request->obat_id,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'total_harga' => $request->jumlah * $request->harga_satuan,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        return redirect()->route('transaksi_obat.index')->with('success', 'Transaksi penerimaan obat berhasil ditambahkan.');
    }

    // 🔹 Update transaksi
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:transaksi_obat,kode_transaksi,' . $id,
            'obat_id' => 'required|exists:obat,id',
            'kategori_id' => 'required|exists:kategori,id',
            'supplier_id' => 'required|exists:supplier,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date',
        ]);

        $transaksi = TransaksiObat::findOrFail($id);
        $transaksi->update([
            'kode_transaksi' => $request->kode_transaksi,
            'obat_id' => $request->obat_id,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'total_harga' => $request->jumlah * $request->harga_satuan,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        return redirect()->route('transaksi_obat.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    // 🔹 Hapus transaksi
    public function destroy($id)
    {
        $transaksi = TransaksiObat::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi_obat.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
