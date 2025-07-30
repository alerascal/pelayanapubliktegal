@extends('layouts.frontend')

@section('title', 'Aspirasi Masyarakat')

@section('content')
    <!-- Hero Section -->
    <section class="home-section section-hero overlay bg-image"
        style="background-image: url('{{ asset('frontend/images/hero_1.jpg') }}'); min-height: 60vh; display: flex; align-items: center; justify-content: center;"
        id="home-section">
        <div class="container text-center text-white">
            <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">Aspirasi Masyarakat</h1>
            <p class="lead animate__animated animate__fadeInUp">Sampaikan aspirasi Anda kepada DPRD Kota Tegal melalui form berikut.</p>
        </div>
    </section>

    <!-- Notifikasi Success -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm custom-alert" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
<!-- Form Section -->
<section class="site-section bg-light py-5">
    <div class="container">

        @if(Auth::check())
            {{-- Jika user sudah login, tampilkan form --}}
            <div class="text-center mb-5">
                <h2 class="section-title fw-bold" style="color: #000;">Form Aspirasi Masyarakat</h2>
                <p class="text-muted" style="color: #000;">Silakan lengkapi data di bawah untuk menyampaikan aspirasi Anda.</p>
            </div>

            <div class="glass-card mx-auto p-4 shadow-lg" style="max-width: 720px;">
                <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf

                    <!-- Data User -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIK</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->nik }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">Alamat</label>
                        <input type="text" name="alamat" id="alamat"
                               class="form-control @error('alamat') is-invalid @enderror"
                               value="{{ old('alamat', Auth::user()->alamat) }}"
                               placeholder="Masukkan alamat Anda" required>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor Telepon</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->phone }}" disabled>
                    </div>

                    <!-- Aspirasi -->
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold">Judul Aspirasi</label>
                        <input type="text" name="judul" id="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               placeholder="Masukkan Judul Aspirasi" value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label fw-semibold">Isi Aspirasi</label>
                        <textarea name="isi" id="isi" rows="5"
                                  class="form-control @error('isi') is-invalid @enderror"
                                  placeholder="Jelaskan aspirasi Anda..." required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Lampiran -->
                    <div class="mb-4">
                        <label for="lampiran" class="form-label fw-semibold">Lampiran Surat</label>
                        <input type="file" name="lampiran" id="lampiran"
                               class="form-control @error('lampiran') is-invalid @enderror"
                               accept=".pdf,.jpg,.jpeg,.png">
                        <small class="form-text">Format PDF, JPG, atau PNG. Maksimal 2MB.</small>
                        @error('lampiran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <button type="submit" class="btn btn-dark w-100 py-2 fw-semibold shadow-sm">Kirim Aspirasi</button>
                </form>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-outline-dark btn-sm px-4">← Kembali ke Beranda</a>
            </div>
        @else
            {{-- Jika belum login --}}
            <div class="alert alert-warning text-center shadow">
                <strong>Perhatian!</strong> Anda harus <a href="{{ route('login') }}">login</a> terlebih dahulu untuk mengirim aspirasi.
            </div>
        @endif
    </div>
</section>
    <!-- Style Estetik -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .form-control {
            border: 1.5px solid #ced4da;
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #3182ce;
            box-shadow: 0 0 10px rgba(49, 130, 206, 0.3);
        }

        .btn-dark {
            background-color: #1a202c;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #2d3748;
        }

        .btn-outline-dark:hover {
            background-color: #1a202c;
            color: #fff;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 600;
        }

        .invalid-feedback {
            color: #e53e3e;
        }

        textarea.form-control {
            resize: none;
        }

        /* Animasi untuk hero */
        .animate__animated {
            animation-duration: 1s;
        }

        /* Perbaikan alert agar selalu di atas */
        .custom-alert {
            position: fixed;
            top: 70px; /* sesuaikan jika ada navbar */
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            max-width: 720px;
            width: 90%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
    </style>

    <!-- CDN animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endsection
