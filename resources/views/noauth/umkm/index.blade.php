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
                        <option value="all" {{ request('tahun','all')=='all'?'selected':'' }}>Semua Tahun</option>
                        @foreach($daftarTahun as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun')==$tahun?'selected':'' }}>
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
                        <button type="button"
                                class="btn btn-sm btn-outline-primary bulan-btn {{ request('bulan')==$bulan?'active':'' }}"
                                data-bulan="{{ $bulan }}">
                            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('M') }}
                        </button>
                    @endforeach
                    <button type="button"
                            class="btn btn-sm btn-outline-primary bulan-btn {{ request('bulan')=='all'?'active':'' }}"
                            data-bulan="all">All</button>
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
        <input type="hidden" name="tahun" value="{{ request('tahun','all') }}">
        <input type="hidden" name="bulan" value="{{ request('bulan','all') }}">
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
    const colors = [
        'rgba(255, 99, 132, 0.6)','rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)','rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)','rgba(255, 159, 64, 0.6)'
    ];
    const bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

    // === Data dari backend ===
    const statistikBulanan = @json($statistikBulanan);
    const statistikTahunan = @json($statistikTahunan);
    const karyawanBulanan  = @json($karyawanBulanan);
    const kategoriBulanan  = @json($kategoriBulanan);
    const daerahBulanan    = @json($daerahBulanan);
    const sektorBulanan    = @json($sektorBulanan);
    const kategoris        = @json($kategoris);
    const daerahs          = @json($daerahs);
    const sektors          = @json($sektors);

    // === Data UMKM & Karyawan per bulan ===
    let dataBulanan = Array(12).fill(0);
    for (const [bulan, total] of Object.entries(statistikBulanan)) {
        const idx = parseInt(bulan) - 1;
        if (idx >= 0 && idx < 12) dataBulanan[idx] = total ?? 0;
    }

    let dataKaryawan = Array(12).fill(0);
    for (const [bulan, total] of Object.entries(karyawanBulanan)) {
        const idx = parseInt(bulan) - 1;
        if (idx >= 0 && idx < 12) dataKaryawan[idx] = total ?? 0;
    }

    // === Helper dataset multi-series ===
    function buildDataset(obj) {
        return Object.keys(obj).map((key,i)=>({
            label:key,
            data:Object.values(obj[key]),
            borderColor:colors[i%colors.length],
            backgroundColor:colors[i%colors.length],
            fill:false,tension:0.3
        }));
    }
    const datasetsKategori = buildDataset(kategoriBulanan);
    const datasetsDaerah   = buildDataset(daerahBulanan);
    const datasetsSektor   = buildDataset(sektorBulanan);

    // === Chart Utama ===
    const ctx = document.getElementById('chartUtama').getContext('2d');
    let chartUtama = new Chart(ctx,{
        type:'line',
        data:{
            labels:bulanLabels,
            datasets:[{label:'Total UMKM',data:dataBulanan,borderColor:colors[0],fill:false}]
        }
    });

    // === Summary Cards ===
    function updateSummaryCards(labels, values){
        const c=document.getElementById("summaryCards");
        c.innerHTML="";
        labels.forEach((l,i)=>{
            c.innerHTML+=`
            <div class="col-md-3 col-6 mb-3">
              <div class="card text-center shadow-sm">
                <div class="card-body p-2">
                  <h6 class="mb-1">${l}</h6>
                  <h5 class="fw-bold text-primary mb-0">${values[i]}</h5>
                </div>
              </div>
            </div>`;
        });
        // gunakan total dari backend agar sesuai filter tahun
        const totalFromBackend = {{ $totalUmkm }};
        c.innerHTML+=`
        <div class="col-md-3 col-6 mb-3">
          <div class="card text-center shadow-sm bg-light">
            <div class="card-body p-2">
              <h6 class="mb-1">Grand Total</h6>
              <h5 class="fw-bold text-success mb-0">${totalFromBackend}</h5>
            </div>
          </div>
        </div>`;
    }

    // === Update Chart & Summary ===
    function updateChart(type, bulan=null){
        let ds=[], lbl=[], val=[];
        if(type==='umkm'){
            let d=[...dataBulanan];
            if(bulan!==null) d=[d[bulan]];
            ds=[{label:'Total UMKM',data:d,borderColor:colors[0],fill:false}];
            lbl=bulan!==null?[bulanLabels[bulan]]:bulanLabels;
            val=bulan!==null?[dataBulanan[bulan]]:dataBulanan;
        } else if(type==='karyawan'){
            let d=[...dataKaryawan];
            if(bulan!==null) d=[d[bulan]];
            ds=[{label:'Total Karyawan',data:d,borderColor:colors[1],fill:false}];
            lbl=bulan!==null?[bulanLabels[bulan]]:bulanLabels;
            val=bulan!==null?[dataKaryawan[bulan]]:dataKaryawan;
        } else if(type==='kategori'){
            ds=datasetsKategori;
            lbl=kategoris.map(k=>k.nama);
            val=lbl.map(nama => kategoriBulanan[nama]
                ? Object.values(kategoriBulanan[nama]).reduce((a,b)=>a+b,0)
                : 0);
        } else if(type==='daerah'){
            ds=datasetsDaerah;
            lbl=daerahs.map(d=>d.nama);
            val=lbl.map(nama => daerahBulanan[nama]
                ? Object.values(daerahBulanan[nama]).reduce((a,b)=>a+b,0)
                : 0);
        } else if(type==='sektor'){
            ds=datasetsSektor;
            lbl=sektors.map(s=>s.nama);
            val=lbl.map(nama => sektorBulanan[nama]
                ? Object.values(sektorBulanan[nama]).reduce((a,b)=>a+b,0)
                : 0);
        }
        chartUtama.data = { labels: lbl, datasets: ds };
        chartUtama.update();
        updateSummaryCards(lbl, val);
    }

    // === Event Listeners ===
    document.getElementById('chartSelector').addEventListener('change',()=> {
        updateChart(document.getElementById('chartSelector').value);
    });
    document.querySelectorAll('.bulan-btn').forEach(btn=>{
        btn.addEventListener('click',function(){
            const b = this.dataset.bulan;
            if(b === 'all'){ updateChart('umkm', null); }
            else { updateChart('umkm', parseInt(b)-1); }
        });
    });
    document.getElementById('tahunFilter').addEventListener('change',function(){
        let url=new URL(window.location.href);
        url.searchParams.set('tahun',this.value);
        window.location.href=url.toString();
    });

    // default chart saat load
    updateChart('umkm');

    // === AJAX Search Tabel UMKM ===
    let timer=null;
    $('#searchInput').on('input',function(){
        clearTimeout(timer);
        const keyword=$(this).val();
        timer=setTimeout(()=>{
            $.get("{{ route('noauth.umkm.index') }}",
                { nama:keyword, tahun:$('input[name="tahun"]').val(), bulan:$('input[name="bulan"]').val() },
                function(data){
                    $('#umkmTable').html($(data).find('#umkmTable').html());
                });
        },300);
    });
    $(document).on('click','#umkmTable .pagination a',function(e){
        e.preventDefault();
        $.get($(this).attr('href'),function(data){
            $('#umkmTable').html($(data).find('#umkmTable').html());
        });
    });

    // === Chart kecil tambahan (klik untuk filter tabel) ===
    function redirectWithFilter(type,label){
        let url = new URL(window.location.href);
        if(type==='kategori'){
            const item = kategoris.find(k=>k.nama===label);
            if(item) url.searchParams.set('kategori_id', item.id);
        }
        if(type==='daerah'){
            const item = daerahs.find(d=>d.nama===label);
            if(item) url.searchParams.set('daerah_id', item.id);
        }
        if(type==='sektor'){
            const item = sektors.find(s=>s.nama===label);
            if(item) url.searchParams.set('sektor_id', item.id);
        }
        window.location.href = url.toString();
    }

    function simpleLineChart(id,l,d){
        new Chart(document.getElementById(id),{
            type:'line',
            data:{labels:l,datasets:[{label:'Total',data:d,borderColor:colors[2],fill:false}]}
        });
    }
    function simpleBarChart(id,l,d,type){
        new Chart(document.getElementById(id),{
            type:'bar',
            data:{labels:l,datasets:[{label:'Total',data:d,backgroundColor:l.map((_,i)=>colors[i%colors.length])}]},
            options:{
                onClick:(evt,els)=>{ if(els.length>0) redirectWithFilter(type,l[els[0].index]); }
            }
        });
    }

    // === Warna tetap untuk pie chart kategori ===
    const warnaKategori = [
        'rgba(255, 99, 132, 0.6)',   // Mikro
        'rgba(54, 162, 235, 0.6)',   // Kecil
        'rgba(255, 206, 86, 0.6)'    // Menengah
    ];

    function simplePieChart(id,l,d,type){
        new Chart(document.getElementById(id),{
            type:'pie',
            data:{
                labels:l,
                datasets:[{
                    data:d,
                    backgroundColor:warnaKategori, // tetap konsisten
                    borderColor:warnaKategori.map(c=>c.replace('0.6','1')),
                    borderWidth:1
                }]
            },
            options:{
                plugins:{ legend:{ position:'bottom' } },
                onClick:(evt,els)=>{ if(els.length>0) redirectWithFilter(type,l[els[0].index]); }
            }
        });
    }

    // === Fix: pakai data master agar chart kecil tidak berubah bentuk ===
    const lblKategori = kategoris.map(k => k.nama);
    const valKategori = lblKategori.map(nama => {
        return kategoriBulanan[nama]
            ? Object.values(kategoriBulanan[nama]).reduce((a,b)=>a+b,0)
            : 0;
    });

    const lblDaerah = daerahs.map(d => d.nama);
    const valDaerah = lblDaerah.map(nama => {
        return daerahBulanan[nama]
            ? Object.values(daerahBulanan[nama]).reduce((a,b)=>a+b,0)
            : 0;
    });

    const lblSektor = sektors.map(s => s.nama);
    const valSektor = lblSektor.map(nama => {
        return sektorBulanan[nama]
            ? Object.values(sektorBulanan[nama]).reduce((a,b)=>a+b,0)
            : 0;
    });

    // === Render Chart kecil ===
    simpleLineChart('chartBulanan',bulanLabels,dataBulanan);
    simpleLineChart('chartTahunan',Object.keys(statistikTahunan),Object.values(statistikTahunan));
    simpleBarChart('chartDaerah',lblDaerah,valDaerah,'daerah');
    simpleBarChart('chartSektor',lblSektor,valSektor,'sektor');
    simplePieChart('chartKategori',lblKategori,valKategori,'kategori');
});
</script>
@endsection
