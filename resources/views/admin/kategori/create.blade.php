@extends('layouts.app')
@section('title', 'Tambah Kategori')

@section('content')
<div class="container mt-4">
    <h1>Tambah Kategori</h1>
    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
