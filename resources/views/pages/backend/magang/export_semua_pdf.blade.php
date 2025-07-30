<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftar Magang</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #2c3e50;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 70px;
            height: auto;
            margin-bottom: 8px;
        }

        .header h1 {
            font-size: 18px;
            margin: 5px 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header h2 {
            font-size: 14px;
            margin: 0;
            font-weight: normal;
        }

        .contact-info {
            font-size: 10px;
            color: #555;
            text-align: center;
            margin-top: 4px;
        }

        hr {
            border: 1px solid #bdc3c7;
            margin: 10px 0 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 7px 10px;
            text-align: left;
        }

        th {
            background-color: #e0e0e0;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header">
        <img src="{{ public_path('assets/logo.png') }}" alt="Logo DPRD">
        <h1>Dewan Perwakilan Rakyat Daerah</h1>
        <h2>Kota Tegal</h2>
        <div class="contact-info">
            Jl. Pemuda No. 4, Kota Tegal · 
            Website: <span>dprd.tegalkota.go.id</span> · 
            Telp: +62283 321505
        </div>
    </div>

    <hr>

    {{-- Judul --}}
    <h3 style="text-align:center; margin-bottom: 10px;">DAFTAR PENDAFTAR MAGANG</h3>

    {{-- Tabel --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Asal Sekolah</th>
                <th>Lowongan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftar as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->telepon }}</td>
                <td>{{ $data->asal_sekolah }}</td>
                <td>{{ $data->lowongan->judul ?? '-' }}</td>
                <td>{{ ucfirst($data->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
    </div>
</body>
</html>
