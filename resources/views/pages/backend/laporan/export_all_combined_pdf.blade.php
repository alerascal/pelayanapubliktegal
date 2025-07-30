<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Aspirasi dan Pendaftar Magang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #444;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #ddd;
        }
        .section-title {
            background-color: #f2f2f2;
            padding: 6px 8px;
            margin-top: 30px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Laporan Gabungan Aspirasi dan Pendaftar Magang</h2>

    {{-- Bagian Aspirasi --}}
    <div class="section-title">Data Aspirasi</div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pengirim</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($aspirasis as $i => $aspirasi)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $aspirasi->user->name ?? '-' }}</td>
                    <td>{{ $aspirasi->judul ?? '-' }}</td>
                    <td>{{ \Illuminate\Support\Str::limit(strip_tags($aspirasi->isi), 50) }}</td>
                    <td>{{ $aspirasi->alamat ?? '-' }}</td>
                    <td>{{ ucfirst($aspirasi->status ?? '-') }}</td>
                    <td>{{ $aspirasi->created_at?->format('d-m-Y') ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data aspirasi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Bagian Pendaftar Magang --}}
    <div class="section-title">Data Pendaftar Magang</div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Lowongan</th>
                <th>Status</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendaftarans as $i => $pendaftar)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $pendaftar->nama ?? '-' }}</td>
                    <td>{{ $pendaftar->asal_sekolah ?? '-' }}</td>
                    <td>{{ $pendaftar->email ?? '-' }}</td>
                    <td>{{ $pendaftar->telepon ?? '-' }}</td>
                    <td>{{ $pendaftar->lowongan->judul ?? '-' }}</td>
                    <td>{{ ucfirst($pendaftar->status ?? '-') }}</td>
                    <td>{{ $pendaftar->created_at?->format('d-m-Y') ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data pendaftar magang</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
