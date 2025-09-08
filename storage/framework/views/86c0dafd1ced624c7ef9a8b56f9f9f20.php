<!-- resources/views/admin/pending-users.blade.php -->


<?php $__env->startSection('title', 'Pending Users'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold">
                    <i class="fas fa-user-clock me-2"></i>Pending Users
                </h1>
                <p class="text-muted">Review and approve new user registrations</p>
            </div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Users Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">
                <i class="fas fa-clock me-2"></i>Users Awaiting Approval
            </h5>
        </div>
        <div class="card-body p-0">
            <?php if($users->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Registered</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <i class="fas fa-user me-2 text-muted"></i>
                                        <?php echo e($user->name); ?>

                                    </td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td>
                                        <span class="badge bg-secondary"><?php echo e($user->role->display_name); ?></span>
                                    </td>
                                    <td><?php echo e($user->created_at->format('M d, Y')); ?></td>
                                    <td class="text-center">
                                        <form method="POST" action="<?php echo e(route('admin.approve-user', $user)); ?>" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-success btn-sm" 
                                                    onclick="return confirm('Approve this user?')">
                                                <i class="fas fa-check me-1"></i>Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="<?php echo e(route('admin.reject-user', $user)); ?>" class="d-inline ms-1">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Reject and delete this user? This action cannot be undone.')">
                                                <i class="fas fa-times me-1"></i>Reject
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center p-3">
                    <?php echo e($users->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center p-5">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <h5>No Pending Users</h5>
                    <p class="text-muted">All users have been processed.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views/admin/users/verifikasi.blade.php ENDPATH**/ ?>