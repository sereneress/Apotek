<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiObat;
use App\Models\Obat;
use App\Models\Kategori;
use App\Models\RiwayatObat;
use Illuminate\Support\Facades\Auth;

class TransaksiC extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:transaksi_obat,kode_transaksi',
            'obat_id' => 'required|exists:obats,id',
            'supplier' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        // 🔹 Ambil data obat
        $obat = Obat::findOrFail($request->obat_id);

        // 🔹 Simpan transaksi obat masuk
        $transaksi = TransaksiObat::create([
            'kode_transaksi'    => $request->kode_transaksi,
            'obat_id'           => $obat->id,
            'kategori_id'       => $obat->kategori_id, // otomatis dari obat
            'supplier'          => $request->supplier,
            'jumlah'            => $request->jumlah,
            'harga_satuan'      => $obat->harga,
            'total_harga'       => $request->jumlah * $obat->harga,
            'tanggal_transaksi' => now()->format('Y-m-d'),
            'user_id'           => Auth::id(),
        ]);

        // 🔹 Catat ke tabel riwayat_obats
        RiwayatObat::create([
            'obat_id'       => $obat->id,
            'tipe'          => 'masuk', // stok masuk
            'jumlah'        => $request->jumlah,
            'harga_satuan'  => $obat->harga ?? 0,
            'total'         => $request->jumlah * ($obat->harga ?? 0),
            'keterangan'    => 'Penerimaan dari supplier: ' . $request->supplier,
            'sumber'        => 'Transaksi #' . $transaksi->kode_transaksi,
            'user_id'       => Auth::id(),
        ]);

        // 🔹 Update stok obat
        $obat->stok += $request->jumlah;
        $obat->save();

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan dan stok obat diperbarui.');
    }




    // 🔹 Hapus transaksi
    public function destroy($id)
    {
        $transaksi = TransaksiObat::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi_obat.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
