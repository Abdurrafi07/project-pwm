
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
            <?php $__empty_1 = true; $__currentLoopData = $umkms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $umkm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($umkm->id); ?></td>
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
        <?php echo e($umkms->withQueryString()->links('layouts.pagination')); ?>

    </div>
</div>
<?php /**PATH C:\laragon\www\project-pwm\resources\views/noauth/umkm/table.blade.php ENDPATH**/ ?>