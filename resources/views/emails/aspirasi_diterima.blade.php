<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Aspirasi Diterima</title>
</head>
<body>
    <h2>Halo {{ $aspirasi->nama }}</h2>
    <p>Aspirasi Anda dengan judul <strong>{{ $aspirasi->judul }}</strong> telah <strong>diterima</strong>.</p>
    <p>📍 Silakan hadir ke: <strong>Sekretariat DPRD Kota Tegal</strong></p>
    <p>👤 Temui: <strong>Bapak Turino, SH</strong> (Lantai 3)</p>
    <p>📅 Jadwal Hadir: <strong>{{ \Carbon\Carbon::parse($aspirasi->updated_at)->addDay()->translatedFormat('l, d F Y') }}</strong> s.d. <strong>{{ \Carbon\Carbon::parse($aspirasi->updated_at)->addDays(7)->translatedFormat('l, d F Y') }}</strong></p>
    <p>Terima kasih telah menyampaikan aspirasi Anda.</p>
</body>
</html>
