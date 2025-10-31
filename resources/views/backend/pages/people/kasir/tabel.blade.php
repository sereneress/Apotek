@extends('backend.master')

@section('content')
    <div class="main-content">

        <!-- ===== PAGE HEADER ===== -->
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Kasir</h3>
                    <p class="text-subtitle text-muted">Kelola data petugas kasir dengan mudah dan efisien.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kasir</li>
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

        <!-- ===== TABEL DATA KASIR ===== -->
        <section class="section mt-4">
            <div class="card shadow border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center px-4 py-3">
                    <h5 class="card-title mb-0 fw-semibold text-dark">
                        <i class="bi bi-person-vcard me-2 text-success"></i> Daftar Kasir
                    </h5>
                    <button class="btn btn-success btn-sm rounded-pill shadow-sm fw-semibold" data-bs-toggle="modal"
                        data-bs-target="#modalTambahKasir">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Kasir
                    </button>
                </div>

                <div class="card-body px-4 pb-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-hover modern-table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kasirs as $i => $kasir)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $kasir->person->name ?? '-' }}</td>
                                        <td>{{ $kasir->user->email ?? '-' }}</td>
                                        <td>{{ $kasir->person->phone ?? '-' }}</td>
                                        <td>
                                            @if ($kasir->status === 'aktif')
                                                <span class="badge rounded-pill bg-soft-success text-success">Aktif</span>
                                            @else
                                                <span class="badge rounded-pill bg-soft-danger text-danger">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-light-info me-1" data-bs-toggle="modal"
                                                data-bs-target="#modalDetailKasir{{ $kasir->id }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-light-primary me-1" data-bs-toggle="modal"
                                                data-bs-target="#modalEditKasir{{ $kasir->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-light-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalHapusKasir{{ $kasir->id }}">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- ===== Modal Detail Kasir ===== -->
                                    <div class="modal fade" id="modalDetailKasir{{ $kasir->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content rounded-4 border-0 shadow">
                                                <div class="modal-header border-0 pb-0">
                                                    <h5 class="modal-title fw-semibold text-info">
                                                        <i class="bi bi-eye me-2"></i>Detail Kasir
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body pt-2">
                                                    <div class="row g-3">

                                                        <!-- 🔹 People Info -->
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Nama Lengkap</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $kasir->person->name ?? '-' }}" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $kasir->person->sex == 'L' ? 'Laki-laki' : ($kasir->person->sex == 'P' ? 'Perempuan' : '-') }}"
                                                                readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Tempat Lahir</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $kasir->person->pob ?? '-' }}" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $kasir->person->dob ?? '-' }}" readonly>
                                                        </div>

                                                        <!-- 🔹 User Info -->
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Username</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $kasir->user->username ?? '-' }}" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Email</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $kasir->user->email ?? '-' }}" readonly>
                                                        </div>

                                                        <!-- 🔹 Kasir Info -->
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Tanggal Mulai
                                                                Kerja</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $kasir->start_date ?? '-' }}" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Status
                                                                Kepegawaian</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ ucfirst($kasir->employment_status ?? '-') }}"
                                                                readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Pendidikan
                                                                Terakhir</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $kasir->last_education ?? '-' }}" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Shift</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $kasir->shift ?? '-' }}" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Status</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ ucfirst($kasir->status ?? '-') }}" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Foto Profil</label>
                                                            <div>
                                                                @if ($kasir->profile_image)
                                                                    <img src="{{ asset('storage/' . $kasir->profile_image) }}"
                                                                        alt="Foto Kasir" class="img-fluid rounded"
                                                                        style="max-height: 120px;">
                                                                @else
                                                                    <span class="text-muted">Tidak ada foto</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold">Alamat</label>
                                                            <textarea class="form-control" rows="2" readonly>{{ $kasir->person->address ?? '-' }}</textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <button type="button"
                                                        class="btn btn-light-secondary rounded-pill px-4"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- ===== Modal Edit Kasir ===== -->
                                    <div class="modal fade" id="modalEditKasir{{ $kasir->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content rounded-4 border-0 shadow">
                                                <div class="modal-header border-0 pb-0">
                                                    <h5 class="modal-title fw-semibold text-primary">
                                                        <i class="bi bi-pencil-square me-2"></i>Edit Kasir
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body pt-2">
                                                    <form action="{{ route('kasir.update', $kasir->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row g-3">

                                                            <!-- 🔹 People Info -->
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $kasir->person->name ?? '' }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Jenis Kelamin</label>
                                                                <select name="sex" class="form-select">
                                                                    <option value="L"
                                                                        {{ ($kasir->person->sex ?? '') == 'L' ? 'selected' : '' }}>
                                                                        Laki-laki</option>
                                                                    <option value="P"
                                                                        {{ ($kasir->person->sex ?? '') == 'P' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Tempat Lahir</label>
                                                                <input type="text" class="form-control" name="pob"
                                                                    value="{{ $kasir->person->pob ?? '' }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Tanggal Lahir</label>
                                                                <input type="date" class="form-control" name="dob"
                                                                    value="{{ $kasir->person->dob ?? '' }}">
                                                            </div>

                                                            <!-- 🔹 User Info -->
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Username</label>
                                                                <input type="text" class="form-control"
                                                                    name="username"
                                                                    value="{{ $kasir->user->username ?? '' }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Email</label>
                                                                <input type="email" class="form-control" name="email"
                                                                    value="{{ $kasir->user->email ?? '' }}">
                                                            </div>

                                                            <!-- 🔹 Kasir Info -->
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Tanggal Mulai
                                                                    Kerja</label>
                                                                <input type="date" class="form-control"
                                                                    name="start_date"
                                                                    value="{{ $kasir->start_date ?? '' }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Status
                                                                    Kepegawaian</label>
                                                                <select name="employment_status" class="form-select">
                                                                    <option value="tetap"
                                                                        {{ ($kasir->employment_status ?? '') == 'tetap' ? 'selected' : '' }}>
                                                                        Tetap</option>
                                                                    <option value="kontrak"
                                                                        {{ ($kasir->employment_status ?? '') == 'kontrak' ? 'selected' : '' }}>
                                                                        Kontrak</option>
                                                                    <option value="magang"
                                                                        {{ ($kasir->employment_status ?? '') == 'magang' ? 'selected' : '' }}>
                                                                        Magang</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Pendidikan
                                                                    Terakhir</label>
                                                                <input type="text" class="form-control"
                                                                    name="last_education"
                                                                    value="{{ $kasir->last_education ?? '' }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Shift</label>
                                                                <input type="text" class="form-control" name="shift"
                                                                    value="{{ $kasir->shift ?? '' }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Status</label>
                                                                <select name="status" class="form-select">
                                                                    <option value="aktif"
                                                                        {{ ($kasir->status ?? '') == 'aktif' ? 'selected' : '' }}>
                                                                        Aktif</option>
                                                                    <option value="nonaktif"
                                                                        {{ ($kasir->status ?? '') == 'nonaktif' ? 'selected' : '' }}>
                                                                        Nonaktif</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold">Foto Profil</label>
                                                                <input type="file" class="form-control"
                                                                    name="profile_image" accept="image/*">
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer border-0 pt-0">
                                                            <button type="button"
                                                                class="btn btn-light-secondary rounded-pill px-4"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-primary rounded-pill px-4">
                                                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- ===== Modal Hapus Kasir ===== -->
                                    <div class="modal fade" id="modalHapusKasir{{ $kasir->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4 border-0 shadow">
                                                <div class="modal-header border-0 pb-0">
                                                    <h5 class="modal-title fw-semibold text-danger">
                                                        <i class="bi bi-exclamation-triangle me-2"></i>Hapus Kasir
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p class="mb-2">Apakah kamu yakin ingin menghapus kasir:</p>
                                                    <h6 class="fw-bold text-dark">“{{ $kasir->person->name ?? '-' }}”</h6>
                                                    <p class="text-muted small mb-0">Data yang dihapus tidak dapat
                                                        dikembalikan.</p>
                                                </div>
                                                <div class="modal-footer border-0 justify-content-center">
                                                    <button type="button"
                                                        class="btn btn-light-secondary rounded-pill px-4"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('kasir.destroy', $kasir->id) }}"
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== Modal Tambah Kasir ===== -->
        <div class="modal fade" id="modalTambahKasir" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content rounded-4 border-0 shadow">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-semibold text-success">
                            <i class="bi bi-person-plus me-2"></i>Tambah Kasir
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-2">
                        <form action="{{ route('kasir.store') }}" method="POST" enctype="multipart/form-data"
                            id="formTambahKasir">
                            @csrf
                            <div class="row g-3">

                                <!-- 🔹 People Info -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Jenis Kelamin</label>
                                    <select name="sex" class="form-select" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="pob"
                                        placeholder="Contoh: Jakarta" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="dob" required>
                                </div>

                                <!-- 🔹 User Info -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Username</label>
                                    <input type="text" class="form-control" name="username"
                                        placeholder="Masukkan username" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Masukkan email">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Password</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Masukkan password" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Konfirmasi password" required>
                                </div>

                                <!-- 🔹 Kasir Info -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Tanggal Mulai Kerja</label>
                                    <input type="date" class="form-control" name="start_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Status Kepegawaian</label>
                                    <select name="employment_status" class="form-select" required>
                                        <option value="tetap">Tetap</option>
                                        <option value="kontrak">Kontrak</option>
                                        <option value="magang">Magang</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" name="last_education"
                                        placeholder="Contoh: S1 Farmasi">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Shift</label>
                                    <input type="text" class="form-control" name="shift"
                                        placeholder="Contoh: Pagi / Malam">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="aktif">Aktif</option>
                                        <option value="non-aktif">Nonaktif</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Foto Profil</label>
                                    <input type="file" class="form-control" name="profile_image" accept="image/*">
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
        </div>


    </div>
@endsection
