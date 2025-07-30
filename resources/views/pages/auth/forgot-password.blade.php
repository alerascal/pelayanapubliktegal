<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Lupa Password - DPRD Kota Tegal</title>
    <link rel="shortcut icon" href="{{ asset('Assets/logo.png') }}" type="image/png">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

    <style>
        .login-container {
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
            background: white;
            transition: all 0.3s ease-in-out;
        }

        .login-container:hover {
            box-shadow: 0 0 35px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: 500;
        }

        .text-right .btn {
            width: 100%;
        }

        .text-center a {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
<div id="app">
    <section class="section">
        <div class="row no-gutters">
            <div class="col-lg-4 col-md-6 col-12 d-flex align-items-center justify-content-center min-vh-100 bg-white">
                <div class="login-container w-100">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/logo.png') }}" alt="logo" width="80" class="mb-3">
                        <h4 class="text-dark font-weight-normal">Reset Password</h4>
                        <p class="text-muted">Masukkan email Anda untuk menerima tautan reset password.</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="invalid-feedback">
                                Email wajib diisi
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Link Reset
                            </button>
                        </div>

                        <div class="form-group text-center mt-4">
                            <a href="{{ route('login') }}" class="text-muted"><i class="fas fa-chevron-left mr-1"></i> Kembali ke login</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-12 min-vh-100 d-none d-lg-block background-walk-y position-relative overlay-gradient-bottom"
                 style="background-image: url('{{ asset('img/unsplash/login-bg.jpg') }}');">
                <div class="absolute-bottom-left index-2 text-light p-5">
                    <div class="mb-5">
                        <h1 class="display-4 font-weight-bold">DPRD Kota Tegal</h1>
                        <h5 class="font-weight-normal text-muted-transparent">Dewan Perwakilan Rakyat Daerah Kota Tegal</h5>
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
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
