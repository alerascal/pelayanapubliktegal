@extends('layouts.frontend')

@section('title', $berita->judul)

@section('content')
<!-- HERO SECTION -->
<section class="home-section section-hero overlay bg-image"
    style="background-image: url('{{ asset('frontend/images/hero_1.jpg') }}'); background-size: cover; background-position: center;"
    id="home-section">
    <div class="container py-5">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10">
                <h1 class="text-white fw-bold display-4 animate__animated animate__fadeInDown">
                    {{ $berita->judul }}
                </h1>
                <p class="text-white mt-3 animate__animated animate__fadeInUp">
                    Diposting oleh: <strong>{{ $berita->user->name }}</strong> <br>
                    <small>{{ \Carbon\Carbon::parse($berita->created_at)->locale('id')->translatedFormat('l, d F Y') }}</small>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- DETAIL BERITA -->
<section class="site-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="card border-0 shadow rounded-3">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Konten"
                        class="card-img-top rounded-top" style="object-fit: cover; max-height: 450px;">
                    <div class="card-body p-4">
                        <article class="text-dark" style="line-height: 1.8; font-size: 1rem;">
                            {!! $berita->konten !!}
                        </article>
                    </div>
                </div>

                <!-- Navigasi berita sebelumnya & berikutnya -->
                <div class="d-flex justify-content-between mt-4">
                    @if ($previousBerita)
                        <a href="{{ route('post.detail', $previousBerita->slug) }}"
                            class="btn btn-outline-primary shadow-sm">
                            &laquo; {{ Str::limit($previousBerita->judul, 40) }}
                        </a>
                    @else
                        <div></div>
                    @endif

                    @if ($nextBerita)
                        <a href="{{ route('post.detail', $nextBerita->slug) }}"
                            class="btn btn-outline-primary shadow-sm">
                            {{ Str::limit($nextBerita->judul, 40) }} &raquo;
                        </a>
                    @endif
                </div>

                <!-- Tombol kembali -->
                <div class="text-center mt-5">
                    <a href="{{ route('home') }}" class="btn btn-primary px-4 py-2 shadow">
                        ⬅ Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Berita Lainnya -->
        <div class="row mt-4">
            <div class="col-md-12 mb-3">
                <h4 class="fw-semibold text-dark">Berita Lainnya</h4>
                <hr>
            </div>

            @foreach ($beritaLain as $item)
                <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                    <div class="card border-0 shadow-sm w-100 h-100">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="..."
                            class="card-img-top" style="object-fit: cover; height: 180px;">
                        <div class="card-body">
                            <h6 class="card-title">
                                <a href="{{ route('post.detail', $item->slug) }}" class="text-dark text-decoration-none">
                                    {{ Str::limit($item->judul, 50) }}
                                </a>
                            </h6>
                            <p class="text-muted small mb-0">
                                {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
@endsection
