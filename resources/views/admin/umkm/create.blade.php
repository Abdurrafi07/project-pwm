@extends('layouts.app')

@section('title', 'Tambah UMKM')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah UMKM</h1>

    <form action="{{ route('admin.umkm.store') }}" method="POST">
        @csrf

        {{-- Nama UMKM --}}
        <div class="mb-3">
            <label>Nama UMKM</label>
            <input type="text" name="nama" value="{{ old('nama') }}" 
                class="form-control @error('nama') is-invalid @enderror">
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Pemilik --}}
        <div class="mb-3">
            <label>Pemilik</label>
            <input type="text" name="pemilik" value="{{ old('pemilik') }}" 
                class="form-control @error('pemilik') is-invalid @enderror">
            @error('pemilik') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Jenis Kelamin --}}
        <div class="mb-3">
            <label>Jenis Kelamin Pemilik</label>
            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Usia --}}
        <div class="mb-3">
            <label>Usia Pemilik</label>
            <select name="usia" class="form-control @error('usia') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                <option value="<20" {{ old('usia') == '<20' ? 'selected' : '' }}>&lt; 20</option>
                <option value="20-29" {{ old('usia') == '20-29' ? 'selected' : '' }}>20-29</option>
                <option value="30-39" {{ old('usia') == '30-39' ? 'selected' : '' }}>30-39</option>
                <option value="40-49" {{ old('usia') == '40-49' ? 'selected' : '' }}>40-49</option>
                <option value=">50" {{ old('usia') == '>50' ? 'selected' : '' }}>&gt; 50</option>
            </select>
            @error('usia') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Pendidikan --}}
        <div class="mb-3">
            <label>Pendidikan Terakhir</label>
            <select name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                <option value="SD/SMP" {{ old('pendidikan_terakhir') == 'SD/SMP' ? 'selected' : '' }}>SD/SMP</option>
                <option value="SMA/SMK" {{ old('pendidikan_terakhir') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                <option value="Diploma" {{ old('pendidikan_terakhir') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1</option>
                <option value="S2/S3" {{ old('pendidikan_terakhir') == 'S2/S3' ? 'selected' : '' }}>S2/S3</option>
            </select>
            @error('pendidikan_terakhir') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Tahun Berdiri --}}
        <div class="mb-3">
            <label>Tahun Berdiri</label>
            <input type="number" name="tahun_berdiri" value="{{ old('tahun_berdiri') }}" 
                class="form-control @error('tahun_berdiri') is-invalid @enderror" 
                min="1900" max="{{ now()->year }}">
            @error('tahun_berdiri') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Status Lokasi --}}
        <div class="mb-3">
            <label>Status Lokasi</label>
            <select name="status_lokasi" class="form-control @error('status_lokasi') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                <option value="Milik" {{ old('status_lokasi') == 'Milik' ? 'selected' : '' }}>Milik</option>
                <option value="Sewa" {{ old('status_lokasi') == 'Sewa' ? 'selected' : '' }}>Sewa</option>
            </select>
            @error('status_lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Sumber Modal --}}
        <div class="mb-3">
            <label>Sumber Modal</label>
            <select name="sumber_modal" class="form-control @error('sumber_modal') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                <option value="modal pribadi" {{ old('sumber_modal') == 'modal pribadi' ? 'selected' : '' }}>Modal Pribadi</option>
                <option value="pinjaman keluarga" {{ old('sumber_modal') == 'pinjaman keluarga' ? 'selected' : '' }}>Pinjaman Keluarga</option>
                <option value="bank" {{ old('sumber_modal') == 'bank' ? 'selected' : '' }}>Bank</option>
                <option value="koperasi/leasing" {{ old('sumber_modal') == 'koperasi/leasing' ? 'selected' : '' }}>Koperasi/Leasing</option>
                <option value="program pemerintah/lainnya" {{ old('sumber_modal') == 'program pemerintah/lainnya' ? 'selected' : '' }}>Program Pemerintah/Lainnya</option>
            </select>
            @error('sumber_modal') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Metode Pemasaran --}}
        <div class="mb-3">
            <label>Metode Pemasaran</label>
            <select name="metode_pemasaran" class="form-control @error('metode_pemasaran') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                <option value="offline" {{ old('metode_pemasaran') == 'offline' ? 'selected' : '' }}>Offline</option>
                <option value="online" {{ old('metode_pemasaran') == 'online' ? 'selected' : '' }}>Online</option>
                <option value="offline&online" {{ old('metode_pemasaran') == 'offline&online' ? 'selected' : '' }}>Offline & Online</option>
            </select>
            @error('metode_pemasaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Hambatan Pemasaran --}}
        <div class="mb-3">
            <label>Hambatan Pemasaran</label>
            <textarea name="hambatan_pemasaran" class="form-control @error('hambatan_pemasaran') is-invalid @enderror">{{ old('hambatan_pemasaran') }}</textarea>
            @error('hambatan_pemasaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Kebutuhan Pengembangan --}}
        <div class="mb-3">
            <label>Kebutuhan Pengembangan</label>
            <textarea name="kebutuhan_pengembangan" class="form-control @error('kebutuhan_pengembangan') is-invalid @enderror">{{ old('kebutuhan_pengembangan') }}</textarea>
            @error('kebutuhan_pengembangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- No Telp --}}
        <div class="mb-3">
            <label>No Telp</label>
            <input type="text" name="no_telp" value="{{ old('no_telp') }}" 
                class="form-control @error('no_telp') is-invalid @enderror" 
                pattern="[0-9]+" title="Hanya boleh angka">
            @error('no_telp') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Jumlah Karyawan --}}
        <div class="mb-3">
            <label>Jumlah Karyawan</label>
            <input type="number" name="jumlah_karyawan" value="{{ old('jumlah_karyawan') }}" 
                class="form-control @error('jumlah_karyawan') is-invalid @enderror" min="0">
            @error('jumlah_karyawan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Kategori --}}
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Daerah --}}
        <div class="mb-3">
            <label>Daerah</label>
            <select name="daerah_id" class="form-control @error('daerah_id') is-invalid @enderror">
                <option value="">-- Pilih Daerah --</option>
                @foreach ($daerahs as $daerah)
                    <option value="{{ $daerah->id }}" {{ old('daerah_id') == $daerah->id ? 'selected' : '' }}>
                        {{ $daerah->nama }}
                    </option>
                @endforeach
            </select>
            @error('daerah_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Sektor --}}
        <div class="mb-3">
            <label>Sektor</label>
            <select name="sektor_id" class="form-control @error('sektor_id') is-invalid @enderror">
                <option value="">-- Pilih Sektor --</option>
                @foreach ($sektors as $sektor)
                    <option value="{{ $sektor->id }}" {{ old('sektor_id') == $sektor->id ? 'selected' : '' }}>
                        {{ $sektor->nama }}
                    </option>
                @endforeach
            </select>
            @error('sektor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
