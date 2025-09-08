@extends('layouts.app')

@section('title', 'Tambah UMKM')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah UMKM</h1>

    <form action="{{ route('admin.umkm.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama UMKM</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pemilik</label>
            <input type="text" name="pemilik" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>No Telp</label>
            <input type="text" name="no_telp" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jumlah Karyawan</label>
            <input type="number" name="jumlah_karyawan" class="form-control" min="0">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Daerah</label>
            <select name="daerah_id" class="form-control" required>
                <option value="">-- Pilih Daerah --</option>
                @foreach ($daerahs as $daerah)
                    <option value="{{ $daerah->id }}">{{ $daerah->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Sektor</label>
            <select name="sektor_id" class="form-control" required>
                <option value="">-- Pilih Sektor --</option>
                @foreach ($sektors as $sektor)
                    <option value="{{ $sektor->id }}">{{ $sektor->nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
