@extends('backend.master')

@section('content')
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-semibold mb-0">
                <i class="bi bi-calendar-check text-success me-2"></i>Laporan Harian
            </h4>
            <span class="badge bg-light text-dark fs-6">
                <i class="bi bi-calendar-event me-1"></i>{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
            </span>
        </div>

        <form method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="date" name="tanggal" class="form-control shadow-sm" value="{{ $tanggal }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-search"></i> Tampilkan
                    </button>
                </div>
            </div>
        </form>

        {{-- Ringkasan Statistik --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-success text-white">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="fw-bold mb-1">Total Transaksi Masuk</h6>
                            <h4 class="fw-semibold mb-0">
                                {{ $laporan->where('jenis_transaksi', 'masuk')->sum('jumlah') }}
                            </h4>
                        </div>
                        <i class="bi bi-box-arrow-in-down fs-2 opacity-75"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-danger text-white">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="fw-bold mb-1">Total Transaksi Keluar</h6>
                            <h4 class="fw-semibold mb-0">
                                {{ $laporan->where('jenis_transaksi', 'keluar')->sum('jumlah') }}
                            </h4>
                        </div>
                        <i class="bi bi-box-arrow-up fs-2 opacity-75"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="fw-bold mb-1">Total Semua Transaksi</h6>
                            <h4 class="fw-semibold mb-0">
                                {{ $laporan->sum('jumlah') }}
                            </h4>
                        </div>
                        <i class="bi bi-clipboard-data fs-2 opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Laporan --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold text-success">
                    <i class="bi bi-table me-1"></i>Detail Transaksi Harian
                </h6>
                <a href="#" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-printer"></i> Cetak
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Nama Obat</th>
                            <th>Jenis Transaksi</th>
                            <th>Jumlah</th>
                            <th>Supplier/Pasien</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporan as $index => $row)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->tanggal_transaksi)->format('d-m-Y') }}</td>
                                <td>{{ $row->obat->nama ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $row->jenis_transaksi == 'masuk' ? 'success' : 'danger' }}">
                                        {{ ucfirst($row->jenis_transaksi) }}
                                    </span>
                                </td>
                                <td>{{ $row->jumlah }}</td>
                                <td>{{ $row->supplier ?? ($row->pasien ?? '-') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-info-circle me-1"></i> Tidak ada transaksi untuk tanggal ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
