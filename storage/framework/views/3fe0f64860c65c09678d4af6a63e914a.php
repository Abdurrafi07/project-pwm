
<?php $__env->startSection('title', 'Lowongan Tersedia'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Lowongan Tersedia</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php $__currentLoopData = $lowongans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="border p-4 rounded shadow">
            <?php if($l->gambar): ?>
                <div class="mb-2 flex justify-center">
                    <img src="<?php echo e(asset('storage/'.$l->gambar)); ?>"
                        alt="<?php echo e($l->judul); ?>"
                        style="width:5cm; height:5cm; object-fit:contain;"
                        class="rounded border">
                </div>
            <?php endif; ?>
            <h2 class="text-lg font-semibold"><?php echo e($l->judul); ?></h2>
            <p class="text-sm text-gray-600"><?php echo e($l->perusahaan); ?></p>
            <p class="text-sm">Lokasi: <?php echo e($l->lokasi); ?></p>
            <p class="text-sm">Kontak: <a href="https://wa.me/<?php echo e($l->no_hp); ?>" class="text-green-600"><?php echo e($l->no_hp); ?></a></p>
            <a href="<?php echo e(route('noauth.lowongan.show',$l)); ?>" class="text-blue-500">Detail</a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php echo e($lowongans->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views/noauth/lowongan/index.blade.php ENDPATH**/ ?>