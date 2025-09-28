

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Daftar Pengurus</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('admin.penguruses.create')); ?>" class="btn btn-primary mb-3">Tambah Pengurus</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $penguruses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pengurus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($pengurus->id); ?></td>
                    <td><?php echo e($pengurus->nama); ?></td>
                    <td><?php echo e($pengurus->jabatan); ?></td>
                    <td><?php echo e($pengurus->deskripsi); ?></td>
                    <td>
                        <?php if($pengurus->gambar): ?>
                            <img src="<?php echo e(asset('storage/'.$pengurus->gambar)); ?>" width="100" alt="<?php echo e($pengurus->nama); ?>">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.penguruses.edit', $pengurus->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('admin.penguruses.destroy', $pengurus->id)); ?>" method="POST" style="display:inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus pengurus ini?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pengurus</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php echo e($penguruses->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views/admin/penguruses/index.blade.php ENDPATH**/ ?>