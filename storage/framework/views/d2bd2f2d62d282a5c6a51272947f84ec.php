
<?php $__env->startSection('title', 'History Lowongan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1 class="mb-3">History Lowongan</h1>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-secondary">
                    <tr>
                        <th>Judul</th>
                        <th>Perusahaan</th>
                        <th>Lokasi</th>
                        <th>No HP/WA</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $lowongans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($l->judul); ?></td>
                        <td><?php echo e($l->perusahaan); ?></td>
                        <td><?php echo e($l->lokasi); ?></td>
                        <td><?php echo e($l->no_hp); ?></td>
                        <td><?php echo e($l->tanggal_mulai?->format('d-m-Y H:i')); ?></td>
                        <td><?php echo e($l->tanggal_akhir?->format('d-m-Y H:i')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada lowongan yang sudah berakhir</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <?php echo e($lowongans->links()); ?>

    </div>

    <div class="mt-3">
        <a href="<?php echo e(route('admin.lowongan.index')); ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\lowongan\history.blade.php ENDPATH**/ ?>