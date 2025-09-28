

<?php $__env->startSection('title', 'Daftar UMKM'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Daftar UMKM</h1>

    <!-- Statistik Utama -->
    <div class="mb-3">
        <span class="badge bg-primary">Total UMKM: <?php echo e($totalUmkm); ?></span>
        <span class="badge bg-success">Total Karyawan: <?php echo e($totalKaryawan); ?></span>
    </div>

    <!-- Grafik Pertumbuhan -->
    <div class="row mb-4">
        <!-- Bulanan -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    Grafik Pertumbuhan Bulanan (<?php echo e($tahunSekarang); ?>)
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="card text-center shadow-sm">
                                <div class="card-body p-2">
                                    <h6 class="mb-1">Total Tahun Ini</h6>
                                    <h5 class="text-primary mb-0">
                                        <?php echo e(is_array($statistikBulanan) ? array_sum($statistikBulanan) : $statistikBulanan->sum()); ?>

                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card text-center shadow-sm">
                                <div class="card-body p-2">
                                    <h6 class="mb-1">Bulan Terakhir</h6>
                                    <h5 class="text-success mb-0">
                                        <?php echo e((is_array($statistikBulanan) ? end($statistikBulanan) : $statistikBulanan->last()) ?? 0); ?>

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
                                        <?php echo e(is_array($statistikTahunan) ? count($statistikTahunan) : $statistikTahunan->count()); ?>

                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card text-center shadow-sm">
                                <div class="card-body p-2">
                                    <h6 class="mb-1">Total UMKM</h6>
                                    <h5 class="text-success mb-0">
                                        <?php echo e(is_array($statistikTahunan) ? end($statistikTahunan) : $statistikTahunan->last()); ?>

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
                        <option value="all" <?php echo e(request('tahun','all')=='all'?'selected':''); ?>>Semua Tahun</option>
                        <?php $__currentLoopData = $daftarTahun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tahun); ?>" <?php echo e(request('tahun')==$tahun?'selected':''); ?>>
                                <?php echo e($tahun); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <?php $__currentLoopData = range(1,12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bulan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button"
                                class="btn btn-sm btn-outline-primary bulan-btn <?php echo e(request('bulan')==$bulan?'active':''); ?>"
                                data-bulan="<?php echo e($bulan); ?>">
                            <?php echo e(\Carbon\Carbon::create()->month($bulan)->translatedFormat('M')); ?>

                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <button type="button"
                            class="btn btn-sm btn-outline-primary bulan-btn <?php echo e(request('bulan')=='all'?'active':''); ?>"
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
    <form method="GET" action="<?php echo e(route('noauth.umkm.index')); ?>" id="searchForm" class="mb-3 d-flex">
        <input type="hidden" name="tahun" value="<?php echo e(request('tahun','all')); ?>">
        <input type="hidden" name="bulan" value="<?php echo e(request('bulan','all')); ?>">
        <input type="text" name="nama" value="<?php echo e(request('nama')); ?>" class="form-control" placeholder="Cari UMKM..." id="searchInput">
    </form>

    <!-- Tabel UMKM -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-dark text-white">Data UMKM</div>
        <div class="card-body" id="umkmTable">
            <?php echo $__env->make('noauth.umkm.table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
    const statistikBulanan = <?php echo json_encode($statistikBulanan, 15, 512) ?>;
    const statistikTahunan = <?php echo json_encode($statistikTahunan, 15, 512) ?>;
    const karyawanBulanan  = <?php echo json_encode($karyawanBulanan, 15, 512) ?>;
    const kategoriBulanan  = <?php echo json_encode($kategoriBulanan, 15, 512) ?>;
    const daerahBulanan    = <?php echo json_encode($daerahBulanan, 15, 512) ?>;
    const sektorBulanan    = <?php echo json_encode($sektorBulanan, 15, 512) ?>;
    const kategoris        = <?php echo json_encode($kategoris, 15, 512) ?>;
    const daerahs          = <?php echo json_encode($daerahs, 15, 512) ?>;
    const sektors          = <?php echo json_encode($sektors, 15, 512) ?>;

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

    // === Dataset multi-series ===
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

    // === Chart utama ===
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
        const totalFromBackend = <?php echo e($totalUmkm); ?>;
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

    // === AJAX Tabel UMKM ===
    function updateTable(extraParams={}) {
        let params = {
            nama: $('#searchInput').val(),
            tahun: $('input[name="tahun"]').val(),
            bulan: $('input[name="bulan"]').val(),
            ...extraParams
        };
        $.get("<?php echo e(route('noauth.umkm.index')); ?>", params, function (data) {
            $('#umkmTable').html($(data).find('#umkmTable').html());
        });
    }

    // === Sinkronisasi tombol bulan ===
    function setActiveBulan(bulan) {
        $('.bulan-btn').removeClass('active');
        if(bulan === 'all'){
            $('.bulan-btn[data-bulan="all"]').addClass('active');
            $('input[name="bulan"]').val('all');
        } else {
            $('.bulan-btn[data-bulan="'+bulan+'"]').addClass('active');
            $('input[name="bulan"]').val(bulan);
        }
    }

    // === Klik chart filter tabel ===
    function enableClickFilter(chart, type) {
        chart.options.onClick = function(evt,elements){
            if(elements.length > 0){
                const idx = elements[0].index;
                const label = chart.data.labels[idx];

                if(type === 'bulan'){ 
                    const bulanIndex = bulanLabels.indexOf(label) + 1; 
                    setActiveBulan(bulanIndex);
                    updateChart('umkm', bulanIndex-1); 
                    updateTable({ bulan: bulanIndex });
                }
                else if(type === 'tahun'){ 
                    updateTable({ tahun: label });
                }
                else if(type === 'kategori'){ 
                    // gunakan kategori_id sesuai backend
                    const kategoriObj = kategoris.find(k => k.nama === label);
                    if (kategoriObj) updateTable({ kategori_id: kategoriObj.id });
                }
                else if(type === 'daerah'){ 
                    // gunakan daerah_id sesuai backend
                    const daerahObj = daerahs.find(d => d.nama === label);
                    if (daerahObj) updateTable({ daerah_id: daerahObj.id });
                }
                else if(type === 'sektor'){ 
                    // gunakan sektor_id sesuai backend
                    const sektorObj = sektors.find(s => s.nama === label);
                    if (sektorObj) updateTable({ sektor_id: sektorObj.id });
                }
            }
        };
    }


    // === Chart kecil ===
    function simpleLineChart(id,l,d,type='bulan'){
        const c = new Chart(document.getElementById(id),{
            type:'line',
            data:{labels:l,datasets:[{label:'Total',data:d,borderColor:colors[2],fill:false}]}
        });
        enableClickFilter(c, type);
        return c;
    }
    function simpleBarChart(id,labels,data,type){
        const c = new Chart(document.getElementById(id),{
            type:'bar',
            data:{
                labels:labels,
                datasets:[{
                    label:'Total',
                    data:labels.map((_,i)=>data[i] ?? 0),
                    backgroundColor:labels.map((_,i)=>colors[i%colors.length]),
                    borderColor:labels.map((_,i)=>colors[i%colors.length].replace('0.6','1')),
                    borderWidth:1
                }]
            },
            options:{
                responsive:true,
                plugins:{ legend:{ display:false } },
                scales:{ y:{ beginAtZero:true } }
            }
        });
        enableClickFilter(c, type);
        return c;
    }
    function simplePieChart(id,labels,data,type){
        const warnaKategori = [
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)'
        ];
        const c = new Chart(document.getElementById(id),{
            type:'pie',
            data:{
                labels:labels,
                datasets:[{
                    data:labels.map((_,i)=>data[i] ?? 0),
                    backgroundColor:warnaKategori,
                    borderColor:warnaKategori.map(c=>c.replace('0.6','1')),
                    borderWidth:1
                }]
            },
            options:{ plugins:{ legend:{ position:'bottom' } } }
        });
        enableClickFilter(c, type);
        return c;
    }

    // === Data master kategori/daerah/sektor ===
    const lblKategori = kategoris.map(k => k.nama);
    const valKategori = lblKategori.map(nama => kategoriBulanan[nama]
        ? Object.values(kategoriBulanan[nama]).reduce((a,b)=>a+b,0)
        : 0);
    const lblDaerah = daerahs.map(d => d.nama);
    const valDaerah = lblDaerah.map(nama => daerahBulanan[nama]
        ? Object.values(daerahBulanan[nama]).reduce((a,b)=>a+b,0)
        : 0);
    const lblSektor = sektors.map(s => s.nama);
    const valSektor = lblSektor.map(nama => sektorBulanan[nama]
        ? Object.values(sektorBulanan[nama]).reduce((a,b)=>a+b,0)
        : 0);

    // === Render chart kecil dengan filter klik ===
    const chartBulanan = simpleLineChart('chartBulanan',bulanLabels,dataBulanan,'bulan');
    const chartTahunan = simpleLineChart('chartTahunan',Object.keys(statistikTahunan),Object.values(statistikTahunan),'tahun');
    const chartDaerah  = simpleBarChart('chartDaerah',lblDaerah,valDaerah,'daerah');
    const chartSektor  = simpleBarChart('chartSektor',lblSektor,valSektor,'sektor');
    const chartKategori= simplePieChart('chartKategori',lblKategori,valKategori,'kategori');

    // === Event listeners tambahan ===
    document.getElementById('chartSelector').addEventListener('change',()=> {
        updateChart(document.getElementById('chartSelector').value);
    });
    document.querySelectorAll('.bulan-btn').forEach(btn=>{
        btn.addEventListener('click',function(){
            const b = this.dataset.bulan;
            if(b === 'all'){ 
                updateChart('umkm', null); 
                updateTable({ bulan:'all' });
                setActiveBulan('all');
            }
            else { 
                updateChart('umkm', parseInt(b)-1); 
                updateTable({ bulan:parseInt(b) });
                setActiveBulan(b);
            }
        });
    });
    document.getElementById('tahunFilter').addEventListener('change',function(){
        let url=new URL(window.location.href);
        url.searchParams.set('tahun',this.value);
        window.location.href=url.toString();
    });

    // === AJAX Search & Pagination ===
    let timer=null;
    $('#searchInput').on('input',function(){
        clearTimeout(timer);
        const keyword=$(this).val();
        timer=setTimeout(()=>{
            updateTable();
        },300);
    });
    $(document).on('click','#umkmTable .pagination a',function(e){
        e.preventDefault();
        $.get($(this).attr('href'),function(data){
            $('#umkmTable').html($(data).find('#umkmTable').html());
        });
    });

    // === Default chart ===
    updateChart('umkm');
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views/noauth/umkm/index.blade.php ENDPATH**/ ?>