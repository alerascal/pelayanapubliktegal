@extends('layouts.app')

@section('title', 'Detail Pendaftar Magang')

@section('main')
<div class="main-content">
    <section class="section animate__animated animate__fadeIn">
        <div class="section-header">
            <h1 class="text-dark fw-bold animate__animated animate__fadeInDown" 
                style="font-size: clamp(1.8rem, 3vw, 2.5rem); color: #003366; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
                Detail Pendaftar Magang
            </h1>
            <div class="ml-auto">
                <a href="{{ route('magang.pendaftar') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card animate__animated animate__fadeInUp" 
                     style="border: none; border-radius: 15px; box-shadow: 0 10px 25px rgba(0, 51, 102, 0.1); overflow: hidden; background: linear-gradient(135deg, #ffffff, #f7fbff);">
                    <div class="card-header bg-primary text-white" 
                         style="background: linear-gradient(45deg, #003366, #1e90ff); border-radius: 15px 15px 0 0;">
                        <h4 class="mb-0 fw-bold" style="font-size: clamp(1.5rem, 2.5vw, 1.8rem);">Formulir Pendaftaran Magang</h4>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered table-hover align-middle" 
                               style="border-color: #dee2e6; background-color: #ffffff;">
                            <tbody>
                                <tr>
                                    <th style="width: 30%; background-color: #f8f9fa; color: #003366;">Nama Lengkap</th>
                                    <td>{{ $pendaftar->nama }}</td>
                                </tr>
                                <tr>
                                    <th style="background-color: #f8f9fa; color: #003366;">Alamat Lengkap</th>
                                    <td>{{ $pendaftar->alamat }}</td>
                                </tr>
                                <tr>
                                    <th style="background-color: #f8f9fa; color: #003366;">Asal Instansi</th>
                                    <td>{{ $pendaftar->asal_sekolah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th style="background-color: #f8f9fa; color: #003366;">Email Aktif</th>
                                    <td>{{ $pendaftar->email }}</td>
                                </tr>
                                <tr>
                                    <th style="background-color: #f8f9fa; color: #003366;">Nomor Telepon</th>
                                    <td>{{ $pendaftar->telepon }}</td>
                                </tr>
                                <tr>
                                    <th style="background-color: #f8f9fa; color: #003366;">CV</th>
                                    <td>
                                        <a href="{{ asset('storage/' . $pendaftar->cv) }}" class="btn btn-sm btn-info" target="_blank">Lihat CV</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="background-color: #f8f9fa; color: #003366;">Surat Izin Magang</th>
                                    <td>
                                        <a href="{{ asset('storage/' . $pendaftar->surat_izin) }}" class="btn btn-sm btn-warning" target="_blank">Lihat Surat</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="background-color: #f8f9fa; color: #003366;">Status</th>
                                    <td>
                                        <span class="badge badge-{{ $pendaftar->status == 'diterima' ? 'success' : ($pendaftar->status == 'ditolak' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($pendaftar->status) }}
                                        </span>
                                    </td>
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
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 51, 102, 0.2);
    }

    .table th, .table td {
        vertical-align: middle;
        padding: 1rem;
        transition: background-color 0.3s ease;
    }

    .table th:hover, .table td:hover {
        background-color: #f1f3f5;
    }

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

    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn:hover {
        transform: scale(1.05);
    }
</style>
