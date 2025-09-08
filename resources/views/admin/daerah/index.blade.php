@extends('layouts.app')

@section('title', 'Daerah')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Daerah</h1>

    <a href="{{ route('admin.daerah.create') }}" class="btn btn-primary mb-3">Tambah Daerah</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Jumlah UMKM</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daerahs as $daerah)
                <tr>
                    <td>{{ $daerah->id }}</td>
                    <td>{{ $daerah->nama }}</td>
                    <td>{{ $daerah->deskripsi }}</td>
                    <td>{{ $daerah->umkms_count }}</td>
                    <td>
                        <a href="{{ route('admin.daerah.edit', $daerah) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.daerah.destroy', $daerah) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $daerahs->links() }}
</div>
@endsection
