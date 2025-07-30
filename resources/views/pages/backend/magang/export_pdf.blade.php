<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Pendaftar PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border: 1px solid black;
            text-align: left;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Daftar Pendaftar Magang - {{ $lowongan->judul }}</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Asal Sekolah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftar as $p)
            <tr>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->telepon }}</td>
                <td>{{ $p->asal_sekolah }}</td>
                <td>{{ ucfirst($p->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
