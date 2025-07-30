

<?php $__env->startSection('title', 'Arsip Aspirasi'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    .arsip-header {
        background: linear-gradient(90deg, #3b82f6, #1e40af);
        padding: 1.5rem 2rem;
        border-radius: 0.75rem;
        color: #fff;
        font-family: 'Poppins', sans-serif;
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 2rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .arsip-card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    .arsip-card-header {
        background: linear-gradient(90deg, #1e3a8a, #1e40af);
        color: #fff;
        padding: 1rem 1.5rem;
        font-size: 1.125rem;
        font-weight: 600;
        border-radius: 0.75rem 0.75rem 0 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .list-container {
        max-height: 300px; /* Fixed height for scrollable lists */
        overflow-y: auto;
    }
    .arsip-item {
        border: none;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.25rem 1.5rem;
        background-color: #fff;
        transition: background-color 0.2s ease;
    }
    .arsip-item:hover {
        background-color: #f9fafb;
    }
    .arsip-badge {
        display: inline-block;
        margin-top: 0.5rem;
        font-size: 0.8rem;
        background-color: #f1f5f9;
        color: #334155;
        padding: 0.25rem 0.75rem;
        border-radius: 0.5rem;
        line-height: 1.5;
    }
    .btn-sm {
        padding: 0.375rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .isi-preview {
        color: #475569;
        font-size: 0.9rem;
        margin-top: 0.25rem;
        line-height: 1.4;
    }
    .d-flex-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    .fade-in-up {
        animation: fadeInUp 0.5s ease-in;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 576px) {
        .arsip-header {
            font-size: 1.25rem;
            padding: 1rem 1.5rem;
        }
        .arsip-card-header {
            font-size: 1rem;
        }
        .arsip-item {
            flex-direction: column !important;
            align-items: flex-start !important;
            padding: 1rem;
        }
        .d-flex-wrap {
            flex-direction: column;
        }
        .table th, .table td, .list-group-item {
            font-size: 0.75rem;
        }
        .btn-sm {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="arsip-header fade-in-up">
            <i class="fas fa-archive"></i> Arsip Aspirasi
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success shadow-sm rounded fade-in-up">
                <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Pencarian & Navigasi -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <form action="<?php echo e(route('aspirasi.arsip')); ?>" method="GET" class="flex-grow-1">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-primary text-white">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="keyword" class="form-control" placeholder="Cari judul aspirasi..." value="<?php echo e(request('keyword')); ?>">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
            <a href="<?php echo e(route('aspirasi.index')); ?>" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
            </a>
        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex d-flex-wrap gap-2 mb-4">
            <form action="<?php echo e(route('aspirasi.restoreAll')); ?>" method="POST" onsubmit="return confirm('Pulihkan semua aspirasi?')">
                <?php echo csrf_field(); ?>
                <button class="btn btn-success btn-sm shadow-sm">
                    <i class="fas fa-undo mr-2"></i> Pulihkan Semua
                </button>
            </form>
            <form action="<?php echo e(route('aspirasi.destroyAllPermanentArchived')); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus permanen semua aspirasi?')">
                <?php echo csrf_field(); ?>
                <button class="btn btn-danger btn-sm shadow-sm">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus Semua Permanen
                </button>
            </form>
        </div>

        <!-- Daftar Arsip -->
        <?php if(!empty($arsip)): ?>
            <?php $__currentLoopData = $arsip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bulan => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card arsip-card mb-4 fade-in-up">
                    <div class="arsip-card-header">
                        <i class="fas fa-calendar-alt mr-2"></i> <?php echo e($bulan); ?>

                    </div>
                    <div class="card-body p-0">
                        <div class="list-container">
                            <ul class="list-group list-group-flush">
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aspirasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-column flex-md-row arsip-item">
                                        <div>
                                            <div class="fw-bold text-dark">
                                                <i class="fas fa-sticky-note mr-2 text-primary"></i> <?php echo e($aspirasi->judul); ?>

                                            </div>
                                            <div class="isi-preview text-muted"><?php echo e(Str::limit($aspirasi->isi, 100)); ?></div>
                                            <small class="arsip-badge">
                                                <i class="fas fa-user mr-1"></i> <?php echo e($aspirasi->user->name ?? 'Pengguna tidak dikenal'); ?><br>
                                                <i class="fas fa-trash-alt mr-1"></i> Dihapus: <?php echo e($aspirasi->deleted_at->format('d M Y')); ?>

                                            </small>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2 mt-3 mt-md-0">
                                            <form action="<?php echo e(route('aspirasi.restore', $aspirasi->id)); ?>" method="POST" onsubmit="return confirm('Pulihkan aspirasi ini?')">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fas fa-undo mr-1"></i> Pulihkan
                                                </button>
                                            </form>
                                            <form action="<?php echo e(route('aspirasi.deletePermanent', $aspirasi->id)); ?>" method="POST" onsubmit="return confirm('Yakin hapus permanen aspirasi ini?')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="mt-3 px-3">
                <?php echo e($paginator->links()); ?>

            </div>
        <?php else: ?>
            <div class="alert alert-info rounded shadow-sm fade-in-up">
                <i class="fas fa-info-circle mr-2"></i> Tidak ada aspirasi yang diarsipkan.
            </div>
        <?php endif; ?>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/pages/backend/aspirasi/arsip.blade.php ENDPATH**/ ?>