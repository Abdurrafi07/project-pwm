@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pengurus</h1>
    <form action="{{ route('admin.penguruses.store') }}" method="POST" enctype="multipart/form-data">
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
                placeholder="Masukkan nama pengurus"
            >
            <small id="namaError" class="text-danger d-none">Nama hanya boleh huruf dan spasi.</small>
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Jabatan --}}
        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" 
                   name="jabatan" 
                   class="form-control @error('jabatan') is-invalid @enderror" 
                   value="{{ old('jabatan') }}">
            @error('jabatan')
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
            >{{ old('deskripsi') }}</textarea>
            
            {{-- Awalnya hidden --}}
            <small id="deskripsiHelp" class="text-muted d-none">
                <span id="deskripsiCount">0</span>/500 karakter (min. 10)
            </small>

            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Input File --}}
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" 
                id="gambar"
                name="gambar" 
                class="form-control @error('gambar') is-invalid @enderror"
                accept="image/*">
            <input type="hidden" name="gambar_temp" id="gambar_temp" value="{{ old('gambar_temp') }}">
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Preview --}}
        <div class="mb-3">
            <img id="preview" 
                src="{{ old('gambar_temp') ? asset('storage/tmp/'.old('gambar_temp')) : '' }}" 
                class="img-thumbnail {{ old('gambar_temp') ? '' : 'd-none' }}" 
                style="max-width: 200px;">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.penguruses.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

{{-- Script validasi & hitung huruf --}}
<script>

document.getElementById('gambar').addEventListener('change', function() {
    let formData = new FormData();
    formData.append('gambar', this.files[0]);

    fetch("{{ route('admin.pengurus.upload.temp') }}", {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(res => res.json())
    .then(data => {
        // simpan nama file ke hidden input
        document.getElementById('gambar_temp').value = data.filename;

        // tampilkan preview
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview');
            output.src = reader.result;
            output.classList.remove('d-none');
        };
        reader.readAsDataURL(document.getElementById('gambar').files[0]);
    })
    .catch(err => console.error(err));
});

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
