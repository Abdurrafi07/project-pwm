

<?php $__env->startSection('title', 'Pengurus'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">

    <?php if($penguruses->count() > 0): ?>
        <?php
            $main = $penguruses->first();
            $others = $penguruses->slice(1);
        ?>

        <!-- Pengurus Utama -->
        <div class="row mb-5 align-items-center" style="background-color: #1E3A8A; color: #fff; border-radius: 10px; padding: 30px;">
            <div class="col-md-8">
                <h2 style="color:#A3FF00;"><?php echo e($main->nama); ?></h2>
                <h5><?php echo e($main->jabatan); ?></h5>
                <p style="color: #fff;"><?php echo e($main->deskripsi); ?></p>
            </div>
            <div class="col-md-4 text-center">
                <?php if($main->gambar): ?>
                    <img src="<?php echo e(asset('storage/' . $main->gambar)); ?>" alt="<?php echo e($main->nama); ?>" class="img-fluid rounded" style="max-height: 300px;">
                <?php endif; ?>
            </div>
        </div>

        <!-- Pengurus Lain -->
        <div class="row text-center">
            <?php $__currentLoopData = $others; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengurus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-sm-4 col-md-2 mb-4">
                    <div class="card border-0">
                        <?php if($pengurus->gambar): ?>
                            <img src="<?php echo e(asset('storage/' . $pengurus->gambar)); ?>" alt="<?php echo e($pengurus->nama); ?>" class="rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
                        <?php endif; ?>
                        <h6 class="card-title"><?php echo e($pengurus->nama); ?></h6>
                        <small class="text-muted"><?php echo e($pengurus->jabatan); ?></small>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <p>Tidak ada pengurus untuk ditampilkan.</p>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views/noauth/pengurus/index.blade.php ENDPATH**/ ?>