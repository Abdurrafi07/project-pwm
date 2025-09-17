

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row">
        
        <div class="col-lg-8 mb-4">
            <?php if($news->isNotEmpty()): ?>
                <?php
                    $mainNews = $news->first();
                ?>
                <div class="card shadow-lg border-0">
                    <?php if($mainNews->gambar): ?>
                        <img src="<?php echo e(asset('storage/' . $mainNews->gambar)); ?>" 
                            class="card-img-top"
                            alt="<?php echo e($mainNews->judul); ?>"
                            style="height: 350px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            <?php echo e($mainNews->judul); ?>

                        </h5>
                        <p class="card-text text-muted">
                            <?php echo e(Str::limit($mainNews->deskripsi, 150, '...')); ?>

                        </p>
                        <small class="text-secondary">
                            <?php echo e($mainNews->created_at->format('d M Y')); ?> | <?php echo e($mainNews->penulis); ?>

                        </small>
                        <div class="mt-3">
                            <a href="<?php echo e(route('noauth.news.show', $mainNews->id)); ?>" class="btn btn-primary">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="col-lg-4">
            <div class="list-group shadow-sm">
                <?php $__currentLoopData = $news->skip(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('noauth.news.show', $item->id)); ?>" class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center">
                            <?php if($item->gambar): ?>
                                <img src="<?php echo e(asset('storage/' . $item->gambar)); ?>" 
                                    class="rounded me-3" 
                                    alt="<?php echo e($item->judul); ?>" 
                                    style="width: 80px; height: 60px; object-fit: cover;">
                            <?php endif; ?>
                            <div>
                                <h6 class="mb-1 fw-semibold">
                                    <?php echo e(Str::limit($item->judul, 50, '...')); ?>

                                </h6>
                                <small class="text-muted">
                                    <?php echo e($item->created_at->format('d M Y')); ?>

                                </small>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\noauth\news\index.blade.php ENDPATH**/ ?>