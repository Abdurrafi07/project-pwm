<table class="table table-bordered">
    <thead>
        <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Pemilik</th>
                <th>No. Telp</th>
                <th>Jenis Kelamin</th>
                <th>Usia</th>
                <th>Pendidikan Terakhir</th>
                <th>Berdiri</th>
                <th>Alamat</th>
                <th>Lokasi</th>
                <th>Pemasaran</th>
                <th>Jumlah Karyawan</th>
                <th>Kategori</th>
                <th>Daerah</th>
                <th>Sektor</th>
                <th>Modal</th>
                <th>Hambatan</th>
                <th>Kebutuhan</th>
                <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $umkms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $umkm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                    <td><?php echo e($umkm->id); ?></td>
                    <td><?php echo e($umkm->nama); ?></td>
                    <td><?php echo e($umkm->pemilik); ?></td>
                    <td><?php echo e($umkm->no_telp); ?></td>
                    <td><?php echo e($umkm->jenis_kelamin); ?></td>
                    <td><?php echo e($umkm->usia); ?></td>
                    <td><?php echo e($umkm->pendidikan_terakhir); ?></td>
                    <td><?php echo e($umkm->tahun_berdiri); ?></td>
                    <td><?php echo e($umkm->alamat); ?></td>
                    <td><?php echo e($umkm->status_lokasi); ?></td>
                    <td><?php echo e($umkm->metode_pemasaran); ?></td>
                    <td><?php echo e($umkm->jumlah_karyawan); ?></td>
                    <td><?php echo e($umkm->kategori->nama); ?></td>
                    <td><?php echo e($umkm->daerah->nama); ?></td>
                    <td><?php echo e($umkm->sektor->nama); ?></td>
                    <td><?php echo e($umkm->sumber_modal); ?></td>
                    <td><?php echo e($umkm->hambatan_pemasaran); ?></td>
                    <td><?php echo e($umkm->kebutuhan_pengembangan); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.umkm.edit', $umkm)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('admin.umkm.destroy', $umkm)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="text-center">Tidak ada data</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="mt-3">
    <?php echo e($umkms->withQueryString()->links('layouts.pagination')); ?>

</div>
<?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\umkm\table.blade.php ENDPATH**/ ?>