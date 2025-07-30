<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Pelayanan Publik DPRD KOTA TEGAL - @yield('title')</title>

        <!-- Favicon -->
        <link
            rel="shortcut icon"
            href="{{ asset('Assets/logo.png') }}"
            type="image/png"
        />

        <!-- Fonts -->
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
            rel="stylesheet"
        />

        <!-- CSS -->
        <link
            rel="stylesheet"
            href="{{ asset('frontend/css/custom-bs.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('frontend/css/jquery.fancybox.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('frontend/css/bootstrap-select.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('frontend/fonts/icomoon/style.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('frontend/fonts/line-icons/style.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('frontend/css/owl.carousel.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('frontend/css/animate.min.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        />

        <!-- Custom Inline Styles -->
        <style>
            body {
                font-family: "Poppins", sans-serif;
                padding-top: 80px;
                background: linear-gradient(180deg, #f0f8ff, #e6f0fa);
                color: #333;
                transition: all 0.3s ease;
            }

            /* Navbar */
            .navbar-dark {
                background: linear-gradient(45deg, #003366, #005fa3);
                position: fixed;
                top: 0;
                width: 100%;
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
                z-index: 1000;
                transition: all 0.3s ease;
            }

            .navbar-brand {
                display: flex;
                align-items: center;
                transition: transform 0.3s ease;
            }

            .navbar-brand:hover {
                transform: scale(1.1);
            }

            .navbar-nav .nav-link {
                color: #ffffff !important;
                font-weight: 600;
                font-size: 1.2rem;
                margin-right: 15px;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
                transition: all 0.3s ease;
            }

            .navbar-nav .nav-link:hover {
                color: #ffc107 !important;
                transform: translateY(-3px) scale(1.05);
            }

            .navbar .dropdown-menu {
                background: linear-gradient(180deg, #ffffff, #f0f8ff);
                border-radius: 12px;
                border: none;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
                animation: slideIn 0.4s ease-in-out;
                padding: 0.75rem 0;
            }

            .navbar .dropdown-item {
                color: #333;
                font-weight: 500;
                padding: 12px 30px;
                transition: all 0.3s ease;
            }

            .navbar .dropdown-item:hover {
                background: linear-gradient(45deg, #005fa3, #007bff);
                color: #ffffff;
                transform: translateX(8px);
            }

            .btn-login {
                background: transparent;
                border: 2px solid #ffc107;
                color: #ffc107 !important;
                border-radius: 30px;
                padding: 8px 20px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-login:hover {
                background: linear-gradient(45deg, #ffc107, #ffca28);
                color: #003366 !important;
                border-color: #ffc107;
                transform: scale(1.15);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            }

            /* Footer */
            footer {
                background: linear-gradient(180deg, #003366, #001a33);
                color: white;
                padding: 80px 0 30px;
                width: 100%;
            }

            .footer-icon a {
                color: #ffffff;
                margin: 0 15px;
                font-size: 1.8rem;
                transition: all 0.3s ease;
            }

            .footer-icon a:hover {
                color: #ffc107;
                transform: scale(1.3) rotate(10deg);
            }

            /* Animations */
            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateY(15px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .text-sm {
                font-size: 1rem;
            }

            section {
                padding-top: 60px;
                padding-bottom: 60px;
            }

            /* Contact Icons */
            .contact-icon {
                transition: all 0.3s ease;
            }

            .contact-icon:hover {
                transform: scale(1.3) rotate(15deg);
                color: #ffc107 !important;
            }
        </style>
    </head>

    <body id="top">
        <div class="site-wrap">
            {{-- MOBILE MENU --}}
            <div
                class="site-mobile-menu site-navbar-target animate__animated animate__fadeIn"
            >
                <div class="site-mobile-menu-header">
                    <div class="site-mobile-menu-close mt-3">
                        <span
                            class="icon-close2 js-menu-toggle animate__animated animate__zoomIn"
                        ></span>
                    </div>
                </div>
                <div class="site-mobile-menu-body"></div>
            </div>

            {{-- NAVBAR --}}
            <nav
                class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm animate__animated animate__fadeInDown"
            >
                <div class="container">
                    {{-- Logo & Judul --}}
                    <a
                        class="navbar-brand d-flex align-items-center animate__animated animate__zoomIn"
                        href="/"
                    >
                        <img
                            src="{{ asset('assets/logo.png') }}"
                            alt="Logo"
                            style="
                                height: 40px;
                                transition: transform 0.3s ease;
                            "
                        />
                        <span
                            class="ml-3 font-weight-bold text-white"
                            style="
                                font-size: 1.5rem;
                                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
                            "
                        >
                            DPRD Kota Tegal
                        </span>
                    </a>

                    {{-- Toggle Menu --}}
                    <button
                        class="navbar-toggler animate__animated animate__fadeIn"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarNav"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    {{-- Isi Menu --}}
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto align-items-center">
                            {{-- Dropdown Beranda --}}
                            <li
                                class="nav-item dropdown animate__animated animate__fadeIn animate__delay-1s"
                            >
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="berandaDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                >
                                    Beranda
                                </a>
                                <div
                                    class="dropdown-menu"
                                    aria-labelledby="berandaDropdown"
                                >
                                    <a
                                        class="dropdown-item animate__animated animate__fadeInUp animate__delay-0s"
                                        href="/"
                                        >Beranda</a
                                    >
                                    <a
                                        class="dropdown-item animate__animated animate__fadeInUp animate__delay-1s"
                                        href="/sejarah"
                                        >Sejarah</a
                                    >
                                    <a
                                        class="dropdown-item animate__animated animate__fadeInUp animate__delay-2s"
                                        href="/visimisi"
                                        >Visi Misi</a
                                    >
                                    <a
                                        class="dropdown-item animate__animated animate__fadeInUp animate__delay-3s"
                                        href="{{ route('sekretariat') }}"
                                        >Sekretariat</a
                                    >
                                    <a
                                        class="dropdown-item animate__animated animate__fadeInUp animate__delay-4s"
                                        href="{{
                                            route('anggota.showAnggota')
                                        }}"
                                    >
                                        Pimpinan Dewan DPRD Kota Tegal
                                    </a>
                                    <a
                                        class="dropdown-item animate__animated animate__fadeInUp animate__delay-5s"
                                        href="{{ route('aspirasi.create') }}"
                                    >
                                        Aspirasi
                                    </a>
                                    <a
                                        class="dropdown-item animate__animated animate__fadeInUp animate__delay-6s"
                                        href="{{ route('magang.lowongan') }}"
                                    >
                                        Lowongan Magang
                                    </a>
                                </div>
                            </li>

                            {{-- Pemberitahuan --}}
                            <li
                                class="nav-item animate__animated animate__fadeIn animate__delay-2s"
                            >
                                <a
                                    class="nav-link"
                                    href="{{ route('pemberitahuan') }}"
                                    >Pemberitahuan</a
                                >
                            </li>
                        </ul>

                        {{-- Auth --}}
                        <ul class="navbar-nav align-items-center">
                            @auth
                            <li
                                class="nav-item dropdown animate__animated animate__fadeIn animate__delay-3s"
                            >
                                <a
                                    class="nav-link dropdown-toggle d-flex align-items-center"
                                    href="#"
                                    id="userDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                >
                                    <i
                                        class="fas fa-user-circle fa-lg mr-2"
                                    ></i>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <form
                                        action="{{ route('logout') }}"
                                        method="POST"
                                    >
                                        @csrf
                                        <button
                                            class="dropdown-item animate__animated animate__fadeInUp"
                                            type="submit"
                                        >
                                            <i
                                                class="fas fa-sign-out-alt mr-2"
                                            ></i>
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </li>
                            @else
                            <li
                                class="nav-item animate__animated animate__fadeIn animate__delay-3s"
                            >
                                <a
                                    class="nav-link btn btn-login"
                                    href="{{ route('login') }}"
                                >
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Login
                                </a>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            {{-- MAIN CONTENT --}}
            <main style="margin: -15px 0 0 0 !important">
                @yield('content')
            </main>

            {{-- FOOTER --}}
            <footer class="text-white pt-5 animate__animated animate__fadeInUp">
                <section id="kontak" class="pb-5">
                    <div class="container text-center">
                        <h2
                            class="font-semibold mb-3 animate__animated animate__bounceIn"
                            style="
                                color: #ffc107;
                                font-size: 2.5rem;
                                text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.5);
                            "
                        >
                            Hubungi Kami
                        </h2>
                        <p
                            class="mb-5 animate__animated animate__fadeInUp animate__delay-1s"
                            style="font-size: 1.2rem"
                        >
                            Informasi lebih lanjut hubungi kontak kami.
                        </p>
                        <div class="row">
                            <div
                                class="col-md-4 mb-4 animate__animated animate__zoomIn animate__delay-2s"
                            >
                                <i
                                    class="fa-solid fa-clock fa-2x mb-2 contact-icon"
                                ></i>
                                <p>
                                    Senin - Jumat 07:30 - 16:30<br />Sabtu &
                                    Minggu - Tutup
                                </p>
                            </div>
                            <div
                                class="col-md-4 mb-4 animate__animated animate__zoomIn animate__delay-3s"
                            >
                                <i
                                    class="fa-solid fa-envelope fa-2x mb-2 contact-icon"
                                ></i>
                                <p>(0283) 321505<br />dprd@tegalkota.go.id</p>
                            </div>
                            <div
                                class="col-md-4 mb-4 animate__animated animate__zoomIn animate__delay-4s"
                            >
                                <i
                                    class="fa-solid fa-map-location-dot fa-2x mb-2 contact-icon"
                                ></i>
                                <a
                                    href="https://www.google.com/maps?q=Jl.+Pemuda+No.4,+Tegalsari,+Tegal+Barat,+Kota+Tegal"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-white text-decoration-none"
                                >
                                    <p>
                                        Jl. Pemuda No.4, Tegalsari, Tegal Barat,
                                        Kota Tegal
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <div
                    class="border-top border-secondary py-3 animate__animated animate__fadeIn"
                >
                    <div class="text-center">
                        <div
                            class="footer-icon mb-2 flex space-x-4 justify-center"
                        >
                            <a
                                href="https://www.facebook.com/dprdkotategal"
                                target="_blank"
                                class="animate__animated animate__pulse animate__infinite animate__delay-1s text-gray-600 hover:text-blue-600 transition-colors duration-300"
                                title="Ikuti kami di Facebook"
                            >
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a
                                href="https://twitter.com/dprdkotategal"
                                target="_blank"
                                class="animate__animated animate__pulse animate__infinite animate__delay-2s text-gray-600 hover:text-blue-400 transition-colors duration-300"
                                title="Ikuti kami di Twitter"
                            >
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a
                                href="https://www.instagram.com/dprdkotategal"
                                target="_blank"
                                class="animate__animated animate__pulse animate__infinite animate__delay-3s text-gray-600 hover:text-pink-500 transition-colors duration-300"
                                title="Ikuti kami di Instagram"
                            >
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a
                                href="https://www.youtube.com/channel/dprdkotategal"
                                target="_blank"
                                class="animate__animated animate__pulse animate__infinite animate__delay-4s text-gray-600 hover:text-red-600 transition-colors duration-300"
                                title="Tonton kami di YouTube"
                            >
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                        </div>
                        <p
                            class="text-sm animate__animated animate__fadeIn animate__delay-5s"
                        >
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            DPRD Kota Tegal. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        <!-- JS Scripts -->
        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script src="{{
                asset('frontend/js/bootstrap.bundle.min.js')
            }}"></script>
        <script src="{{
                asset('frontend/js/jquery.fancybox.min.js')
            }}"></script>
        <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
        <script src="{{
                asset('frontend/js/bootstrap-select.min.js')
            }}"></script>
        <script src="{{ asset('frontend/js/custom.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
        <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

        <!-- WOW for animation -->
        <script>
            new WOW().init();

            // Navbar hover animations
            document
                .querySelectorAll(".navbar-nav .nav-link")
                .forEach((link) => {
                    link.addEventListener("mouseenter", () => {
                        link.style.transform = "translateY(-3px) scale(1.05)";
                        link.style.color = "#ffc107";
                    });
                    link.addEventListener("mouseleave", () => {
                        link.style.transform = "translateY(0) scale(1)";
                        link.style.color = "#ffffff";
                    });
                });

            // Login button hover animation
            document
                .querySelector(".btn-login")
                .addEventListener("mouseenter", () => {
                    document.querySelector(".btn-login").style.transform =
                        "scale(1.1)";
                    document.querySelector(".btn-login").style.boxShadow =
                        "0 8px 20px rgba(0, 0, 0, 0.4)";
                });
            document
                .querySelector(".btn-login")
                .addEventListener("mouseleave", () => {
                    document.querySelector(".btn-login").style.transform =
                        "scale(1)";
                    document.querySelector(".btn-login").style.boxShadow =
                        "none";
                });

            // Footer icon hover animations
            document.querySelectorAll(".footer-icon a").forEach((icon) => {
                icon.addEventListener("mouseenter", () => {
                    icon.style.transform = "scale(1.3) rotate(10deg)";
                    icon.style.color = "#ffc107";
                });
                icon.addEventListener("mouseleave", () => {
                    icon.style.transform = "scale(1) rotate(0deg)";
                    icon.style.color = "#ffffff";
                });
            });

            // Contact icon hover animations
            document.querySelectorAll(".contact-icon").forEach((icon) => {
                icon.addEventListener("mouseenter", () => {
                    icon.style.transform = "scale(1.3) rotate(15deg)";
                    icon.style.color = "#ffc107";
                });
                icon.addEventListener("mouseleave", () => {
                    icon.style.transform = "scale(1) rotate(0deg)";
                    icon.style.color = "#ffffff";
                });
            });
        </script>
    </body>
</html>
