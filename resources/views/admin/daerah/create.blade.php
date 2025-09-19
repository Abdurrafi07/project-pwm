@extends('layouts.app')

@section('title', 'Tambah Daerah')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Daerah</h1>

    <form action="{{ route('admin.daerah.store') }}" method="POST">
        @csrf

        {{-- Input Nama --}}
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input 
                type="text" 
                id="nama"
                name="nama" 
                value="{{ old('nama') }}" 
                class="form-control @error('nama') is-invalid @enderror"
                placeholder="Masukkan nama daerah"
            >
            <small id="namaError" class="text-danger d-none">Nama hanya boleh huruf dan spasi.</small>
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
            >{{ old('deskripsi') }}</textarea>
            
            {{-- Awalnya hidden --}}
            <small id="deskripsiHelp" class="text-muted d-none">
                <span id="deskripsiCount">0</span>/100 karakter (min. 3)
            </small>

            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.daerah.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

{{-- Script validasi & hitung huruf --}}
<script>
    const namaInput = document.getElementById('nama');
    const namaError = document.getElementById('namaError');

    namaInput.addEventListener('input', function() {
        const regex = /^[A-Za-z\s]*$/;

        if (!regex.test(this.value)) {
            namaError.textContent = "Nama hanya boleh huruf dan spasi.";
            namaError.classList.remove("d-none");
        } 
        else {
            namaError.classList.add("d-none");
        }
    });

    const deskripsi = document.getElementById('deskripsi');
    const deskripsiCount = document.getElementById('deskripsiCount');
    const deskripsiHelp = document.getElementById('deskripsiHelp');

    function updateCount() {
        const length = deskripsi.value.length;

        if (length === 0) {
            // Kosong → sembunyikan
            deskripsiHelp.classList.add('d-none');
        } else {
            // Ada isi → tampilkan counter
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
    updateCount(); // inisialisasi (untuk handle old value)
</script>
@endsection
