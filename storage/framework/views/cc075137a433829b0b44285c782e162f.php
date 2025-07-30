

<?php $__env->startSection('title', 'Daftar Anggota Dewan'); ?>

<?php $__env->startPush('style'); ?>
<style>
    .table-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    .btn-action {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }
    .btn-icon {
        width: 36px;
        height: 36px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        transition: all 0.3s ease;
        font-size: 14px;
        border: none;
    }
    .btn-icon:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .btn-edit {
        background-color: #ffc107;
        color: #fff;
    }
    .btn-edit:hover {
        background-color: #e0a800;
    }
    .btn-delete {
        background-color: #dc3545;
        color: #fff;
    }
    .btn-delete:hover {
        background-color: #c82333;
    }
    th, td {
        vertical-align: middle !important;
        text-align: center;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-users mr-2"></i> Daftar Anggota Dewan</h1>
        </div>

        <div class="section-body">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Data Anggota Dewan</h4>
                    <a href="<?php echo e(route('anggota.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus-circle mr-1"></i> Tambah Anggota
                    </a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Foto</th>
                                    <th>Fraksi</th>  
                                    <th>Dibuat Oleh</th>                 
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $anggotaDewan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($anggota->nama); ?></td>
                                        <td><?php echo e($anggota->jabatan); ?></td>
                                        <td>
                                            <img src="<?php echo e(asset('storage/' . $anggota->gambar_anggota)); ?>" alt="Foto Anggota" class="table-img">
                                        </td>
                                        <td><?php echo e($anggota->fraksi); ?></td>
                                        <td><?php echo e(optional($anggota->user)->name ?? 'Tidak diketahui'); ?></td>

                                        <td>
                                            <div class="btn-action">
                                                <a href="<?php echo e(route('anggota.edit', $anggota->id)); ?>" class="btn-icon btn-edit" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button 
                                                    type="button" 
                                                    class="btn-icon btn-delete" 
                                                    data-toggle="modal" 
                                                    data-target="#deleteModal"
                                                    data-id="<?php echo e($anggota->id); ?>"
                                                    data-nama="<?php echo e($anggota->nama); ?>"
                                                    title="Hapus"
                                                >
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada data anggota.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="formDelete" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalDeleteLabel">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Konfirmasi Hapus
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus <strong id="namaAnggota"></strong> dari daftar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#deleteModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let nama = button.data('nama');

            let modal = $(this);
            modal.find('#namaAnggota').text(nama);
            modal.find('#formDelete').attr('action', '/backend/anggota/' + id);
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/pages/backend/anggota_dewan/index.blade.php ENDPATH**/ ?>