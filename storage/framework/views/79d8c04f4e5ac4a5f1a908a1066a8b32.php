

<?php $__env->startSection('title', 'Lowongan Magang'); ?>

<?php $__env->startSection('content'); ?>
<!-- HERO SECTION -->
<section class="home-section section-hero overlay bg-image animate__animated animate__fadeIn" 
         style="background: linear-gradient(135deg, rgba(0, 51, 102, 0.7), rgba(0, 0, 0, 0.6)), url('<?php echo e(asset('frontend/images/magang.jpg')); ?>'); background-size: cover; background-position: center; min-height: 60vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-10 text-center" style="padding: 40px 0;">
                <h1 class="text-white fw-bold animate__animated animate__zoomIn" 
                    style="font-size: clamp(2.5rem, 6vw, 3.5rem); font-weight: 700; text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5); margin-bottom: 20px;">
                    Lowongan Magang
                </h1>
                <p class="text-white animate__animated animate__fadeInUp animate__delay-1s" 
                   style="color: #e0e0e0; font-size: clamp(1rem, 2.5vw, 1.25rem); font-weight: 400; line-height: 1.6; max-width: 800px; margin: 0 auto;">
                    Bergabunglah dengan program magang DPRD Kota Tegal untuk mendapatkan pengalaman kerja nyata dan mengasah keterampilanmu di lingkungan profesional!
                </p>
            </div>
        </div>
    </div>
    <a href="#lowongan" class="scroll-button smoothscroll animate__animated animate__pulse animate__infinite" 
       style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); color: #ffc107; font-size: clamp(1.5rem, 3vw, 2rem); text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);">
        <span class="icon-keyboard_arrow_down"></span>
    </a>
</section>

<!-- FLASH MESSAGE -->
<?php if(session('error')): ?>
<div class="container mt-4">
    <div class="alert alert-danger text-center animate__animated animate__bounceIn" 
         style="font-size: clamp(0.9rem, 1.5vw, 1rem); border-radius: 10px; border-left: 5px solid #dc3545; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
        <?php echo e(session('error')); ?>

    </div>
</div>
<?php endif; ?>

