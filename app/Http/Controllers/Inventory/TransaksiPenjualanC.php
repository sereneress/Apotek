<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiPenjualan;
use App\Models\TransaksiPenjualanItem;
use App\Models\Obat;
use App\Models\RiwayatObat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransaksiPenjualanC extends Controller
{
  public function store(Request $request)
  {
    try {
      $request->validate([
        'keranjang' => 'required|array|min:1',
        'keranjang.*.id' => 'required|exists:obats,id',
        'keranjang.*.jumlah' => 'required|integer|min:1',
      ]);

      $total = 0;

      DB::transaction(function () use ($request, &$total) {
        $transaksi = TransaksiPenjualan::create([
          'kode_transaksi' => 'TRX' . time(),
          'tanggal' => Carbon::now(),
          'total' => 0,
          'user_id' => auth()->id() ?? 1, // default user jika belum login
        ]);

        foreach ($request->keranjang as $item) {
          $obat = Obat::findOrFail($item['id']);

          if ($item['jumlah'] > $obat->stok) {
            throw new \Exception("Stok obat {$obat->nama} tidak cukup.");
          }

          $subtotal = $item['jumlah'] * $obat->harga;

          TransaksiPenjualanItem::create([
            'transaksi_penjualan_id' => $transaksi->id,
            'obat_id' => $obat->id,
            'jumlah' => $item['jumlah'],
            'harga_satuan' => $obat->harga,
            'subtotal' => $subtotal
          ]);

          RiwayatObat::create([
            'obat_id' => $obat->id,
            'tipe' => 'keluar',
            'jumlah' => $item['jumlah'],
            'harga_satuan' => $obat->harga ?? 0,
            'total' => $subtotal,
            'sumber' => 'Transaksi Penjualan #' . $transaksi->id,
            'user_id' => Auth::id(),
          ]);

          $obat->stok -= $item['jumlah'];
          $obat->save();

          $total += $subtotal;
        }

        $transaksi->update(['total' => $total]);
      });

      return response()->json([
        'success' => true,
        'message' => 'Transaksi berhasil disimpan!'
      ]);
    } catch (ValidationException $e) {
      return response()->json([
        'success' => false,
        'message' => 'Validasi gagal!',
        'errors' => $e->errors()
      ], 422);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage()
      ], 500);
    }
  }
}
