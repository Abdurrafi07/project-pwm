

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Pengurus</h1>
    <form action="<?php echo e(route('admin.penguruses.update', $pengurus->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?php echo e(old('nama', $pengurus->nama)); ?>">
        </div>
        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="<?php echo e(old('jabatan', $pengurus->jabatan)); ?>">
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"><?php echo e(old('deskripsi', $pengurus->deskripsi)); ?></textarea>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
            <?php if($pengurus->gambar): ?>
                <img src="<?php echo e(asset('storage/'.$pengurus->gambar)); ?>" width="100" class="mt-2">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\penguruses\edit.blade.php ENDPATH**/ ?>