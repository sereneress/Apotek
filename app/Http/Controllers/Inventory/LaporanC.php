<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPenjualan;
use App\Models\Obat;
use Carbon\Carbon;

class LaporanC extends Controller
{
    public function penjualanHarian()
    {
        $today = Carbon::today();
        $penjualan = TransaksiPenjualan::with('items.obat')
            ->whereDate('tanggal_transaksi', $today)
            ->get();

        // Partial view (HTML saja)
        return view('backend.pages.laporan._penjualan_harian', compact('penjualan', 'today'));
    }

    public function penjualanBulanan()
    {
        $month = Carbon::now()->month;
        $penjualan = TransaksiPenjualan::with('items.obat')
            ->whereMonth('tanggal_transaksi', $month)
            ->get();

        return view('backend.pages.laporan._penjualan_bulanan', compact('penjualan', 'month'));
    }

    public function stokObat()
    {
        $obats = Obat::all();
        return view('backend.pages.laporan._stok_obat', compact('obats'));
    }

    public function obatKadaluarsa()
    {
        $today = Carbon::today();
        $limit = $today->copy()->addDays(30);

        $obats = Obat::whereDate('tanggal_kadaluarsa', '<=', $limit)->get();

        return view('backend.pages.laporan._obat_kadaluarsa', compact('obats', 'today', 'limit'));
    }
}
