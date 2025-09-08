

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Tambah Pengurus</h1>
    <form action="<?php echo e(route('admin.penguruses.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?php echo e(old('nama')); ?>">
        </div>
        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="<?php echo e(old('jabatan')); ?>">
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"><?php echo e(old('deskripsi')); ?></textarea>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\penguruses\create.blade.php ENDPATH**/ ?>