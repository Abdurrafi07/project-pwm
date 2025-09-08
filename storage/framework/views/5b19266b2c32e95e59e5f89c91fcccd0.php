

<?php $__env->startSection('title', 'Berita'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Berita</h1>
    <a href="<?php echo e(route('admin.news.create')); ?>" class="btn btn-primary mb-3">Tambah Berita</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item->judul); ?></td>
                <td><?php echo e($item->penulis); ?></td>
                <td>
                    <?php if($item->gambar): ?>
                        <img src="<?php echo e(asset('storage/' . $item->gambar)); ?>" width="80" alt="gambar">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo e(route('admin.news.edit', $item->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="<?php echo e(route('admin.news.destroy', $item->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus berita ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($news->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\news\index.blade.php ENDPATH**/ ?>