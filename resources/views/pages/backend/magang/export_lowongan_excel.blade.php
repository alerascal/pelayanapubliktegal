<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Tanggal Daftar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lowongan->pendaftar as $index => $pendaftar)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $pendaftar->nama }}</td>
            <td>{{ $pendaftar->alamat }}</td>
            <td>{{ ucfirst($pendaftar->status) }}</td>
            <td>{{ $pendaftar->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
