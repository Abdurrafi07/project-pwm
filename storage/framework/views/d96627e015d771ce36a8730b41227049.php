
<?php $__env->startSection('title', 'Lowongan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1 class="mb-3">Daftar Lowongan</h1>

    <a href="<?php echo e(route('admin.lowongan.create')); ?>" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Lowongan
    </a>

    <a href="<?php echo e(route('admin.lowongan.history')); ?>" class="btn btn-outline-secondary mb-3 ms-2">
        <i class="fas fa-history"></i> History
    </a>

    <!-- Search Form -->
    <form method="GET" action="<?php echo e(route('admin.lowongan.index')); ?>" id="searchForm" class="mb-3 d-flex">
        <input type="text" name="q" id="searchInput" value="<?php echo e(request('q')); ?>" class="form-control" placeholder="Cari judul lowongan...">
    </form>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Tabel Lowongan -->
    <div id="lowonganTable">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Perusahaan</th>
                    <th>Lokasi</th>
                    <th>No HP/WA</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Akhir</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                <tbody>
                <?php $__currentLoopData = $lowongans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($l->id); ?></td> <!-- pakai ID langsung -->
                    <td><?php echo e($l->judul); ?></td>
                    <td><?php echo e($l->perusahaan); ?></td>
                    <td><?php echo e($l->lokasi); ?></td>
                    <td><?php echo e($l->no_hp); ?></td>
                    <td><?php echo e($l->tanggal_mulai?->format('d-m-Y H:i')); ?></td>
                    <td><?php echo e($l->tanggal_akhir?->format('d-m-Y H:i')); ?></td>
                    <td>
                        <?php if($l->isExpired()): ?>
                            <span class="badge bg-danger">Expired</span>
                        <?php else: ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.lowongan.edit', $l)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('admin.lowongan.destroy', $l)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus lowongan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
        </table>

        <?php echo e($lowongans->withQueryString()->links('layouts.pagination')); ?>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let timer = null;

// Search auto
$('#searchInput').on('keyup', function() {
    clearTimeout(timer);
    let keyword = $(this).val();

    timer = setTimeout(() => {
        $.ajax({
            url: "<?php echo e(route('admin.lowongan.index')); ?>",
            type: "GET",
            data: { q: keyword },
            success: function(data) {
                $('#lowonganTable').html($(data).find('#lowonganTable').html());
            }
        });
    }, 400); // debounce
});

// Pagination AJAX
$(document).on('click', '#lowonganTable .pagination a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    $.get(url, function(data) {
        $('#lowonganTable').html($(data).find('#lowonganTable').html());
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views/admin/lowongan/index.blade.php ENDPATH**/ ?>