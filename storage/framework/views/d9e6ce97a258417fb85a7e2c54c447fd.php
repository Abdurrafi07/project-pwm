
<?php $__env->startSection('title', 'Kategori'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1 class="mb-3">Daftar Kategori</h1>

    <a href="<?php echo e(route('admin.kategori.create')); ?>" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Kategori
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
            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration + ($kategoris->currentPage()-1)*$kategoris->perPage()); ?></td>
                <td><?php echo e($kategori->nama); ?></td>
                <td><?php echo e($kategori->deskripsi); ?></td>
                <td><?php echo e($kategori->umkms_count); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.kategori.edit', $kategori)); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?php echo e(route('admin.kategori.destroy', $kategori)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($kategoris->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\kategori\index.blade.php ENDPATH**/ ?>