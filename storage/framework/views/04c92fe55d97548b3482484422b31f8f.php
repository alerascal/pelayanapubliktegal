

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
        background-color: #d1fae5;
        color: #065f46;
    }

    .badge-danger {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .badge-role {
        background-color: #e0e7ff;
        color: #3730a3;
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
        background-color: #f3f4f6;
        color: #1f2937;
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
        <div class="section-header mb-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-users"></i> Manajemen Pengguna
            </h1>
        </div>

        <?php if(session('success')): ?>
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 rounded-lg px-4 py-3 shadow-sm">
                <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

       <!-- 🔍 Filter dan Search -->
<form method="GET" class="mb-4">
    <div class="row g-2 align-items-end">
        <!-- Kolom Cari -->
        <div class="col-md-4">
            <label class="form-label fw-semibold">Cari Nama / Email</label>
            <input type="text" name="search" class="form-control" placeholder="Masukkan kata kunci..."
                value="<?php echo e(request('search')); ?>">
        </div>

        <!-- Filter Role -->
        <div class="col-md-3">
            <label class="form-label fw-semibold">Role</label>
            <select name="role" class="form-select">
                <option value="">Semua Role</option>
                <option value="admin" <?php echo e(request('role') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                <option value="user" <?php echo e(request('role') == 'user' ? 'selected' : ''); ?>>User</option>
            </select>
        </div>

        <!-- Filter Status -->
        <div class="col-md-3">
            <label class="form-label fw-semibold">Status</label>
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Aktif</option>
                <option value="banned" <?php echo e(request('status') == 'banned' ? 'selected' : ''); ?>>Banned</option>
            </select>
        </div>

        <!-- Tombol Submit -->
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
        </div>
    </div>
</form>


        <!-- 📋 Tabel Data -->
        <div class="table-container bg-white rounded-xl overflow-hidden">
            <table class="table table-bordered table-hover table-striped w-full mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Registrasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td>
                                <span class="badge badge-role">
                                    <i class="fas fa-user-tag"></i> <?php echo e(ucfirst($user->role)); ?>

                                </span>
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
                            <td class="flex flex-col items-center justify-center gap-2">
                                <?php if($user->is_banned): ?>
                                    <form action="<?php echo e(route('admin.users.unban', $user->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button class="action-btn btn-unban" onclick="return confirm('Yakin ingin membuka ban user ini?')">
                                            <i class="fas fa-lock-open"></i> Unban
                                        </button>
                                    </form>
                                <?php else: ?>
                               <form action="<?php echo e(url('backend/admin/users/' . $user->id . '/change-role')); ?>" method="POST" class="d-inline">

    <?php echo csrf_field(); ?>
    <input type="hidden" name="role" value="<?php echo e($user->role === 'admin' ? 'user' : 'admin'); ?>">
    <button class="action-btn btn-role" onclick="return confirm('Yakin ingin mengubah role user ini?')">
        <i class="fas fa-user-cog"></i>
        <?php echo e($user->role === 'admin' ? 'Jadikan User' : 'Jadikan Admin'); ?>

    </button>
</form>

                                    <form action="<?php echo e(route('admin.users.ban', $user->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button class="action-btn btn-ban" onclick="return confirm('Yakin ingin membanned user ini?')">
                                            <i class="fas fa-user-slash"></i> Ban
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">
                                <i class="fas fa-inbox fa-lg mb-2"></i><br>
                                Tidak ada data user ditemukan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- 📄 Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            <?php echo e($users->links('pagination::bootstrap-5')); ?>

        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/admin/users/index.blade.php ENDPATH**/ ?>