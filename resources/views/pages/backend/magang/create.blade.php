@extends('layouts.app')

@section('title', 'Tambah Lowongan Magang')

@section('main')
<div class="main-content">
    <section class="section animate__animated animate__fadeIn">
        <div class="section-header">
            <h1 class="text-dark fw-bold animate__animated animate__fadeInDown" style="font-size: clamp(1.8rem, 3vw, 2.5rem); color: #003366; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
                Tambah Lowongan Magang
            </h1>
            <div class="ml-auto">
                <a href="{{ route('magang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        
        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success animate__animated animate__bounceIn" style="border-left: 5px solid #28a745; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Pesan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger animate__animated animate__shakeX" style="border-left: 5px solid #dc3545; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                <strong class="mr-2">Terjadi kesalahan:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                {{-- FORM TAMBAH LOWONGAN --}}
                <div class="card animate__animated animate__fadeInUp" style="border: none; border-radius: 15px; box-shadow: 0 10px 25px rgba(0, 51, 102, 0.1); overflow: hidden; background: linear-gradient(135deg, #ffffff, #f7fbff);">
                    <div class="card-header bg-primary text-white" style="background: linear-gradient(45deg, #003366, #1e90ff); border-radius: 15px 15px 0 0;">
                        <h4 class="mb-0 fw-bold" style="font-size: clamp(1.5rem, 2.5vw, 1.8rem);">Form Lowongan Magang</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('magang.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group mb-4">
                                <label for="judul" class="form-label fw-medium text-dark" style="font-size: clamp(1rem, 1.8vw, 1.2rem); color: #003366;">Judul Lowongan</label>
                                <input type="text" name="judul" id="judul" class="form-control border-primary" required value="{{ old('judul') }}"
                                       style="border-radius: 10px; padding: 0.75rem; transition: box-shadow 0.3s ease; font-size: clamp(0.9rem, 1.6vw, 1.1rem);">
                                <div class="invalid-feedback">Judul wajib diisi.</div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="deskripsi" class="form-label fw-medium text-dark" style="font-size: clamp(1rem, 1.8vw, 1.2rem); color: #003366;">Deskripsi Lowongan</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control border-primary" rows="6" required placeholder="Contoh: Magang bagian Administrasi untuk mendukung proses surat-menyurat dan dokumentasi kegiatan." 
                                          style="border-radius: 10px; padding: 0.75rem; transition: box-shadow 0.3s ease; font-size: clamp(0.9rem, 1.6vw, 1.1rem);">{{ old('deskripsi') }}</textarea>
                                <div class="invalid-feedback">Deskripsi wajib diisi.</div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="kuota" class="form-label fw-medium text-dark" style="font-size: clamp(1rem, 1.8vw, 1.2rem); color: #003366;">Kuota Peserta</label>
                                <input type="number" name="kuota" id="kuota" class="form-control border-primary" min="1" required value="{{ old('kuota') }}"
                                       style="border-radius: 10px; padding: 0.75rem; transition: box-shadow 0.3s ease; font-size: clamp(0.9rem, 1.6vw, 1.1rem);">
                                <div class="invalid-feedback">Kuota wajib diisi dan minimal 1.</div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="periode" class="form-label fw-medium text-dark" style="font-size: clamp(1rem, 1.8vw, 1.2rem); color: #003366;">Periode Magang</label>
                                <input type="text" name="periode" id="periode" class="form-control border-primary" required placeholder="Contoh: 4 bulan" value="{{ old('periode') }}"
                                       style="border-radius: 10px; padding: 0.75rem; transition: box-shadow 0.3s ease; font-size: clamp(0.9rem, 1.6vw, 1.1rem);">
                                <div class="invalid-feedback">Periode wajib diisi.</div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="deadline" class="form-label fw-medium text-dark" style="font-size: clamp(1rem, 1.8vw, 1.2rem); color: #003366;">Deadline Pendaftaran</label>
                                <input type="date" name="deadline" id="deadline" class="form-control border-primary" required value="{{ old('deadline') }}"
                                       style="border-radius: 10px; padding: 0.75rem; transition: box-shadow 0.3s ease; font-size: clamp(0.9rem, 1.6vw, 1.1rem);">
                                <div class="invalid-feedback">Deadline wajib diisi.</div>
                            </div>
                            <div class="d-flex justify-content-end gap-3">
                                <button type="submit" class="btn btn-success animate__animated animate__pulse" style="padding: 0.75rem 1.5rem; border-radius: 10px; font-size: clamp(0.9rem, 1.6vw, 1.1rem);">
                                    <i class="fas fa-save mr-2"></i> Simpan
                                </button>
                                <a href="{{ route('magang.index') }}" class="btn btn-secondary animate__animated animate__pulse" style="padding: 0.75rem 1.5rem; border-radius: 10px; font-size: clamp(0.9rem, 1.6vw, 1.1rem);">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

<style>
    /* General styling */
    .section {
        padding: 40px 0;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 51, 102, 0.2);
    }

    .form-control:focus {
        box-shadow: 0 0 10px rgba(30, 144, 255, 0.5);
        border-color: #1e90ff;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    /* Alert styling */
    .alert-success {
        animation-duration: 0.5s;
    }

    .alert-danger {
        animation-duration: 0.5s;
    }

    /* Responsive design */
    @media (max-width: 767px) {
        .section-header h1 {
            font-size: clamp(1.5rem, 4vw, 1.8rem);
        }

        .card {
            margin-bottom: 2rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-control {
            font-size: clamp(0.8rem, 2vw, 0.9rem);
            padding: 0.5rem;
        }

        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .d-flex {
            flex-direction: column;
        }
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .col-md-10 {
            flex: 0 0 85%;
            max-width: 85%;
        }
    }
</style>

@push('scripts')
<script>
    // Form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Hover effects for buttons
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mouseenter', () => {
            btn.style.transform = 'scale(1.05)';
        });
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'scale(1)';
        });
    });
</script>
@endpush