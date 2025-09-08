@extends('layouts.app')

@section('title', $umkm->nama)

@section('content')
<div class="container">
    <h1>{{ $umkm->nama }}</h1>
    <p><strong>Pemilik:</strong> {{ $umkm->pemilik ?? '-' }}</p>
    <p><strong>Alamat:</strong> {{ $umkm->alamat ?? '-' }}</p>
    <p><strong>Kategori:</strong> {{ $umkm->kategori->nama }}</p>
    <p><strong>Daerah:</strong> {{ $umkm->daerah->nama }}</p>

    <a href="{{ route('umkm.index') }}" class="btn btn-secondary">← Kembali</a>
</div>
@endsection
