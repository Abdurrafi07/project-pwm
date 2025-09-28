{{-- resources/views/noauth/umkm/_table.blade.php --}}
<div id="umkmTable">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama UMKM</th>
                <th>Daerah</th>
                <th>Sektor</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @forelse($umkms as $umkm)
                <tr>
                    <td>{{ $umkm->id }}</td>
                    <td>{{ $umkm->nama }}</td>
                    <td>{{ $umkm->daerah->nama ?? '-' }}</td>
                    <td>{{ $umkm->sektor->nama ?? '-' }}</td>
                    <td>{{ $umkm->kategori->nama ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada data UMKM</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $umkms->withQueryString()->links('layouts.pagination') }}
    </div>
</div>
