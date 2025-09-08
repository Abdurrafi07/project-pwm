<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?> - <?php echo $__env->yieldContent('title'); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?> -->
</head>
<body class="d-flex flex-column min-vh-100 font-sans antialiased bg-gray-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <?php if(auth()->guard()->guest()): ?>
                <a class="navbar-brand fw-bold" href="<?php echo e(route('home')); ?>">
                    <i class="fas fa-shield-alt me-2"></i><?php echo e(config('app.name', 'Public App')); ?>

                </a>
            <?php endif; ?>

            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->isUser()): ?>
                    <a class="navbar-brand fw-bold" href="<?php echo e(route('user.dashboard')); ?>">
                        <i class="fas fa-shield-alt me-2"></i><?php echo e(config('app.name', 'User Dashboard')); ?>

                    </a>
                <?php elseif(auth()->user()->isAdmin()): ?>
                    <a class="navbar-brand fw-bold" href="<?php echo e(route('admin.dashboard')); ?>">
                        <i class="fas fa-shield-alt me-2"></i><?php echo e(config('app.name', 'Admin Panel')); ?>

                    </a>
                <?php endif; ?>
            <?php endif; ?>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1 py-4">
        <div class="container">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3 mt-auto">
        <small>&copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name', 'Multi-Role App')); ?>. All rights reserved.</small>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\project-pwm\resources\views\layouts\app.blade.php ENDPATH**/ ?>