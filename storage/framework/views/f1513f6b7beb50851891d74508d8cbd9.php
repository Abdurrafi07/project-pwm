

<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<h1>Dashboard Admin</h1>
<div>
    <p>Total UMKM: <?php echo e($totalUmkm); ?></p>
    <p>Total Berita: <?php echo e($totalNews); ?></p>
    <p>Total Pengurus: <?php echo e($totalPengurus); ?></p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\dashboard\index.blade.php ENDPATH**/ ?>