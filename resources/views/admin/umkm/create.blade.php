@extends('layouts.app')

@section('title', 'Tambah UMKM')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah UMKM</h1>

    {{-- Alert global error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups! Ada beberapa kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.umkm.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama UMKM</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Pemilik</label>
            <input type="text" name="pemilik" value="{{ old('pemilik') }}" class="form-control @error('pemilik') is-invalid @enderror">
            @error('pemilik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>No Telp</label>
            <input type="number" name="no_telp" value="{{ old('no_telp') }}" class="form-control @error('no_telp') is-invalid @enderror">
            @error('no_telp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Jumlah Karyawan</label>
            <input type="number" name="jumlah_karyawan" value="{{ old('jumlah_karyawan') }}" class="form-control @error('jumlah_karyawan') is-invalid @enderror" min="0">
            @error('jumlah_karyawan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Daerah</label>
            <select name="daerah_id" class="form-control @error('daerah_id') is-invalid @enderror" required>
                <option value="">-- Pilih Daerah --</option>
                @foreach ($daerahs as $daerah)
                    <option value="{{ $daerah->id }}" {{ old('daerah_id') == $daerah->id ? 'selected' : '' }}>
                        {{ $daerah->nama }}
                    </option>
                @endforeach
            </select>
            @error('daerah_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Sektor</label>
            <select name="sektor_id" class="form-control @error('sektor_id') is-invalid @enderror" required>
                <option value="">-- Pilih Sektor --</option>
                @foreach ($sektors as $sektor)
                    <option value="{{ $sektor->id }}" {{ old('sektor_id') == $sektor->id ? 'selected' : '' }}>
                        {{ $sektor->nama }}
                    </option>
                @endforeach
            </select>
            @error('sektor_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
