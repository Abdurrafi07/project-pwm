<table class="table table-bordered">
    <thead>
        <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Pemilik</th>
                <th>No. Telp</th>
                <th>Jenis Kelamin</th>
                <th>Usia</th>
                <th>Pendidikan Terakhir</th>
                <th>Berdiri</th>
                <th>Alamat</th>
                <th>Lokasi</th>
                <th>Pemasaran</th>
                <th>Jumlah Karyawan</th>
                <th>Kategori</th>
                <th>Daerah</th>
                <th>Sektor</th>
                <th>Modal</th>
                <th>Hambatan</th>
                <th>Kebutuhan</th>
                <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($umkms as $umkm)
            <tr>
                    <td>{{ $umkm->id }}</td>
                    <td>{{ $umkm->nama }}</td>
                    <td>{{ $umkm->pemilik }}</td>
                    <td>{{ $umkm->no_telp }}</td>
                    <td>{{ $umkm->jenis_kelamin }}</td>
                    <td>{{ $umkm->usia }}</td>
                    <td>{{ $umkm->pendidikan_terakhir }}</td>
                    <td>{{ $umkm->tahun_berdiri }}</td>
                    <td>{{ $umkm->alamat }}</td>
                    <td>{{ $umkm->status_lokasi }}</td>
                    <td>{{ $umkm->metode_pemasaran }}</td>
                    <td>{{ $umkm->jumlah_karyawan }}</td>
                    <td>{{ $umkm->kategori->nama }}</td>
                    <td>{{ $umkm->daerah->nama }}</td>
                    <td>{{ $umkm->sektor->nama }}</td>
                    <td>{{ $umkm->sumber_modal }}</td>
                    <td>{{ $umkm->hambatan_pemasaran }}</td>
                    <td>{{ $umkm->kebutuhan_pengembangan }}</td>
                    <td>
                        <a href="{{ route('admin.umkm.edit', $umkm) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.umkm.destroy', $umkm) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $umkms->withQueryString()->links('layouts.pagination') }}
</div>
