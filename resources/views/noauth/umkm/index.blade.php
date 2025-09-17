@extends('layouts.app')

@section('title', 'Daftar UMKM')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar UMKM</h1>

    <!-- Statistik Angka -->
    <div class="mb-3">
        <span class="badge bg-primary">Total UMKM: {{ $totalUmkm }}</span>
        <span class="badge bg-success">Total Karyawan: {{ $totalKaryawan }}</span>
    </div>

    <!-- Grafik Pertumbuhan -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    Grafik Pertumbuhan Bulanan ({{ $tahunSekarang }})
                </div>
                <div class="card-body">
                    <canvas id="chartBulanan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    Grafik Pertumbuhan Tahunan
                </div>
                <div class="card-body">
                    <canvas id="chartTahunan"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Distribusi -->
    <div class="row mb-4">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">UMKM per Daerah</div>
                <div class="card-body">
                    <canvas id="chartDaerah"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">UMKM per Sektor</div>
                <div class="card-body">
                    <canvas id="chartSektor"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">UMKM per Kategori</div>
                <div class="card-body">
                    <canvas id="chartKategori"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel UMKM -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-dark text-white">Data UMKM</div>
        <div class="card-body">
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
                            <td>{{ $loop->iteration + ($umkms->currentPage() - 1) * $umkms->perPage() }}</td>
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
                {{ $umkms->links('layouts.pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // ==== Helper redirect dengan query param ====
    function applyFilter(param, value) {
        let url = new URL(window.location.href);

        if (value) {
            url.searchParams.set(param, value);
        } else {
            url.searchParams.delete(param);
        }

        url.searchParams.delete('page'); // reset pagination

        window.location.href = url.toString();
    }

    document.addEventListener('DOMContentLoaded', function () {
        // ==== Grafik Pertumbuhan Bulanan ====
        let dataBulanan = Array(12).fill(0);
        const statistikBulanan = @json($statistikBulanan);

        for (const [bulan, total] of Object.entries(statistikBulanan)) {
            dataBulanan[bulan - 1] = total;
        }
        for (let i = 1; i < dataBulanan.length; i++) {
            dataBulanan[i] += dataBulanan[i - 1];
        }

        new Chart(document.getElementById('chartBulanan'), {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                datasets: [{
                    label: 'Total UMKM Akumulasi',
                    data: dataBulanan,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.3,
                    fill: false
                }]
            }
        });

        // ==== Grafik Pertumbuhan Tahunan ====
        const tahunLabels = Object.keys(@json($statistikTahunan));
        const tahunData   = Object.values(@json($statistikTahunan));

        new Chart(document.getElementById('chartTahunan'), {
            type: 'line',
            data: {
                labels: tahunLabels,
                datasets: [{
                    label: 'Total UMKM Tahunan',
                    data: tahunData,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    tension: 0.3,
                    fill: false
                }]
            }
        });

        // ==== Chart Daerah ====
        const daerahChart = new Chart(document.getElementById('chartDaerah'), {
            type: 'pie',
            data: {
                labels: @json($daerahLabels),
                datasets: [{
                    data: @json($daerahCounts),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ]
                }]
            },
            options: {
                onClick: (evt, elements) => {
                    if (elements.length > 0) {
                        let index = elements[0].index;
                        let daerahId = @json($daerahs->pluck('id'))[index];
                        applyFilter('daerah_id', daerahId);
                    }
                }
            }
        });

        // ==== Chart Sektor ====
        const sektorChart = new Chart(document.getElementById('chartSektor'), {
            type: 'bar',
            data: {
                labels: @json($sektorLabels),
                datasets: [{
                    data: @json($sektorCounts),
                    backgroundColor: 'rgba(255, 159, 64, 0.6)'
                }]
            },
            options: {
                onClick: (evt, elements) => {
                    if (elements.length > 0) {
                        let index = elements[0].index;
                        let sektorId = @json($sektors->pluck('id'))[index];
                        applyFilter('sektor_id', sektorId);
                    }
                }
            }
        });

        // ==== Chart Kategori ====
        const kategoriChart = new Chart(document.getElementById('chartKategori'), {
            type: 'pie',
            data: {
                labels: @json($kategoriLabels),
                datasets: [{
                    data: @json($kategoriCounts),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ]
                }]
            },
            options: {
                onClick: (evt, elements) => {
                    if (elements.length > 0) {
                        let index = elements[0].index;
                        let kategoriId = @json($kategoris->pluck('id'))[index];
                        applyFilter('kategori_id', kategoriId);
                    }
                }
            }
        });
    });
</script>
@endsection
