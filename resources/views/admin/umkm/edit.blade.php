@extends('layouts.app')

@section('title', 'Edit UMKM')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit UMKM</h1>

    <form action="{{ route('admin.umkm.update', $umkm) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        {{-- Nama UMKM --}}
        <div class="mb-3">
            <label>Nama UMKM</label>
            <input type="text" name="nama"
                   class="form-control @error('nama') is-invalid @enderror"
                   value="{{ old('nama', $umkm->nama) }}">
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Pemilik --}}
        <div class="mb-3">
            <label>Pemilik</label>
            <input type="text" name="pemilik"
                   class="form-control @error('pemilik') is-invalid @enderror"
                   value="{{ old('pemilik', $umkm->pemilik) }}">
            @error('pemilik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Jenis Kelamin --}}
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                <option value="laki-laki" {{ old('jenis_kelamin', $umkm->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="perempuan" {{ old('jenis_kelamin', $umkm->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Usia --}}
        <div class="mb-3">
            <label>Usia</label>
            <select name="usia" class="form-control @error('usia') is-invalid @enderror">
                @foreach (['<20','20-29','30-39','40-49','>50'] as $u)
                    <option value="{{ $u }}" {{ old('usia', $umkm->usia) == $u ? 'selected' : '' }}>{{ $u }}</option>
                @endforeach
            </select>
            @error('usia')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Pendidikan Terakhir --}}
        <div class="mb-3">
            <label>Pendidikan Terakhir</label>
            <select name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror">
                @foreach (['SD/SMP','SMA/SMK','Diploma','S1','S2/S3'] as $p)
                    <option value="{{ $p }}" {{ old('pendidikan_terakhir', $umkm->pendidikan_terakhir) == $p ? 'selected' : '' }}>{{ $p }}</option>
                @endforeach
            </select>
            @error('pendidikan_terakhir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tahun Berdiri --}}
        <div class="mb-3">
            <label>Tahun Berdiri</label>
            <input type="number" name="tahun_berdiri"
                   class="form-control @error('tahun_berdiri') is-invalid @enderror"
                   value="{{ old('tahun_berdiri', $umkm->tahun_berdiri) }}">
            @error('tahun_berdiri')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Status Lokasi --}}
        <div class="mb-3">
            <label>Status Lokasi</label>
            <select name="status_lokasi" class="form-control @error('status_lokasi') is-invalid @enderror">
                <option value="Milik" {{ old('status_lokasi', $umkm->status_lokasi) == 'Milik' ? 'selected' : '' }}>Milik</option>
                <option value="Sewa" {{ old('status_lokasi', $umkm->status_lokasi) == 'Sewa' ? 'selected' : '' }}>Sewa</option>
            </select>
            @error('status_lokasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Sumber Modal --}}
        <div class="mb-3">
            <label>Sumber Modal</label>
            <select name="sumber_modal" class="form-control @error('sumber_modal') is-invalid @enderror">
                @foreach (['modal pribadi','pinjaman keluarga','bank','koperasi/leasing','program pemerintah/lainnya'] as $s)
                    <option value="{{ $s }}" {{ old('sumber_modal', $umkm->sumber_modal) == $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
            @error('sumber_modal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Metode Pemasaran --}}
        <div class="mb-3">
            <label>Metode Pemasaran</label>
            <select name="metode_pemasaran" class="form-control @error('metode_pemasaran') is-invalid @enderror">
                <option value="offline" {{ old('metode_pemasaran', $umkm->metode_pemasaran) == 'offline' ? 'selected' : '' }}>Offline</option>
                <option value="online" {{ old('metode_pemasaran', $umkm->metode_pemasaran) == 'online' ? 'selected' : '' }}>Online</option>
                <option value="offline&online" {{ old('metode_pemasaran', $umkm->metode_pemasaran) == 'offline&online' ? 'selected' : '' }}>Offline & Online</option>
            </select>
            @error('metode_pemasaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Hambatan Pemasaran --}}
        <div class="mb-3">
            <label>Hambatan Pemasaran</label>
            <textarea name="hambatan_pemasaran"
                      class="form-control @error('hambatan_pemasaran') is-invalid @enderror"
                      minlength="3" maxlength="50">{{ old('hambatan_pemasaran', $umkm->hambatan_pemasaran) }}</textarea>
            @error('hambatan_pemasaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Kebutuhan Pengembangan --}}
        <div class="mb-3">
            <label>Kebutuhan Pengembangan</label>
            <textarea name="kebutuhan_pengembangan"
                      class="form-control @error('kebutuhan_pengembangan') is-invalid @enderror"
                      minlength="3" maxlength="50">{{ old('kebutuhan_pengembangan', $umkm->kebutuhan_pengembangan) }}</textarea>
            @error('kebutuhan_pengembangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat"
                      class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $umkm->alamat) }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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

        {{-- Jumlah Karyawan --}}
        <div class="mb-3">
            <label>Jumlah Karyawan</label>
            <input type="number" name="jumlah_karyawan"
                   class="form-control @error('jumlah_karyawan') is-invalid @enderror"
                   min="0"
                   value="{{ old('jumlah_karyawan', $umkm->jumlah_karyawan) }}">
            @error('jumlah_karyawan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id"
                    class="form-control @error('kategori_id') is-invalid @enderror">
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ old('kategori_id', $umkm->kategori_id) == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Daerah --}}
        <div class="mb-3">
            <label>Daerah</label>
            <select name="daerah_id"
                    class="form-control @error('daerah_id') is-invalid @enderror">
                @foreach ($daerahs as $daerah)
                    <option value="{{ $daerah->id }}"
                        {{ old('daerah_id', $umkm->daerah_id) == $daerah->id ? 'selected' : '' }}>
                        {{ $daerah->nama }}
                    </option>
                @endforeach
            </select>
            @error('daerah_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Sektor --}}
        <div class="mb-3">
            <label>Sektor</label>
            <select name="sektor_id"
                    class="form-control @error('sektor_id') is-invalid @enderror">
                @foreach ($sektors as $sektor)
                    <option value="{{ $sektor->id }}"
                        {{ old('sektor_id', $umkm->sektor_id) == $sektor->id ? 'selected' : '' }}>
                        {{ $sektor->nama }}
                    </option>
                @endforeach
            </select>
            @error('sektor_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol Aksi --}}
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
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
</script>
@endsection
