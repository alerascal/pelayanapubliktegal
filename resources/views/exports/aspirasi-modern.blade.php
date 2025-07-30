<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Aspirasi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .logo {
            width: 70px;
            height: 70px;
            margin-right: 15px;
        }

        .header-text {
            text-align: center;
            flex: 1;
        }

        .header-text h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text p {
            margin: 2px 0;
            font-size: 12px;
        }

        h2.title {
            text-align: center;
            margin-bottom: 15px;
            font-size: 16px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #bbb;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .badge {
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            color: #fff;
            display: inline-block;
        }

        .badge.diproses { background-color: #3490dc; }
        .badge.menunggu { background-color: #ff9800; }
        .badge.diterima { background-color: #38c172; }
        .badge.ditolak { background-color: #e3342f; }
        .badge.default { background-color: #6c757d; }

        .text-center { text-align: center; }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ public_path('assets/logo.png') }}" class="logo" alt="Logo DPRD">
    <div class="header-text">
        <h3>DEWAN PERWAKILAN RAKYAT DAERAH</h3>
        <h3>KOTA TEGAL</h3>
        <p>Jl. Pemuda No. 23, Kota Tegal, Jawa Tengah</p>
    </div>
</div>

<h2 class="title">Laporan Data Aspirasi Masyarakat</h2>

<table>
    <thead>
        <tr>
            <th style="width: 30px;">No</th>
            <th>Judul</th>
            <th>Isi</th>
            <th>Lampiran</th>
            <th>Pengirim</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($aspirasis as $no => $aspirasi)
        <tr>
            <td class="text-center">{{ $no + 1 }}</td>
            <td>{{ $aspirasi->judul }}</td>
            <td>{{ \Illuminate\Support\Str::limit(strip_tags($aspirasi->isi), 100) }}</td>
            <td class="text-center">
                @if($aspirasi->lampiran)
                    ✔ Ada
                @else
                    ✘ Tidak Ada
                @endif
            </td>
            <td>{{ $aspirasi->user->name ?? $aspirasi->nama ?? 'Anonim' }}</td>
            <td>{{ \Carbon\Carbon::parse($aspirasi->created_at)->format('d-m-Y') }}</td>
            <td>
                @php
                    $badgeClass = [
                        'diproses' => 'diproses',
                        'menunggu' => 'menunggu',
                        'diterima' => 'diterima',
                        'ditolak' => 'ditolak',
                    ][$aspirasi->status] ?? 'default';
                @endphp
                <span class="badge {{ $badgeClass }}">
                    {{ ucfirst($aspirasi->status) }}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
