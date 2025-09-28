@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pengurus</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.penguruses.create') }}" class="btn btn-primary mb-3">Tambah Pengurus</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penguruses as $index => $pengurus)
                <tr>
                    <td>{{ $pengurus->id }}</td>
                    <td>{{ $pengurus->nama }}</td>
                    <td>{{ $pengurus->jabatan }}</td>
                    <td>{{ $pengurus->deskripsi }}</td>
                    <td>
                        @if($pengurus->gambar)
                            <img src="{{ asset('storage/'.$pengurus->gambar) }}" width="100" alt="{{ $pengurus->nama }}">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.penguruses.edit', $pengurus->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.penguruses.destroy', $pengurus->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus pengurus ini?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pengurus</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $penguruses->links() }}
</div>
@endsection
