@extends('layouts.app')
@section('title', 'Edit Kategori')

@section('content')
<div class="container mt-4">
    <h1>Edit Kategori</h1>
    <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
