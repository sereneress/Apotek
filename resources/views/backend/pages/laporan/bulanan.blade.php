@extends('backend.master')

@section('content')
    <div class="main-content">
        {{-- === Header Judul dan Filter === --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-semibold text-success mb-1">
                    <i class="bi bi-bar-chart-line-fill me-2"></i> Laporan Stok Obat Bulanan
                </h4>
                <p class="text-muted mb-0">
                    Periode: <strong>{{ \Carbon\Carbon::create($tahun, $bulan)->translatedFormat('F Y') }}</strong>
                </p>
            </div>
            <form method="GET" class="d-flex gap-2">
                <select name="bulan" class="form-select shadow-sm">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>

                <select name="tahun" class="form-select shadow-sm">
                    @for ($y = 2023; $y <= date('Y'); $y++)
                        <option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>{{ $y }}
                        </option>
                    @endfor
                </select>

                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-search"></i> Tampilkan
                </button>
            </form>
        </div>

        {{-- === Statistik Ringkasan === --}}
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon bg-success bg-opacity-10 text-success p-3 rounded-3 me-3">
                            <i class="bi bi-box-arrow-in-down fs-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Obat Masuk</h6>
                            <h5 class="fw-semibold mb-0">
                                {{ $laporan->sum('total_masuk') }} pcs
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon bg-danger bg-opacity-10 text-danger p-3 rounded-3 me-3">
                            <i class="bi bi-box-arrow-up fs-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Obat Keluar</h6>
                            <h5 class="fw-semibold mb-0">
                                {{ $laporan->sum('total_keluar') }} pcs
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon bg-info bg-opacity-10 text-info p-3 rounded-3 me-3">
                            <i class="bi bi-capsule fs-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Sisa Stok Akhir</h6>
                            <h5 class="fw-semibold mb-0">
                                {{ $laporan->sum('total_masuk') - $laporan->sum('total_keluar') }} pcs
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- === Tabel Data === --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div
                class="card-header bg-success text-white border-0 rounded-top-4 py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-semibold mb-0">
                    <i class="bi bi-clipboard-check me-2"></i> Rincian Transaksi Bulan Ini
                </h6>
                <a href="#" class="btn btn-light btn-sm text-success border-0 shadow-sm">
                    <i class="bi bi-printer"></i> Cetak
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-success text-center">
                            <tr>
                                <th>#</th>
                                <th>Nama Obat</th>
                                <th>Total Masuk</th>
                                <th>Total Keluar</th>
                                <th>Sisa Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporan as $index => $row)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $row->obat->nama ?? '-' }}</td>
                                    <td class="text-center text-success fw-semibold">{{ $row->total_masuk }}</td>
                                    <td class="text-center text-danger fw-semibold">{{ $row->total_keluar }}</td>
                                    <td class="text-center fw-semibold">
                                        {{ $row->total_masuk - $row->total_keluar }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        <i class="bi bi-info-circle me-1"></i> Tidak ada data untuk bulan ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