<!-- LOWONGAN SECTION -->
<section class="site-section bg-light py-5 animate__animated animate__fadeIn" 
         style="background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);" id="lowongan">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-12 col-lg-8">
                <h2 class="section-title animate__animated animate__fadeInDown" 
                    style="font-size: clamp(2rem, 4vw, 2.5rem); font-weight: 700; color: #1a1a1a; margin-bottom: 15px; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
                    Daftar Lowongan Magang
                </h2>
                <p class="text-muted animate__animated animate__fadeInUp animate__delay-1s" 
                   style="color: #555; font-size: clamp(1rem, 2vw, 1.1rem); line-height: 1.7; max-width: 700px; margin: 0 auto;">
                    Temukan posisi magang yang sesuai dengan passion dan keahlianmu. Jadilah bagian dari tim kami dan raih pengalaman berharga untuk masa depanmu!
                </p>
            </div>
        </div>

        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $lowongan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lowongan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $deadline = \Carbon\Carbon::parse($lowongan->deadline);
                    $expired = $deadline->lt(now());
                ?>

                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 card-lowongan animate__animated animate__fadeInUp animate__delay-<?php echo e($index * 0.2); ?>s" 
                         style="border-radius: 15px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; background: #ffffff;">
                        <div class="card-body d-flex flex-column" style="padding: 25px;">
                            <h5 style="font-size: clamp(1.3rem, 2.5vw, 1.5rem); font-weight: 600; color: #003366;">
                                <?php echo e($lowongan->judul); ?>

                            </h5>
                            <p style="font-size: clamp(0.9rem, 1.8vw, 1rem);"><strong>Kuota:</strong> <?php echo e($lowongan->kuota); ?> peserta</p>
                            <p style="font-size: clamp(0.9rem, 1.8vw, 1rem);"><strong>Deadline:</strong> <?php echo e($deadline->translatedFormat('d F Y')); ?></p>
                            <p style="font-size: clamp(0.9rem, 1.8vw, 1rem);"><strong>Periode:</strong> <?php echo e($lowongan->periode); ?></p>
                            <p class="job-description" style="font-size: clamp(0.85rem, 1.6vw, 0.95rem); color: #4a5568; line-height: 1.6; margin: 1rem 0 1.6rem 0; flex-grow: 1; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; transition: max-height 0.3s ease; cursor: pointer;">
                                <?php echo e($lowongan->deskripsi); ?>

                            </p>

                            <?php if($expired): ?>
                                <div class="alert alert-danger mt-auto animate__animated animate__shakeX" 
                                     style="border-radius: 20px; padding: 10px 15px; font-size: clamp(0.8rem, 1.5vw, 0.95rem); background-color: #f8d7da; color: #721c24; border: none;">
                                    Pendaftaran telah ditutup
                                </div>
                            <?php else: ?>
                                <a href="<?php echo e(route('magang.form', ['id' => $lowongan->id])); ?>" 
                                   class="btn mt-auto animate__animated animate__pulse" 
                                   style="background: linear-gradient(90deg, #2b6cb0, #3182ce); color: #ffffff; border-radius: 25px; padding: 10px 20px; font-weight: 500; font-size: clamp(0.9rem, 1.8vw, 1.1rem); text-align: center; transition: transform 0.3s ease;">
                                    Daftar Sekarang
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center animate__animated animate__fadeInUp">
                    <p style="font-size: clamp(1rem, 2vw, 1.1rem); color: #718096; font-style: italic;">Belum ada lowongan magang tersedia saat ini. Pantau terus untuk pembaruan!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
    /* Hover effects */
    .card-lowongan:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 51, 102, 0.2);
    }

    .card-lowongan:hover .btn {
        transform: scale(1.05);
    }

    .card-lowongan:hover .job-description {
        -webkit-line-clamp: unset;
        overflow: visible;
        max-height: 500px;
        cursor: default;
    }

    .btn:hover {
        background: linear-gradient(90deg, #2c5282, #2b6cb0) !important;
    }

    /* Responsive design */
    @media (max-width: 767px) {
        .section-hero {
            min-height: 40vh;
        }

        .section-hero h1 {
            font-size: clamp(2rem, 6vw, 2.5rem);
        }

        .section-hero p {
            font-size: clamp(0.9rem, 2.5vw, 1rem);
        }

        .col-md-6, .col-lg-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .card-lowongan {
            margin-bottom: 2rem;
        }

        h5, p {
            font-size: clamp(1rem, 2.5vw, 1.3rem);
        }

        .job-description {
            font-size: clamp(0.8rem, 1.8vw, 0.85rem);
        }

        .btn {
            width: 100%;
        }
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    /* Additional styling */
    .section-hero {
        position: relative;
    }

    .scroll-button:hover {
        color: #ffc107;
        transform: scale(1.2);
        text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.7);
    }

    .animate__delay-0s { animation-delay: 0s; }
    .animate__delay-2s { animation-delay: 0.2s; }
    .animate__delay-4s { animation-delay: 0.4s; }
    .animate__delay-6s { animation-delay: 0.6s; }
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Scroll to section on button click
    document.querySelector('.scroll-button')?.addEventListener('click', function (event) {
        event.preventDefault();
        document.querySelector('#lowongan').scrollIntoView({ behavior: 'smooth' });
    });

    // Hover effects for cards
    document.querySelectorAll('.card-lowongan').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-8px)';
            card.style.boxShadow = '0 12px 30px rgba(0, 51, 102, 0.2)';
            card.querySelector('.btn').style.transform = 'scale(1.05)';
            card.querySelector('.job-description').style.webkitLineClamp = 'unset';
            card.querySelector('.job-description').style.overflow = 'visible';
            card.querySelector('.job-description').style.maxHeight = '500px';
            card.querySelector('.job-description').style.cursor = 'default';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.style.boxShadow = '0 4px 10px rgba(0, 0, 0, 0.1)';
            card.querySelector('.btn').style.transform = 'scale(1)';
            card.querySelector('.job-description').style.webkitLineClamp = '4';
            card.querySelector('.job-description').style.overflow = 'hidden';
            card.querySelector('.job-description').style.maxHeight = '';
            card.querySelector('.job-description').style.cursor = 'pointer';
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/lowonganmagang.blade.php ENDPATH**/ ?>