@extends('backend.master')

@section('content')
<div class="main-content">
    <div class="page-title mb-3">
        <h4 class="fw-bold text-success">📆 Laporan Penjualan Bulanan</h4>
        <p class="text-muted">Ringkasan total transaksi per bulan</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-semibold text-secondary mb-0">Rekap Penjualan Bulanan</h6>
            <button class="btn btn-success btn-sm">
                <i class="bi bi-download"></i> Unduh PDF
            </button>
        </div>

        <table class="table table-hover table-striped align-middle">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Total Transaksi</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualanBulanan as $index => $bulan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bulan->bulan }}</td>
                    <td>{{ $bulan->total_transaksi }}</td>
                    <td>Rp {{ number_format($bulan->total_pendapatan, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada data transaksi bulan ini</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
