@extends('layouts.app')
@section('title', 'Tambah Lowongan')

@section('content')
<div class="container mt-4">
    <h1>Tambah Lowongan</h1>
    <form action="{{ route('admin.lowongan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" 
                   name="judul" 
                   class="form-control @error('judul') is-invalid @enderror" 
                   value="{{ old('judul') }}" 
                   required>
            @error('judul') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" 
                      class="form-control @error('deskripsi') is-invalid @enderror" 
                      rows="4" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Perusahaan</label>
                <input type="text" 
                       name="perusahaan" 
                       class="form-control @error('perusahaan') is-invalid @enderror" 
                       value="{{ old('perusahaan') }}" 
                       required>
                @error('perusahaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Lokasi</label>
                <input type="text" 
                       name="lokasi" 
                       class="form-control @error('lokasi') is-invalid @enderror" 
                       value="{{ old('lokasi') }}">
                @error('lokasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">No HP/WA</label>
            <input type="text" 
                   name="no_hp" 
                   class="form-control @error('no_hp') is-invalid @enderror" 
                   value="{{ old('no_hp') }}">
            @error('no_hp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" 
                   name="gambar" 
                   class="form-control @error('gambar') is-invalid @enderror">
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="datetime-local" 
                       name="tanggal_mulai" 
                       class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                       value="{{ old('tanggal_mulai') }}" 
                       required>
                @error('tanggal_mulai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Akhir</label>
                <input type="datetime-local" 
                       name="tanggal_akhir" 
                       class="form-control @error('tanggal_akhir') is-invalid @enderror" 
                       value="{{ old('tanggal_akhir') }}" 
                       required>
                @error('tanggal_akhir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.lowongan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
