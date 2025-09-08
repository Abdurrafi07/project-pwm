@extends('layouts.app')

@section('title', 'Edit Daerah')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Daerah</h1>

    <form action="{{ route('admin.daerah.update', $daerah) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $daerah->nama) }}" required>
            @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi', $daerah->deskripsi) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.daerah.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
