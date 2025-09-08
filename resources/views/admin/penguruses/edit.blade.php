@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pengurus</h1>
    <form action="{{ route('admin.penguruses.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $pengurus->nama) }}">
        </div>
        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $pengurus->jabatan) }}">
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $pengurus->deskripsi) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
            @if($pengurus->gambar)
                <img src="{{ asset('storage/'.$pengurus->gambar) }}" width="100" class="mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
