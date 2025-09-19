@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="container mt-4">
    <h1>Edit Berita</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" 
                   name="judul" 
                   id="judul" 
                   class="form-control @error('judul') is-invalid @enderror" 
                   value="{{ old('judul', $news->judul) }}">
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" 
                      id="deskripsi" 
                      class="form-control @error('deskripsi') is-invalid @enderror" 
                      rows="5" 
                      minlength="100" 
                      maxlength="3000">{{ old('deskripsi', $news->deskripsi) }}</textarea>
            <small id="deskripsiHelp" class="text-muted">
                <span id="deskripsiCount">0</span>/3000 karakter (minimal 100 huruf)
            </small>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Input Penulis --}}
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input 
                type="text" 
                id="penulis"
                name="penulis"
                value="{{ old('penulis', $news->penulis) }}"
                class="form-control @error('penulis') is-invalid @enderror"
                placeholder="Masukkan penulis"
            />
            <small id="penulisError" class="text-danger d-none">Penulis hanya boleh berisi huruf dan spasi.</small>
            @error('penulis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Gambar --}}
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            @if($news->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $news->gambar) }}" width="120" alt="Gambar Berita">
                </div>
            @endif
            <input type="file" 
                   name="gambar" 
                   id="gambar" 
                   class="form-control @error('gambar') is-invalid @enderror" 
                   accept="image/*">
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol --}}
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

{{-- Script hitung jumlah huruf --}}
<script>
    
    const penulisInput = document.getElementById('penulis');
    const penulisError = document.getElementById('penulisError');

    penulisInput.addEventListener('input', function() {
        const regex = /^[A-Za-z\s]*$/;

        if (!regex.test(this.value)) {
            penulisError.textContent = "Penulis hanya boleh huruf dan spasi.";
            penulisError.classList.remove("d-none");
        } 
        else {
            penulisError.classList.add("d-none");
        }
    });

    const deskripsi = document.getElementById('deskripsi');
    const deskripsiCount = document.getElementById('deskripsiCount');
    const deskripsiHelp = document.getElementById('deskripsiHelp');

    function updateCount() {
        const length = deskripsi.value.length;
        deskripsiCount.textContent = length;

        if (length < 100) {
            deskripsiHelp.classList.remove('text-muted');
            deskripsiHelp.classList.add('text-danger');
        } else {
            deskripsiHelp.classList.remove('text-danger');
            deskripsiHelp.classList.add('text-muted');
        }
    }

    deskripsi.addEventListener('input', updateCount);
    updateCount(); // inisialisasi saat halaman dibuka
</script>
@endsection
