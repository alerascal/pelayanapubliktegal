<div class="table-responsive">
    <table class="table table-bordered table-striped table-sm align-middle">
        <thead class="bg-primary bg-opacity-25 text-primary text-center">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Lowongan</th>
                <th>Status</th>
                <th class="text-nowrap">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($pendaftarans->firstItem() + $i); ?></td>
                    <td><?php echo e($row->nama ?? '-'); ?></td>
                    <td><?php echo e($row->asal_sekolah ?? '-'); ?></td>
                    <td><?php echo e($row->email ?? '-'); ?></td>
                    <td><?php echo e($row->telepon ?? '-'); ?></td>
                    <td><?php echo e($row->lowongan->judul ?? '-'); ?></td>
                    <td>
                        <span class="badge bg-<?php echo e(match($row->status ?? 'unknown') {
                            'menunggu' => 'warning',
                            'ditolak' => 'danger',
                            'diterima', 'selesai' => 'success',
                            default => 'secondary'
                        }); ?>">
                            <?php echo e(ucfirst($row->status ?? '-')); ?>

                        </span>
                    </td>
                    <td class="text-nowrap"><?php echo e($row->created_at?->format('d M Y') ?? '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="mt-3 d-flex justify-content-center">
        <?php echo e($pendaftarans->withQueryString()->links('pagination::bootstrap-5')); ?>

    </div>
</div>
<?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/pages/backend/laporan/_magang.blade.php ENDPATH**/ ?>