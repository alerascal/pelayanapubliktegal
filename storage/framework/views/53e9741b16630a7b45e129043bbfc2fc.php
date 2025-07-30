

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header bg-primary text-white p-3 rounded">
            <h1>Preview Laporan Pendaftaran Magang</h1>
        </div>

        <div class="section-body">
            <!-- Form Pencarian -->
            <div class="mb-4">
                <form method="GET" action="<?php echo e(route('laporan.preview-magang')); ?>" class="d-flex gap-2 flex-wrap align-items-center">
                    <input type="text" name="search" class="form-control" placeholder="Cari laporan..." value="<?php echo e($search ?? ''); ?>">
                    <input type="hidden" name="tahun" value="<?php echo e($tahun); ?>">
                    <input type="hidden" name="bulan" value="<?php echo e($bulan); ?>">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                    <a href="<?php echo e(route('laporan.preview-magang', ['tahun' => $tahun, 'bulan' => $bulan])); ?>" class="btn btn-secondary"><i class="fas fa-sync"></i> Reset</a>
                </form>
            </div>

            <!-- Informasi Periode -->
            <div class="mb-3 card p-3 shadow-sm">
                <p class="mb-0"><strong>Periode:</strong> <?php echo e($bulan ? \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') : 'Semua Bulan'); ?> <?php echo e($tahun ?? 'Semua Tahun'); ?></p>
                <?php if($search): ?>
                    <p class="mb-0"><strong>Pencarian:</strong> <?php echo e($search); ?></p>
                <?php endif; ?>
            </div>

            <!-- Tombol Unduh -->
            <div class="mb-3 d-flex flex-wrap gap-2">
                <form action="<?php echo e(route('laporan.export.pdf')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="tab" value="magang">
                    <input type="hidden" name="search" value="<?php echo e($search); ?>">
                    <input type="hidden" name="tahun" value="<?php echo e($tahun); ?>">
                    <input type="hidden" name="bulan" value="<?php echo e($bulan); ?>">
                    <button class="btn btn-danger btn-icon">
                        <span class="icon"><i class="fas fa-file-pdf"></i></span>
                        <span class="text">Unduh PDF</span>
                    </button>
                </form>
                <form action="<?php echo e(route('laporan.export.excel')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="tab" value="magang">
                    <input type="hidden" name="search" value="<?php echo e($search); ?>">
                    <input type="hidden" name="tahun" value="<?php echo e($tahun); ?>">
                    <input type="hidden" name="bulan" value="<?php echo e($bulan); ?>">
                    <button class="btn btn-success btn-icon">
                        <span class="icon"><i class="fas fa-file-excel"></i></span>
                        <span class="text">Unduh Excel</span>
                    </button>
                </form>
                <a href="<?php echo e(route('laporan.index', ['tab' => 'magang', 'search' => $search, 'tahun' => $tahun, 'bulan' => $bulan])); ?>" class="btn btn-secondary btn-icon">
                    <span class="icon"><i class="fas fa-arrow-left"></i></span>
                    <span class="text">Kembali</span>
                </a>
            </div>

            <!-- Tabel Data -->
            <?php $__empty_1 = true; $__currentLoopData = $pendaftarByMonth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month => $pendaftarans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h4 class="mb-0"><?php echo e($month); ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Asal Sekolah</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Lowongan</th>
                                        <th>Status</th>
                                        <th>Tanggal Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pendaftaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($paginator->firstItem() + $index); ?></td>
                                            <td><?php echo e($pendaftaran->nama); ?></td>
                                            <td><?php echo e($pendaftaran->asal_sekolah); ?></td>
                                            <td><?php echo e($pendaftaran->email); ?></td>
                                            <td><?php echo e($pendaftaran->telepon); ?></td>
                                            <td><?php echo e($pendaftaran->lowongan->judul ?? '-'); ?></td>
                                            <td>
                                                <span class="badge <?php echo e($pendaftaran->status === 'selesai' ? 'badge-success' : 'badge-warning'); ?>">
                                                    <?php echo e($pendaftaran->status ?? 'Diproses'); ?>

                                                </span>
                                            </td>
                                            <td><?php echo e($pendaftaran->created_at->format('Y-m-d H:i:s')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="alert alert-info">Tidak ada data ditemukan untuk periode ini.</div>
            <?php endif; ?>

            <?php echo e($paginator->links()); ?>

        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/pages/backend/laporan/preview-magang-all.blade.php ENDPATH**/ ?>