<div class="card card-custom mb-4">
    <div class="card-header-custom bg-warning text-dark">
        Aspirasi Belum Diproses
    </div>
    <div class="card-body table-responsive">
        <div class="table-container">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th class="p-3 text-left font-semibold text-gray-700">Judul Aspirasi</th>
                        <th class="p-3 text-left font-semibold text-gray-700">Status</th>
                        <th class="p-3 text-left font-semibold text-gray-700">Pengirim</th>
                        <th class="p-3 text-left font-semibold text-gray-700">Tanggal Kirim</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $aspirasiBelumDiproses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aspirasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3"><?php echo e($aspirasi->judul); ?></td>
                            <td class="p-3">
                                <span class="status-badge inline-block bg-warning text-dark px-3 py-1 rounded-full">
                                    Belum Diproses
                                </span>
                            </td>
                            <td class="p-3"><?php echo e($aspirasi->user->name ?? 'Anonim'); ?></td>
                            <td class="p-3"><?php echo e($aspirasi->created_at->format('d M Y')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted p-4">
                                Tidak ada aspirasi yang belum diproses
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    .card-custom {
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .card-header-custom {
        font-size: 1.125rem;
        font-weight: 600;
        padding: 1rem;
    }
    .status-badge {
        padding: 6px 12px;
        border-radius: 9999px;
        font-weight: 500;
        font-size: 0.875rem;
    }
    .table-container {
        max-height: 300px; /* Adjusted for dashboard context */
        overflow-y: auto;
    }
    .table th, .table td {
        vertical-align: middle;
        font-size: 0.875rem;
    }
    @media (max-width: 640px) {
        .table th, .table td {
            font-size: 0.75rem;
        }
        .card-header-custom {
            font-size: 1rem;
        }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/components/dashboard/aspirasi.blade.php ENDPATH**/ ?>