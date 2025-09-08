@extends('layouts.app')

@section('title', 'Edit UMKM')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit UMKM</h1>

    <form action="{{ route('admin.umkm.update', $umkm) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama UMKM</label>
            <input type="text" name="nama" class="form-control" value="{{ $umkm->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Pemilik</label>
            <input type="text" name="pemilik" class="form-control" value="{{ $umkm->pemilik }}">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ $umkm->alamat }}</textarea>
        </div>

        <div class="mb-3">
            <label>No Telp</label>
            <input type="text" name="no_telp" class="form-control" value="{{ $umkm->no_telp }}">
        </div>

        <div class="mb-3">
            <label>Jumlah Karyawan</label>
            <input type="number" name="jumlah_karyawan" class="form-control" min="0" value="{{ $umkm->jumlah_karyawan }}">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $umkm->kategori_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Daerah</label>
            <select name="daerah_id" class="form-control" required>
                @foreach ($daerahs as $daerah)
                    <option value="{{ $daerah->id }}" {{ $umkm->daerah_id == $daerah->id ? 'selected' : '' }}>
                        {{ $daerah->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Sektor</label>
            <select name="sektor_id" class="form-control" required>
                @foreach ($sektors as $sektor)
                    <option value="{{ $sektor->id }}" {{ $umkm->sektor_id == $sektor->id ? 'selected' : '' }}>
                        {{ $sektor->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
