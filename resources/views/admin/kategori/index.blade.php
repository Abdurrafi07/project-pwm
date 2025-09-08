@extends('layouts.app')
@section('title', 'Kategori')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Daftar Kategori</h1>

    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Kategori
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
            @foreach($kategoris as $key => $kategori)
            <tr>
                <td>{{ $loop->iteration + ($kategoris->currentPage()-1)*$kategoris->perPage() }}</td>
                <td>{{ $kategori->nama }}</td>
                <td>{{ $kategori->deskripsi }}</td>
                <td>{{ $kategori->umkms_count }}</td>
                <td>
                    <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $kategoris->links() }}
</div>
@endsection
