@extends('layouts.app')
@section('title', 'Edit Lowongan')

@section('content')
<div class="container mt-4">
    <h1>Edit Lowongan</h1>
    <form action="{{ route('admin.lowongan.update', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" 
                   name="judul" 
                   class="form-control @error('judul') is-invalid @enderror" 
                   value="{{ old('judul', $lowongan->judul) }}">
            @error('judul') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea id="deskripsi"
                      name="deskripsi" 
                      class="form-control @error('deskripsi') is-invalid @enderror" 
                      rows="4"
                      minlength="100"
                      maxlength="5000">{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>
            <small id="deskripsiHelp" class="text-muted">
                <span id="deskripsiCount">0</span>/5000 karakter (min. 100)
            </small>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Perusahaan & Lokasi --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Perusahaan</label>
                <input type="text" 
                       name="perusahaan" 
                       class="form-control @error('perusahaan') is-invalid @enderror" 
                       value="{{ old('perusahaan', $lowongan->perusahaan) }}">
                @error('perusahaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Lokasi</label>
                <input type="text" 
                       name="lokasi" 
                       class="form-control @error('lokasi') is-invalid @enderror" 
                       value="{{ old('lokasi', $lowongan->lokasi) }}">
                @error('lokasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- No Telp --}}
        <div class="mb-3">
            <label for="no_telp" class="form-label">No Telp</label>
            <input 
                type="text" 
                id="no_telp"
                name="no_telp" 
                value="{{ old('no_telp', $umkm->no_telp) }}" 
                class="form-control @error('no_telp') is-invalid @enderror"
                placeholder="Masukkan nomor telepon"
            >
            <small id="noTelpError" class="text-danger d-none">No telp hanya boleh angka.</small>
            @error('no_telp') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Gambar --}}
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" 
                   name="gambar" 
                   class="form-control @error('gambar') is-invalid @enderror" 
                   accept="image/*">
            @if($lowongan->gambar)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $lowongan->gambar) }}" alt="Gambar Lowongan" width="150">
                </div>
            @endif
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tanggal Mulai & Akhir --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="datetime-local" 
                       name="tanggal_mulai" 
                       class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                       value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($lowongan->tanggal_mulai)->format('Y-m-d\TH:i')) }}">
                @error('tanggal_mulai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Akhir</label>
                <input type="datetime-local" 
                       name="tanggal_akhir" 
                       class="form-control @error('tanggal_akhir') is-invalid @enderror" 
                       value="{{ old('tanggal_akhir', \Carbon\Carbon::parse($lowongan->tanggal_akhir)->format('Y-m-d\TH:i')) }}">
                @error('tanggal_akhir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.lowongan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

{{-- Script validasi & hitung huruf --}}
<script>

    // === Validasi realtime No Telp ===
    const noTelpInput = document.getElementById('no_telp');
    const noTelpError = document.getElementById('noTelpError');

    noTelpInput.addEventListener('input', function() {
        const regex = /^[0-9]*$/; // hanya angka

        if (!regex.test(this.value)) {
            noTelpError.textContent = "No telp hanya boleh angka.";
            noTelpError.classList.remove("d-none");
        } else {
            noTelpError.classList.add("d-none");
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
