<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover table-sm align-middle" id="tableAspirasi">
        <caption class="text-muted">Daftar Aspirasi Pengguna</caption>
        <thead class="bg-primary-subtle text-primary text-center">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Alamat</th>
                <th>Status</th>
                <th class="text-nowrap">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $aspirasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-center"><?php echo e($aspirasis->firstItem() + $i); ?></td>
                    <td><?php echo e($item->user->name ?? '-'); ?></td>
                    <td><?php echo e($item->user->phone ?? '-'); ?></td>
                    <td><?php echo e($item->judul ?? '-'); ?></td>
                    <td><?php echo e(\Str::limit(strip_tags($item->isi), 50)); ?></td>
                    <td><?php echo e($item->alamat ?? '-'); ?></td>
                    <td class="text-center">
                        <span class="badge bg-<?php echo e(match($item->status ?? 'unknown') {
                            'menunggu' => 'warning',
                            'diproses' => 'info',
                            'ditolak' => 'danger',
                            'diterima', 'selesai' => 'success',
                            default => 'secondary'
                        }); ?>">
                            <?php echo e(ucfirst($item->status ?? '-')); ?>

                        </span>
                    </td>
                    <td class="text-nowrap text-center"><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d M Y')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Tidak ada data aspirasi</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        <?php echo e($aspirasis->withQueryString()->links('pagination::bootstrap-5')); ?>

    </div>
</div>
<?php /**PATH D:\alam\pelayanan_publik_dprd\resources\views/pages/backend/laporan/_aspirasi.blade.php ENDPATH**/ ?>