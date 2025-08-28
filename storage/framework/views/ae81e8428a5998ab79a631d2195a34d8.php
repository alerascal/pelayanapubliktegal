

<?php $__env->startSection('title', 'Daftar Pendaftar Magang'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">

        
        <div class="section-header d-flex justify-content-between align-items-center flex-wrap">
            <h1><i class="fas fa-users"></i> Pendaftar Magang</h1>
              <a href="<?php echo e(route('magang.index')); ?>" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <form method="GET" class="mb-3 d-flex gap-2 flex-wrap">
                <div class="input-group" style="width: 250px;">
                    <span class="input-group-text bg-primary text-white">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                    <select name="tahun" class="form-select border-primary" onchange="this.form.submit()">
                        <option value="">📆 Semua Tahun</option>
                        <?php $__currentLoopData = $tahunList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tahun); ?>" <?php echo e($tahun == $tahunFilter ? 'selected' : ''); ?>>
                                Tahun <?php echo e($tahun); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-info text-white">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-info"
                           value="<?php echo e(request('search')); ?>" placeholder="🔍 Cari nama pendaftar..">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </form>
        </div>

        
        <div class="mb-3 d-flex gap-2 flex-wrap">
            <form action="<?php echo e(route('magang.export.all.pdf')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button class="btn btn-outline-danger">
                    <i class="fas fa-file-pdf"></i> Export Semua PDF
                </button>
            </form>

            <form action="<?php echo e(route('magang.export.all.excel')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button class="btn btn-outline-success">
                    <i class="fas fa-file-excel"></i> Export Semua Excel
                </button>
            </form>
        </div>

        
        <?php if($tahunFilter): ?>
            <form action="<?php echo e(route('magang.hapusTahun', $tahunFilter)); ?>" method="POST" class="mb-3"
                  onsubmit="return confirm('Yakin ingin menghapus semua data tahun <?php echo e($tahunFilter); ?>?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i> Hapus Semua Tahun <?php echo e($tahunFilter); ?>

                </button>
            </form>
        <?php endif; ?>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <?php $__currentLoopData = $lowongans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lowongan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                    <h5 class="mb-0">
                        <i class="fas fa-briefcase"></i> <?php echo e($lowongan->judul); ?> (<?php echo e($lowongan->created_at->year); ?>)
                    </h5>

                    <div class="d-flex gap-2">
                        
                        <form action="<?php echo e(route('magang.export.lowongan.pdf', $lowongan->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-light btn-sm">
                                <i class="fas fa-file-pdf"></i> PDF
                            </button>
                        </form>

                        <form action="<?php echo e(route('magang.export.lowongan.excel', $lowongan->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-light btn-sm">
                                <i class="fas fa-file-excel"></i> Excel
                            </button>
                        </form>

                      
                        
                        <form action="<?php echo e(route('pendaftar.hapus.semua', $lowongan->id)); ?>" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus semua pendaftar?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-outline-light btn-sm">
                                <i class="fas fa-trash"></i> Hapus Semua
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <?php if($lowongan->pendaftar->count()): ?>
                        <div class="table-responsive">
                            <table id="table-<?php echo e($lowongan->id); ?>" class="table table-striped table-hover align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>CV</th>
                                        <th>Surat Izin</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $lowongan->pendaftar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendaftar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($pendaftar->nama); ?></td>
                                            <td><?php echo e($pendaftar->alamat); ?></td>
                                            <td class="text-center">
                                                <?php if($pendaftar->cv): ?>
                                                    <a href="<?php echo e(asset('storage/' . $pendaftar->cv)); ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-file"></i> Lihat CV
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if($pendaftar->surat_izin): ?>
                                                    <a href="<?php echo e(asset('storage/' . $pendaftar->surat_izin)); ?>" target="_blank" class="btn btn-outline-secondary btn-sm">
                                                        <i class="fas fa-file-alt"></i> Lihat Surat
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-<?php echo e($pendaftar->status == 'diterima' ? 'success' :
                                                    ($pendaftar->status == 'ditolak' ? 'danger' :
                                                    ($pendaftar->status == 'diproses' ? 'info' : 'warning'))); ?>">
                                                    <?php echo e(ucfirst($pendaftar->status)); ?>

                                                </span>
                                            </td>
                                            <td class="text-center">
                                                
                                                <form action="<?php echo e(route('magang.status', $pendaftar->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <div class="btn-group btn-group-sm">
                                                        <?php $__currentLoopData = ['menunggu', 'diproses', 'diterima', 'ditolak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <button type="submit" name="status" value="<?php echo e($status); ?>"
                                                                    class="btn btn-outline-<?php echo e($status == 'menunggu' ? 'warning' :
                                                                        ($status == 'diproses' ? 'info' :
                                                                        ($status == 'diterima' ? 'success' : 'danger'))); ?>

                                                                    <?php echo e($pendaftar->status == $status ? 'active' : ''); ?>">
                                                                <i class="fas fa-<?php echo e($status == 'menunggu' ? 'clock' :
                                                                    ($status == 'diproses' ? 'spinner' :
                                                                    ($status == 'diterima' ? 'check' : 'times'))); ?>">
                                                                </i>
                                                            </button>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </form>

                                                
                                                <a href="<?php echo e(route('pendaftar.detail', $pendaftar->id)); ?>" class="btn btn-outline-dark btn-sm" title="Lihat Detail">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>

                                                
                                                <form action="<?php echo e(route('pendaftar.hapus', $pendaftar->id)); ?>" method="POST" class="d-inline"
                                                      onsubmit="return confirm('Hapus pendaftar ini?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button class="btn btn-danger btn-sm" title="Hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-user-slash fa-2x mb-2"></i><br>
                            Belum ada pendaftar untuk lowongan ini.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php $__currentLoopData = $lowongans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lowongan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($lowongan->pendaftar->count()): ?>
        <script>
            $(document).ready(function () {
                $('#table-<?php echo e($lowongan->id); ?>').DataTable({
                    responsive: true,
                    language: {
                        search: "🔍 Cari:",
                        lengthMenu: "_MENU_ entri per halaman",
                        zeroRecords: "Tidak ditemukan",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                        infoEmpty: "Tidak ada data",
                        paginate: {
                            first: "Awal",
                            last: "Akhir",
                            next: "→",
                            previous: "←"
                        }
                    }
                });
            });
        </script>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\alam\pelayanan_publik_dprd\resources\views/pages/backend/magang/pendaftar.blade.php ENDPATH**/ ?>