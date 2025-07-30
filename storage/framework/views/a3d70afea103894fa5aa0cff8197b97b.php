

<?php $__env->startSection('title', 'Berita'); ?>

<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1 style="font-size: 24px; font-weight: bold; color: #000000;">Berita</h1>
            </div>
            
            <div class="col-12 mb-4">
                <?php if(session('success')): ?>
                    <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 5px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                        <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
            </div>

            <div style="border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); border: none;" class="card">
                <div class="card-header" style="background-color: #007bff; color: white; padding: 16px;">
                    <a href="<?php echo e(route('berita.create')); ?>" class="btn" style="background-color: #f8f9fa; color: #007bff; border-radius: 30px; padding: 10px 20px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                        <i class="fas fa-plus-circle"></i> Tambah Berita
                    </a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table" style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
                            <thead style="background-color: #fcfcfc; color: white;">
                                <tr>
                                    <th style="padding: 10px; text-align: center; border: 1px solid #ddd;">#</th>
                                    <th style="padding: 10px; text-align: center; border: 1px solid #ddd;">Judul</th>
                                    <th style="padding: 10px; text-align: center; border: 1px solid #ddd;">Gambar</th>
                                    <th style="padding: 10px; text-align: center; border: 1px solid #ddd;">Dibuat Oleh</th>

                                    <th style="padding: 10px; text-align: center; border: 1px solid #ddd;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $beritaItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr style="border-top: 1px solid #ddd;">
                                        <td style="padding: 10px; text-align: center;"><?php echo e($loop->iteration); ?></td>
                                        <td style="padding: 10px;"><?php echo e($beritaItem->judul); ?></td>
                                        <td style="padding: 10px; text-align: center;">
                                            <img src="<?php echo e(asset('storage/' . $beritaItem->gambar)); ?>" width="100" class="rounded shadow-sm">
                                        </td>
                                        <td style="padding: 10px; text-align: center;">
    <?php echo e($beritaItem->user->name ?? '-'); ?>

</td>

                                        <td style="padding: 10px; text-align: center;">
                                            <a href="<?php echo e(route('berita.edit', $beritaItem)); ?>" class="btn btn-warning btn-sm" style="border-radius: 50%; padding: 8px 12px;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?php echo e(route('berita.destroy', $beritaItem)); ?>" method="POST" class="d-inline" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button class="btn btn-danger btn-sm" style="border-radius: 50%; padding: 8px 12px;" onclick="return confirm('Yakin ingin menghapus?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        <?php echo e($beritas->links('pagination::bootstrap-4')); ?>

                    </nav>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/pages/backend/berita/index.blade.php ENDPATH**/ ?>