@extends('layouts.frontend')
@section('title', 'Selamat Datang')
@section('content')

<header>
  <section class="home-section section-hero overlay bg-image animate__animated animate__fadeIn" 
           style="background: linear-gradient(135deg, rgba(0, 51, 102, 0.7), rgba(0, 0, 0, 0.5)), url('{{ asset('frontend/images/hero_1.jpg') }}'); background-size: cover; background-position: center; position: relative; padding: 180px 0; overflow: hidden;" 
           id="home-section">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-12 col-md-10 text-center">
          <h1 class="text-white font-weight-bold animate__animated animate__zoomIn" 
              style="font-size: clamp(2.8rem, 8vw, 5rem); text-shadow: 6px 6px 15px rgba(0, 0, 0, 0.9);">
            Sekretariat DPRD Kota Tegal
          </h1>
          <p class="text-white mt-4 lead animate__animated animate__fadeInUp animate__delay-1s" 
             style="max-width: 800px; font-size: clamp(1.2rem, 2.5vw, 1.5rem); line-height: 1.8; text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.6);">
            Pusat administrasi dan pelayanan unggulan untuk mendukung fungsi legislatif Kota Tegal.
          </p>
        </div>
      </div>
    </div>
    <a href="#sekretariat" class="scroll-button smoothscroll animate__animated animate__pulse animate__infinite" 
       style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); color: #ffc107; font-size: clamp(1.8rem, 3vw, 2.5rem); text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.8);">
      <span class="icon-keyboard_arrow_down"></span>
    </a>
  </section>
</header>

