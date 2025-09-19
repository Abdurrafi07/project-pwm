@extends('layouts.app')

@section('title', 'Edit Sektor')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Sektor</h1>

    <form action="{{ route('admin.sektor.update', $sektor) }}" method="POST">
        @csrf @method('PUT')
        
        {{-- Input Nama --}}
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input 
                type="text" 
                id="nama"
                name="nama"
                value="{{ old('nama', $sektor->nama) }}"
                class="form-control @error('nama') is-invalid @enderror"
                placeholder="Masukkan nama sektor"
            >
            <small id="namaError" class="text-danger d-none">Nama hanya boleh berisi huruf dan spasi.</small>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea 
                id="deskripsi"
                name="deskripsi" 
                class="form-control @error('deskripsi') is-invalid @enderror" 
                rows="4"
                minlength="3"
                maxlength="100"
            >{{ old('deskripsi', $sektor->deskripsi) }}</textarea>

            {{-- Awalnya disembunyikan --}}
            <small id="deskripsiHelp" class="text-muted d-none">
                <span id="deskripsiCount">0</span>/100 karakter (min. 3)
            </small>

            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.sektor.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

{{-- Script validasi & hitung huruf --}}
<script>
    // === Validasi realtime Nama ===
    const namaInput = document.getElementById('nama');
    const namaError = document.getElementById('namaError');

    namaInput.addEventListener('input', function() {
        const regex = /^[A-Za-z\s]*$/;

        if (!regex.test(this.value)) {
            namaError.textContent = "Nama hanya boleh berisi huruf dan spasi.";
            namaError.classList.remove("d-none");
        } else {
            namaError.classList.add("d-none");
        }
    });

    // === Counter Deskripsi ===
    const deskripsi = document.getElementById('deskripsi');
    const deskripsiCount = document.getElementById('deskripsiCount');
    const deskripsiHelp = document.getElementById('deskripsiHelp');

    function updateCount() {
        const length = deskripsi.value.length;

        if (length === 0) {
            deskripsiHelp.classList.add('d-none');
        } else {
            deskripsiHelp.classList.remove('d-none');
            deskripsiCount.textContent = length;

            if (length < 3) {
                deskripsiHelp.classList.remove('text-muted');
                deskripsiHelp.classList.add('text-danger');
            } else {
                deskripsiHelp.classList.remove('text-danger');
                deskripsiHelp.classList.add('text-muted');
            }
        }
    }

    deskripsi.addEventListener('input', updateCount);
    updateCount(); // inisialisasi
</script>
@endsection
