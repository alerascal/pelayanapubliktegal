<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftar Magang - {{ $lowongan->judul }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #000;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header img {
            width: 80px;
            margin-bottom: 8px;
        }

        .header .instansi {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header .alamat {
            font-size: 11px;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            font-size: 15px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 10px;
            font-size: 12px;
        }

        .info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 8px;
            border: 1px solid #555;
        }

        td {
            padding: 8px;
            border: 1px solid #555;
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f4f4f4;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            font-size: 10px;
            border-radius: 6px;
            color: #fff;
            text-transform: capitalize;
        }

        .badge.diterima { background: #2ecc71; }
        .badge.ditolak { background: #e74c3c; }
        .badge.diproses { background: #3498db; }
        .badge.menunggu { background: #f1c40f; color: #000; }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 11px;
            color: #555;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <img src="{{ public_path('assets/logo.png') }}" alt="Logo DPRD">
        <div class="instansi">Dewan Perwakilan Rakyat Daerah</div>
        <div class="instansi">Kota Tegal</div>
        <div class="alamat">Jl. Pemuda No. 1, Kota Tegal, Jawa Tengah</div>
    </div>

    {{-- Judul Laporan --}}
    <h2>Data Pendaftar Magang - {{ $lowongan->judul }}</h2>

    {{-- Info Lowongan --}}
    <div class="info">
        <p><strong>Tahun:</strong> {{ $lowongan->created_at->year }}</p>
        <p><strong>Total Pendaftar:</strong> {{ $lowongan->pendaftar->count() }}</p>
    </div>

    {{-- Tabel Pendaftar --}}
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Nama</th>
                <th style="width: 45%;">Alamat</th>
                <th style="width: 20%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($lowongan->pendaftar as $index => $pendaftar)
            <tr>
                <td align="center">{{ $index + 1 }}</td>
                <td>{{ $pendaftar->nama }}</td>
                <td>{{ $pendaftar->alamat }}</td>
                <td align="center">
                    <span class="badge {{ $pendaftar->status }}">
                        {{ ucfirst($pendaftar->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" align="center">Belum ada pendaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
    </div>

</body>
</html>
