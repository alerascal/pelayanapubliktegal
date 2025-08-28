<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover table-sm align-middle" id="tableLaporan">
        <caption class="text-muted">Gabungan Laporan Aspirasi dan Magang</caption>
        <thead class="bg-primary-subtle text-primary text-center">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Jenis</th>
                <th scope="col">Judul / Nama</th>
                <th scope="col">Pengirim / Sekolah</th>
                <th scope="col">Alamat / Email</th>
                <th scope="col" class="text-nowrap">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $laporans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-center"><?php echo e($laporans->firstItem() + $i); ?></td>
                    <td class="text-center">
                        <span class="badge bg-<?php echo e($row->tipe === 'aspirasi' ? 'info' : 'warning'); ?> text-dark">
                            <?php echo e(ucfirst($row->tipe)); ?>

                        </span>
                    </td>
                    <td><?php echo e($row->tipe === 'aspirasi' ? ($row->judul ?? '-') : ($row->nama ?? '-')); ?></td>
                    <td><?php echo e($row->tipe === 'aspirasi' ? ($row->user->name ?? '-') : ($row->asal_sekolah ?? '-')); ?></td>
                    <td><?php echo e($row->tipe === 'aspirasi' ? ($row->alamat ?? '-') : ($row->email ?? '-')); ?></td>
                    <td class="text-nowrap text-center"><?php echo e(\Carbon\Carbon::parse($row->created_at)->format('d M Y')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        <?php echo e($laporans->withQueryString()->links('pagination::bootstrap-5')); ?>

    </div>
</div>
<?php /**PATH D:\alam\pelayanan_publik_dprd\resources\views/pages/backend/laporan/_laporan.blade.php ENDPATH**/ ?>