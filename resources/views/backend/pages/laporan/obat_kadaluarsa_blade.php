@extends('backend.master')

@section('content')
<div class="main-content">
    <div class="page-title mb-3">
        <h4 class="fw-bold text-danger">⚠️ Laporan Obat Kadaluarsa</h4>
        <p class="text-muted">Daftar obat yang mendekati atau sudah kadaluarsa</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-3">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-danger">
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Sisa Hari</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kadaluarsa as $index => $obat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $obat->nama_obat }}</td>
                    <td>{{ $obat->tanggal_kadaluarsa->format('d M Y') }}</td>
                    <td>
                        {{ now()->diffInDays($obat->tanggal_kadaluarsa, false) }} hari
                    </td>
                    <td>
                        @if($obat->tanggal_kadaluarsa < now())
                            <span class="badge bg-danger">Kadaluarsa</span>
                        @elseif($obat->tanggal_kadaluarsa->diffInDays(now()) <= 30)
                            <span class="badge bg-warning text-dark">Segera Kadaluarsa</span>
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
