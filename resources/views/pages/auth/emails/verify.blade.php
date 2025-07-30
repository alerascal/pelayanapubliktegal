<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
    <title>Verifikasi Email - DPRD Kota Tegal</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components.css') }}" />
<style>
    .notification-container {
        padding: 2.5rem 2rem;
        border-radius: 15px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
        background: white;
        transition: all 0.3s ease-in-out;
        max-width: 480px;
        margin: auto;
        margin-top: 7vh;
    }

    .notification-container:hover {
        box-shadow: 0 0 35px rgba(0, 0, 0, 0.1);
    }

    .btn-resend {
        width: 100%;
        border-radius: 50px;
        padding: 0.75rem 1rem;
        font-size: 1.1rem;
    }

    .text-primary-custom {
        color: #003366 !important; /* Sesuaikan warna birutua tema */
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    /* Perbaikan warna teks untuk paragraf */
    .notification-container p.fs-5,
    .notification-container p.fs-6 {
        color: rgba(0, 0, 0, 0.75) !important; /* abu gelap */
        font-weight: 500;
        line-height: 1.5;
    }

    /* Warna khusus untuk email yang dicetak tebal */
    .notification-container strong {
        color: #003366;
        font-weight: 700;
    }
</style>

</head>

<body>
    <div id="app">
        <section class="section">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="notification-container text-center">

                        <img src="{{ asset('assets/logo.png') }}" alt="Logo DPRD Kota Tegal" width="90" class="mb-3" />

                        <h3 class="text-primary-custom fw-bold mb-3">
                            Halo, {{ auth()->user()->name }}
                        </h3>

                        <p class="fs-5 text-secondary mb-4">
                            Terima kasih sudah mendaftar! Silakan cek email Anda dan klik tautan verifikasi yang telah kami kirim ke email<br />
                            <strong>{{ auth()->user()->email }}</strong>
                        </p>

                        @if(session('message'))
                            <div class="alert alert-success rounded-pill">
                                {{ session('message') }}
                            </div>
                        @endif

                        <p class="fs-6 text-muted mb-4">
                            Jika Anda belum menerima email, klik tombol di bawah ini untuk kirim ulang email verifikasi.
                        </p>

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-resend shadow-sm">
                                <i class="fas fa-envelope me-2"></i> Kirim Ulang Email Verifikasi
                            </button>
                        </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
