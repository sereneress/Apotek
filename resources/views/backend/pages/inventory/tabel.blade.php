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
                <a class="nav-link active" id="data-obat-tab" data-bs-toggle="tab" href="#data-obat" role="tab"
                    aria-controls="data-obat" aria-selected="true">
                    <i class="iconly-boldProfile"></i>
                    <div>
                        <div class="fw-semibold">Data Obat</div>
                        <small>Lihat/Edit</small>
                    </div>
                </a>
            </li>
            <li class="nav-item col-12 col-md-6 col-lg-4" role="presentation">
                <a class="nav-link" id="stok-obat-tab" data-bs-toggle="tab" href="#stok-obat" role="tab"
                    aria-controls="stok-obat" aria-selected="false">
                    <i class="iconly-boldShow"></i>
                    <div>
                        <div class="fw-semibold">Stok Obat</div>
                        <small>Tambah/Kurangi</small>
                    </div>
                </a>
            </li>
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
                <a class="nav-link" id="riwayat-stok-tab" data-bs-toggle="tab" href="#riwayat-stok" role="tab"
                    aria-controls="riwayat-stok" aria-selected="false">
                    <i class="iconly-boldDocument"></i>
                    <div>
                        <div class="fw-semibold">Riwayat Transaksi</div>
                        <small>Riwayat Transaksi Obat</small>
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
            <div class="tab-pane fade show active" id="data-obat" role="tabpanel" aria-labelledby="data-obat-tab">

                <div class="row g-3">

                    <!-- Obat 1 -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card shadow-sm border-0 rounded-3 p-2">
                            <!-- Header: Nama Obat & Stok -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="fw-semibold fs-6 text-truncate">Paracetamol</div>
                                <span class="badge bg-success small">Stok: 15</span>
                            </div>

                            <!-- Kategori & Harga -->
                            <div class="mb-1">
                                <small class="text-muted text-truncate">Kategori: Analgesik</small>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted">Harga: Rp 5.000</small>
                            </div>

                            <!-- Modern Action (icon kecil) -->
                            <div class="d-flex gap-1 justify-content-end">
                                <button class="btn btn-outline-primary btn-sm py-0 px-2 rounded-pill">Edit</button>
                                <button class="btn btn-outline-danger btn-sm py-0 px-2 rounded-pill">Hapus</button>
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan obat lainnya di sini -->

                </div>

            </div>

            <div class="tab-pane fade" id="stok-obat" role="tabpanel" aria-labelledby="stok-obat-tab">

                <div class="row g-3">

                    <!-- Obat 1 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0 rounded-3 p-3 h-100">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="fw-semibold fs-6">Paracetamol</div>
                                <span class="badge bg-success small">Stok: 15</span>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted">Kategori: Analgesik</small>
                            </div>
                            <div class="d-flex gap-2 mt-2">
                                <button class="btn btn-sm btn-primary flex-grow-1" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahStok1">Tambah Stok</button>
                                <button class="btn btn-sm btn-warning flex-grow-1" data-bs-toggle="modal"
                                    data-bs-target="#modalKurangiStok1">Kurangi Stok</button>
                            </div>
                        </div>
                    </div>

                    <!-- Obat 2 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0 rounded-3 p-3 h-100">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="fw-semibold fs-6">Amoxicillin</div>
                                <span class="badge bg-danger small">Stok: 3</span>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted">Kategori: Antibiotik</small>
                            </div>
                            <div class="d-flex gap-2 mt-2">
                                <button class="btn btn-sm btn-primary flex-grow-1" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahStok2">Tambah Stok</button>
                                <button class="btn btn-sm btn-warning flex-grow-1" data-bs-toggle="modal"
                                    data-bs-target="#modalKurangiStok2">Kurangi Stok</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tambahkan obat lain sesuai kebutuhan -->

                </div>

            </div>



            <div class="tab-pane fade" id="kategori-obat" role="tabpanel" aria-labelledby="kategori-obat-tab">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-semibold">Daftar Kategori Obat</h5>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
                    </button>
                </div>

                <div class="table-responsive shadow-sm rounded-3">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Analgesik</td>
                                <td>Obat penghilang rasa sakit.</td>

                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Aksi">
                                        <button class="btn btn-sm btn-outline-warning" title="Edit Kategori">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus Kategori">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Antibiotik</td>
                                <td>Obat untuk infeksi bakteri.</td>

                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Aksi">
                                        <button class="btn btn-sm btn-outline-warning" title="Edit Kategori">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus Kategori">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Vitamin</td>
                                <td>Obat suplemen dan vitamin.</td>

                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Aksi">
                                        <button class="btn btn-sm btn-outline-warning" title="Edit Kategori">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus Kategori">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tab-pane fade" id="riwayat-stok" role="tabpanel" aria-labelledby="riwayat-stok-tab">

                <h5 class="fw-semibold mb-3">Riwayat Stok Obat</h5>

                <div class="list-group shadow-sm rounded-3">
                    <!-- Item 1 -->
                    <div
                        class="list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row mb-2 p-3 rounded-3 border">
                        <div class="mb-2 mb-md-0">
                            <h6 class="mb-1">Paracetamol</h6>
                            <small class="text-muted">31-10-2025 | Supplier ABC</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success">Masuk +50</span>
                            <span class="text-muted">Stok: 150</span>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Detail</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div
                        class="list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row mb-2 p-3 rounded-3 border">
                        <div class="mb-2 mb-md-0">
                            <h6 class="mb-1">Amoxicillin</h6>
                            <small class="text-muted">31-10-2025 | Penjualan</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-danger">Keluar -20</span>
                            <span class="text-muted">Stok: 80</span>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Detail</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div
                        class="list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row mb-2 p-3 rounded-3 border">
                        <div class="mb-2 mb-md-0">
                            <h6 class="mb-1">Vitamin C</h6>
                            <small class="text-muted">30-10-2025 | Supplier XYZ</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success">Masuk +100</span>
                            <span class="text-muted">Stok: 200</span>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Detail</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="transaksi-obat" role="tabpanel" aria-labelledby="transaksi-obat-tab">
                <h5 class="fw-semibold mb-3">Transaksi Obat Masuk</h5>

                <!-- Form Input Penerimaan Obat -->
                <form class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Pilih Supplier</label>
                        <select class="form-select">
                            <option selected>-- Pilih Supplier --</option>
                            <option value="1">Supplier ABC</option>
                            <option value="2">Supplier XYZ</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Obat</label>
                        <input type="text" class="form-control" placeholder="Nama Obat">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Jumlah</label>
                        <input type="number" class="form-control" placeholder="0">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">Tambah</button>
                    </div>
                </form>

                <!-- Riwayat Obat Masuk -->
                <div class="list-group shadow-sm rounded-3">
                    <div
                        class="list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row mb-2 p-3 rounded-3 border">
                        <div class="mb-2 mb-md-0">
                            <h6 class="mb-1">Paracetamol 500mg</h6>
                            <small class="text-muted">Masuk: 50 pcs | Supplier: ABC | Tanggal: 31-10-2025</small>
                        </div>
                        <span class="badge bg-success rounded-pill align-self-start">Masuk</span>
                    </div>

                    <div
                        class="list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row mb-2 p-3 rounded-3 border">
                        <div class="mb-2 mb-md-0">
                            <h6 class="mb-1">Amoxicillin 250mg</h6>
                            <small class="text-muted">Masuk: 30 pcs | Supplier: XYZ | Tanggal: 30-10-2025</small>
                        </div>
                        <span class="badge bg-success rounded-pill align-self-start">Masuk</span>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="laporan" role="tabpanel" aria-labelledby="laporan-tab">
                <h5 class="fw-semibold mb-3">Laporan Inventory & Penjualan</h5>

                <div class="row g-2">
                    <!-- Laporan Penjualan Harian -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card shadow-sm rounded-3 border-0 p-2">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <h6 class="mb-0 fw-semibold">Penjualan Harian</h6>
                                    <small class="text-muted">Ringkasan hari ini</small>
                                </div>
                                <i class="bi bi-calendar2-day fs-4 text-primary"></i>
                            </div>
                            <button class="btn btn-sm btn-outline-primary w-100 mt-1">Lihat Laporan</button>
                        </div>
                    </div>

                    <!-- Laporan Penjualan Bulanan -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card shadow-sm rounded-3 border-0 p-2">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <h6 class="mb-0 fw-semibold">Penjualan Bulanan</h6>
                                    <small class="text-muted">Ringkasan bulan ini</small>
                                </div>
                                <i class="bi bi-calendar2-month fs-4 text-success"></i>
                            </div>
                            <button class="btn btn-sm btn-outline-success w-100 mt-1">Lihat Laporan</button>
                        </div>
                    </div>

                    <!-- Laporan Stok Obat -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card shadow-sm rounded-3 border-0 p-2">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <h6 class="mb-0 fw-semibold">Stok Obat</h6>
                                    <small class="text-muted">Obat tersedia & minimum stok</small>
                                </div>
                                <i class="bi bi-box-seam fs-4 text-warning"></i>
                            </div>
                            <button class="btn btn-sm btn-outline-warning w-100 mt-1">Lihat Laporan</button>
                        </div>
                    </div>

                    <!-- Laporan Obat Kadaluarsa -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card shadow-sm rounded-3 border-0 p-2">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <h6 class="mb-0 fw-semibold">Obat Kadaluarsa</h6>
                                    <small class="text-muted">Daftar obat mendekati kadaluarsa</small>
                                </div>
                                <i class="bi bi-exclamation-triangle fs-4 text-danger"></i>
                            </div>
                            <button class="btn btn-sm btn-outline-danger w-100 mt-1">Lihat Laporan</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>




    </div>
@endsection
