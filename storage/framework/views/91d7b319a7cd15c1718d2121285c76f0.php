

<?php $__env->startSection('title', $umkm->nama); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo e($umkm->nama); ?></h1>
    <p><strong>Pemilik:</strong> <?php echo e($umkm->pemilik ?? '-'); ?></p>
    <p><strong>Alamat:</strong> <?php echo e($umkm->alamat ?? '-'); ?></p>
    <p><strong>Kategori:</strong> <?php echo e($umkm->kategori->nama); ?></p>
    <p><strong>Daerah:</strong> <?php echo e($umkm->daerah->nama); ?></p>

    <a href="<?php echo e(route('umkm.index')); ?>" class="btn btn-secondary">← Kembali</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\noauth\umkm\show.blade.php ENDPATH**/ ?>