@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                @if($mainNews->gambar)
                    <img src="{{ asset('storage/' . $mainNews->gambar) }}" 
                        class="card-img-top"
                        alt="{{ $mainNews->judul }}"
                        style="height: 350px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                @endif
                <div class="card-body">
                    <h2 class="fw-bold mb-3">{{ $mainNews->judul }}</h2>
                    <p class="text-muted mb-4">
                        <small>{{ $mainNews->created_at->format('d M Y') }} | {{ $mainNews->penulis }}</small>
                    </p>
                    <p class="card-text" style="white-space: pre-line;">
                        {!! nl2br(e($mainNews->deskripsi)) !!}
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('noauth.news.index') }}" class="btn btn-secondary">
                            ← Kembali ke Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
