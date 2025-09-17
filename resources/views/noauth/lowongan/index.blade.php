@extends('layouts.app')
@section('title', 'Lowongan Tersedia')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Lowongan Tersedia</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($lowongans as $l)
        <div class="border p-4 rounded shadow">
            @if($l->gambar)
                <div class="mb-2 flex justify-center">
                    <img src="{{ asset('storage/'.$l->gambar) }}"
                        alt="{{ $l->judul }}"
                        style="width:5cm; height:5cm; object-fit:contain;"
                        class="rounded border">
                </div>
            @endif
            <h2 class="text-lg font-semibold">{{ $l->judul }}</h2>
            <p class="text-sm text-gray-600">{{ $l->perusahaan }}</p>
            <p class="text-sm">Lokasi: {{ $l->lokasi }}</p>
            <p class="text-sm">Kontak: <a href="https://wa.me/{{ $l->no_hp }}" class="text-green-600">{{ $l->no_hp }}</a></p>
            <a href="{{ route('noauth.lowongan.show',$l) }}" class="text-blue-500">Detail</a>
        </div>
        @endforeach
    </div>
    {{ $lowongans->links() }}
</div>
@endsection