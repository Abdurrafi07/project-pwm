@extends('layouts.app')
@section('title', 'Lowongan')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Daftar Lowongan</h1>

    <a href="{{ route('admin.lowongan.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Lowongan
    </a>

    <a href="{{ route('admin.lowongan.history') }}" class="btn btn-outline-secondary mb-3 ms-2">
        <i class="fas fa-history"></i> History
    </a>

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.lowongan.index') }}" id="searchForm" class="mb-3 d-flex">
        <input type="text" name="q" id="searchInput" value="{{ request('q') }}" class="form-control" placeholder="Cari judul lowongan...">
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel Lowongan -->
    <div id="lowonganTable">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Perusahaan</th>
                    <th>Lokasi</th>
                    <th>No HP/WA</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Akhir</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                <tbody>
                @foreach($lowongans as $l)
                <tr>
                    <td>{{ $l->id }}</td> <!-- pakai ID langsung -->
                    <td>{{ $l->judul }}</td>
                    <td>{{ $l->perusahaan }}</td>
                    <td>{{ $l->lokasi }}</td>
                    <td>{{ $l->no_hp }}</td>
                    <td>{{ $l->tanggal_mulai?->format('d-m-Y H:i') }}</td>
                    <td>{{ $l->tanggal_akhir?->format('d-m-Y H:i') }}</td>
                    <td>
                        @if($l->isExpired())
                            <span class="badge bg-danger">Expired</span>
                        @else
                            <span class="badge bg-success">Aktif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.lowongan.edit', $l) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.lowongan.destroy', $l) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus lowongan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
        </table>

        {{ $lowongans->withQueryString()->links('layouts.pagination') }}
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
            url: "{{ route('admin.lowongan.index') }}",
            type: "GET",
            data: { q: keyword },
            success: function(data) {
                $('#lowonganTable').html($(data).find('#lowonganTable').html());
            }
        });
    }, 400); // debounce
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
