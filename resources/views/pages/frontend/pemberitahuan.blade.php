@extends('layouts.frontend')

@section('content')

<!-- Hero Section -->
<section class="home-section section-hero overlay bg-image" id="home-section"
    style="background-image: url('{{ asset('frontend/images/hero_1.jpg') }}'); background-size: cover; background-position: center; padding: 80px 0; position: relative;">
    <div class="container d-flex flex-column justify-content-center align-items-center text-center text-white" style="min-height: 100vh;">
        <h1 class="animate__animated animate__fadeIn animate__delay-1s fw-bold display-5 text-shadow">
            Pantau Status Pendaftaran Magang & Aspirasi Anda
        </h1>
    </div>
    <a href="#notifikasi" class="scroll-button smoothscroll" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); font-size: 2rem; color: #111;">
        <i class="fa-solid fa-chevron-down"></i>
    </a>
</section>

<!-- Notifikasi Section -->
<div class="container py-5" id="notifikasi">
    <h2 class="text-center fw-bold mb-5">
        <i class="fas fa-bell me-2"></i> Notifikasi Anda
    </h2>

    {{-- STATUS MAGANG --}}
    <div class="mb-5">
        <h4 class="mb-4 text-secondary">
            💼 <strong>Status Pendaftaran Magang</strong>
        </h4>

        @if($pendaftarMagang->isEmpty())
            <div class="alert alert-info text-center shadow-sm">
                Anda belum melakukan pendaftaran magang.
            </div>
        @else
            @foreach($pendaftarMagang as $pendaftaran)
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold fs-5 mb-3">
                            📄 {{ $pendaftaran->lowongan->judul ?? '-' }}
                        </h5>

                        <span class="badge
                            @if($pendaftaran->status === 'diterima') bg-success
                            @elseif($pendaftaran->status === 'ditolak') bg-danger
                            @elseif($pendaftaran->status === 'hangus') bg-danger
                            @else bg-warning text-dark
                            @endif
                            py-2 px-3 rounded-pill fs-6 mb-3 d-inline-block">
                            {{ ucfirst($pendaftaran->status) }}
                        </span>

                        @switch($pendaftaran->status)
                            @case('diterima')
                                @php
                                    $start = \Carbon\Carbon::parse($pendaftaran->updated_at)->addDay();
                                    while ($start->isWeekend()) $start->addDay();
                                    $end = $start->copy(); $c = 1;
                                    while ($c < 7) { $end->addDay(); if (!$end->isWeekend()) $c++; }
                                @endphp
                                <p>🎉 <strong>Selamat!</strong> Anda <strong>diterima</strong> untuk program magang.</p>
                                <ul class="mb-0">
                                    <li>📍 Lokasi: Sekretariat DPRD Kota Tegal</li>
                                    <li>👤 Temui: Bapak Turino, SH (Bagian Umum & Kepegawaian - Lantai 3)</li>
                                    <li>📅 Jadwal Hadir: <strong>{{ $start->translatedFormat('l, d F Y') }}</strong> s.d. <strong>{{ $end->translatedFormat('l, d F Y') }}</strong></li>
                                </ul>
                                <p class="text-danger fw-semibold mt-2"><i class="fas fa-exclamation-triangle me-1"></i> Jika tidak hadir sesuai jadwal, kesempatan <strong>hangus</strong>.</p>
                                @break

                            @case('hangus')
                                <p class="text-danger fw-semibold">❌ Anda tidak hadir sesuai jadwal. Kesempatan magang <strong>hangus</strong>.</p>
                                @break

                            @case('ditolak')
                                <p>🙏 Terima kasih telah mendaftar. Namun Anda <strong>belum lolos</strong> seleksi magang kali ini.</p>
                                @break

                            @default
                                <p>⏳ Pendaftaran Anda sedang <strong>diproses</strong>. Harap menunggu informasi lebih lanjut.</p>
                        @endswitch
                    </div>
                </div>
            @endforeach
        @endif

        <div class="d-flex justify-content-center">
            {{ $pendaftarMagang->appends(['aspirasi_page' => request('aspirasi_page')])->links('pagination::bootstrap-5') }}
        </div>
    </div>

    {{-- STATUS ASPIRASI --}}
    <div>
        <h4 class="mb-4 text-secondary">
            🗣 <strong>Status Aspirasi Anda</strong>
        </h4>

        @if($aspirasis->isEmpty())
            <div class="alert alert-info text-center shadow-sm">
                Anda belum mengirimkan aspirasi.
            </div>
        @else
            @foreach($aspirasis as $aspirasi)
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold fs-5 mb-2">📌 {{ $aspirasi->judul }}</h5>
                        <p>{{ $aspirasi->isi }}</p>

                        <span class="badge 
                            @if($aspirasi->status === 'diterima') bg-success 
                            @elseif($aspirasi->status === 'selesai') bg-primary 
                            @elseif($aspirasi->status === 'ditolak') bg-danger 
                            @elseif($aspirasi->status === 'hangus') bg-danger
                            @else bg-warning text-white 
                            @endif
                            py-2 px-3 rounded-pill fs-6 mb-3 d-inline-block">
                            {{ ucfirst($aspirasi->status) }}
                        </span>

                        @switch($aspirasi->status)
                            @case('diterima')
                                @php
                                    $startAsp = \Carbon\Carbon::parse($aspirasi->updated_at)->addDay();
                                    while ($startAsp->isWeekend()) $startAsp->addDay();
                                    $endAsp = $startAsp->copy(); $c = 1;
                                    while ($c < 7) { $endAsp->addDay(); if (!$endAsp->isWeekend()) $c++; }
                                @endphp
                                <p>🎉 Aspirasi Anda telah <strong>diterima</strong>.</p>
                                <ul class="mb-0">
                                    <li>📍 Tindak lanjut di Sekretariat DPRD Kota Tegal</li>
                                    <li>👤 Temui: Bapak Turino, SH (Lantai 3, Bagian Umum)</li>
                                    <li>📅 Jadwal Hadir: <strong>{{ $startAsp->translatedFormat('l, d F Y') }}</strong> s.d. <strong>{{ $endAsp->translatedFormat('l, d F Y') }}</strong></li>
                                </ul>
                                <p class="text-danger fw-semibold mt-2"><i class="fas fa-exclamation-circle me-1"></i> Jika tidak hadir, aspirasi dinyatakan <strong>hangus</strong>.</p>
                                @break

                            @case('selesai')
                                <p class="text-success fw-semibold">✅ Aspirasi Anda telah selesai ditindaklanjuti. Terima kasih atas partisipasi Anda.</p>
                                @break

                            @case('hangus')
                                <p class="text-danger fw-semibold">❌ Anda tidak hadir sesuai jadwal. Aspirasi dinyatakan <strong>hangus</strong>.</p>
                                @break

                            @case('ditolak')
                                <p>🙏 Aspirasi Anda <strong>ditolak</strong> dan belum dapat diproses saat ini.</p>
                                @break

                            @default
                                <p>⏳ Aspirasi Anda sedang dalam proses verifikasi. Mohon menunggu konfirmasi selanjutnya.</p>
                        @endswitch
                    </div>
                </div>
            @endforeach
        @endif

        <div class="d-flex justify-content-center mt-4">
            {{ $aspirasis->appends(['magang_page' => request('magang_page')])->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection
