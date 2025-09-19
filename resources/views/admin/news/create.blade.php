@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
<div class="container mt-4">
    <h1>Tambah Berita</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        {{-- Judul --}}
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" 
                   name="judul" 
                   id="judul" 
                   class="form-control @error('judul') is-invalid @enderror" 
                   value="{{ old('judul') }}">
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
                      maxlength="3000">{{ old('deskripsi') }}</textarea>
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
                value="{{ old('penulis') }}" 
                class="form-control @error('penulis') is-invalid @enderror"
                placeholder="Masukkan penulis kategori"
            >
            <small id="penulisError" class="text-danger d-none">Penulis hanya boleh huruf dan spasi.</small>
            @error('penulis') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Gambar --}}
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" 
                   name="gambar" 
                   id="gambar" 
                   class="form-control @error('gambar') is-invalid @enderror" 
                   accept="image/*">
            <input type="hidden" name="gambar_temp" id="gambar_temp" value="{{ old('gambar_temp') }}">
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Preview Gambar --}}
        <div class="mb-3">
            <img id="preview" 
                 src="{{ old('gambar_temp') ? asset('storage/tmp/' . old('gambar_temp')) : '' }}" 
                 class="img-thumbnail {{ old('gambar_temp') ? '' : 'd-none' }}" 
                 style="max-width: 200px;">
        </div>

        {{-- Tombol --}}
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

{{-- Script hitung jumlah huruf & preview gambar --}}
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
    // Counter Deskripsi
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
    updateCount();

    // Preview Gambar & Upload Temp
    const gambarInput = document.getElementById('gambar');
    const preview = document.getElementById('preview');
    const gambarTemp = document.getElementById('gambar_temp');

    gambarInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('gambar', file);

        fetch("{{ route('admin.news.upload.temp') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(res => res.json())
        .then(data => {
            gambarTemp.value = data.filename;

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        })
        .catch(err => console.error(err));
    });
</script>
@endsection
