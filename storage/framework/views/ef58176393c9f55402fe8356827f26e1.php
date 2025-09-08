

<?php $__env->startSection('title', 'All Users'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold">
                    <i class="fas fa-users me-2"></i>All Users
                </h1>
                <p class="text-muted">Manage all registered users</p>
            </div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Registered Users
            </h5>
        </div>
        <div class="card-body p-0">
            <?php if($users->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Active</th>
                                <th>Registered</th>
                                <th>Approved By</th>
                                <th>Actions</th>
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
                                    <td>
                                        <?php if($user->is_approved): ?>
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>Approved
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($user->is_active): ?>
                                            <span class="badge bg-success">
                                                <i class="fas fa-toggle-on me-1"></i>Active
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">
                                                <i class="fas fa-toggle-off me-1"></i>Inactive
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($user->created_at->format('M d, Y')); ?></td>
                                    <td>
                                        <?php if($user->approver): ?>
                                            <?php echo e($user->approver->name); ?>

                                            <small class="text-muted d-block">
                                                <?php echo e($user->approved_at->format('M d, Y')); ?>

                                            </small>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <!-- Toggle Active/Inactive -->
                                            <?php if($user->is_active): ?>
                                                <form action="<?php echo e(route('admin.users.deactivate', $user)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-ban me-1"></i>Deactivate
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <form action="<?php echo e(route('admin.users.activate', $user)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-check-circle me-1"></i>Activate
                                                    </button>
                                                </form>
                                            <?php endif; ?>

                                            <!-- Delete -->
                                            <form action="<?php echo e(route('admin.users.delete', $user)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash me-1"></i>Delete
                                                </button>
                                            </form>
                                        </div>
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
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5>No Users Found</h5>
                    <p class="text-muted">No users have been registered yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\admin\users\pengguna.blade.php ENDPATH**/ ?>