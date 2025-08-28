@extends('layouts.frontend')
@section('title', 'Selamat Datang')
@section('content')
<!-- Hero Section -->
<section class="home-section section-hero" id="home-section"
    style="background-image: url('{{ asset('frontend/images/hero_1.jpg') }}'); background-size: cover; background-position: center; position: relative; padding: 100px 0; width: 100vw; overflow: hidden;">

    <!-- Overlay Gelap -->
    <div style="
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.6));
        z-index: 1;
    "></div>
    <!-- Konten -->
    <div class="container-fluid px-4 d-flex flex-column justify-content-center align-items-center text-center text-white"
         style="min-height: 85vh; position: relative; z-index: 2;">

        <div class="text-center my-4">
            <h1 class="animate__animated animate__zoomIn fw-bold mb-3"
                style="text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.6); color: white; font-size: 2.8rem;">
                Selamat Datang di
            </h1>

            <h2 class="animate__animated animate__bounceIn fw-bold mb-2"
                style="color: #ffc107; text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5); font-size: 2.5rem;">
                Pelayanan Publik
            </h2>

            <h3 class="animate__animated animate__bounceIn animate__delay-1s fw-bold"
                style="color: #ffc107; text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5); font-size: 2rem;">
                DPRD Kota Tegal
            </h3>
        </div>

        <p class="animate__animated animate__fadeInUp animate__delay-2s lead"
           style="max-width: 700px; line-height: 1.8; text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4); font-size: 1.1rem;">
            Pelayanan publik berbasis <b>transparansi</b>, <b>akuntabilitas</b>, dan <b>inovasi</b> demi kemajuan Kota Tegal yang <b>demokratif</b> dan <b>disiplin</b>.
        </p>
    </div>
</section>

<!-- Tambahan CSS Responsif & Fix Putih -->
<style>
    /* Atur lebar dan mencegah white space */
    html, body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        width: 100%;
    }

    .section-hero {
        width: 100vw;
        overflow-x: hidden;
    }

    .section-hero h1 {
        font-size: 2rem;
    }

    @media (min-width: 576px) {
        .section-hero h1 {
            font-size: 2.5rem;
        }
    }

    @media (min-width: 768px) {
        .section-hero h1 {
            font-size: 3rem;
        }
    }

    @media (min-width: 992px) {
        .section-hero h1 {
            font-size: 3.5rem;
        }
    }

    @media (min-width: 1200px) {
        .section-hero h1 {
            font-size: 4rem;
        }
    }

    .text-shadow {
        text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.6);
    }

    .lead {
        font-size: 1.1rem;
    }

    /* Hover effects */
    .scroll-button:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        background-color: #005fa3;
    }
</style>

<!-- Bagian Layanan -->
<section id="next" class="site-section services-section bg-light" style="padding: 60px 0;">
    <div class="container">
        <!-- Judul Bagian Layanan -->
        <div class="text-center mb-5">
            <h2 class="animate__animated animate__fadeInDown" style="color: #003366;">
                Pelayanan Publik DPRD Kota Tegal
            </h2>
            <p class="animate__animated animate__fadeInUp animate__delay-1s">
                Jelajahi berbagai layanan dan informasi penting terkait DPRD Kota Tegal.
            </p>
        </div>

        <div class="row">
            @php
                $menus = [
                    ['icon'=>'book', 'text'=>'Sejarah DPRD Kota Tegal', 'link'=>'/sejarah'],
                    ['icon'=>'bullseye', 'text'=>'Visi Misi', 'link'=>'/visimisi'],
                    ['icon'=>'building', 'text'=>'Sekretariat DPRD', 'link'=>route('sekretariat')],
                    ['icon'=>'users', 'text'=>'Anggota Dewan', 'link'=>route('anggota.showAnggota')],
                    ['icon'=>'briefcase', 'text'=>'Lowongan Magang', 'link'=>route('magang.lowongan')],
                ];
            @endphp

            @foreach($menus as $index => $menu)
            <div class="col-6 col-md-4 col-lg-4 mb-4 mb-lg-5 text-center">
                <a href="{{ $menu['link'] }}" class="d-block menu-item animate__animated animate__zoomIn animate__delay-{{ $index }}s"
                   style="text-decoration: none; transition: all 0.3s ease;">
                    <div class="mx-auto mb-3 service-icon"
                         style="display: flex; justify-content: center; align-items: center; background-color: #003366; width: 60px; height: 60px; border-radius: 50%; transition: all 0.3s ease;">
                        <i class="fa-solid fa-{{ $menu['icon'] }}" style="color: white;"></i>
                    </div>
                    <h5 style="color: #003366; transition: color 0.3s ease;">{{ $menu['text'] }}</h5>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Aspirasi Masyarakat -->
