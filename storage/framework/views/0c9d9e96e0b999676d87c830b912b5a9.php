

<?php $__env->startSection('title', 'Tambah UMKM'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Tambah UMKM</h1>

    <form action="<?php echo e(route('admin.umkm.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label>Nama UMKM</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pemilik</label>
            <input type="text" name="pemilik" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>No Telp</label>
            <input type="text" name="no_telp" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jumlah Karyawan</label>
            <input type="number" name="jumlah_karyawan" class="form-control" min="0">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($kategori->id); ?>"><?php echo e($kategori->nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Daerah</label>
            <select name="daerah_id" class="form-control" required>
                <option value="">-- Pilih Daerah --</option>
                <?php $__currentLoopData = $daerahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $daerah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($daerah->id); ?>"><?php echo e($daerah->nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Sektor</label>
            <select name="sektor_id" class="form-control" required>
                <option value="">-- Pilih Sektor --</option>
                <?php $__currentLoopData = $sektors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sektor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($sektor->id); ?>"><?php echo e($sektor->nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?php echo e(route('admin.umkm.index')); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\umkm\create.blade.php ENDPATH**/ ?>