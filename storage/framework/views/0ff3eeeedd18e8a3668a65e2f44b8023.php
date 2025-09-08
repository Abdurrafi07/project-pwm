

<?php $__env->startSection('title', 'Tambah Daerah'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Tambah Daerah</h1>

    <form action="<?php echo e(route('admin.daerah.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?php echo e(old('nama')); ?>" required>
            <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control"><?php echo e(old('deskripsi')); ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?php echo e(route('admin.daerah.index')); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\daerah\create.blade.php ENDPATH**/ ?>