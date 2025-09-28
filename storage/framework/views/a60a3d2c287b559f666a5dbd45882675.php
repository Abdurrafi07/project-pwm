

<?php $__env->startSection('title', 'Daerah'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Daftar Daerah</h1>

    <a href="<?php echo e(route('admin.daerah.create')); ?>" class="btn btn-primary mb-3">Tambah Daerah</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Jumlah UMKM</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $daerahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $daerah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($daerah->id); ?></td>
                    <td><?php echo e($daerah->nama); ?></td>
                    <td><?php echo e($daerah->deskripsi); ?></td>
                    <td><?php echo e($daerah->umkms_count); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.daerah.edit', $daerah)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('admin.daerah.destroy', $daerah)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($daerahs->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views/admin/daerah/index.blade.php ENDPATH**/ ?>