@extends('backend.master')

@section('content')
    <div class="main-content">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Management Inventory Obat</h3>
                    <p class="text-subtitle text-muted">Tabel statis, sortable dan responsive.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Apoteker</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="analytics-card card border-0 rounded-4 mb-4 text-white">
            <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div>
                    <h5 class="fw-semibold mb-1">Website Analytics</h5>
                    <p class="mb-4 opacity-75">Total 28.5% Conversion Rate</p>

                    <div class="d-flex flex-wrap gap-3">
                        <div>
                            <h6 class="mb-0">1.6k</h6>
                            <small class="opacity-75">Sessions</small>
                        </div>
                        <div>
                            <h6 class="mb-0">3.1k</h6>
                            <small class="opacity-75">Page Views</small>
                        </div>
                        <div>
                            <h6 class="mb-0">1.2k</h6>
                            <small class="opacity-75">Leads</small>
                        </div>
                        <div>
                            <h6 class="mb-0">12%</h6>
                            <small class="opacity-75">Conversions</small>
                        </div>
                    </div>
                </div>

                <div class="mt-4 mt-md-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/1048/1048953.png" alt="Analytics Icon"
                        class="img-fluid" style="width: 120px; opacity: 0.9;">
                </div>
            </div>
        </div>


        <!-- Nav Tabs as Rectangular Cards -->
        <ul class="nav nav-tabs flex-wrap g-3" id="inventoryTabs" role="tablist">
            <li class="nav-item col-12 col-md-6 col-lg-4" role="presentation">
                <a class="nav-link" id="kategori-obat-tab" data-bs-toggle="tab" href="#kategori-obat" role="tab"
                    aria-controls="kategori-obat" aria-selected="false">
                    <i class="iconly-boldBookmark"></i>
                    <div>
                        <div class="fw-semibold">Kategori</div>
                        <small>Manage Kategori</small>
                    </div>
                </a>
            </li>

            <li class="nav-item col-12 col-md-6 col-lg-4" role="presentation">
                <a class="nav-link" id="transaksi-obat-tab" data-bs-toggle="tab" href="#transaksi-obat" role="tab"
                    aria-controls="transaksi-obat" aria-selected="false">
                    <i class="iconly-boldAdd-User"></i>
                    <div>
                        <div class="fw-semibold">Transaksi Obat</div>
                        <small>Supplier & Penerimaan</small>
                    </div>
                </a>
            </li>

            <li class="nav-item col-12 col-md-6 col-lg-4" role="presentation">
                <a class="nav-link" id="laporan-tab" data-bs-toggle="tab" href="#laporan" role="tab"
                    aria-controls="laporan" aria-selected="false">
                    <i class="iconly-boldGraph"></i>
                    <div>
                        <div class="fw-semibold">Laporan</div>
                        <small>Penjualan & Stok</small>
                    </div>
                </a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-4">

            <!-- 🔹 Kategori -->
            <div class="tab-pane fade show active" id="kategori-obat" role="tabpanel" aria-labelledby="kategori-obat-tab">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-semibold">Daftar Kategori Obat</h5>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
                    </button>
                </div>

                <div class="table-responsive shadow-sm rounded-3">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategoris as $index => $kategori)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>{{ $kategori->deskripsi }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Aksi">
                                            <a href="{{ route('kategori.edit', $kategori->id) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit Kategori">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    title="Hapus Kategori">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
            <!-- 🔹 Modal Tambah Kategori -->
            <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0 shadow">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-semibold" id="modalTambahKategoriLabel">
                                Tambah Kategori Obat
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="modal-body pt-0">
                                <div class="mb-3">
                                    <label for="kode_kategori" class="form-label">Kode Kategori</label>
                                    <input type="text" name="kode_kategori" id="kode_kategori" class="form-control"
                                        placeholder="Masukkan kode kategori" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                                        placeholder="Masukkan nama kategori" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"
                                        placeholder="Masukkan deskripsi kategori"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="transaksi-obat" role="tabpanel" aria-labelledby="transaksi-obat-tab">
                <h5 class="fw-semibold mb-3">Transaksi Obat Masuk</h5>

                <form action="{{ route('transaksi.store') }}" method="POST" class="row g-3 mb-4">
                    @csrf

                    <div class="col-md-3">
                        <label for="kode_transaksi" class="form-label">Kode Transaksi</label>
                        <input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control"
                            value="{{ 'TRX-' . date('Ymd') . '-' . rand(100, 999) }}" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <input type="text" name="supplier" id="supplier" class="form-control"
                            placeholder="Masukkan nama supplier" required>
                    </div>

                    <div class="col-md-3">
                        <label for="obat_id" class="form-label">Obat</label>
                        <select name="obat_id" id="obat_id" class="form-select" required>
                            <option value="">-- Pilih Obat --</option>
                            @foreach ($obats as $obat)
                                <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                    {{ $obat->nama }} | Stok: {{ $obat->stok }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" min="1"
                            placeholder="0" required>
                    </div>

                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>



                <!-- Riwayat Obat Masuk -->
                <div class="list-group shadow-sm rounded-3">
                    @foreach ($transaksiObats as $transaksi)
                        <div
                            class="list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row mb-2 p-3 rounded-3 border">
                            <div class="mb-2 mb-md-0">
                                <h6 class="mb-1">{{ $transaksi->obat->nama ?? 'Obat Tidak Ada' }}</h6>
                                <small class="text-muted">
                                    Masuk: {{ $transaksi->jumlah }} pcs |
                                    Supplier: {{ $transaksi->supplier }} |
                                    Tanggal: {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}
                                </small>
                            </div>
                            <span class="badge bg-success rounded-pill align-self-start">Masuk</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="laporan" role="tabpanel" aria-labelledby="laporan-tab">
                <h5 class="fw-semibold mb-4 text-success">
                    <i class="bi bi-bar-chart-line me-2"></i> Laporan Penjualan
                </h5>

                <div class="row g-4">
                    {{-- === Laporan Harian === --}}
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-4 hover-shadow transition-all">
                            <div class="card-body">
                                <div class="mb-3">
                                    <i class="bi bi-calendar-day display-4 text-success"></i>
                                </div>
                                <h5 class="fw-semibold mb-3 text-dark">Laporan Harian</h5>
                                <p class="text-muted small mb-4">
                                    Lihat data transaksi penjualan untuk hari ini.
                                </p>
                                <a href="{{ route('laporan.harian') }}"
                                    class="btn btn-success btn-lg px-4 rounded-pill shadow-sm">
                                    <i class="bi bi-arrow-right-circle me-2"></i> Tampilkan
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- === Laporan Bulanan === --}}
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-4 hover-shadow transition-all">
                            <div class="card-body">
                                <div class="mb-3">
                                    <i class="bi bi-calendar3 display-4 text-success"></i>
                                </div>
                                <h5 class="fw-semibold mb-3 text-dark">Laporan Bulanan</h5>
                                <p class="text-muted small mb-4">
                                    Lihat total penjualan dan pendapatan selama bulan ini.
                                </p>
                                <a href="{{ route('laporan.bulanan') }}"
                                    class="btn btn-success btn-lg px-4 rounded-pill shadow-sm">
                                    <i class="bi bi-arrow-right-circle me-2"></i> Tampilkan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>




    </div>
@endsection