<section id="aspirasi" class="site-section bg-light py-5">
    <div class="container text-center">
        <!-- Judul -->
        <h2 class="fw-bold mb-3 animate__animated animate__fadeInDown" style="color: #003366; font-size: 2rem;">
            - Aspirasi Masyarakat -
        </h2>
        <p class="text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 1.1rem;">
            Sampaikan aspirasi Anda demi kemajuan Kota Tegal yang lebih <strong>demokratif</strong> dan <strong>inovatif</strong>.
        </p>

        <!-- Tombol Aksi -->
        <a href="{{ route('aspirasi.create') }}" class="btn btn-lg mt-3 px-4 shadow-sm animate__animated animate__pulse animate__infinite"
           style="background-color: #003366; color: white; border-radius: 30px; transition: all 0.3s ease;">
            <i class="fa-solid fa-paper-plane me-2"></i> Sampaikan Aspirasi
        </a>

        <!-- Fitur Utama -->
        <div class="row mt-5 justify-content-center">
            @php
                $features = [
                    ['icon'=>'comment-dots', 'title'=>'Mudah & Cepat', 'desc'=>'Isi formulir aspirasi secara online hanya dalam beberapa menit.'],
                    ['icon'=>'shield-halved', 'title'=>'Privasi Terjaga', 'desc'=>'Data pelapor dijaga kerahasiaannya sesuai ketentuan yang berlaku.'],
                    ['icon'=>'chart-line', 'title'=>'Tindak Lanjut', 'desc'=>'Aspirasi Anda akan diteruskan kepada pihak berwenang untuk ditindaklanjuti.']
                ];
            @endphp

            @foreach($features as $index => $f)
                <div class="col-sm-10 col-md-4 mb-4 d-flex">
                    <div class="p-4 bg-white rounded-4 shadow-sm w-100 text-center h-100 feature-card animate__animated animate__fadeInUp animate__delay-{{ $index + 1 }}s"
                         style="transition: all 0.3s ease;">
                        <div class="mb-3 d-flex justify-content-center align-items-center mx-auto rounded-circle"
                             style="width: 60px; height: 60px; background-color: #003366; transition: all 0.3s ease;">
                            <i class="fa-solid fa-{{ $f['icon'] }} fa-lg text-white"></i>
                        </div>
                        <h5 class="fw-semibold mt-3 text-dark">{{ $f['title'] }}</h5>
                        <p class="text-secondary" style="font-size: 0.95rem;">{{ $f['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Notifikasi Jika User Login -->
@if(Auth::check())
<div class="container mt-4">
    <div class="alert shadow-sm p-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center bg-white border-start border-5 animate__animated animate__fadeIn"
         style="border-left-color: #003366; border-radius: 10px;">
        <div>
            <h5 class="mb-2 text-dark"><i class="fa-solid fa-bell me-1"></i> Pemberitahuan</h5>
            <p class="mb-1 text-dark"><strong>Total Aspirasi Kamu:</strong> 
                <span class="badge bg-primary rounded-pill animate__animated animate__bounceIn">{{ $jumlahAspirasi }}</span>
            </p>
            <p class="mb-2 text-dark"><strong>Total Lowongan yang Didaftar:</strong> 
                <span class="badge bg-success rounded-pill animate__animated animate__bounceIn">{{ $jumlahMagang }}</span>
            </p>
        </div>
        <a href="{{ route('pemberitahuan') }}" class="btn btn-sm mt-3 mt-md-0 animate__animated animate__pulse animate__infinite"
           style="background-color: #003366; color: white; border-radius: 20px; transition: all 0.3s ease;">
            <i class="fa-solid fa-arrow-right me-1"></i> Lihat Semua
        </a>
    </div>
</div>
@endif

<!-- CSS Modern -->
<style>
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .feature-card:hover .rounded-circle {
        background-color: #005fa3;
        transform: scale(1.05) rotate(5deg);
    }

    @media (max-width: 576px) {
        .feature-card {
            padding: 1.5rem 1rem;
        }
    }

    /* Additional hover effects */
    .menu-item:hover .service-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .menu-item:hover h5 {
        color: #005fa3;
    }

    .btn:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        background-color: #005fa3;
    }
</style>

<!-- Berita Terkini -->
<section id="berita" class="site-section bg-light py-5">
    <div class="container">
        <!-- Judul -->
        <div class="text-center mb-5">
            <h2 class="fw-bold animate__animated animate__fadeInDown" style="color: #003366;">
                - Berita Terkini -
            </h2>
        </div>

        <!-- Daftar Berita -->
        <div class="row" id="berita-list">
            @foreach ($berita as $index => $row)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0 berita-card animate__animated animate__fadeInUp animate__delay-{{ $index }}s"
                     style="transition: all 0.3s ease; border-radius: 10px;">
                    <a href="/post/{{ $row->slug }}">
                        <img src="{{ asset('storage/' . $row->gambar) }}"
                             alt="Image"
                             class="card-img-top rounded-top"
                             style="object-fit: cover; height: 200px; transition: transform 0.3s ease;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/post/{{ $row->slug }}" class="text-dark text-decoration-none" style="transition: color 0.3s;">
                                {{ $row->judul }}
                            </a>
                        </h5>
                        <small class="text-dark d-block">
                            {{ \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                            @if ($row->user)
                                <span class="mx-2">|</span> {{ $row->user->name }}
                            @else
                                <span class="mx-2">|</span> <em>User tidak ditemukan</em>
                            @endif
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-4 align-items-center">
            <div class="col-md-6 text-muted mb-2 small animate__animated animate__fadeIn">
                Menampilkan {{ $berita->firstItem() }}–{{ $berita->lastItem() }} dari {{ $berita->total() }} berita
            </div>

            <div class="col-12 text-center mt-3">
                <nav class="d-inline-flex flex-wrap justify-content-center gap-2">
                    @foreach ($berita->links()->elements[0] ?? [] as $page => $url)
                        @if ($page == $berita->currentPage())
                            <span class="px-3 py-1 fw-bold rounded animate__animated animate__pulse"
                                  style="background-color: #003366; color: white; border: 1px solid #003366;">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 rounded text-decoration-none animate__animated animate__fadeIn"
                               style="background-color: #f0f8ff; color: #003366; border: 1px solid #003366;">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </nav>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Scroll ke section #next jika tombol ditekan
    document.querySelector('.scroll-button')?.addEventListener('click', function (event) {
        event.preventDefault();
        document.querySelector('#next').scrollIntoView({ behavior: 'smooth' });
    });

    // Hover effects for service icons
    document.querySelectorAll('.service-icon').forEach(icon => {
        icon.addEventListener('mouseenter', () => {
            icon.style.transform = 'scale(1.1) rotate(5deg)';
            icon.style.boxShadow = '0 8px 20px rgba(0, 0, 0, 0.3)';
        });
        icon.addEventListener('mouseleave', () => {
            icon.style.transform = 'scale(1) rotate(0deg)';
            icon.style.boxShadow = 'none';
        });
    });

    // Hover effects for feature cards
    document.querySelectorAll('.feature-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.querySelector('.rounded-circle').style.transform = 'scale(1.05) rotate(5deg)';
            card.querySelector('.rounded-circle').style.backgroundColor = '#005fa3';
            card.style.boxShadow = '0 12px 24px rgba(0, 0, 0, 0.1)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.querySelector('.rounded-circle').style.transform = 'scale(1) rotate(0deg)';
            card.querySelector('.rounded-circle').style.backgroundColor = '#003366';
            card.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
        });
    });

    // Hover effects for berita cards
    document.querySelectorAll('.berita-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.querySelector('.card-img-top').style.transform = 'scale(1.05)';
            card.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.1)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.querySelector('.card-img-top').style.transform = 'scale(1)';
            card.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
        });
    });
</script>
@endpush

<!-- CSS Tambahan -->
<style>
    .berita-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .berita-card a:hover {
        color: #005fa3 !important;
    }

    /* Ensure smooth transitions */
    .service-icon, .feature-card, .berita-card, .btn {
        transition: all 0.3s ease;
    }
</style>