

<?php $__env->startSection('title', 'Manajemen User'); ?>

<?php $__env->startPush('style'); ?>
<style>
    .badge {
        padding: 0.4em 0.75em;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .badge-success {
        background-color: #e6fffa;
        color: #047857;
    }

    .badge-danger {
        background-color: #fff1f2;
        color: #b91c1c;
    }

    .badge-role {
        background-color: #eef2ff;
        color: #4338ca;
    }
    .badge-master {
    background-color: #fdf6b2;
    color: #92400e;
}


    .alert {
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .alert-success {
        background-color: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .alert-danger {
        background-color: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .action-btn {
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.4rem 0.8rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        margin: 2px 0;
    }

    .btn-ban {
        background-color: #ef4444;
        color: #fff;
    }

    .btn-ban:hover {
        background-color: #dc2626;
    }

    .btn-unban {
        background-color: #10b981;
        color: #fff;
    }

    .btn-unban:hover {
        background-color: #059669;
    }

    .btn-role {
        background-color: #3b82f6;
        color: #fff;
    }

    .btn-role:hover {
        background-color: #2563eb;
    }

    .table-container {
        overflow-x: auto;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .table th {
        background-color: #f9fafb;
        color: #374151;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .table td, .table th {
        vertical-align: middle;
        text-align: center;
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('main'); ?>
<div class="main-content fade-in">
    <section class="section">
        <div class="section-header mb-4 d-flex justify-content-between align-items-center">
            <h1 class="text-2xl fw-bold text-gray-800">
                <i class="fas fa-users me-2"></i> Manajemen Pengguna
            </h1>
        </div>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-times-circle"></i> <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        
        <form method="GET" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Cari Nama / Email</label>
                    <input type="text" name="search" class="form-control" placeholder="Masukkan kata kunci..."
                        value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Role</label>
                    <select name="role" class="form-select">
                        <option value="">Semua Role</option>
                        <option value="admin" <?php echo e(request('role') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                        <option value="user" <?php echo e(request('role') == 'user' ? 'selected' : ''); ?>>User</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="banned" <?php echo e(request('status') == 'banned' ? 'selected' : ''); ?>>Banned</option>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                </div>
            </div>
        </form>

        
        <div class="table-container bg-white rounded-xl overflow-hidden">
            <table class="table table-bordered table-hover table-striped mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Registrasi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td>
                                <?php if($user->role === 'master'): ?>
                                    <span class="badge badge-master">
                                        <i class="fas fa-crown"></i> Master
                                    </span>
                                <?php elseif($user->role === 'admin'): ?>
                                    <span class="badge badge-role">
                                        <i class="fas fa-user-shield"></i> Admin
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-role">
                                        <i class="fas fa-user"></i> User
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($user->is_banned): ?>
                                    <span class="badge badge-danger">
                                        <i class="fas fa-ban"></i> Banned
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($user->created_at->format('d M Y')); ?></td>
                            <td>
                                <?php if($user->id !== auth()->id()): ?>
                                    <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                        
                                        <?php if(auth()->user()->role === 'admin' && $user->role !== 'user'): ?>
                                            <span class="text-muted small fst-italic">Tidak bisa ubah <?php echo e($user->role); ?></span>
                                        <?php elseif(auth()->user()->role === 'master' && $user->role === 'master'): ?>
                                            <span class="text-muted small fst-italic">Master tidak bisa ubah Master</span>
                                        <?php else: ?>
                                            
                                            <?php if($user->is_banned): ?>
                                                <form action="<?php echo e(route('admin.users.unban', $user->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <button class="action-btn btn-unban" onclick="return confirm('Buka ban user ini?')">
                                                        <i class="fas fa-lock-open"></i> Unban
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                
                                                <?php if(
                                                    (auth()->user()->role === 'master' && $user->role !== 'master') ||
                                                    (auth()->user()->role === 'admin' && $user->role === 'user')
                                                ): ?>
                                                    <form action="<?php echo e(url('backend/admin/users/' . $user->id . '/change-role')); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="role" value="<?php echo e($user->role === 'admin' ? 'user' : 'admin'); ?>">
                                                        <button class="action-btn btn-role" onclick="return confirm('Ubah role user ini?')">
                                                            <i class="fas fa-user-cog"></i>
                                                            <?php echo e($user->role === 'admin' ? 'Jadikan User' : 'Jadikan Admin'); ?>

                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    <span class="text-muted small fst-italic">Tidak bisa ubah role</span>
                                                <?php endif; ?>

                                                
                                                <?php if(auth()->user()->role === 'master' || (auth()->user()->role === 'admin' && $user->role === 'user')): ?>
                                                    <form action="<?php echo e(route('admin.users.ban', $user->id)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <button class="action-btn btn-ban" onclick="return confirm('Ban user ini?')">
                                                            <i class="fas fa-user-slash"></i> Ban
                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    <span class="text-muted small fst-italic">Tidak bisa ban</span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted">Tidak tersedia</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-lg mb-2"></i><br>
                                Tidak ada data user ditemukan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div class="mt-4 d-flex justify-content-center">
            <?php echo e($users->links('pagination::bootstrap-5')); ?>

        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\alam\pelayanan_publik_dprd\resources\views/admin/users/index.blade.php ENDPATH**/ ?>