<section class="site-section services-section bg-light block__62849 py-5 animate__animated animate__fadeIn" 
         id="sekretariat" style="background: linear-gradient(135deg, #f7fbff 0%, #e9f1fb 100%);">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-12">
        <h2 class="section-title mb-2 animate__animated animate__fadeInDown" 
            style="font-weight: 800; color: #003366; letter-spacing: 2px; font-family: 'Poppins', sans-serif; font-size: clamp(2rem, 4vw, 2.8rem); text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);">
          - Sekretariat DPRD dan Komisi-Komisi -
        </h2>
        <p class="text-muted animate__animated animate__fadeInUp animate__delay-1s" 
           style="font-size: clamp(1rem, 2vw, 1.2rem); max-width: 700px; margin: 0 auto;">
          Jelajahi struktur dan fungsi utama yang mendukung legislasi Kota Tegal.
        </p>
      </div>
    </div>

    <div class="row g-4">
      <!-- Item Sekretariat/Komisi -->
      @php
        $services = [
          ['icon' => 'fa-users', 'title' => 'Bagian Umum dan Kepegawaian', 'desc' => 'Mengelola administrasi kepegawaian, sarana prasarana, dan urusan umum lainnya.'],
          ['icon' => 'fa-money-bill-wave', 'title' => 'Bagian Keuangan', 'desc' => 'Mengelola anggaran, keuangan, dan pertanggungjawaban penggunaan dana DPRD.'],
          ['icon' => 'fa-gavel', 'title' => 'Bagian Persidangan dan Perundang-undangan', 'desc' => 'Mendukung kegiatan sidang, pembuatan peraturan, serta dokumentasi hukum.'],
          ['icon' => 'fa-landmark', 'title' => 'Komisi I', 'desc' => 'Bidang Pemerintahan.'],
          ['icon' => 'fa-wallet', 'title' => 'Komisi II', 'desc' => 'Bidang Perekonomian dan Keuangan.'],
          ['icon' => 'fa-hammer', 'title' => 'Komisi III', 'desc' => 'Bidang Pembangunan dan Bidang Kesejahteraan Rakyat.']
        ];
      @endphp

      @foreach($services as $index => $service)
        <div class="col-12 col-md-6 col-lg-4">
          <a href="#" class="service-card d-block p-4 text-center rounded-lg shadow-md h-100 animate__animated animate__fadeInUp animate__delay-{{ $index }}s" 
             style="background: #ffffff; transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;">
            <span class="icon-wrapper mx-auto mb-3 d-flex justify-content-center align-items-center rounded-circle" 
                  style="width: 70px; height: 70px; background: linear-gradient(45deg, #003366, #005fa3); box-shadow: 0 6px 15px rgba(0, 51, 102, 0.4); transition: transform 0.3s ease;">
              <i class="fa-solid {{ $service['icon'] }} text-white" style="font-size: 2.2rem;"></i>
            </span>
            <h3 style="font-weight: 700; color: #004080; font-family: 'Poppins', sans-serif; font-size: clamp(1.3rem, 2.5vw, 1.6rem);">
              {{ $service['title'] }}
            </h3>
            <p style="color: #444; font-size: clamp(0.9rem, 1.8vw, 1rem); line-height: 1.6; margin-top: 10px;">
              {{ $service['desc'] }}
            </p>
          </a>
        </div>
      @endforeach
    </div>
  </div>

  <style>
    /* Hover effect pada card */
    .service-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 51, 102, 0.5);
      background: linear-gradient(135deg, #f0f8ff, #e6f0fa);
      text-decoration: none;
    }

    .service-card:hover .icon-wrapper {
      transform: scale(1.1) rotate(5deg);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
    }

    .service-card:hover h3,
    .service-card:hover p {
      color: #00264d;
    }

    /* Responsif spacing antar card */
    @media (max-width: 767px) {
      .service-card {
        padding: 2rem 1.5rem;
      }

      .icon-wrapper {
        width: 50px;
        height: 50px;
      }

      .icon-wrapper i {
        font-size: 1.6rem;
      }

      h3 {
        font-size: clamp(1.1rem, 3vw, 1.3rem);
      }

      p {
        font-size: clamp(0.8rem, 1.5vw, 0.9rem);
      }
    }

    @media (min-width: 768px) and (max-width: 991px) {
      .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
      }
    }

    /* Additional modern styling */
    .section-hero {
      position: relative;
      overflow: hidden;
    }

    .scroll-button:hover {
      color: #ffc107;
      transform: scale(1.3);
      text-shadow: 4px 4px 12px rgba(0, 0, 0, 0.9);
    }

    .animate__delay-0s { animation-delay: 0s; }
    .animate__delay-1s { animation-delay: 0.2s; }
    .animate__delay-2s { animation-delay: 0.4s; }
    .animate__delay-3s { animation-delay: 0.6s; }
    .animate__delay-4s { animation-delay: 0.8s; }
    .animate__delay-5s { animation-delay: 1s; }
  </style>
</section>

@endsection

@push('scripts')
<script>
  // Scroll to section on button click
  document.querySelector('.scroll-button')?.addEventListener('click', function (event) {
    event.preventDefault();
    document.querySelector('#sekretariat').scrollIntoView({ behavior: 'smooth' });
  });

  // Hover effects for service cards
  document.querySelectorAll('.service-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
      card.style.transform = 'translateY(-10px)';
      card.style.boxShadow = '0 15px 30px rgba(0, 51, 102, 0.5)';
      card.style.background = 'linear-gradient(135deg, #f0f8ff, #e6f0fa)';
      card.querySelector('.icon-wrapper').style.transform = 'scale(1.1) rotate(5deg)';
      card.querySelector('.icon-wrapper').style.boxShadow = '0 8px 20px rgba(0, 0, 0, 0.4)';
    });
    card.addEventListener('mouseleave', () => {
      card.style.transform = 'translateY(0)';
      card.style.boxShadow = '0 6px 15px rgba(0, 51, 102, 0.4)';
      card.style.background = '#ffffff';
      card.querySelector('.icon-wrapper').style.transform = 'scale(1) rotate(0deg)';
      card.querySelector('.icon-wrapper').style.boxShadow = '0 6px 15px rgba(0, 51, 102, 0.4)';
    });
  });
</script>
@endpush