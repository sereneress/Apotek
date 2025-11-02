@extends('backend.master')

@section('content')
<div class="main-content">
  <div class="page-title mb-3">
    <h4 class="fw-bold text-primary">📅 Laporan Penjualan Harian</h4>
    <p class="text-muted">Ringkasan transaksi penjualan obat hari ini</p>
  </div>

  <div class="card border-0 shadow-sm rounded-4 p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h6 class="fw-semibold text-secondary mb-0">Data Transaksi Hari Ini</h6>
      <button class="btn btn-primary btn-sm">
        <i class="bi bi-printer"></i> Cetak Laporan
      </button>
    </div>

    <table class="table table-hover table-striped align-middle">
      <thead class="table-primary">
        <tr>
          <th>No</th>
          <th>Kode Transaksi</th>
          <th>Obat</th>
          <th>Jumlah</th>
          <th>Total Harga</th>
          <th>Kasir</th>
          <th>Waktu</th>
        </tr>
      </thead>
      <tbody>
        @forelse($penjualanHarian as $index => $trx)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $trx->kode_transaksi }}</td>
          <td>{{ $trx->obat->nama_obat }}</td>
          <td>{{ $trx->jumlah }}</td>
          <td>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
          <td>{{ $trx->user->name ?? '-' }}</td>
          <td>{{ $trx->created_at->format('H:i') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center text-muted">Belum ada transaksi hari ini</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection