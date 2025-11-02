<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Obat;
use App\Models\RiwayatObat;
use App\Models\TransaksiObat;

class InventoryC extends Controller
{
  // 🔹 Tampilkan daftar kategori, obat, transaksi, dan riwayat obat
  public function index()
  {
    // Ambil semua kategori
    $kategoris = Kategori::all();

    // Ambil semua obat beserta relasi kategori
    $obats = Obat::with('kategori')->get();

    // Ambil semua transaksi obat beserta relasi obat, urut terbaru
    $transaksiObats = TransaksiObat::with(['obat', 'user'])
      ->orderBy('tanggal_transaksi', 'desc')
      ->get();

    // 🔹 Ambil semua riwayat obat beserta relasi obat & user
    $riwayatObats =RiwayatObat::with(['obat', 'user'])
      ->latest()
      ->get();

    // Kirim semua data ke view
    return view('backend.pages.inventory.tabel', compact(
      'kategoris',
      'obats',
      'transaksiObats',
      'riwayatObats'
    ));
  }
}
