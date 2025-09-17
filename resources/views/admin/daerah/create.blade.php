@extends('layouts.app')

@section('title', 'Tambah Daerah')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Daerah</h1>

    <form action="{{ route('admin.daerah.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input 
                type="text" 
                name="nama" 
                id="nama" 
                class="form-control @error('nama') is-invalid @enderror" 
                value="{{ old('nama') }}" 
                required
            >
            @error('nama') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea 
                name="deskripsi" 
                id="deskripsi" 
                class="form-control @error('deskripsi') is-invalid @enderror" 
                required
            >{{ old('deskripsi') }}</textarea>
            @error('deskripsi') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.daerah.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
