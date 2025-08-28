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
        max-height: 300px; /* Fixed height for scrollable tables */
        overflow-y: auto;
    }
    .table th, .table td {
        vertical-align: middle;
        font-size: 0.875rem;
    }
    .fade-in-up {
        animation: fadeInUp 0.5s ease-in;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 640px) {
        .table th, .table td {
            font-size: 0.75rem;
        }
        .card-header-custom {
            font-size: 1rem;
        }
        .btn-sm {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<div class="card shadow-sm rounded-xl mb-5 fade-in-up border-0">
    <div class="card-header-custom bg-warning bg-opacity-25 text-dark d-flex align-items-center px-4 py-3 rounded-top border-bottom">
        <i class="fas fa-user-clock me-2 fs-5 text-warning"></i>
        <h5 class="mb-0 fw-bold">Pendaftar Magang Belum Diproses</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <div class="table-container">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary fw-bold border-bottom">
                        <tr>
                            <th class="px-4 py-3">Nama Lengkap</th>
                            <th>Status</th>
                            <th>Posisi</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $pendaftarBelumDiproses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendaftar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="border-bottom">
                                <td class="px-4 py-3 fw-semibold text-dark">
                                    <i class="fas fa-user me-1 text-muted"></i><?php echo e($pendaftar->nama); ?>

                                </td>
                                <td>
                                    <?php
                                        $status = strtolower($pendaftar->status);
                                        $badgeClass = match($status) {
                                            'menunggu' => 'bg-secondary-subtle text-secondary',
                                            'diproses' => 'bg-info-subtle text-info',
                                            'diterima' => 'bg-success-subtle text-success',
                                            'ditolak' => 'bg-danger-subtle text-danger',
                                            default => 'bg-warning text-dark'
                                        };
                                        $icon = match($status) {
                                            'menunggu' => 'fas fa-stopwatch',
                                            'diproses' => 'fas fa-spinner fa-spin',
                                            'diterima' => 'fas fa-check',
                                            'ditolak' => 'fas fa-times',
                                            default => 'fas fa-question'
                                        };
                                    ?>
                                    <span class="badge status-badge <?php echo e($badgeClass); ?> px-3 py-1 rounded-pill fw-semibold">
                                        <i class="<?php echo e($icon); ?> me-1"></i><?php echo e(ucfirst($status)); ?>

                                    </span>
                                </td>
                                <td class="text-capitalize">
                                    <i class="fas fa-briefcase me-1 text-muted"></i>
                                    <?php echo e($pendaftar->lowongan->judul ?? 'Tidak Diketahui'); ?>

                                </td>
                                <td class="text-muted small">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    <?php echo e($pendaftar->created_at->format('d M Y')); ?>

                                </td>
                                <td>
                                    <?php if($status === 'menunggu'): ?>
                                        <form action="<?php echo e(route('magang.status', $pendaftar->id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <input type="hidden" name="status" value="diproses">
                                            <button type="submit" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-play me-1"></i> Proses
                                            </button>
                                        </form>
                                    <?php elseif($status === 'diproses'): ?>
                                        <form action="<?php echo e(route('magang.status', $pendaftar->id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <input type="hidden" name="status" value="diterima">
                                            <button type="submit" class="btn btn-sm btn-outline-success me-1">
                                                <i class="fas fa-check"></i> Terima
                                            </button>
                                        </form>
                                        <form action="<?php echo e(route('magang.status', $pendaftar->id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-times"></i> Tolak
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-muted small">Tidak ada aksi</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                    Tidak ada pendaftar yang belum diproses.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\alam\pelayanan_publik_dprd\resources\views/components/dashboard/magang.blade.php ENDPATH**/ ?>