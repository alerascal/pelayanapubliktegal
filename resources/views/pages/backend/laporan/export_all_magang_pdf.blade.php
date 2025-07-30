<!DOCTYPE html>
<html>
<head>
    <title>Export Semua Pendaftar Magang</title>
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
        }
    </style>
</head>
<body>
    <h3>Data Semua Pendaftar Magang</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftarans as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->asal_sekolah }}</td> {{-- Sesuaikan atribut model --}}
                <td>{{ $item->email }}</td>
                <td>{{ $item->telepon }}</td> {{-- Sesuaikan atribut model --}}
                <td>{{ ucfirst($item->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
