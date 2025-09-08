

<?php $__env->startSection('title', 'Add New User'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h1 class="fw-bold mb-3">Add New User</h1>

    <form action="<?php echo e(route('admin.users.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role_id" class="form-select" required>
                <?php $__currentLoopData = \App\Models\Role::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <button class="btn btn-success">Save User</button>
        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\users\create.blade.php ENDPATH**/ ?>