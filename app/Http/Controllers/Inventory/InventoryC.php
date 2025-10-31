<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;


class InventoryC extends Controller
{
  // 🔹 Tampilkan semua data gudang
  public function index()
  {
    return view('backend.pages.inventory.tabel');
  }
}
