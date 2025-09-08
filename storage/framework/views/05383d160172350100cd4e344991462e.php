
<?php $__env->startSection('title', 'Edit Kategori'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1>Edit Kategori</h1>
    <form action="<?php echo e(route('admin.kategori.update', $kategori)); ?>" method="POST">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" value="<?php echo e(old('nama', $kategori->nama)); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control"><?php echo e(old('deskripsi', $kategori->deskripsi)); ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="<?php echo e(route('admin.kategori.index')); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\kategori\edit.blade.php ENDPATH**/ ?>