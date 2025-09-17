

<?php $__env->startSection('title', 'Daftar UMKM'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Daftar UMKM</h1>

    <!-- Statistik Angka -->
    <div class="mb-3">
        <span class="badge bg-primary">Total UMKM: <?php echo e($totalUmkm); ?></span>
        <span class="badge bg-success">Total Karyawan: <?php echo e($totalKaryawan); ?></span>
    </div>

    <!-- Grafik Pertumbuhan -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    Grafik Pertumbuhan Bulanan (<?php echo e($tahunSekarang); ?>)
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
                    <?php $__empty_1 = true; $__currentLoopData = $umkms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $umkm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration + ($umkms->currentPage() - 1) * $umkms->perPage()); ?></td>
                            <td><?php echo e($umkm->nama); ?></td>
                            <td><?php echo e($umkm->daerah->nama ?? '-'); ?></td>
                            <td><?php echo e($umkm->sektor->nama ?? '-'); ?></td>
                            <td><?php echo e($umkm->kategori->nama ?? '-'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data UMKM</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                <?php echo e($umkms->links('layouts.pagination')); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
        const statistikBulanan = <?php echo json_encode($statistikBulanan, 15, 512) ?>;

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
        const tahunLabels = Object.keys(<?php echo json_encode($statistikTahunan, 15, 512) ?>);
        const tahunData   = Object.values(<?php echo json_encode($statistikTahunan, 15, 512) ?>);

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
                labels: <?php echo json_encode($daerahLabels, 15, 512) ?>,
                datasets: [{
                    data: <?php echo json_encode($daerahCounts, 15, 512) ?>,
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
                        let daerahId = <?php echo json_encode($daerahs->pluck('id'), 15, 512) ?>[index];
                        applyFilter('daerah_id', daerahId);
                    }
                }
            }
        });

        // ==== Chart Sektor ====
        const sektorChart = new Chart(document.getElementById('chartSektor'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($sektorLabels, 15, 512) ?>,
                datasets: [{
                    data: <?php echo json_encode($sektorCounts, 15, 512) ?>,
                    backgroundColor: 'rgba(255, 159, 64, 0.6)'
                }]
            },
            options: {
                onClick: (evt, elements) => {
                    if (elements.length > 0) {
                        let index = elements[0].index;
                        let sektorId = <?php echo json_encode($sektors->pluck('id'), 15, 512) ?>[index];
                        applyFilter('sektor_id', sektorId);
                    }
                }
            }
        });

        // ==== Chart Kategori ====
        const kategoriChart = new Chart(document.getElementById('chartKategori'), {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($kategoriLabels, 15, 512) ?>,
                datasets: [{
                    data: <?php echo json_encode($kategoriCounts, 15, 512) ?>,
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
                        let kategoriId = <?php echo json_encode($kategoris->pluck('id'), 15, 512) ?>[index];
                        applyFilter('kategori_id', kategoriId);
                    }
                }
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\noauth\umkm\index.blade.php ENDPATH**/ ?>