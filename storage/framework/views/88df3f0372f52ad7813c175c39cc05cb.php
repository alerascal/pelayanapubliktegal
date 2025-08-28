

<?php $__env->startSection('title', 'Anggota Dewan'); ?>

<?php $__env->startSection('content'); ?>
<!-- HERO SECTION -->
<section class="home-section section-hero overlay bg-image animate__animated animate__fadeIn" 
         style="background-image: url('<?php echo e(asset('frontend/images/hero_1.jpg')); ?>');" id="home-section">
    <div class="container">
        <div class="row align-items-center justify-content-center" style="min-height: 50vh;">
            <div class="col-md-10 text-center">
                <h1 class="text-white fw-bold display-5 mb-3 animate__animated animate__zoomIn">Pimpinan Dewan DPRD Kota Tegal</h1>
                <p class="text-white fs-5 animate__animated animate__fadeInUp animate__delay-1s">Kenali lebih dekat para Pimpinan dewan yang berperan dalam membangun Kota Tegal.</p>
            </div>
        </div>
    </div>
</section>

<!-- DAFTAR ANGGOTA -->
<section class="site-section bg-white py-5 animate__animated animate__fadeIn">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="section-title mb-3 fw-bold text-dark animate__animated animate__fadeInDown" style="color: #1A1A1A;">Daftar Pimpinan DPRD Kota Tegal</h2>
                <p class="text-muted animate__animated animate__fadeInUp animate__delay-1s">Berikut adalah daftar lengkap anggota DPRD Kota Tegal beserta jabatan dan fraksinya.</p>
            </div>
        </div>

        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $anggotaDewan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $anggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-sm-6 col-md-4 mb-4">
                    <div class="card h-100 shadow-lg border-0 rounded-4 animate__animated animate__fadeInUp animate__delay-<?php echo e($index * 0.2); ?>s" 
                         style="transition: transform 0.3s ease;">
                        <div class="text-center px-3" style="margin-top: -40px;">
                            <img src="<?php echo e(asset('storage/' . ($anggota->gambar_anggota ?? 'default.jpg'))); ?>"
                                 alt="Foto <?php echo e($anggota->nama); ?>"
                                 class="rounded-circle shadow-sm"
                                 style="width: 250px; height: 250px; object-fit: cover; object-position: top; border: 5px solid #fff; transition: transform 0.3s ease;">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-dark mb-1" style="color: #1A1A1A; transition: color 0.3s ease;"><?php echo e($anggota->nama); ?></h5>
                            <p class="text-secondary mb-1" style="transition: color 0.3s ease;"><?php echo e($anggota->jabatan); ?></p>
                            <span class="badge bg-dark-blue text-white px-3 py-2 rounded-pill" 
                                  style="font-size: 0.9rem; transition: transform 0.3s ease;">
                                Fraksi: <?php echo e($anggota->fraksi ?? '-'); ?>

                            </span>
                            <div class="mt-3">
                                <a href="<?php echo e(route('anggota.detail', $anggota->id)); ?>" 
                                   class="btn btn-sm text-white" 
                                   style="background-color: #003366; border-color: #003366; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Tidak ada data anggota dewan yang tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
    .bg-dark-blue {
        background-color: #003366;
    }

    /* Hover animations */
    .card:hover {
        transform: translateY(-10px);
    }

    .card:hover img {
        transform: scale(1.05);
    }

    .card:hover h5,
    .card:hover p {
        color: #00264d;
    }

    .card:hover .badge {
        transform: scale(1.1);
    }

    .card:hover .btn {
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    /* Animation delays */
    .animate__delay-0s { animation-delay: 0s; }
    .animate__delay-2s { animation-delay: 0.2s; }
    .animate__delay-4s { animation-delay: 0.4s; }
    .animate__delay-6s { animation-delay: 0.6s; }
    .animate__delay-8s { animation-delay: 0.8s; }
    .animate__delay-10s { animation-delay: 1s; }

    /* Responsive adjustments */
    @media (max-width: 767px) {
        .card img {
            width: 200px;
            height: 200px;
        }
    }

    @media (max-width: 576px) {
        .card img {
            width: 150px;
            height: 150px;
        }
        h5 {
            font-size: 1.25rem;
        }
        .btn-sm {
            font-size: 0.8rem;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Hover effects for cards
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px)';
            const img = card.querySelector('img');
            if (img) img.style.transform = 'scale(1.05)';
            const h5 = card.querySelector('h5');
            if (h5) h5.style.color = '#00264d';
            const p = card.querySelector('p');
            if (p) p.style.color = '#00264d';
            const badge = card.querySelector('.badge');
            if (badge) badge.style.transform = 'scale(1.1)';
            const btn = card.querySelector('.btn');
            if (btn) {
                btn.style.transform = 'scale(1.1)';
                btn.style.boxShadow = '0 8px 20px rgba(0, 0, 0, 0.3)';
            }
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            const img = card.querySelector('img');
            if (img) img.style.transform = 'scale(1)';
            const h5 = card.querySelector('h5');
            if (h5) h5.style.color = '#1A1A1A';
            const p = card.querySelector('p');
            if (p) p.style.color = '';
            const badge = card.querySelector('.badge');
            if (badge) badge.style.transform = 'scale(1)';
            const btn = card.querySelector('.btn');
            if (btn) {
                btn.style.transform = 'scale(1)';
                btn.style.boxShadow = 'none';
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/pages/frontend/anggota_dewan.blade.php ENDPATH**/ ?>