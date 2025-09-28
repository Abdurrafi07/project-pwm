
<?php $__env->startSection('title', 'Lowongan Tersedia'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <!-- Search -->
    <input type="text" name="q" id="searchInput" value="<?php echo e(request('q')); ?>" 
           class="form-control mb-4" placeholder="Cari judul lowongan...">

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <h1 class="text-xl font-bold mb-4">Lowongan Tersedia</h1>

    <!-- Wrapper -->
    <div id="lowonganWrapper">
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
                <p class="text-sm">Kontak: 
                    <a href="https://wa.me/<?php echo e($l->no_hp); ?>" class="text-green-600"><?php echo e($l->no_hp); ?></a>
                </p>
                <a href="<?php echo e(route('noauth.lowongan.show',$l)); ?>" class="text-blue-500">Detail</a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Pagination -->
    <div id="paginationLinks" class="mt-4">
        <?php echo e($lowongans->withQueryString()->links()); ?>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let timer = null;

// Live search
$('#searchInput').on('input', function() {
    clearTimeout(timer);
    let keyword = $(this).val();

    timer = setTimeout(() => {
        $.get("<?php echo e(route('noauth.lowongan.index')); ?>", keyword ? { q: keyword } : {}, function(data) {
            $('#lowonganWrapper').html($(data).find('#lowonganWrapper').html());
            $('#paginationLinks').html($(data).find('#paginationLinks').html());
        });
    }, 300);
});

// Pagination via AJAX
$(document).on('click', '#paginationLinks .pagination a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    $.get(url, function(data) {
        $('#lowonganWrapper').html($(data).find('#lowonganWrapper').html());
        $('#paginationLinks').html($(data).find('#paginationLinks').html());
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\noauth\lowongan\index.blade.php ENDPATH**/ ?>