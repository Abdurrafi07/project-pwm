@extends('layouts.app')
@section('title', 'History Lowongan')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">History Lowongan</h1>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-secondary">
                    <tr>
                        <th>Judul</th>
                        <th>Perusahaan</th>
                        <th>Lokasi</th>
                        <th>No HP/WA</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowongans as $l)
                    <tr>
                        <td>{{ $l->judul }}</td>
                        <td>{{ $l->perusahaan }}</td>
                        <td>{{ $l->lokasi }}</td>
                        <td>{{ $l->no_hp }}</td>
                        <td>{{ $l->tanggal_mulai?->format('d-m-Y H:i') }}</td>
                        <td>{{ $l->tanggal_akhir?->format('d-m-Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada lowongan yang sudah berakhir</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $lowongans->links() }}
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.lowongan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
