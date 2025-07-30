<!DOCTYPE html>
@php use Illuminate\Support\Str; @endphp
<html>
<head>
    <title>Export Semua Laporan Aspirasi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <h3>Data Semua Laporan Aspirasi</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Isi Aspirasi</th>
                <th>Alamat</th>
                <th>Pelapor</th>
                <th>Email Pelapor</th>
                <th>Status</th>
                <th>Tanggal Laporan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aspirasis as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ Str::limit($item->isi, 100) }}</td> {{-- Batasi isi agar PDF tidak terlalu panjang --}}
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->user->email ?? '-' }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
