@extends('layouts.app')

@section('title', 'Pengurus')

@section('content')
<div class="container py-5">

    @if($penguruses->count() > 0)
        @php
            $main = $penguruses->first();
            $others = $penguruses->slice(1);
        @endphp

        <!-- Pengurus Utama -->
        <div class="row mb-5 align-items-center" style="background-color: #1E3A8A; color: #fff; border-radius: 10px; padding: 30px;">
            <div class="col-md-8">
                <h2 style="color:#A3FF00;">{{ $main->nama }}</h2>
                <h5>{{ $main->jabatan }}</h5>
                <p style="color: #fff;">{{ $main->deskripsi }}</p>
            </div>
            <div class="col-md-4 text-center">
                @if($main->gambar)
                    <img src="{{ asset('storage/' . $main->gambar) }}" alt="{{ $main->nama }}" class="img-fluid rounded" style="max-height: 300px;">
                @endif
            </div>
        </div>

        <!-- Pengurus Lain -->
        <div class="row text-center">
            @foreach($others as $pengurus)
                <div class="col-6 col-sm-4 col-md-2 mb-4">
                    <div class="card border-0">
                        @if($pengurus->gambar)
                            <img src="{{ asset('storage/' . $pengurus->gambar) }}" alt="{{ $pengurus->nama }}" class="rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
                        @endif
                        <h6 class="card-title">{{ $pengurus->nama }}</h6>
                        <small class="text-muted">{{ $pengurus->jabatan }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Tidak ada pengurus untuk ditampilkan.</p>
    @endif

</div>
@endsection
