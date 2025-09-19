@extends('layouts.app')
@section('title', 'History Lowongan')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">History Lowongan</h1>

    <form method="GET" class="mb-3 d-flex" id="searchForm">
        <input type="text" name="q" id="searchInput" class="form-control me-2" placeholder="Cari judul lowongan..." value="{{ request('q') }}">
    </form>

    <div id="lowonganTable">
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Perusahaan</th>
                            <th>Lokasi</th>
                            <th>No HP/WA</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowongans as $l)
                        <tr>
                            <td>{{ $l->id }}</td> <!-- pakai ID asli -->
                            <td>{{ $l->judul }}</td>
                            <td>{{ $l->perusahaan }}</td>
                            <td>{{ $l->lokasi }}</td>
                            <td>{{ $l->no_hp }}</td>
                            <td>{{ $l->tanggal_mulai?->format('d-m-Y H:i') }}</td>
                            <td>{{ $l->tanggal_akhir?->format('d-m-Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada lowongan yang sudah berakhir</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $lowongans->withQueryString()->links('layouts.pagination') }}
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.lowongan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let timer = null;

// Search auto
$('#searchInput').on('keyup', function() {
    clearTimeout(timer);
    let keyword = $(this).val();

    timer = setTimeout(() => {
        $.ajax({
            url: "{{ route('admin.lowongan.history') }}",
            type: "GET",
            data: { q: keyword },
            success: function(data) {
                $('#lowonganTable').html($(data).find('#lowonganTable').html());
            }
        });
    }, 400);
});

// Pagination AJAX
$(document).on('click', '#lowonganTable .pagination a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    $.get(url, function(data) {
        $('#lowonganTable').html($(data).find('#lowonganTable').html());
    });
});
</script>
@endsection
