

<?php $__env->startSection('title', 'Lowongan Magang'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-briefcase"></i> Lowongan Magang</h1>
            <div class="section-header-button">
                <a href="<?php echo e(route('magang.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Tambah Lowongan
                </a>
            </div>
        </div>

        
        <form method="GET" class="mb-3">
            <div class="input-group" style="max-width: 300px;">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary text-white">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                </div>
                <select name="tahun" onchange="this.form.submit()" class="form-control border-primary">
                    <option value="">📆 Tampilkan Semua Tahun</option>
                    <?php $__currentLoopData = $tahunList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tahun); ?>" <?php echo e($tahun == $tahunFilter ? 'selected' : ''); ?>>
                            Tahun <?php echo e($tahun); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </form>

        
        <?php if($tahunFilter): ?>
            <form action="<?php echo e(route('magang.hapusTahun', ['tahun' => $tahunFilter])); ?>" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus semua lowongan & pendaftar tahun <?php echo e($tahunFilter); ?>?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-danger mb-3">
                    <i class="fas fa-trash"></i> Hapus Semua Tahun <?php echo e($tahunFilter); ?>

                </button>
            </form>
        <?php endif; ?>

        
        <?php
            $expiredCount = $lowongan->where('deadline', '<', now())->count();
        ?>
        <?php if($expiredCount > 0): ?>
            <form action="<?php echo e(route('magang.hapusExpired')); ?>" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus semua lowongan yang telah expired?')" class="mb-3">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-outline-danger">
                    <i class="fas fa-trash-alt"></i> Hapus <?php echo e($expiredCount); ?> Lowongan Expired
                </button>
            </form>
        <?php endif; ?>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($expiredCount > 0): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> Ada <?php echo e($expiredCount); ?> lowongan yang sudah <strong>melewati deadline</strong>.
            </div>
        <?php endif; ?>

        
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-list"></i> Daftar Lowongan Magang</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Judul & Deskripsi</th>
                                <th>Periode</th>
                                <th>Kuota</th>
                                <th>Deadline</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $lowongan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>

                                
                                <td class="text-start clickable-cell" 
                                    onclick="window.location='<?php echo e(route('magang.pendaftar', $item->id)); ?>'">
                                    <strong><?php echo e($item->judul); ?></strong><br>
                                    <small class="text-muted"><?php echo e(Str::limit($item->deskripsi, 80)); ?></small>
                                </td>

                                <td>
                                    <span class="badge bg-info text-white">
                                        <?php echo e($item->periode); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-success text-white">
                                        <?php echo e($item->kuota); ?> Orang
                                    </span>
                                </td>
                                <td>
                                    <?php if(\Carbon\Carbon::parse($item->deadline)->lt(now())): ?>
                                        <span class="badge bg-danger text-white animate-expired">
                                            <?php echo e(\Carbon\Carbon::parse($item->deadline)->format('d M Y')); ?><br>
                                            <small>(Expired)</small>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">
                                            <?php echo e(\Carbon\Carbon::parse($item->deadline)->format('d M Y')); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('magang.show', $item->id)); ?>" class="btn btn-sm btn-info animate__animated animate__fadeIn" 
                                       style="margin-right: 5px; border-radius: 5px;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('magang.edit', $item->id)); ?>" class="btn btn-sm btn-warning" 
                                       style="margin-right: 5px; border-radius: 5px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('magang.destroy', $item->id)); ?>" method="POST"
                                          class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lowongan ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-danger" style="border-radius: 5px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada lowongan magang.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>


<style>
    .animate-expired {
        animation: pulse-red 1.5s infinite;
    }

    @keyframes pulse-red {
        0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.5); }
        70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
    }

    .clickable-cell {
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .clickable-cell:hover {
        background-color: #f8f9fa;
    }

    /* Styling for Show button */
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\alam\pelayanan_publik_dprd\resources\views/pages/backend/magang/index.blade.php ENDPATH**/ ?>