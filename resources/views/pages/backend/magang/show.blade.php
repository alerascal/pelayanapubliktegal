@extends('layouts.app')

@section('title', 'Detail Lowongan Magang')

@section('main')
<div class="main-content">
    <section class="section animate__animated animate__fadeIn">
        <div class="section-header">
            <h1 class="text-dark fw-bold animate__animated animate__fadeInDown" 
                style="font-size: clamp(1.8rem, 3vw, 2.5rem); color: #003366; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
                Detail Lowongan Magang
            </h1>
        </div>

        {{-- Pesan sukses (jika ada) --}}
        @if (session('success'))
            <div class="alert alert-success animate__animated animate__bounceIn" 
                 style="border-left: 5px solid #28a745; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                {{-- CARD DETAIL LOWONGAN --}}
                <div class="card animate__animated animate__fadeInUp" 
                     style="border: none; border-radius: 15px; box-shadow: 0 10px 25px rgba(0, 51, 102, 0.1); overflow: hidden; background: linear-gradient(135deg, #ffffff, #f7fbff);">
                    <div class="card-header bg-primary text-white" 
                         style="background: linear-gradient(45deg, #003366, #1e90ff); border-radius: 15px 15px 0 0;">
                        <h4 class="mb-0 fw-bold" style="font-size: clamp(1.5rem, 2.5vw, 1.8rem);">Detail Lowongan Magang</h4>
                        <div class="ml-auto">
                <a href="{{ route('magang.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered table-hover align-middle" 
                               style="border-color: #dee2e6; background-color: #ffffff;">
                            <tbody>
                                <tr>
                                    <th style="width: 30%; font-size: clamp(1rem, 1.8vw, 1.2rem); color: #003366; font-weight: 600; background-color: #f8f9fa;">Judul Lowongan</th>
                                    <td style="font-size: clamp(1rem, 1.8vw, 1.2rem);">{{ $lowongan->judul }}</td>
                                </tr>
                                <tr>
                                    <th style="font-size: clamp(1rem, 1.8vw, 1.2rem); color: #003366; font-weight: 600; background-color: #f8f9fa;">Deskripsi Lowongan</th>
                                    <td style="font-size: clamp(1rem, 1.8vw, 1.2rem);">{{ $lowongan->deskripsi }}</td>
                                </tr>
                                <tr>
                                    <th style="font-size: clamp(1rem, 1.8vw, 1.2rem); color: #003366; font-weight: 600; background-color: #f8f9fa;">Kuota Peserta</th>
                                    <td style="font-size: clamp(1rem, 1.8vw, 1.2rem);">{{ $lowongan->kuota }} Orang</td>
                                </tr>
                                <tr>
                                    <th style="font-size: clamp(1rem, 1.8vw, 1.2rem); color: #003366; font-weight: 600; background-color: #f8f9fa;">Periode Magang</th>
                                    <td style="font-size: clamp(1rem, 1.8vw, 1.2rem);">{{ $lowongan->periode }}</td>
                                </tr>
                                <tr>
                                    <th style="font-size: clamp(1rem, 1.8vw, 1.2rem); color: #003366; font-weight: 600; background-color: #f8f9fa;">Deadline Pendaftaran</th>
                                    <td style="font-size: clamp(1rem, 1.8vw, 1.2rem);">{{ \Carbon\Carbon::parse($lowongan->deadline)->translatedFormat('d F Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

<style>
    /* Card hover effect */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 51, 102, 0.2);
    }

    /* Table styling */
    .table th, .table td {
        vertical-align: middle;
        padding: 1rem;
        transition: background-color 0.3s ease;
    }

    .table th:hover, .table td:hover {
        background-color: #f1f3f5;
    }

    /* Responsive design */
    @media (max-width: 767px) {
        .card-body {
            padding: 1.5rem;
        }

        .table th, .table td {
            font-size: clamp(0.9rem, 2vw, 1rem);
            padding: 0.75rem;
        }

        .btn {
            width: 100%;
            margin-bottom: 1rem;
        }
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .container {
            max-width: 90%;
        }
    }

    /* Animation styling */
    .animate__pulse {
        animation-duration: 1.5s;
    }

    /* Additional styling */
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn:hover {
        transform: scale(1.05);
    }
</style>

@push('scripts')
<script>
    // Hover effects for button
    document.querySelector('.btn').addEventListener('mouseenter', () => {
        document.querySelector('.btn').style.transform = 'scale(1.05)';
    });
    document.querySelector('.btn').addEventListener('mouseleave', () => {
        document.querySelector('.btn').style.transform = 'scale(1)';
    });
</script>
@endpush