@extends('layouts.app')

@section('title', 'Data UMKM')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar UMKM</h1>

    <!-- Grafik Statistik -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Grafik Pertumbuhan Bulanan ({{ $tahunSekarang }})</h5>
            <canvas id="chartBulanan"></canvas>
        </div>
        <div class="col-md-6">
            <h5>Grafik Pertumbuhan Tahunan</h5>
            <canvas id="chartTahunan"></canvas>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Distribusi UMKM per Daerah</h5>
            <canvas id="chartDaerah"></canvas>
        </div>
        <div class="col-md-6">
            <h5>Distribusi UMKM per Sektor</h5>
            <canvas id="chartSektor"></canvas>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Distribusi UMKM per Kategori</h5>
            <canvas id="chartKategori"></canvas>
        </div>
    </div>

    <!-- Statistik Angka -->
    <div class="mb-3">
        <span class="badge bg-primary">Total UMKM: {{ $totalUmkm }}</span>
        <span class="badge bg-success">Total Karyawan: {{ $totalKaryawan }}</span>
    </div>

    <!-- Filter Kategori -->
    <div class="mb-3">
        <strong>Kategori:</strong>
        <a href="{{ route('admin.umkm.index') }}" 
           class="btn btn-sm {{ request('kategori_id') ? 'btn-outline-secondary' : 'btn-primary' }}">
            Semua
        </a>
        @foreach ($kategoris as $kategori)
            <a href="{{ route('admin.umkm.index', array_merge(request()->query(), ['kategori_id' => $kategori->id])) }}"
               class="btn btn-sm {{ request('kategori_id') == $kategori->id ? 'btn-primary' : 'btn-outline-secondary' }}">
                {{ $kategori->nama }}
            </a>
        @endforeach
    </div>

    <!-- Filter Daerah -->
    <div class="mb-3">
        <strong>Daerah:</strong>
        <a href="{{ route('admin.umkm.index', ['kategori_id' => request('kategori_id')]) }}" 
           class="btn btn-sm {{ request('daerah_id') ? 'btn-outline-secondary' : 'btn-success' }}">
            Semua
        </a>
        @foreach ($daerahs as $daerah)
            <a href="{{ route('admin.umkm.index', array_merge(request()->query(), ['daerah_id' => $daerah->id])) }}"
               class="btn btn-sm {{ request('daerah_id') == $daerah->id ? 'btn-success' : 'btn-outline-success' }}">
                {{ $daerah->nama }}
            </a>
        @endforeach
    </div>

    <!-- Filter Sektor -->
    <div class="mb-3">
        <strong>Sektor:</strong>
        <a href="{{ route('admin.umkm.index', [
            'kategori_id' => request('kategori_id'),
            'daerah_id'   => request('daerah_id')
        ]) }}" 
        class="btn btn-sm {{ request('sektor_id') ? 'btn-outline-secondary' : 'btn-warning' }}">
            Semua
        </a>
        @foreach ($sektors as $sektor)
            <a href="{{ route('admin.umkm.index', array_merge(request()->query(), ['sektor_id' => $sektor->id])) }}"
            class="btn btn-sm {{ request('sektor_id') == $sektor->id ? 'btn-warning' : 'btn-outline-warning' }}">
                {{ $sektor->nama }}
            </a>
        @endforeach
    </div>

    <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary mb-3">Tambah UMKM</a>

    <form method="GET" action="{{ route('admin.umkm.index') }}" id="searchForm" class="mb-3 d-flex">
        <input type="text" name="nama" value="{{ request('nama') }}" 
            class="form-control" placeholder="Cari UMKM..." id="searchInput">
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel Data -->
    <div id="umkmTable">
        @include('admin.umkm.table')
    </div>
    
</div>

<!-- Chart.js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let timer = null;

    $('#searchInput').on('keyup', function() {
        clearTimeout(timer);
        let keyword = $(this).val();

        timer = setTimeout(() => {
            $.ajax({
                url: "{{ route('admin.umkm.index') }}",
                type: "GET",
                data: { nama: keyword },
                success: function(data) {
                    $('#umkmTable').html($(data).find('#umkmTable').html());
                }
            });
        }, 400); // debounce biar gak terlalu sering
    });

    // Pagination AJAX
    $(document).on('click', '#umkmTable .pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        $.get(url, function(data) {
            $('#umkmTable').html($(data).find('#umkmTable').html());
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data Bulanan
        let dataBulanan = Array(12).fill(0);
        const statistikBulanan = @json($statistikBulanan);

        // isi per bulan dari backend
        for (const [bulan, total] of Object.entries(statistikBulanan)) {
            dataBulanan[bulan - 1] = total;
        }

        // ubah ke akumulasi (running total)
        for (let i = 1; i < dataBulanan.length; i++) {
            dataBulanan[i] += dataBulanan[i - 1];
        }

        new Chart(document.getElementById('chartBulanan'), {
            type: 'line',
            data: {
                labels: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                    'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
                ],
                datasets: [{
                    label: 'Total UMKM Akumulasi',
                    data: dataBulanan,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.3,
                    fill: false
                }]
            }
        });

        // Data Tahunan (langsung dari DB, biasanya sudah akumulasi per tahun)
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

        // Pie Chart Daerah
        const daerahLabels = @json($daerahs->pluck('nama'));
        const daerahData   = @json($daerahCounts);

        new Chart(document.getElementById('chartDaerah'), {
            type: 'pie',
            data: {
                labels: daerahLabels,
                datasets: [{
                    label: 'UMKM per Daerah',
                    data: daerahData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ]
                }]
            }
        });

        // Bar Chart Sektor
        const sektorLabels = @json($sektors->pluck('nama'));
        const sektorData   = @json($sektorCounts);

        new Chart(document.getElementById('chartSektor'), {
            type: 'bar',
            data: {
                labels: sektorLabels,
                datasets: [{
                    label: 'UMKM per Sektor',
                    data: sektorData,
                    backgroundColor: 'rgba(255, 159, 64, 0.6)'
                }]
            }
        });
    });

    // Pie Chart Kategori
    const kategoriLabels = @json($kategoriLabels);
    const kategoriData   = @json($kategoriCounts);

    new Chart(document.getElementById('chartKategori'), {
        type: 'pie',
        data: {
            labels: kategoriLabels,
            datasets: [{
                label: 'UMKM per Kategori',
                data: kategoriData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ]
            }]
        }
    });
    </script>
@endsection
