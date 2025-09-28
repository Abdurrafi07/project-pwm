@extends('layouts.app')
@section('title', 'Lowongan Tersedia')

@section('content')
<div class="p-6">
    <!-- Search -->
    <input type="text" name="q" id="searchInput" value="{{ request('q') }}" 
           class="form-control mb-4" placeholder="Cari judul lowongan...">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1 class="text-xl font-bold mb-4">Lowongan Tersedia</h1>

    <!-- Wrapper -->
    <div id="lowonganWrapper">
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
                <p class="text-sm">Kontak: 
                    <a href="https://wa.me/{{ $l->no_hp }}" class="text-green-600">{{ $l->no_hp }}</a>
                </p>
                <a href="{{ route('noauth.lowongan.show',$l) }}" class="text-blue-500">Detail</a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div id="paginationLinks" class="mt-4">
        {{ $lowongans->withQueryString()->links() }}
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let timer = null;

// Live search
$('#searchInput').on('input', function() {
    clearTimeout(timer);
    let keyword = $(this).val();

    timer = setTimeout(() => {
        $.get("{{ route('noauth.lowongan.index') }}", keyword ? { q: keyword } : {}, function(data) {
            $('#lowonganWrapper').html($(data).find('#lowonganWrapper').html());
            $('#paginationLinks').html($(data).find('#paginationLinks').html());
        });
    }, 300);
});

// Pagination via AJAX
$(document).on('click', '#paginationLinks .pagination a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    $.get(url, function(data) {
        $('#lowonganWrapper').html($(data).find('#lowonganWrapper').html());
        $('#paginationLinks').html($(data).find('#paginationLinks').html());
    });
});
</script>
@endsection
