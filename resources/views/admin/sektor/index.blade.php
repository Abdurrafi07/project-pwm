@extends('layouts.app')
@section('title', 'sektor')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Daftar sektor</h1>

    <a href="{{ route('admin.sektor.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah sektor
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Jumlah UMKM</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sektors as $key => $sektor)
            <tr>
                <td>{{ $sektor->id }}</td>
                <td>{{ $sektor->nama }}</td>
                <td>{{ $sektor->deskripsi }}</td>
                <td>{{ $sektor->umkms_count }}</td>
                <td>
                    <a href="{{ route('admin.sektor.edit', $sektor) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.sektor.destroy', $sektor) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus sektor ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sektors->withQueryString()->links('layouts.pagination') }}
</div>
@endsection
