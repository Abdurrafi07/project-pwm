<ul class="navbar-nav ms-auto">
    
    <?php if(auth()->guard()->guest()): ?>
        <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('noauth.umkm.index') ? 'active' : ''); ?>" href="<?php echo e(route('noauth.umkm.index')); ?>">UMKM</a></li>
        <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('noauth.pengurus.index') ? 'active' : ''); ?>" href="<?php echo e(route('noauth.pengurus.index')); ?>">Pengurus</a></li>
        <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('noauth.news.index') ? 'active' : ''); ?>" href="<?php echo e(route('noauth.news.index')); ?>">News</a></li>

        <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('login') ? 'active' : ''); ?>" href="<?php echo e(route('login')); ?>"><i class="fas fa-sign-in-alt me-1"></i>Login</a></li>
        <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('register') ? 'active' : ''); ?>" href="<?php echo e(route('register')); ?>"><i class="fas fa-user-plus me-1"></i>Register</a></li>
    <?php endif; ?>

    
    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->isUser()): ?>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('user.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('user.dashboard')); ?>"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a></li>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('profile.edit') ? 'active' : ''); ?>" href="<?php echo e(route('profile.edit')); ?>"><i class="fas fa-user me-1"></i>Profile</a></li>
            <li class="nav-item">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-link nav-link text-danger"><i class="fas fa-sign-out-alt me-1"></i>Logout</button>
                </form>
            </li>
        <?php endif; ?>

        
        <?php if(auth()->user()->isAdmin()): ?>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a></li>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('admin.kategori.index') ? 'active' : ''); ?>" href="<?php echo e(route('admin.kategori.index')); ?>"><i class="fas fa-tags me-1"></i>Kategori</a></li>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('admin.users.index') ? 'active' : ''); ?>" href="<?php echo e(route('admin.users.index')); ?>"><i class="fas fa-users me-1"></i>Users</a></li>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('profile.edit') ? 'active' : ''); ?>" href="<?php echo e(route('profile.edit')); ?>"><i class="fas fa-user me-1"></i>Profile</a></li>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('admin.daerah.index') ? 'active' : ''); ?>" href="<?php echo e(route('admin.daerah.index')); ?>"><i class="fas fa-map-marker-alt me-1"></i>Daerah</a></li>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('admin.sektor.index') ? 'active' : ''); ?>" href="<?php echo e(route('admin.sektor.index')); ?>"><i class="fas fa-industry me-1"></i>Sektor</a></li>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('admin.umkm.index') ? 'active' : ''); ?>" href="<?php echo e(route('admin.umkm.index')); ?>"><i class="fas fa-store me-1"></i>UMKM</a></li>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('admin.berita.index') ? 'active' : ''); ?>" href="<?php echo e(route('admin.news.index')); ?>"><i class="fas fa-file-alt me-1"></i>Berita</a></li>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('admin.penguruses.index') ? 'active' : ''); ?>" href="<?php echo e(route('admin.penguruses.index')); ?>"><i class="fas fa-users-cog me-1"></i>Pengurus</a></li>
            <li class="nav-item">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-link nav-link text-danger"><i class="fas fa-sign-out-alt me-1"></i>Logout</button>
                </form>
            </li>
        <?php endif; ?>
    <?php endif; ?>
</ul>
<?php /**PATH C:\laragon\www\project-pwm\resources\views\layouts\navbar.blade.php ENDPATH**/ ?>