@extends('layouts.frontend') @section('content')
<style>
    .hero-background {
        background-image: url("{{ asset("frontend/images/hero_1.jpg") }}");
        background-size: cover;
        background-position: center;
    }

    .form-label {
        font-weight: bold;
    }

    .card {
        border: none;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #0056b3;
        color: white;
        padding: 1rem;
        border-bottom: none;
    }

    .btn-primary {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-primary:hover {
        background-color: #004494;
        border-color: #004494;
    }
</style>

<section
    class="home-section section-hero overlay bg-image hero-background"
    id="home-section"
>
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10">
                <div class="mb-5 text-white">
                    <h1 class="mb-4">Formulir Pendaftaran Magang</h1>
                    <p>
                        Silakan isi formulir di bawah ini untuk mendaftar
                        program magang
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Formulir Pendaftaran Magang</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                        <form
                            method="POST"
                            action="{{ route('magang.daftar.store', ['id' => $lowongan->id]) }}"
                            enctype="multipart/form-data"
                        >
                            @csrf

                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="nama"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea
                                    class="form-control"
                                    name="alamat"
                                    rows="3"
                                    required
                                ></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Asal Instansi</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="asal_sekolah"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email Aktif</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nomor Telepon</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="telepon"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label class="form-label"
                                    >Upload CV (PDF/DOCX)</label
                                >
                                <input
                                    type="file"
                                    class="form-control-file"
                                    name="cv"
                                    accept=".pdf,.doc,.docx"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label class="form-label"
                                    >Upload Surat Izin Magang (PDF/DOCX)</label
                                >
                                <input
                                    type="file"
                                    class="form-control-file"
                                    name="surat_izin"
                                    accept=".pdf,.doc,.docx"
                                    required
                                />
                            </div>
     <div class="form-group mt-4 d-flex justify-content-between align-items-center">
                                <a href="{{ route('magang.lowongan') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Kirim Pendaftaran
                                </button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
