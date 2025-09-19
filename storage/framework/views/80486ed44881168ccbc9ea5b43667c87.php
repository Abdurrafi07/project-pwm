

<?php $__env->startSection('title', $lowongan->judul); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-4"><?php echo e($lowongan->judul); ?></h1>

        <?php if($lowongan->gambar): ?>
            <div class="mb-4 flex justify-center">
                <img src="<?php echo e(asset('storage/'.$lowongan->gambar)); ?>"
                    alt="<?php echo e($lowongan->judul); ?>"
                    style="width:5cm; height:5cm; object-fit:contain;"
                    class="rounded border shadow">
            </div>
        <?php endif; ?>

        <p class="text-gray-700 mb-4"><?php echo e($lowongan->deskripsi); ?></p>

        <div class="mb-4">
            <p><strong>Perusahaan:</strong> <?php echo e($lowongan->perusahaan); ?></p>
            <p><strong>Lokasi:</strong> <?php echo e($lowongan->lokasi ?? '-'); ?></p>
            <p><strong>No HP:</strong> <?php echo e($lowongan->no_hp ?? '-'); ?></p>
            <p><strong>Tanggal Mulai:</strong> <?php echo e(\Carbon\Carbon::parse($lowongan->tanggal_mulai)->format('d M Y')); ?></p>
            <p><strong>Tanggal Akhir:</strong> <?php echo e(\Carbon\Carbon::parse($lowongan->tanggal_akhir)->format('d M Y')); ?></p>
        </div>

        <a href="<?php echo e(route('noauth.lowongan.index')); ?>" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            ← Kembali ke daftar lowongan
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\noauth\lowongan\show.blade.php ENDPATH**/ ?>