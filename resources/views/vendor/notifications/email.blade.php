<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <title>{{ $subject ?? 'Notifikasi' }} - DPRD Kota Tegal</title>
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
            rel="stylesheet"
        />

        <style>
            body {
                font-family: "Poppins", sans-serif;
                background-color: #f8f9fa;
                color: #333;
                margin: 0;
                padding: 0;
            }

            .email-container {
                max-width: 600px;
                margin: 40px auto;
                background-color: #ffffff;
                border-radius: 12px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.06);
                overflow: hidden;
                border: 1px solid #ddd;
            }

            .email-header {
                background-color: #b30000;
                padding: 20px;
                text-align: center;
            }

            .email-header img {
                max-width: 80px;
                margin-bottom: 10px;
            }

            .email-header h2 {
                color: #fff;
                margin: 0;
                font-weight: 600;
            }

            .email-body {
                padding: 30px;
            }

            .email-body h3 {
                margin-top: 0;
                color: #b30000;
            }

            .email-body p {
                line-height: 1.7;
                margin-bottom: 20px;
            }

            .verify-button {
                display: inline-block;
                background-color: #b30000;
                color: white;
                text-decoration: none;
                padding: 12px 24px;
                border-radius: 8px;
                font-weight: 600;
                transition: background-color 0.3s ease;
            }

            .verify-button:hover {
                background-color: #990000;
            }

            .email-footer {
                text-align: center;
                font-size: 13px;
                color: #999;
                padding: 20px;
            }
        </style>
    </head>

    <body>
        <div class="email-container">
            <div class="email-header">
              <img src="{{ config('app.url') }}/assets/logo.png" alt="Logo DPRD" />
                <h2>DPRD Kota Tegal</h2>
            </div>

            <div class="email-body">
                <h3>
                    {{ isset($user) ? 'Halo, ' . $user->name : ($greeting ?? 'Halo!') }}
                </h3>

                {{-- Intro Lines (untuk reset password atau verifikasi) --}}
                @isset($introLines)
                    @foreach ($introLines as $line)
                        <p>{{ $line }}</p>
                    @endforeach
                @else
                    <p>Terima kasih telah mendaftar di layanan <strong>DPRD Kota Tegal</strong>.</p>
                    <p>Untuk mengaktifkan akun Anda, silakan klik tombol verifikasi di bawah ini:</p>
                @endisset

                {{-- Tombol Aksi --}}
                @isset($actionUrl)
                    <div style="text-align: center; margin: 30px 0">
                        <a href="{{ $actionUrl }}" class="verify-button">
                            {{ $actionText ?? 'Verifikasi Email' }}
                        </a>
                    </div>
                @elseif(isset($url))
                    <div style="text-align: center; margin: 30px 0">
                        <a href="{{ $url }}" class="verify-button">
                            {{ $actionText ?? 'Verifikasi Email' }}
                        </a>
                    </div>
                @endif

                {{-- Outro Lines --}}
                @isset($outroLines)
                    @foreach ($outroLines as $line)
                        <p>{{ $line }}</p>
                    @endforeach
                @else
                    <p>Jika Anda tidak merasa melakukan pendaftaran, abaikan email ini.</p>
                @endisset
            </div>

            <div class="email-footer">
                &copy; {{ date('Y') }} DPRD Kota Tegal. Semua hak dilindungi.
            </div>
        </div>
    </body>
</html>
