@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="container mt-4">
    <h1>Edit Berita</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $news->judul) }}">
            @error('judul')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5">{{ old('deskripsi', $news->deskripsi) }}</textarea>
            @error('deskripsi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" id="penulis" class="form-control" value="{{ old('penulis', $news->penulis) }}">
            @error('penulis')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            @if($news->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $news->gambar) }}" width="120" alt="Gambar Berita">
                </div>
            @endif
            <input type="file" name="gambar" id="gambar" class="form-control">
            @error('gambar')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
