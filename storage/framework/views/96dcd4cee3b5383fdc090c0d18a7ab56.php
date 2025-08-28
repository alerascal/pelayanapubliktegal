

<?php $__env->startSection('title', 'Detail Anggota Dewan'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="fw-bold" style="color: #1A1A1A;">Detail Anggota Dewan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('anggota.index')); ?>">Data Anggota</a></div>
                <div class="breadcrumb-item">Detail</div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-4 mb-4" style="transition: transform 0.3s ease;">
                    <div class="row g-0 align-items-center">
                        <!-- Profile Image and Info -->
                        <div class="col-md-4 text-center p-4">
                            <img src="<?php echo e(asset('storage/' . ($anggota->gambar_anggota ?? 'default.jpg'))); ?>"
                                 alt="Foto <?php echo e($anggota->nama); ?>"
                                 class="img-fluid rounded-circle shadow-sm"
                                 style="width: 250px; height: 250px; object-fit: cover; object-position: top; border: 5px solid #fff; transition: transform 0.3s ease;">
                            <h4 class="mt-3 fw-bold" style="color: #1A1A1A;"><?php echo e($anggota->nama); ?></h4>
                            <p class="text-secondary mb-2"><?php echo e($anggota->jabatan); ?></p>
                            <span class="badge bg-dark-blue text-white px-3 py-2 rounded-pill" style="font-size: 0.9rem; transition: transform 0.3s ease;">
                                Fraksi: <?php echo e($anggota->fraksi ?? '-'); ?>

                            </span>
                        </div>
                        <!-- Sosial Media -->
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="mb-3 fw-bold" style="color: #1A1A1A;">🌐 Sosial Media</h5>
                                <?php 
                                    $sosmed = is_array($anggota->sosmed) ? $anggota->sosmed : json_decode($anggota->sosmed, true); 
                                    $sosmedList = ['Facebook', 'Instagram', 'TikTok', 'Twitter'];
                                    $sosmedIcons = [
                                        'Facebook' => 'fab fa-facebook-f',
                                        'Instagram' => 'fab fa-instagram',
                                        'TikTok' => 'fab fa-tiktok',
                                        'Twitter' => 'fab fa-twitter'
                                    ];
                                ?>
                                <?php if(!empty($sosmed) && is_array($sosmed)): ?>
                                    <div class="d-flex flex-wrap">
                                        <?php $__currentLoopData = $sosmedList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($sosmed[strtolower($platform)])): ?>
                                                <a href="<?php echo e($sosmed[strtolower($platform)]); ?>" 
                                                   target="_blank" 
                                                   class="text-decoration-none text-dark mr-3 mb-2 contact-icon" 
                                                   style="color: #333; transition: color 0.3s ease, transform 0.3s ease;">
                                                    <i class="<?php echo e($sosmedIcons[$platform]); ?> fa-lg mr-1"></i>
                                                    <span><?php echo e($platform); ?></span>
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted">Tidak ada data sosial media.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Pendidikan -->
                <div class="card shadow-lg border-0 rounded-4 mb-4" style="transition: transform 0.3s ease;">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold" style="color: #1A1A1A;">🎓 Riwayat Pendidikan</h5>
                        <?php $pendidikan = is_array($anggota->pendidikan) ? $anggota->pendidikan : json_decode($anggota->pendidikan, true); ?>
                        <?php if(!empty($pendidikan) && is_array($pendidikan)): ?>
                            <ul class="list-unstyled">
                                <?php $__currentLoopData = $pendidikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="mb-2"><i class="fas fa-graduation-cap mr-2" style="color: #1A1A1A;"></i><span style="color: #333;"><?php echo e($item); ?></span></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">Tidak ada data pendidikan.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Pengalaman -->
                <div class="card shadow-lg border-0 rounded-4 mb-4" style="transition: transform 0.3s ease;">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold" style="color: #1A1A1A;">💼 Pengalaman</h5>
                        <?php $pengalaman = is_array($anggota->pengalaman) ? $anggota->pengalaman : json_decode($anggota->pengalaman, true); ?>
                        <?php if(!empty($pengalaman) && is_array($pengalaman)): ?>
                            <ul class="list-unstyled">
                                <?php $__currentLoopData = $pengalaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="mb-2"><i class="fas fa-briefcase mr-2" style="color: #1A1A1A;"></i><span style="color: #333;"><?php echo e($item); ?></span></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">Tidak ada data pengalaman.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Biografi -->
                <div class="card shadow-lg border-0 rounded-4 mb-4" style="transition: transform 0.3s ease;">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold" style="color: #1A1A1A;">📜 Biografi</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p><strong style="color: #1A1A1A;">Latar Belakang:</strong><br><span style="color: #333;"><?php echo e($anggota->bio_latar ?? '-'); ?></span></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p><strong style="color: #1A1A1A;">Perjalanan Karier:</strong><br><span style="color: #333;"><?php echo e($anggota->bio_karier ?? '-'); ?></span></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p><strong style="color: #1A1A1A;">Jabatan & Penghargaan:</strong><br><span style="color: #333;"><?php echo e($anggota->bio_jabatan ?? '-'); ?></span></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p><strong style="color: #1A1A1A;">Visi & Motivasi:</strong><br><span style="color: #333;"><?php echo e($anggota->bio_visi ?? '-'); ?></span></p>
                            </div>
                            <div class="col-md-12">
                                <p><strong style="color: #1A1A1A;">Fokus Perjuangan:</strong><br><span style="color: #333;"><?php echo e($anggota->bio_fokus ?? '-'); ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <a href="<?php echo e(route('anggota.index')); ?>" 
                       class="btn btn-sm text-white" 
                       style="background-color: #003366; border-color: #003366; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .bg-dark-blue {
        background-color: #003366;
    }

    .card:hover {
        transform: translateY(-10px);
    }

    .card img:hover {
        transform: scale(1.05);
    }

    .contact-icon:hover {
        color: #ffc107 !important;
        transform: scale(1.2) rotate(10deg);
    }

    .badge:hover {
        transform: scale(1.1);
    }

    .btn:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    /* Responsive adjustments */
    @media (max-width: 767px) {
        .card .row.g-0 {
            flex-direction: column;
            align-items: center;
        }
        .card .col-md-4, .card .col-md-8 {
            width: 100%;
            text-align: center;
        }
        .card img {
            width: 200px;
            height: 200px;
        }
        .d-flex.flex-wrap {
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .card img {
            width: 150px;
            height: 150px;
        }
        h4, h5 {
            font-size: 1.25rem;
        }
        .btn-sm {
            font-size: 0.8rem;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('adminlte_scripts'); ?>
<script>
    // Card hover animations
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px)';
            const img = card.querySelector('img');
            if (img) img.style.transform = 'scale(1.05)';
            const badge = card.querySelector('.badge');
            if (badge) badge.style.transform = 'scale(1.1)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            const img = card.querySelector('img');
            if (img) img.style.transform = 'scale(1)';
            const badge = card.querySelector('.badge');
            if (badge) badge.style.transform = 'scale(1)';
        });
    });

    // Back button hover animation
    document.querySelector('.btn').addEventListener('mouseenter', () => {
        document.querySelector('.btn').style.transform = 'scale(1.1)';
        document.querySelector('.btn').style.boxShadow = '0 8px 20px rgba(0, 0, 0, 0.3)';
    });
    document.querySelector('.btn').addEventListener('mouseleave', () => {
        document.querySelector('.btn').style.transform = 'scale(1)';
        document.querySelector('.btn').style.boxShadow = 'none';
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/pages/backend/anggota_dewan/show.blade.php ENDPATH**/ ?>