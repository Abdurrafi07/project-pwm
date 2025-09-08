

<?php $__env->startSection('title', 'Edit UMKM'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Edit UMKM</h1>

    <form action="<?php echo e(route('admin.umkm.update', $umkm)); ?>" method="POST">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label>Nama UMKM</label>
            <input type="text" name="nama" class="form-control" value="<?php echo e($umkm->nama); ?>" required>
        </div>

        <div class="mb-3">
            <label>Pemilik</label>
            <input type="text" name="pemilik" class="form-control" value="<?php echo e($umkm->pemilik); ?>">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"><?php echo e($umkm->alamat); ?></textarea>
        </div>

        <div class="mb-3">
            <label>No Telp</label>
            <input type="text" name="no_telp" class="form-control" value="<?php echo e($umkm->no_telp); ?>">
        </div>

        <div class="mb-3">
            <label>Jumlah Karyawan</label>
            <input type="number" name="jumlah_karyawan" class="form-control" min="0" value="<?php echo e($umkm->jumlah_karyawan); ?>">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($kategori->id); ?>" <?php echo e($umkm->kategori_id == $kategori->id ? 'selected' : ''); ?>>
                        <?php echo e($kategori->nama); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Daerah</label>
            <select name="daerah_id" class="form-control" required>
                <?php $__currentLoopData = $daerahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $daerah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($daerah->id); ?>" <?php echo e($umkm->daerah_id == $daerah->id ? 'selected' : ''); ?>>
                        <?php echo e($daerah->nama); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Sektor</label>
            <select name="sektor_id" class="form-control" required>
                <?php $__currentLoopData = $sektors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sektor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($sektor->id); ?>" <?php echo e($umkm->sektor_id == $sektor->id ? 'selected' : ''); ?>>
                        <?php echo e($sektor->nama); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="<?php echo e(route('admin.umkm.index')); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\umkm\edit.blade.php ENDPATH**/ ?>