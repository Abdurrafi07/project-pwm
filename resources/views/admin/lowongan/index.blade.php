@extends('layouts.app')
@section('title', 'Lowongan')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Daftar Lowongan</h1>

    <a href="{{ route('admin.lowongan.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Lowongan
    </a>

    <a href="{{ route('admin.lowongan.history') }}" class="btn btn-outline-secondary mb-3 ms-2">
    <i class="fas fa-history"></i> History
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Perusahaan</th>
                <th>Lokasi</th>
                <th>No HP/WA</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Akhir</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lowongans as $l)
            <tr>
                <td>{{ $loop->iteration + ($lowongans->currentPage()-1)*$lowongans->perPage() }}</td>
                <td>{{ $l->judul }}</td>
                <td>{{ $l->perusahaan }}</td>
                <td>{{ $l->lokasi }}</td>
                <td>{{ $l->no_hp }}</td>
                <td>{{ $l->tanggal_mulai?->format('d-m-Y H:i') }}</td>
                <td>{{ $l->tanggal_akhir?->format('d-m-Y H:i') }}</td>
                <td>
                    @if($l->isExpired())
                        <span class="badge bg-danger">Expired</span>
                    @else
                        <span class="badge bg-success">Aktif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.lowongan.edit', $l) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.lowongan.destroy', $l) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus lowongan ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $lowongans->links() }}
</div>
@endsection
