@extends('backend.master')

@section('content')
    <div class="main-content">
        <!-- 🔹 TITLE SECTION -->
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Gudang</h3>
                    <p class="text-subtitle text-muted">Kelola data petugas gudang dengan tampilan modern dan interaktif.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gudang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- 🔹 ANALYTICS CARD -->
        <div class="analytics-card card border-0 rounded-4 mb-4 text-white"
            style="background: linear-gradient(90deg, #16a085, #27ae60);">
            <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div>
                    <h5 class="fw-semibold mb-1">Gudang Overview</h5>
                    <p class="mb-4 opacity-75">Statistik stok & aktivitas terbaru</p>

                    <div class="d-flex flex-wrap gap-4">
                        <div>
                            <h6 class="mb-0">250</h6>
                            <small class="opacity-75">Total Barang</small>
                        </div>
                        <div>
                            <h6 class="mb-0">20</h6>
                            <small class="opacity-75">Stok Menipis</small>
                        </div>
                        <div>
                            <h6 class="mb-0">8</h6>
                            <small class="opacity-75">Petugas Aktif</small>
                        </div>
                        <div>
                            <h6 class="mb-0">98%</h6>
                            <small class="opacity-75">Kelengkapan Data</small>
                        </div>
                    </div>
                </div>

                <div class="mt-4 mt-md-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/3275/3275970.png" alt="Gudang Icon" class="img-fluid"
                        style="width: 120px; opacity: 0.9;">
                </div>
            </div>
        </div>

        <!-- 🔹 TABLE SECTION -->
        <section class="section mt-4">
            <div class="card shadow border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center px-4 py-3">
                    <h5 class="card-title mb-0 fw-semibold text-dark">
                        <i class="bi bi-box-seam me-2 text-success"></i> Daftar Petugas Gudang
                    </h5>
                    <button class="btn btn-success btn-sm rounded-pill shadow-sm fw-semibold" data-bs-toggle="modal"
                        data-bs-target="#modalTambahGudang">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Petugas
                    </button>
                </div>

                <div class="card-body px-4 pb-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-hover modern-table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($gudangs as $i => $gudang)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <img src="{{ $gudang->profile_image ? asset('storage/' . $gudang->profile_image) : asset('assets/img/default-avatar.png') }}"
                                                alt="Foto Profil" class="rounded-3 shadow-sm"
                                                style="width: 45px; height: 60px; object-fit: cover; border: 1px solid #ddd;">
                                        </td>
                                        <td>{{ $gudang->person->name ?? '-' }}</td>
                                        <td>{{ $gudang->user->email ?? '-' }}</td>
                                        <td>
                                            @if ($gudang->status == 'aktif')
                                                <span class="badge rounded-pill bg-soft-success text-success">Aktif</span>
                                            @else
                                                <span class="badge rounded-pill bg-soft-danger text-danger">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-light-info me-1" data-bs-toggle="modal"
                                                data-bs-target="#modalDetailGudang{{ $gudang->id }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-light-primary me-1" data-bs-toggle="modal"
                                                data-bs-target="#modalEditGudang{{ $gudang->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-light-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalHapusGudang{{ $gudang->id }}">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- 🔹 Modal Hapus -->
                                    <div class="modal fade" id="modalHapusGudang{{ $gudang->id }}" tabindex="-1"
                                        aria-labelledby="modalHapusGudangLabel{{ $gudang->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4 border-0 shadow">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title text-danger fw-semibold">
                                                        <i class="bi bi-exclamation-triangle me-2"></i>Hapus Data
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p class="mb-2">Apakah kamu yakin ingin menghapus petugas:</p>
                                                    <h6 class="fw-bold text-dark">“{{ $gudang->person->name ?? '-' }}”
                                                    </h6>
                                                    <p class="text-muted small mb-0">Data yang dihapus tidak dapat
                                                        dikembalikan.</p>
                                                </div>
                                                <div class="modal-footer border-0 justify-content-center">
                                                    <button type="button" class="btn btn-light-secondary rounded-pill px-4"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('gudang.destroy', $gudang->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                                                            <i class="bi bi-trash3 me-1"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">
                                            Belum ada data petugas gudang.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @foreach ($gudangs as $gudang)
                <!-- 🔹 Modal Tambah Gudang -->
                <div class="modal fade" id="modalTambahGudang" tabindex="-1" aria-labelledby="modalTambahGudangLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-4 border-0 shadow">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-semibold text-primary">
                                    <i class="bi bi-person-plus me-2"></i>Tambah Petugas Gudang
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form action="{{ route('gudang.store') }}" method="POST" id="formTambahGudang"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body pt-2">
                                    <div class="row g-3">

                                        <!-- 🔹 Data Pribadi -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Nama Lengkap</label>
                                            <input type="text" class="form-control modern-input" name="name"
                                                placeholder="Masukkan nama lengkap" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                                            <select class="form-select modern-input" name="sex" required>
                                                <option value="">Pilih jenis kelamin</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Tempat Lahir</label>
                                            <input type="text" class="form-control modern-input" name="pob"
                                                placeholder="Masukkan tempat lahir" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                                            <input type="date" class="form-control modern-input" name="dob"
                                                required>
                                        </div>

                                        <!-- 🔹 Akun User -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Username</label>
                                            <input type="text" class="form-control modern-input" name="username"
                                                placeholder="Masukkan username" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Email</label>
                                            <input type="email" class="form-control modern-input" name="email"
                                                placeholder="contoh@perusahaan.com">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Password</label>
                                            <input type="password" class="form-control modern-input" name="password"
                                                placeholder="Masukkan password" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                                            <input type="password" class="form-control modern-input"
                                                name="password_confirmation" placeholder="Konfirmasi password" required>
                                        </div>

                                        <!-- 🔹 Data Gudang -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Kode Gudang</label>
                                            <input type="text" class="form-control modern-input" name="warehouse_code"
                                                placeholder="Masukkan kode gudang (opsional)">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Posisi / Jabatan</label>
                                            <input type="text" class="form-control modern-input" name="position"
                                                placeholder="Masukkan posisi/jabatan (opsional)">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Status Kepegawaian</label>
                                            <select class="form-select modern-input" name="employment_status" required>
                                                <option value="">Pilih status</option>
                                                <option value="tetap">Tetap</option>
                                                <option value="kontrak">Kontrak</option>
                                                <option value="magang">Magang</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Pendidikan Terakhir</label>
                                            <input type="text" class="form-control modern-input" name="last_education"
                                                placeholder="Contoh: SMA / S1 / D3">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Bagian Gudang</label>
                                            <input type="text" class="form-control modern-input"
                                                name="warehouse_section"
                                                placeholder="Contoh: Barang Masuk / Barang Keluar">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Shift</label>
                                            <input type="text" class="form-control modern-input" name="shift"
                                                placeholder="Contoh: Pagi / Sore / Malam">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Tanggal Mulai Kerja</label>
                                            <input type="date" class="form-control modern-input" name="start_date"
                                                required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Status Aktif</label>
                                            <select class="form-select modern-input" name="status" required>
                                                <option value="aktif">Aktif</option>
                                                <option value="non-aktif">Non-Aktif</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Foto Profil</label>
                                            <input type="file" class="form-control modern-input" name="profile_image"
                                                accept="image/*">
                                        </div>

                                    </div>
                                </div>

                                <div class="modal-footer border-0 pt-0">
                                    <button type="button" class="btn btn-light-secondary rounded-pill px-4"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                                        <i class="bi bi-save me-1"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- 🔹 Modal Edit Petugas Gudang --}}
                <div class="modal fade" id="modalEditGudang{{ $gudang->id }}" tabindex="-1"
                    aria-labelledby="modalEditGudangLabel{{ $gudang->id }}" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-4 border-0 shadow">

                            {{-- Header --}}
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-semibold text-primary">
                                    <i class="bi bi-pencil-square me-2"></i>Edit Petugas Gudang
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            {{-- Form --}}
                            <form action="{{ route('gudang.update', $gudang->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="modal-body pt-2">

                                    {{-- Foto Profil --}}
                                    <div class="text-center mb-3">
                                        <img src="{{ $gudang->profile_image ? asset('storage/' . $gudang->profile_image) : asset('assets/img/default-avatar.png') }}"
                                            alt="Foto Profil" class="passfoto mb-2"
                                            style="max-width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                                        <input type="file" name="profile_image" class="form-control mx-auto"
                                            style="max-width: 300px;">
                                        <small class="text-muted d-block mt-1">
                                            Kosongkan jika tidak ingin mengubah foto.
                                        </small>
                                    </div>

                                    {{-- Detail Form --}}
                                    <div class="row g-3">

                                        {{-- Nama Lengkap --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $gudang->person->name ?? '' }}" required>
                                        </div>

                                        {{-- Username --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Username</label>
                                            <input type="text" name="username" class="form-control"
                                                value="{{ $gudang->user->username ?? '' }}" required>
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $gudang->user->email ?? '' }}">
                                        </div>

                                        {{-- Jenis Kelamin --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                                            <select name="sex" class="form-select" required>
                                                <option value="L"
                                                    {{ $gudang->person->sex == 'L' ? 'selected' : '' }}>
                                                    Laki-laki
                                                </option>
                                                <option value="P"
                                                    {{ $gudang->person->sex == 'P' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                        </div>

                                        {{-- Tempat Lahir --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Tempat Lahir</label>
                                            <input type="text" name="pob" class="form-control"
                                                value="{{ $gudang->person->pob ?? '' }}" required>
                                        </div>

                                        {{-- Tanggal Lahir --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                                            <input type="date" name="dob" class="form-control"
                                                value="{{ $gudang->person->dob ?? '' }}" required>
                                        </div>

                                        {{-- Status Akun --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Status Akun</label>
                                            <select name="status" class="form-select" required>
                                                <option value="aktif" {{ $gudang->status == 'aktif' ? 'selected' : '' }}>
                                                    Aktif
                                                </option>
                                                <option value="non-aktif"
                                                    {{ $gudang->status == 'non-aktif' ? 'selected' : '' }}>
                                                    Nonaktif</option>
                                            </select>

                                        </div>

                                        {{-- Status Kepegawaian --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Status Kepegawaian</label>
                                            <select name="employment_status" class="form-select" required>
                                                <option value="tetap"
                                                    {{ $gudang->employment_status == 'tetap' ? 'selected' : '' }}>
                                                    Tetap</option>
                                                <option value="kontrak"
                                                    {{ $gudang->employment_status == 'kontrak' ? 'selected' : '' }}>
                                                    Kontrak</option>
                                                <option value="magang"
                                                    {{ $gudang->employment_status == 'magang' ? 'selected' : '' }}>
                                                    Magang</option>
                                            </select>
                                        </div>

                                        {{-- Shift --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Shift</label>
                                            <input type="text" name="shift" class="form-control"
                                                value="{{ $gudang->shift ?? '' }}">
                                        </div>

                                        {{-- Bagian Gudang --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Bagian Gudang</label>
                                            <input type="text" name="warehouse_section" class="form-control"
                                                value="{{ $gudang->warehouse_section ?? '' }}">
                                        </div>

                                        {{-- Pendidikan Terakhir --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Pendidikan Terakhir</label>
                                            <input type="text" name="last_education" class="form-control"
                                                value="{{ $gudang->last_education ?? '' }}">
                                        </div>

                                        {{-- Tanggal Mulai Kerja --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Tanggal Mulai Kerja</label>
                                            <input type="date" name="start_date" class="form-control"
                                                value="{{ $gudang->start_date ?? '' }}" required>
                                        </div>

                                    </div>
                                </div>

                                {{-- Footer --}}
                                <div class="modal-footer border-0 pt-0">
                                    <button type="button" class="btn btn-light-secondary rounded-pill px-4"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-warning rounded-pill px-4">
                                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                {{-- 🔹 Modal Detail Petugas Gudang --}}
                <div class="modal fade" id="modalDetailGudang{{ $gudang->id }}" tabindex="-1"
                    aria-labelledby="modalDetailGudangLabel{{ $gudang->id }}" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-4 border-0 shadow">

                            {{-- Header --}}
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-semibold text-primary">
                                    <i class="bi bi-person-badge me-2"></i>Detail Petugas Gudang
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            {{-- Body --}}
                            <div class="modal-body pt-3">
                                {{-- Foto Profil --}}
                                <div class="text-center mb-4">
                                    <img src="{{ $gudang->profile_image ? asset('storage/' . $gudang->profile_image) : asset('assets/img/default-avatar.png') }}"
                                        alt="Foto Profil" class="shadow-sm"
                                        style="max-width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                                    <h5 class="mt-3 fw-bold text-dark mb-0">
                                        {{ $gudang->person->name ?? 'Nama tidak tersedia' }}
                                    </h5>
                                    <small class="text-muted">
                                        {{ ucfirst($gudang->employment_status ?? '-') }} •
                                        {{ ucfirst($gudang->status ?? '-') }}
                                    </small>
                                </div>

                                {{-- Informasi Detail --}}
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-secondary">Username</label>
                                        <p class="form-control-plaintext">{{ $gudang->user->username ?? '-' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="fw-semibold text-secondary">Email</label>
                                        <p class="form-control-plaintext">{{ $gudang->user->email ?? '-' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="fw-semibold text-secondary">Jenis Kelamin</label>
                                        <p class="form-control-plaintext">
                                            {{ $gudang->person->sex == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="fw-semibold text-secondary">Tempat, Tanggal Lahir</label>
                                        <p class="form-control-plaintext">
                                            {{ $gudang->person->pob ?? '-' }},
                                            {{ $gudang->person->dob ? \Carbon\Carbon::parse($gudang->person->dob)->translatedFormat('d F Y') : '-' }}
                                        </p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="fw-semibold text-secondary">Status Kepegawaian</label>
                                        <p class="form-control-plaintext">{{ ucfirst($gudang->employment_status ?? '-') }}
                                        </p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="fw-semibold text-secondary">Pendidikan Terakhir</label>
                                        <p class="form-control-plaintext">{{ $gudang->last_education ?? '-' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="fw-semibold text-secondary">Bagian Gudang</label>
                                        <p class="form-control-plaintext">{{ $gudang->warehouse_section ?? '-' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="fw-semibold text-secondary">Shift</label>
                                        <p class="form-control-plaintext">{{ $gudang->shift ?? '-' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="fw-semibold text-secondary">Tanggal Mulai Kerja</label>
                                        <p class="form-control-plaintext">
                                            {{ $gudang->start_date ? \Carbon\Carbon::parse($gudang->start_date)->translatedFormat('d F Y') : '-' }}
                                        </p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="fw-semibold text-secondary">Status Akun</label>
                                        <p class="form-control-plaintext">
                                            <span
                                                class="badge {{ $gudang->status == 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ ucfirst($gudang->status) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-light-secondary rounded-pill px-4"
                                    data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i> Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
@endsection
