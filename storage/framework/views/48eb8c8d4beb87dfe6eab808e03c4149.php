
<?php $__env->startSection('title', 'sektor'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1 class="mb-3">Daftar sektor</h1>

    <a href="<?php echo e(route('admin.sektor.create')); ?>" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah sektor
    </a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Jumlah UMKM</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $sektors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sektor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($sektor->id); ?></td>
                <td><?php echo e($sektor->nama); ?></td>
                <td><?php echo e($sektor->deskripsi); ?></td>
                <td><?php echo e($sektor->umkms_count); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.sektor.edit', $sektor)); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?php echo e(route('admin.sektor.destroy', $sektor)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus sektor ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($sektors->withQueryString()->links('layouts.pagination')); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views/admin/sektor/index.blade.php ENDPATH**/ ?>