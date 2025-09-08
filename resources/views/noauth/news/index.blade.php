{{-- resources/views/noauth/news/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        {{-- Kolom Kiri: Berita Utama --}}
        <div class="col-lg-8 mb-4">
            @if($news->isNotEmpty())
                @php
                    $mainNews = $news->first();
                @endphp
                <div class="card shadow-lg border-0">
                    @if($mainNews->gambar)
                        <img src="{{ asset('storage/' . $mainNews->gambar) }}" 
                            class="card-img-top"
                            alt="{{ $mainNews->judul }}"
                            style="height: 350px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            {{ $mainNews->judul }}
                        </h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($mainNews->deskripsi, 150, '...') }}
                        </p>
                        <small class="text-secondary">
                            {{ $mainNews->created_at->format('d M Y') }} | {{ $mainNews->penulis }}
                        </small>
                        <div class="mt-3">
                            <a href="{{ route('noauth.news.show', $mainNews->id) }}" class="btn btn-primary">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Kolom Kanan: Daftar Berita Lainnya --}}
        <div class="col-lg-4">
            <div class="list-group shadow-sm">
                @foreach($news->skip(1) as $item)
                    <a href="{{ route('noauth.news.show', $item->id) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" 
                                    class="rounded me-3" 
                                    alt="{{ $item->judul }}" 
                                    style="width: 80px; height: 60px; object-fit: cover;">
                            @endif
                            <div>
                                <h6 class="mb-1 fw-semibold">
                                    {{ Str::limit($item->judul, 50, '...') }}
                                </h6>
                                <small class="text-muted">
                                    {{ $item->created_at->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection