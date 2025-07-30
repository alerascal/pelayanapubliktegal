<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Semua Pendaftar Magang</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 40px;
            font-size: 12px;
            color: #2c3e50;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #444;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .header img {
            width: 80px;
            margin-bottom: 8px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 0;
            font-size: 11px;
            color: #666;
        }

        h2 {
            text-align: center;
            font-size: 15px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #3498db;
            color: white;
            padding: 8px;
            text-align: center;
            border: 1px solid #ccc;
        }

        td {
            border: 1px solid #ccc;
            padding: 6px 8px;
        }

        tr:nth-child(even) {
            background-color: #f7f9fb;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 10px;
            color: #888;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            font-size: 10px;
            border-radius: 6px;
            color: #fff;
        }

        .badge.diterima { background: #2ecc71; }
        .badge.ditolak { background: #e74c3c; }
        .badge.diproses { background: #3498db; }
        .badge.menunggu { background: #f1c40f; color: #000; }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('assets/logo.png') }}" alt="Logo DPRD">
        <h1>Dewan Perwakilan Rakyat Daerah</h1>
        <p>Kota Tegal - Jl. Pemuda No. 1, Jawa Tengah</p>
    </div>

    <h2>Laporan Semua Pendaftar Magang</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Lowongan</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftars as $index => $p)
            <tr>
                <td align="center">{{ $index + 1 }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->alamat }}</td>
                <td align="center">
                    <span class="badge {{ $p->status }}">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
                <td>{{ $p->lowongan->judul ?? '-' }}</td>
                <td align="center">{{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
    </div>

</body>
</html>
