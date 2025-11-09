<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Obat;
use App\Models\RiwayatObat;
use App\Models\TransaksiObat;

class DashC extends Controller
{
  public function index()
  {
    return view('backend.dash');
  }

  public function apoteker()
  {
    $obats = Obat::all();
    $kategoris = Kategori::all();
    $riwayatObats = RiwayatObat::latest()->get();
    $transaksiObats = TransaksiObat::latest()->get();

    return view('backend.dashboard.apoteker', compact(
      'obats',
      'kategoris',
      'riwayatObats',
      'transaksiObats'
    ));
  }

  public function gudang()
  {
    $obats = Obat::all();
    $kategoris = Kategori::all();
    $riwayatObats = RiwayatObat::latest()->get();
    $transaksiObats = TransaksiObat::latest()->get();

    return view('backend.dashboard.gudang', compact(
      'obats',
      'kategoris',
      'riwayatObats',
      'transaksiObats'
    ));
  }
}
