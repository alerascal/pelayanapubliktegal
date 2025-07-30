<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login - DPRD Kota Tegal</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

    <style>
        .success-notification, .error-notification {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 500;
        }

        .success-notification {
            background-color: #e6f4ea;
            color: #276749;
            border: 1px solid #c6e6c6;
        }

        .error-notification {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .background-walk-y {
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>
<div id="app">
    <section class="section">
        <div class="d-flex align-items-stretch flex-wrap">
            <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white d-flex align-items-center">
                <div class="w-100 p-4">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/logo.png') }}" alt="logo" width="80" class="mb-3">
                        <h4 class="text-dark font-weight-normal">Selamat Datang di <span class="font-weight-bold">DPRD Kota Tegal</span></h4>
                        <p class="text-muted">Tata Kelola Sekretariat DPRD yang Efektif, Efisien, dan Berbudaya.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                        @csrf

                        @if (session('status'))
                            <div class="success-notification">
                                <i class="fas fa-check-circle me-2"></i> {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->has('email'))
                            <div class="error-notification">
                                <i class="fas fa-times-circle me-2"></i> {{ $errors->first('email') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="login-password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-lock"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <a href="{{ route('password.request') }}" class="text-small text-primary">Lupa Password?</a>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
                                <label class="custom-control-label" for="remember-me">Ingat saya</label>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <i class="fas fa-sign-in-alt mr-2"></i> Login
                            </button>
                        </div>

                        <div class="form-group text-center mt-4">
                            <a href="{{ route('register') }}" class="text-muted">Belum punya akun? <strong>Daftar di sini</strong></a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-8 col-12 order-lg-2 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
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

<!-- Template JS File -->
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<!-- Toggle Password -->
<script>
    const toggle = document.getElementById('togglePassword');
    const input = document.getElementById('login-password');

    toggle.addEventListener('click', function () {
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        this.innerHTML = isHidden
            ? '<i class="fas fa-unlock-keyhole"></i>'
            : '<i class="fas fa-lock"></i>';
    });
</script>
</body>

</html>
