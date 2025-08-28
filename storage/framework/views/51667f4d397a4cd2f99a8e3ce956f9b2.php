<div class="navbar-bg"></div>

<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
    </form>

    <ul class="navbar-nav navbar-right">
        <!-- Notifikasi Aktivitas -->
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg beep">
                <i class="far fa-bell"></i>
                <?php if($headerLogCount > 0): ?>
                    <span class="badge badge-danger navbar-badge"><?php echo e($headerLogCount); ?></span>
                <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                    Aktivitas Terbaru
                    <div class="float-right">
                        <a href="<?php echo e(route('admin.userlogs.index')); ?>">Lihat Semua</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    <?php $__empty_1 = true; $__currentLoopData = $headerLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="#" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-icon bg-primary text-white">
                                <i class="fas fa-history"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                <?php echo e($log->activity); ?>

                                <div class="time text-muted"><?php echo e($log->activity_at->diffForHumans()); ?></div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center p-3">Tidak ada aktivitas</div>
                    <?php endif; ?>
                </div>
            </div>
        </li>

        <!-- Dropdown User -->
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?php echo e(asset('img/avatar/avatar-1.png')); ?>" class="rounded-circle mr-1" width="30">
                <div class="d-sm-none d-lg-inline-block">Hi, <?php echo e(auth()->user()->name); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title text-center">
                    <strong>Semangat Yaa 💪</strong>
                </div>

                <a href="#" class="dropdown-item has-icon" data-toggle="modal" data-target="#updateProfileModal">
                    <i class="far fa-user"></i> Update Profile
                </a>

                <div class="dropdown-divider"></div>

                <a href="#" class="dropdown-item has-icon text-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </li>
    </ul>
</nav>
<?php /**PATH D:\alam\pelayanan_publik_dprd\resources\views/components/header.blade.php ENDPATH**/ ?>