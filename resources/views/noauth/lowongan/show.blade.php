@extends('layouts.app')

@section('title', $lowongan->judul)

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $lowongan->judul }}</h1>

        @if($lowongan->gambar)
            <div class="mb-4 flex justify-center">
                <img src="{{ asset('storage/'.$lowongan->gambar) }}"
                    alt="{{ $lowongan->judul }}"
                    style="width:5cm; height:5cm; object-fit:contain;"
                    class="rounded border shadow">
            </div>
        @endif

        <p class="text-gray-700 mb-4">{{ $lowongan->deskripsi }}</p>

        <div class="mb-4">
            <p><strong>Perusahaan:</strong> {{ $lowongan->perusahaan }}</p>
            <p><strong>Lokasi:</strong> {{ $lowongan->lokasi ?? '-' }}</p>
            <p><strong>No HP:</strong> {{ $lowongan->no_hp ?? '-' }}</p>
            <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($lowongan->tanggal_mulai)->format('d M Y') }}</p>
            <p><strong>Tanggal Akhir:</strong> {{ \Carbon\Carbon::parse($lowongan->tanggal_akhir)->format('d M Y') }}</p>
        </div>

        <a href="{{ route('noauth.lowongan.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            ← Kembali ke daftar lowongan
        </a>
    </div>
</div>
@endsection
