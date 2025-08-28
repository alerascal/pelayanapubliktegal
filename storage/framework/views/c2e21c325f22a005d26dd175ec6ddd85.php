
<?php $__env->startSection('title', 'Selamat Datang'); ?>
<?php $__env->startSection('content'); ?>

<section class="home-section section-hero overlay bg-image animate__animated animate__fadeIn" 
         style="background: linear-gradient(rgba(0, 51, 102, 0.7), rgba(0, 0, 0, 0.6)), url('<?php echo e(asset('frontend/images/hero_1.jpg')); ?>'); background-size: cover; background-position: center; position: relative; padding: 150px 0;" 
         id="home-section">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12 col-md-10 text-center">
        <h1 class="text-white font-weight-bold animate__animated animate__zoomIn" 
            style="font-size: clamp(2.5rem, 8vw, 4.5rem); text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.8);">
          Visi Misi DPRD Kota Tegal
        </h1>
      </div>
    </div>
  </div>
  <a href="#visi_misi" class="scroll-button smoothscroll animate__animated animate__pulse animate__infinite" 
     style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); color: #ffc107; font-size: 2rem; text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);">
    <span class="icon-keyboard_arrow_down"></span>
  </a>
</section>

<section id="visi_misi" class="py-5 animate__animated animate__fadeIn" 
         style="background: linear-gradient(135deg, #e9f1fb 0%, #f7fbff 100%);">
  <div class="container">
    <div class="row">
      <!-- Visi & Misi -->
      <div class="col-12 col-lg-8">
        <!-- Visi -->
        <div class="mb-5">
          <h3 class="h3 d-flex align-items-center mb-3 animate__animated animate__fadeInDown" 
              style="color: #003366; font-weight: 800; letter-spacing: 1.2px; font-size: clamp(1.5rem, 4vw, 2rem);">
            <i class="fas fa-eye mr-3 animate__animated animate__bounceIn" style="color: #1e90ff; font-size: clamp(1.4rem, 3vw, 1.6rem);"></i> 
            VISI DPRD KOTA TEGAL
          </h3>
          <p class="lead animate__animated animate__fadeInUp animate__delay-1s" 
             style="font-size: clamp(1.1rem, 2.5vw, 1.25rem); color: #222; line-height: 1.8; font-weight: 500;">
            Terwujudnya Pemerintahan yang Berdedikasi Menuju Kota Tegal yang Bersih, Demokratis, Disiplin, dan Inovatif.
          </p>
        </div>

        <!-- Misi -->
        <div>
          <h3 class="h3 d-flex align-items-center mb-4 animate__animated animate__fadeInDown" 
              style="color: #003366; font-weight: 800; letter-spacing: 1.2px; font-size: clamp(1.5rem, 4vw, 2rem);">
            <i class="fas fa-bullseye mr-3 animate__animated animate__bounceIn" style="color: #1e90ff; font-size: clamp(1.4rem, 3vw, 1.6rem);"></i> 
            MISI DPRD KOTA TEGAL
          </h3>
          <ul class="list-unstyled pl-3" style="color: #333; font-size: clamp(1rem, 2vw, 1.1rem); line-height: 1.75;">
            <?php
              $misi = [
                "Mewujudkan Pemerintahan yang Bersih, Profesional, Akuntabel, Berwibawa dan Inovatif, Berbasis Teknologi Informasi.",
                "Menciptakan atmosfir kehidupan Kota Tegal yang lebih agamis, aman, kreatif, berbudaya, demokrasi, Melindungi hak-hak anak dan perempuan untuk kesetaraan serta keadilan gender.",
                "Meningkatkan pembangunan dibidang pendidikan, kesehatan, kesejahteraan pekerja dan masyarakat tidak mampu.",
                "Meningkatkan infrastruktur, transportasi publik, lingkungan hidup yang bersih dan sehat serta pembangunan berkelanjutan yang berorientasi pada energi terbarukan.",
                "Meningkatkan kepariwisataan, investasi, dan daya saing daerah serta mengembangkan ekonomi kerakyatan dan ekonomi kreatif.",
                "Mengoptimalkan peran pemuda, pembinaan olahraga dan seni budaya."
              ];
            ?>
            <?php $__currentLoopData = $misi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="mb-3 d-flex align-items-start animate__animated animate__fadeInUp animate__delay-<?php echo e($index + 1); ?>s">
                <i class="fas fa-check-circle text-primary mr-3 mt-1" style="font-size: clamp(1.2rem, 2.5vw, 1.3rem);"></i>
                <span><?php echo e($item); ?></span>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      </div>

      <!-- Media Sosial -->
      <div class="col-12 col-lg-4 mt-4 mt-lg-0">
        <div class="bg-white p-4 rounded-lg shadow-lg animate__animated animate__zoomIn animate__delay-6s" 
             style="border-left: 5px solid #1e90ff; min-height: 300px; display: flex; flex-direction: column; justify-content: center;">
          <h4 class="mb-4 text-center" style="color: #003366; font-weight: 700; letter-spacing: 1.1px; font-size: clamp(1.4rem, 3vw, 1.8rem);">
            <i class="fas fa-hashtag mr-2"></i> Media Sosial
          </h4>
          <div class="d-flex justify-content-center gap-4">
            <a href="https://www.facebook.com/profile.php?id=100090255246539&mibextid=fToiWhWJ2YtxSTUw" target="_blank" aria-label="Facebook" class="social-icon facebook">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/dprdkotategal?igsh=bXA5ZmMzc2NpeWFl" target="_blank" aria-label="Instagram" class="social-icon instagram">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.tiktok.com/@dprdkotategal?_t=8sDRpIRLhou&_r=1" target="_blank" aria-label="TikTok" class="social-icon tiktok">
              <i class="fab fa-tiktok"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    /* Styling ikon media sosial */
    .social-icon {
      font-size: clamp(1.8rem, 4vw, 2.5rem);
      color: #003366;
      transition: transform 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      width: clamp(40px, 8vw, 50px);
      height: clamp(40px, 8vw, 50px);
      border-radius: 50%;
      background: #e1e9f7;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .social-icon:hover {
      transform: scale(1.2) rotate(10deg);
      color: white;
      box-shadow: 0 8px 16px rgba(30, 144, 255, 0.5);
    }

    .social-icon.facebook:hover {
      background: #3b5998;
    }

    .social-icon.instagram:hover {
      background: #e4405f;
    }

    .social-icon.tiktok:hover {
      background: #000;
    }

    /* Responsive layout */
    @media (max-width: 991px) {
      .col-lg-8, .col-lg-4 {
        flex: 0 0 100%;
        max-width: 100%;
      }

      .social-icon {
        width: 50px;
        height: 50px;
        font-size: 2rem;
      }
    }

    @media (max-width: 767px) {
      .section-hero {
        padding: 100px 0;
      }

      .scroll-button {
        bottom: 10px;
        font-size: 1.5rem;
      }

      h1 {
        font-size: clamp(2rem, 6vw, 3rem);
      }

      .lead, .h3 {
        font-size: clamp(1rem, 2.5vw, 1.25rem);
      }
    }

    /* Additional modern styling */
    .section-hero {
      position: relative;
      overflow: hidden;
    }

    .scroll-button:hover {
      color: #ffc107;
      transform: scale(1.2);
      text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.8);
    }

    .animate__delay-6s {
      animation-delay: 6s;
    }
  </style>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  // Scroll to section on button click
  document.querySelector('.scroll-button')?.addEventListener('click', function (event) {
    event.preventDefault();
    document.querySelector('#visi_misi').scrollIntoView({ behavior: 'smooth' });
  });

  // Hover effects for social media icons
  document.querySelectorAll('.social-icon').forEach(icon => {
    icon.addEventListener('mouseenter', () => {
      icon.style.transform = 'scale(1.2) rotate(10deg)';
      icon.style.boxShadow = '0 8px 16px rgba(30, 144, 255, 0.5)';
    });
    icon.addEventListener('mouseleave', () => {
      icon.style.transform = 'scale(1) rotate(0deg)';
      icon.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
    });
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/pages/frontend/visimisi.blade.php ENDPATH**/ ?>