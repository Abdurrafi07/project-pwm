


<?php $__env->startSection('title', 'User Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold">
                <i class="fas fa-tachometer-alt me-2"></i>
                Welcome, <?php echo e(auth()->user()->name); ?>!
            </h1>
            <p class="text-muted">Your personal dashboard</p>
        </div>
    </div>

    <!-- Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="fw-bold">Dashboard Overview</h4>
                            <p class="mb-0">
                                You're successfully logged in as 
                                <strong><?php echo e(auth()->user()->role->display_name); ?></strong>.
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="fas fa-user-circle fa-4x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Info & Quick Actions -->
    <div class="row g-4">
        <!-- Profile Information -->
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-user me-2"></i>Profile Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Name:</strong>
                        <span class="text-muted"><?php echo e(auth()->user()->name); ?></span>
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <span class="text-muted"><?php echo e(auth()->user()->email); ?></span>
                    </div>
                    <div class="mb-3">
                        <strong>Role:</strong>
                        <span class="badge bg-secondary">
                            <?php echo e(auth()->user()->role->display_name); ?>

                        </span>
                    </div>
                    <div class="mb-3">
                        <strong>Status:</strong>
                        <span class="badge bg-success">
                            <i class="fas fa-check me-1"></i>Approved
                        </span>
                    </div>
                    <div class="mb-0">
                        <strong>Member Since:</strong>
                        <span class="text-muted">
                            <?php echo e(auth()->user()->created_at->format('F d, Y')); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-cog me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-outline-primary w-100 mb-3">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </a>
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Note:</strong> More features will be available soon!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\user\dashboard.blade.php ENDPATH**/ ?>