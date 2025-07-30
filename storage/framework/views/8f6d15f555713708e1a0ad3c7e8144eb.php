

<?php $__env->startSection('title', 'Riwayat Aktivitas'); ?>

<?php $__env->startPush('style'); ?>
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Riwayat Aktivitas</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('admin.userlogs.index')); ?>" class="row g-3">
                <div class="col-md-4">
                    <label for="date" class="form-label">Filter Tanggal</label>
                    <input type="text" name="date" id="date" class="form-control" 
                           value="<?php echo e(request('date')); ?>" placeholder="Pilih tanggal" autocomplete="off">
                </div>
             <div class="col-md-4">
    <label for="user_id" class="form-label">Filter Pengguna (Admin)</label>
    <select name="user_id" id="user_id" class="form-select">
        <option value="">-- Semua Admin --</option>
        <?php $__currentLoopData = $adminUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($admin->id); ?>" <?php echo e(request('user_id') == $admin->id ? 'selected' : ''); ?>>
                <?php echo e($admin->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

           
                <div class="col-md-4 align-self-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="<?php echo e(route('admin.userlogs.index')); ?>" class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </form>

            <div class="table-responsive mt-4">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Role</th>
                            <th>Aksi</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $userLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($index + $userLogs->firstItem()); ?></td>
                            <td><?php echo e($log->user->name ?? 'Tidak Diketahui'); ?></td>
                            <td><?php echo e($log->user->role ?? '-'); ?></td>
                            <td><?php echo e($log->activity); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($log->activity_at)->format('d M Y - H:i')); ?></td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada aktivitas ditemukan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="mt-3">
                    <?php echo e($userLogs->withQueryString()->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#date", {
        dateFormat: "Y-m-d",
        allowInput: false,
        locale: "id"
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/admin/userlogs/index.blade.php ENDPATH**/ ?>