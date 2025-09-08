@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<div class="container">
    <h1>Berita</h1>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary mb-3">Tambah Berita</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $item)
            <tr>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->penulis }}</td>
                <td>
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" width="80" alt="gambar">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus berita ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $news->links() }}
</div>
@endsection
