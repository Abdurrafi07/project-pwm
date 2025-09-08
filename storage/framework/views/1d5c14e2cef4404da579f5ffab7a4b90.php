

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <?php if($mainNews->gambar): ?>
                    <img src="<?php echo e(asset('storage/' . $mainNews->gambar)); ?>" 
                        class="card-img-top"
                        alt="<?php echo e($mainNews->judul); ?>"
                        style="height: 350px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                <?php endif; ?>
                <div class="card-body">
                    <h2 class="fw-bold mb-3"><?php echo e($news->judul); ?></h2>
                    <p class="text-muted mb-4">
                        <small><?php echo e($news->created_at->format('d M Y')); ?> | <?php echo e($news->penulis); ?></small>
                    </p>
                    <p class="card-text" style="white-space: pre-line;">
                        <?php echo nl2br(e($news->deskripsi)); ?>

                    </p>
                    <div class="mt-4">
                        <a href="<?php echo e(route('noauth.news.index')); ?>" class="btn btn-secondary">
                            ← Kembali ke Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\noauth\news\show.blade.php ENDPATH**/ ?>