@extends('backend.master')

@section('content')
<div class="main-content">
    <div class="page-title mb-3">
        <h4 class="fw-bold text-warning">💊 Laporan Stok Obat</h4>
        <p class="text-muted">Daftar stok obat tersedia dan batas minimum</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-3">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-warning">
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Stok Minimum</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($obats as $index => $obat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $obat->nama_obat }}</td>
                    <td>{{ $obat->kategori->nama ?? '-' }}</td>
                    <td>{{ $obat->stok }}</td>
                    <td>{{ $obat->stok_minimum }}</td>
                    <td>
                        @if($obat->stok <= $obat->stok_minimum)
                            <span class="badge bg-danger">Stok Menipis</span>
                        @else
                            <span class="badge bg-success">Aman</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
