<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Aspirasi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Laporan Aspirasi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Status</th>
                <th>Nama Pengirim</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aspirasis as $aspirasi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $aspirasi->judul }}</td>
                    <td>{{ strip_tags($aspirasi->isi) }}</td>
                    <td>{{ ucfirst($aspirasi->status) }}</td>
                    <td>{{ $aspirasi->user->name ?? $aspirasi->nama ?? '-' }}</td>
                    <td>{{ $aspirasi->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
