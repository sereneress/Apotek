<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\RiwayatObat;
use Illuminate\Http\Request;
use App\Models\TransaksiObat;
use Carbon\Carbon;

class LaporanC extends Controller
{
    // 🔹 Laporan Harian
    public function harian(Request $request)
    {
        $tanggal = $request->tanggal ?? date('Y-m-d');

        $laporan = TransaksiObat::with('obat')
            ->whereDate('tanggal_transaksi', $tanggal)
            ->get();

        return view('backend.pages.laporan.harian', compact('laporan', 'tanggal'));
    }

    // 🔹 Laporan Bulanan
    public function bulanan(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        // Ambil data dari tabel riwayat_obat
        $laporan = RiwayatObat::with('obat')
            ->selectRaw('obat_id, 
                    SUM(CASE WHEN tipe = "masuk" THEN jumlah ELSE 0 END) as total_masuk,
                    SUM(CASE WHEN tipe = "keluar" THEN jumlah ELSE 0 END) as total_keluar')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('obat_id')
            ->get();

        return view('backend.pages.laporan.bulanan', compact('laporan', 'bulan', 'tahun'));
    }
}
