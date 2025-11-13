@extends('backend.master')

@section('content')
    <div class="main-content">
        {{-- ✅ Alert sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ✅ Judul Halaman --}}
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Apoteker</h3>
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

        {{-- ✅ Card Statistik --}}
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

        {{-- ✅ Tabel Data Apoteker --}}
        <section class="section mt-4">
            <div class="card shadow border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center px-4 py-3">
                    <h5 class="card-title mb-0 fw-semibold text-dark">
                        <i class="bi bi-person-vcard me-2 text-success"></i> Daftar Apoteker
                    </h5>
                    <button class="btn btn-success btn-sm rounded-pill shadow-sm fw-semibold" data-bs-toggle="modal"
                        data-bs-target="#modalTambahApoteker">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Apoteker
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
                                @forelse ($apotekers as $i => $apoteker)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>

                                        {{-- 🖼️ Gambar profil --}}
                                        <td>
                                            <img src="{{ $apoteker->profile_image
                                                ? asset('storage/' . $apoteker->profile_image)
                                                : asset('assets/img/default-avatar.png') }}"
                                                alt="Foto Profil" class="rounded-3 shadow-sm"
                                                style="width: 45px; height: 60px; object-fit: cover; border: 1px solid #ddd;">
                                        </td>

                                        {{-- Nama & Email --}}
                                        <td>{{ $apoteker->person->name ?? '-' }}</td>
                                        <td>{{ $apoteker->user->email ?? '-' }}</td>

                                        {{-- Status --}}
                                        <td>
                                            @if ($apoteker->status == 'aktif')
                                                <span class="badge rounded-pill bg-soft-success text-success">Aktif</span>
                                            @else
                                                <span class="badge rounded-pill bg-soft-danger text-danger">Nonaktif</span>
                                            @endif
                                        </td>

                                        {{-- Tombol Aksi --}}
                                        <td class="text-center">
                                            {{-- 🔹 Detail --}}
                                            <button class="btn btn-sm btn-light-info me-1" data-bs-toggle="modal"
                                                data-bs-target="#modalDetailApoteker{{ $apoteker->id }}">
                                                <i class="bi bi-eye"></i>
                                            </button>

                                            {{-- 🔹 Edit --}}
                                            <button class="btn btn-sm btn-light-primary me-1" data-bs-toggle="modal"
                                                data-bs-target="#modalEditApoteker{{ $apoteker->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            {{-- 🔹 Hapus --}}
                                            <button class="btn btn-sm btn-light-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalHapusApoteker{{ $apoteker->id }}">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">
                                            Tidak ada data apoteker
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @foreach ($apotekers as $apoteker)
                <!-- 🔹 Modal Tambah Apoteker -->
                <div class="modal fade" id="modalTambahApoteker" tabindex="-1" aria-labelledby="modalTambahApotekerLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-4 border-0 shadow">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-semibold text-success">
                                    <i class="bi bi-person-plus me-2"></i>Tambah Apoteker
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form action="{{ route('apoteker.store') }}" method="POST" id="formTambahApoteker"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body pt-2">
                                    <div class="row g-3">
                                        <!-- Person -->
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

                                        <!-- User -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Username</label>
                                            <input type="text" class="form-control modern-input" name="username"
                                                placeholder="Masukkan username" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="contoh@apotik.com">
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

                                        <!-- Apoteker -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Nomor Lisensi</label>
                                            <input type="text" class="form-control modern-input" name="license_number"
                                                placeholder="Masukkan nomor lisensi (opsional)">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Tanggal Mulai Kerja</label>
                                            <input type="date" class="form-control modern-input" name="start_date"
                                                required>
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
                                                placeholder="Masukkan pendidikan terakhir">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Status Aktif</label>
                                            <select class="form-select modern-input" name="status" required>
                                                <option value="aktif">Aktif</option>
                                                <option value="non-aktif">Non-Aktif</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Shift</label>
                                            <input type="text" class="form-control modern-input" name="shift"
                                                placeholder="Pagi/Sore/Dll">
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
                                    <button type="submit" class="btn btn-success rounded-pill px-4">
                                        <i class="bi bi-save me-1"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- 🔹 Modal Edit Apoteker --}}
                <div class="modal fade" id="modalEditApoteker{{ $apoteker->id }}" tabindex="-1"
                    aria-labelledby="modalEditApotekerLabel{{ $apoteker->id }}" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-4 border-0 shadow">

                            {{-- Header --}}
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-semibold text-primary">
                                    <i class="bi bi-pencil-square me-2"></i>Edit Apoteker
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            {{-- Form --}}
                            <form action="{{ route('apoteker.update', $apoteker->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="modal-body pt-2">

                                    {{-- Foto Profil --}}
                                    <div class="text-center mb-3">
                                        <img src="{{ $apoteker->profile_image
                                            ? asset('storage/' . $apoteker->profile_image)
                                            : asset('assets/img/default-avatar.png') }}"
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
                                                value="{{ $apoteker->person->name ?? '' }}" required>
                                        </div>

                                        {{-- Username --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Username</label>
                                            <input type="text" name="username" class="form-control"
                                                value="{{ $apoteker->user->username ?? '' }}" required>
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $apoteker->user->email ?? '' }}">
                                        </div>

                                        {{-- Jenis Kelamin --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                                            <select name="sex" class="form-select" required>
                                                <option value="L"
                                                    {{ $apoteker->person->sex == 'L' ? 'selected' : '' }}>
                                                    Laki-laki
                                                </option>
                                                <option value="P"
                                                    {{ $apoteker->person->sex == 'P' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                        </div>

                                        {{-- Tempat Lahir --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Tempat Lahir</label>
                                            <input type="text" name="pob" class="form-control"
                                                value="{{ $apoteker->person->pob ?? '' }}" required>
                                        </div>

                                        {{-- Tanggal Lahir --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                                            <input type="date" name="dob" class="form-control"
                                                value="{{ $apoteker->person->dob ?? '' }}" required>
                                        </div>

                                        {{-- Status Akun --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Status Akun</label>
                                            <select name="status" class="form-select" required>
                                                <option value="aktif"
                                                    {{ $apoteker->status == 'aktif' ? 'selected' : '' }}>
                                                    Aktif
                                                </option>
                                                <option value="nonaktif"
                                                    {{ $apoteker->status == 'nonaktif' || $apoteker->status == 'non-aktif' ? 'selected' : '' }}>
                                                    Nonaktif
                                                </option>
                                            </select>
                                        </div>

                                        {{-- Status Kepegawaian --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Status Kepegawaian</label>
                                            <select name="employment_status" class="form-select" required>
                                                <option value="Tetap"
                                                    {{ $apoteker->employment_status == 'Tetap' ? 'selected' : '' }}>
                                                    Tetap</option>
                                                <option value="Kontrak"
                                                    {{ $apoteker->employment_status == 'Kontrak' ? 'selected' : '' }}>
                                                    Kontrak</option>
                                                <option value="Magang"
                                                    {{ $apoteker->employment_status == 'Magang' ? 'selected' : '' }}>
                                                    Magang</option>
                                            </select>
                                        </div>

                                        {{-- Shift --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Shift</label>
                                            <input type="text" name="shift" class="form-control"
                                                value="{{ $apoteker->shift ?? '' }}">
                                        </div>

                                        {{-- Pendidikan Terakhir --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Pendidikan Terakhir</label>
                                            <input type="text" name="last_education" class="form-control"
                                                value="{{ $apoteker->last_education ?? '' }}">
                                        </div>

                                        {{-- Nomor Lisensi --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Nomor Lisensi</label>
                                            <input type="text" name="license_number" class="form-control"
                                                value="{{ $apoteker->license_number ?? '' }}">
                                        </div>

                                        {{-- Tanggal Mulai Kerja --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Tanggal Mulai Kerja</label>
                                            <input type="date" name="start_date" class="form-control"
                                                value="{{ $apoteker->start_date ?? '' }}" required>
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
                {{-- 🔹 Modal Detail Apoteker --}}
                <div class="modal fade" id="modalDetailApoteker{{ $apoteker->id }}" tabindex="-1"
                    aria-labelledby="modalDetailApotekerLabel{{ $apoteker->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-4 border-0 shadow">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-semibold text-info">
                                    <i class="bi bi-person-vcard me-2"></i>Detail Apoteker
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body pt-3 pb-0">
                                <div class="row g-3">
                                    <!-- 🔹 Foto Profil -->
                                    <div class="col-md-4 text-center">
                                        <div class="border rounded-4 shadow-sm d-inline-block bg-white"
                                            style="width: 120px; height: 160px; overflow: hidden;">
                                            <img src="{{ $apoteker->profile_image ? asset('storage/' . $apoteker->profile_image) : asset('assets/img/default-avatar.png') }}"
                                                alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <p class="fw-semibold mb-0 text-dark mt-2">
                                            {{ $apoteker->person->name ?? '-' }}
                                        </p>
                                        <small class="text-muted">{{ $apoteker->user->email ?? '-' }}</small>
                                    </div>

                                    <!-- 🔹 Detail Informasi -->
                                    <div class="col-md-8">
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <p class="mb-1 text-muted small">Jenis Kelamin</p>
                                                <p class="fw-semibold">
                                                    {{ $apoteker->person->sex == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-1 text-muted small">Tanggal Lahir</p>
                                                <p class="fw-semibold">
                                                    {{ $apoteker->person->dob ? \Carbon\Carbon::parse($apoteker->person->dob)->translatedFormat('d F Y') : '-' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <p class="mb-1 text-muted small">Tempat Lahir</p>
                                                <p class="fw-semibold">
                                                    {{ $apoteker->person->pob ?? '-' }}</p>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <p class="mb-1 text-muted small">Nomor Lisensi</p>
                                                <p class="fw-semibold">
                                                    {{ $apoteker->license_number ?? '-' }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-1 text-muted small">Tanggal Mulai Kerja
                                                </p>
                                                <p class="fw-semibold">
                                                    {{ $apoteker->start_date ? \Carbon\Carbon::parse($apoteker->start_date)->translatedFormat('d F Y') : '-' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <p class="mb-1 text-muted small">Pendidikan Terakhir
                                                </p>
                                                <p class="fw-semibold">
                                                    {{ $apoteker->last_education ?? '-' }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-1 text-muted small">Status Kepegawaian</p>
                                                <p class="fw-semibold text-capitalize">
                                                    {{ $apoteker->employment_status ?? '-' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <p class="mb-1 text-muted small">Shift</p>
                                                <p class="fw-semibold">{{ $apoteker->shift ?? '-' }}
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-1 text-muted small">Status Akun</p>
                                                @if ($apoteker->status == 'aktif')
                                                    <span
                                                        class="badge rounded-pill bg-soft-success text-success">Aktif</span>
                                                @else
                                                    <span
                                                        class="badge rounded-pill bg-soft-danger text-danger">Nonaktif</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div> <!-- End col-md-8 -->
                                </div> <!-- End .row -->
                            </div>

                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-light-secondary rounded-pill px-4"
                                    data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 🔹 Modal Hapus --}}
                <div class="modal fade" id="modalHapusApoteker{{ $apoteker->id }}" tabindex="-1"
                    aria-labelledby="modalHapusApotekerLabel{{ $apoteker->id }}" aria-hidden="true">
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
                                <p class="mb-2">Apakah kamu yakin ingin menghapus apoteker:</p>
                                <h6 class="fw-bold text-dark">“{{ $apoteker->person->name }}”</h6>
                                <p class="text-muted small mb-0">Data yang dihapus tidak dapat
                                    dikembalikan.</p>
                            </div>
                            <div class="modal-footer border-0 justify-content-center">
                                <button type="button" class="btn btn-light-secondary rounded-pill px-4"
                                    data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('apoteker.destroy', $apoteker->id) }}" method="POST"
                                    class="d-inline">
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
                @endforeach
        </section>
    </div>
@endsection
