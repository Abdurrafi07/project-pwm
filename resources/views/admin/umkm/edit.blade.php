@extends('layouts.app')

@section('title', 'Edit UMKM')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit UMKM</h1>

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

    <form action="{{ route('admin.umkm.update', $umkm) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama UMKM</label>
            <input type="text" name="nama"
                   class="form-control @error('nama') is-invalid @enderror"
                   value="{{ old('nama', $umkm->nama) }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Pemilik</label>
            <input type="text" name="pemilik"
                   class="form-control @error('pemilik') is-invalid @enderror"
                   value="{{ old('pemilik', $umkm->pemilik) }}">
            @error('pemilik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat"
                      class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $umkm->alamat) }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>No Telp</label>
            <input type="number" name="no_telp"
                   class="form-control @error('no_telp') is-invalid @enderror"
                   value="{{ old('no_telp', $umkm->no_telp) }}">
            @error('no_telp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Jumlah Karyawan</label>
            <input type="number" name="jumlah_karyawan"
                   class="form-control @error('jumlah_karyawan') is-invalid @enderror"
                   min="0"
                   value="{{ old('jumlah_karyawan', $umkm->jumlah_karyawan) }}">
            @error('jumlah_karyawan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id"
                    class="form-control @error('kategori_id') is-invalid @enderror"
                    required>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ old('kategori_id', $umkm->kategori_id) == $kategori->id ? 'selected' : '' }}>
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
            <select name="daerah_id"
                    class="form-control @error('daerah_id') is-invalid @enderror"
                    required>
                @foreach ($daerahs as $daerah)
                    <option value="{{ $daerah->id }}"
                        {{ old('daerah_id', $umkm->daerah_id) == $daerah->id ? 'selected' : '' }}>
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
            <select name="sektor_id"
                    class="form-control @error('sektor_id') is-invalid @enderror"
                    required>
                @foreach ($sektors as $sektor)
                    <option value="{{ $sektor->id }}"
                        {{ old('sektor_id', $umkm->sektor_id) == $sektor->id ? 'selected' : '' }}>
                        {{ $sektor->nama }}
                    </option>
                @endforeach
            </select>
            @error('sektor_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
