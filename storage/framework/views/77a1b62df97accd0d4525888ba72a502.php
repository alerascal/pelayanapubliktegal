

<?php $__env->startSection('title', 'Data Aspirasi'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    .status-badge {
        padding: 6px 12px;
        border-radius: 9999px;
        font-weight: 500;
        font-size: 0.875rem;
    }
    .table-container {
        max-height: 500px;
        overflow-y: auto;
    }
    .table th, .table td {
        vertical-align: middle;
        font-size: 0.875rem;
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease-in;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    /* Ensure compatibility with Bootstrap and Stisla styles */
    .main-content {
        padding: 20px;
    }
    @media (max-width: 640px) {
        .table th, .table td {
            font-size: 0.75rem;
        }
        .section-header h1 {
            font-size: 1.25rem;
        }
        .btn-export, .btn-custom {
            font-size: 0.75rem;
            padding: 0.5rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header flex flex-col sm:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-envelope-open-text mr-2 text-blue-600"></i> Daftar Aspirasi
            </h1>
            <?php if(session('success')): ?>
                <div class="mt-4 sm:mt-0 w-full sm:w-auto alert alert-success p-4 animate-fade-in">
                    <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
        </div>

        <div class="card shadow-sm rounded-lg">
            <div class="card-header flex flex-col sm:flex-row justify-between items-center p-4 sm:p-6 bg-gray-50">
                <h4 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-inbox mr-2 text-blue-600"></i> Aspirasi Masuk
                </h4>
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 mt-4 sm:mt-0">
                    <!-- Export dan Hapus semua -->
                    <form action="<?php echo e(route('aspirasi.export.excel')); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success btn-export px-4 py-2 rounded-md hover:bg-green-700 transition flex items-center">
                            <i class="fas fa-file-excel mr-2"></i> Export Excel
                        </button>
                    </form>
                    <form action="<?php echo e(route('aspirasi.export.pdf')); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger btn-export px-4 py-2 rounded-md hover:bg-red-700 transition flex items-center">
                            <i class="fas fa-file-pdf mr-2"></i> Export PDF
                        </button>
                    </form>
                    <form action="<?php echo e(route('aspirasi.destroyAll')); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua data aspirasi?')" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger btn-custom px-4 py-2 rounded-md hover:bg-red-700 transition flex items-center">
                            <i class="fas fa-trash-alt mr-2"></i> Hapus Semua
                        </button>
                    </form>
                </div>
            </div>

            <div class="card-body p-4 sm:p-6">
                <form action="<?php echo e(route('aspirasi.index')); ?>" method="GET" class="mb-6">
                    <div class="input-group flex shadow-sm">
                        <input type="text" name="keyword" class="form-control flex-1 border-gray-300 rounded-l-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari judul atau isi aspirasi..." value="<?php echo e(request('keyword')); ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-r-md hover:bg-blue-700 transition">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-container">
                    <?php $__empty_1 = true; $__currentLoopData = $aspirasiByMonth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bulan => $aspirasis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <h5 class="text-lg font-bold text-primary mb-4 mt-6"><?php echo e($bulan); ?></h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="p-3 text-left font-semibold text-gray-700">No</th>
                                        <th class="p-3 text-left font-semibold text-gray-700">Judul</th>
                                        <th class="p-3 text-left font-semibold text-gray-700">Isi</th>
                                        <th class="p-3 text-left font-semibold text-gray-700">Lampiran</th>
                                        <th class="p-3 text-left font-semibold text-gray-700">Pengirim</th>
                                        <th class="p-3 text-left font-semibold text-gray-700">Tanggal</th>
                                        <th class="p-3 text-left font-semibold text-gray-700">Status</th>
                                        <th class="p-3 text-left font-semibold text-gray-700">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $aspirasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aspirasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="p-3 text-center"><?php echo e($loop->iteration); ?></td>
                                            <td class="p-3"><?php echo e($aspirasi->judul); ?></td>
                                            <td class="p-3"><?php echo e(Str::limit($aspirasi->isi, 100)); ?></td>
                                            <td class="p-3">
                                                <?php if($aspirasi->lampiran): ?>
                                                    <a href="<?php echo e(asset('storage/' . $aspirasi->lampiran)); ?>" class="btn btn-outline-info btn-sm px-3 py-1 rounded-md hover:bg-blue-100 transition" download>
                                                        <i class="fas fa-download mr-1"></i> Unduh
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted">Tidak ada</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="p-3"><?php echo e($aspirasi->user->name ?? 'Anonim'); ?></td>
                                            <td class="p-3"><?php echo e($aspirasi->created_at->format('d M Y')); ?></td>
                                            <td class="p-3">
                                                <form action="<?php echo e(route('aspirasi.updateStatus', $aspirasi->id)); ?>" method="POST" class="mb-2">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <div class="btn-group btn-group-sm flex space-x-1">
                                                        <button type="submit" name="status" value="menunggu" class="btn btn-warning px-2 py-1 rounded-md hover:bg-yellow-500 transition <?php if($aspirasi->status == 'menunggu'): ?> active <?php endif; ?>" title="Menunggu">
                                                            <i class="fas fa-clock"></i>
                                                        </button>
                                                        <button type="submit" name="status" value="diterima" class="btn btn-success px-2 py-1 rounded-md hover:bg-green-600 transition <?php if($aspirasi->status == 'diterima'): ?> active <?php endif; ?>" title="Diterima">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button type="submit" name="status" value="ditolak" class="btn btn-danger px-2 py-1 rounded-md hover:bg-red-600 transition <?php if($aspirasi->status == 'ditolak'): ?> active <?php endif; ?>" title="Ditolak">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                        <button type="submit" name="status" value="selesai" class="btn btn-primary px-2 py-1 rounded-md hover:bg-blue-600 transition <?php if($aspirasi->status == 'selesai'): ?> active <?php endif; ?>" title="Selesai">
                                                            <i class="fas fa-flag-checkered"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                                <span class="status-badge inline-block 
                                                    <?php if($aspirasi->status == 'diterima'): ?> bg-success text-white
                                                    <?php elseif($aspirasi->status == 'ditolak'): ?> bg-danger text-white
                                                    <?php elseif($aspirasi->status == 'selesai'): ?> bg-primary text-white
                                                    <?php elseif($aspirasi->status == 'hangus'): ?> bg-dark text-white
                                                    <?php elseif($aspirasi->status == 'diproses'): ?> bg-info text-white
                                                    <?php else: ?> bg-warning text-dark
                                                    <?php endif; ?>">
                                                    <?php echo e(ucfirst($aspirasi->status)); ?>

                                                </span>
                                            </td>
                                            <td class="p-3 flex space-x-1">
                                                
                                                <a href="<?php echo e(route('aspirasi.show', $aspirasi->id)); ?>" class="btn btn-info btn-sm px-3 py-1 rounded-md hover:bg-blue-600 transition" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                
                                                <form action="<?php echo e(route('aspirasi.destroy', $aspirasi->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin mengarsipkan aspirasi ini?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-outline-danger btn-sm px-3 py-1 rounded-md hover:bg-red-100 transition" title="Arsipkan">
                                                        <i class="fas fa-archive"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="alert alert-info p-4">
                            Tidak ada data aspirasi untuk ditampilkan.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-6">
                    <?php echo e($paginator->links('pagination::bootstrap-5')); ?>

                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\alam\pelayanan_publik_dprd\resources\views/pages/backend/aspirasi/index.blade.php ENDPATH**/ ?>