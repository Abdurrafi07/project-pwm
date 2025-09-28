@extends('layouts.app')

@section('title', 'Daftar UMKM')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar UMKM</h1>

    <!-- Statistik Utama -->
    <div class="mb-3">
        <span class="badge bg-primary">Total UMKM: {{ $totalUmkm }}</span>
        <span class="badge bg-success">Total Karyawan: {{ $totalKaryawan }}</span>
    </div>

    <!-- Grafik Pertumbuhan -->
    <div class="row mb-4">
        <!-- Bulanan -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    Grafik Pertumbuhan Bulanan ({{ $tahunSekarang }})
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="card text-center shadow-sm">
                                <div class="card-body p-2">
                                    <h6 class="mb-1">Total Tahun Ini</h6>
                                    <h5 class="text-primary mb-0">
                                        {{ is_array($statistikBulanan) ? array_sum($statistikBulanan) : $statistikBulanan->sum() }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card text-center shadow-sm">
                                <div class="card-body p-2">
                                    <h6 class="mb-1">Bulan Terakhir</h6>
                                    <h5 class="text-success mb-0">
                                        {{ (is_array($statistikBulanan) ? end($statistikBulanan) : $statistikBulanan->last()) ?? 0 }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas id="chartBulanan"></canvas>
                </div>
            </div>
        </div>

        <!-- Tahunan -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    Grafik Pertumbuhan Tahunan
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="card text-center shadow-sm">
                                <div class="card-body p-2">
                                    <h6 class="mb-1">Tahun Terdata</h6>
                                    <h5 class="text-primary mb-0">
                                        {{ is_array($statistikTahunan) ? count($statistikTahunan) : $statistikTahunan->count() }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card text-center shadow-sm">
                                <div class="card-body p-2">
                                    <h6 class="mb-1">Total UMKM</h6>
                                    <h5 class="text-success mb-0">
                                        {{ is_array($statistikTahunan) ? end($statistikTahunan) : $statistikTahunan->last() }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
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

    <!-- Chart Utama dengan Dropdown & Filter Tahun/Bulan -->
    <div class="d-flex justify-content-center mb-4">
        <div class="card shadow-sm w-100" style="max-width: 900px;">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span>📊 Grafik Statistik</span>
                <div class="d-flex gap-2">
                    <!-- Dropdown Tahun -->
                    <select id="tahunFilter" class="form-select w-auto">
                        @foreach($daftarTahun as $tahun)
                            <option value="{{ $tahun }}" {{ $tahun == $tahunSekarang ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Dropdown Chart -->
                    <select id="chartSelector" class="form-select w-auto">
                        <option value="umkm">Pertumbuhan UMKM</option>
                        <option value="karyawan">Pertumbuhan Karyawan</option>
                        <option value="kategori">UMKM per Kategori</option>
                        <option value="daerah">UMKM per Daerah</option>
                        <option value="sektor">UMKM per Sektor</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <!-- Filter Bulan -->
                <div class="d-flex flex-wrap gap-2 mb-3" id="bulanFilter">
                    @foreach(range(1,12) as $bulan)
                        <button type="button" class="btn btn-sm btn-outline-primary bulan-btn" data-bulan="{{ $bulan }}">
                            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('M') }}
                        </button>
                    @endforeach
                    <button type="button" class="btn btn-sm btn-outline-primary bulan-btn" data-bulan="all">All</button>
                </div>

                <div style="max-height: 400px;">
                    <canvas id="chartUtama"></canvas>
                </div>
                <div class="row mt-3" id="summaryCards"></div>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('noauth.umkm.index') }}" id="searchForm" class="mb-3 d-flex">
        <input type="text" name="nama" value="{{ request('nama') }}" class="form-control" placeholder="Cari UMKM..." id="searchInput">
    </form>

    <!-- Tabel UMKM -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-dark text-white">Data UMKM</div>
        <div class="card-body" id="umkmTable">
            @include('noauth.umkm.table')
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // === Helper Warna ===
    const colors = [
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 159, 64, 0.6)'
    ];
    const bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

    // === Data dari Backend ===
    const statistikBulanan = @json($statistikBulanan);
    const statistikTahunan = @json($statistikTahunan);
    const karyawanBulanan  = @json($karyawanBulanan);
    const kategoriBulanan  = @json($kategoriBulanan);
    const daerahBulanan    = @json($daerahBulanan);
    const sektorBulanan    = @json($sektorBulanan);
    const tahunDipilih     = @json($tahunDipilih);
    const bulanDipilih     = @json($bulanDipilih);

    // === Data Bulanan UMKM (non kumulatif) ===
    let dataBulanan = Array(12).fill(0);
    for (const [bulan, total] of Object.entries(statistikBulanan)) {
        const idx = parseInt(bulan) - 1;
        if (idx >= 0 && idx < 12) dataBulanan[idx] = total ?? 0;
    }

    // === Data Bulanan Karyawan ===
    let dataKaryawan = Array(12).fill(0);
    for (const [bulan, total] of Object.entries(karyawanBulanan)) {
        const idx = parseInt(bulan) - 1;
        if (idx >= 0 && idx < 12) dataKaryawan[idx] = total ?? 0;
    }

    // === Build Multi-Line Dataset ===
    function buildDataset(dataObj) {
        return Object.keys(dataObj).map((key, i) => ({
            label: key,
            data: Object.values(dataObj[key]),
            borderColor: colors[i % colors.length],
            backgroundColor: colors[i % colors.length],
            fill: false,
            tension: 0.3
        }));
    }

    const datasetsKategori = buildDataset(kategoriBulanan);
    const datasetsDaerah   = buildDataset(daerahBulanan);
    const datasetsSektor   = buildDataset(sektorBulanan);

    // === Chart Utama ===
    const ctx = document.getElementById('chartUtama').getContext('2d');
    let chartUtama = new Chart(ctx, {
        type: 'line',
        data: { 
            labels: bulanLabels,
            datasets: [{ label: 'Total UMKM', data: dataBulanan, borderColor: colors[0], fill: false }] 
        }
    });

    function updateSummaryCards(labels, values) {
        const container = document.getElementById("summaryCards");
        container.innerHTML = "";
        labels.forEach((label, i) => {
            container.innerHTML += `
                <div class="col-md-3 col-6 mb-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body p-2">
                            <h6 class="mb-1">${label}</h6>
                            <h5 class="fw-bold text-primary mb-0">${values[i]}</h5>
                        </div>
                    </div>
                </div>`;
        });
        let grandTotal = values.reduce((a,b) => a + (parseInt(b)||0),0);
        container.innerHTML += `
            <div class="col-md-3 col-6 mb-3">
                <div class="card text-center shadow-sm bg-light">
                    <div class="card-body p-2">
                        <h6 class="mb-1">Grand Total</h6>
                        <h5 class="fw-bold text-success mb-0">${grandTotal}</h5>
                    </div>
                </div>
            </div>`;
    }

    function updateChart(type, bulan=null) {
        let dataSets=[], summaryLabels=[], summaryValues=[];
        if(type==='umkm') {
            let data = [...dataBulanan];
            if(bulan!==null) data = [data[bulan]];
            dataSets = [{label:'Total UMKM', data:data, borderColor: colors[0], fill:false}];
            summaryLabels = bulan!==null ? [bulanLabels[bulan]] : bulanLabels;
            summaryValues = bulan!==null ? [dataBulanan[bulan]] : dataBulanan;
        }
        else if(type==='karyawan') {
            let data = [...dataKaryawan];
            if(bulan!==null) data = [data[bulan]];
            dataSets = [{label:'Total Karyawan', data:data, borderColor: colors[1], fill:false}];
            summaryLabels = bulan!==null ? [bulanLabels[bulan]] : bulanLabels;
            summaryValues = bulan!==null ? [dataKaryawan[bulan]] : dataKaryawan;
        }
        else if(type==='kategori'){ 
            dataSets = datasetsKategori;
            summaryLabels = Object.keys(kategoriBulanan);
            summaryValues = summaryLabels.map(k => Object.values(kategoriBulanan[k]).reduce((a,b)=>a+b,0));
        }
        else if(type==='daerah'){ 
            dataSets = datasetsDaerah;
            summaryLabels = Object.keys(daerahBulanan);
            summaryValues = summaryLabels.map(k => Object.values(daerahBulanan[k]).reduce((a,b)=>a+b,0));
        }
        else if(type==='sektor'){ 
            dataSets = datasetsSektor;
            summaryLabels = Object.keys(sektorBulanan);
            summaryValues = summaryLabels.map(k => Object.values(sektorBulanan[k]).reduce((a,b)=>a+b,0));
        }

        chartUtama.data = { labels: bulanLabels, datasets: dataSets };
        chartUtama.update();
        updateSummaryCards(summaryLabels, summaryValues);
    }

    // === Event Listeners ===
    document.getElementById('chartSelector').addEventListener('change', function(){ 
        updateChart(this.value); 
    });

    document.querySelectorAll('.bulan-btn').forEach(btn => btn.addEventListener('click', function(){
        const b = this.dataset.bulan === 'all' ? null : parseInt(this.dataset.bulan);
        const tahun = document.getElementById('tahunFilter').value;

        let url = new URL(window.location.href);
        url.searchParams.set('tahun', tahun);
        if (b) {
            url.searchParams.set('bulan', b);
        } else {
            url.searchParams.delete('bulan');
        }
        window.location.href = url.toString();
    }));

    document.getElementById('tahunFilter').addEventListener('change', function(){
        const tahun = this.value;
        let url = new URL(window.location.href);
        url.searchParams.set('tahun', tahun);
        url.searchParams.delete('bulan'); // reset bulan ke ALL
        // if (bulanDipilih) url.searchParams.set('bulan', bulanDipilih);
        window.location.href = url.toString();
    });

    // === Set active bulan button saat reload ===
    if (bulanDipilih) {
        document.querySelectorAll('.bulan-btn').forEach(btn => {
            if (btn.dataset.bulan == bulanDipilih) btn.classList.add('active');
        });
    } else {
        document.querySelector('.bulan-btn[data-bulan="all"]').classList.add('active');
    }

    // Load default chart
    updateChart('umkm');

    // === AJAX Search + Pagination (ikut filter tahun/bulan) ===
    let timer = null;
    $('#searchInput').on('input', function() {
        clearTimeout(timer);
        let keyword = $(this).val();
        timer = setTimeout(() => {
            $.get("{{ route('noauth.umkm.index') }}", { 
                nama: keyword, 
                tahun: $('#tahunFilter').val(), 
                bulan: $('.bulan-btn.active').data('bulan') 
            }, function(data) {
                $('#umkmTable').html($(data).find('#umkmTable').html());
            });
        }, 300);
    });
    $(document).on('click', '#umkmTable .pagination a', function(e) {
        e.preventDefault();
        let url = new URL($(this).attr('href'));
        url.searchParams.set('tahun', $('#tahunFilter').val());
        url.searchParams.set('bulan', $('.bulan-btn.active').data('bulan'));
        $.get(url.toString(), function(data) {
            $('#umkmTable').html($(data).find('#umkmTable').html());
        });
    });

    // === Chart Khusus Lain ===
    function simpleLineChart(canvasId, labels, data) {
        new Chart(document.getElementById(canvasId), { 
            type:'line', 
            data:{labels:labels, datasets:[{label:'Total', data:data, borderColor: colors[2], fill:false}]} 
        });
    }
    function simpleBarChart(canvasId, labels, data){
        new Chart(document.getElementById(canvasId), { 
            type:'bar', 
            data:{labels:labels, datasets:[{label:'Total', data:data, backgroundColor:labels.map((_,i)=>colors[i%colors.length])}]} 
        });
    }
    function simplePieChart(canvasId, labels, data){
        new Chart(document.getElementById(canvasId), { 
            type:'pie', 
            data:{labels:labels, datasets:[{data:data, backgroundColor:labels.map((_,i)=>colors[i%colors.length])}]} 
        });
    }

    simpleLineChart('chartBulanan', bulanLabels, dataBulanan);
    simpleLineChart('chartTahunan', Object.keys(statistikTahunan), Object.values(statistikTahunan));
    simpleBarChart('chartDaerah', Object.keys(daerahBulanan), Object.values(daerahBulanan).map(v=>Object.values(v).reduce((a,b)=>a+b,0)));
    simpleBarChart('chartSektor', Object.keys(sektorBulanan), Object.values(sektorBulanan).map(v=>Object.values(v).reduce((a,b)=>a+b,0)));
    simplePieChart('chartKategori', Object.keys(kategoriBulanan), Object.values(kategoriBulanan).map(v=>Object.values(v).reduce((a,b)=>a+b,0)));
});
</script>
@endsection
