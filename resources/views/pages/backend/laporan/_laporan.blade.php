<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover table-sm align-middle" id="tableLaporan">
        <caption class="text-muted">Gabungan Laporan Aspirasi dan Magang</caption>
        <thead class="bg-primary-subtle text-primary text-center">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Jenis</th>
                <th scope="col">Judul / Nama</th>
                <th scope="col">Pengirim / Sekolah</th>
                <th scope="col">Alamat / Email</th>
                <th scope="col" class="text-nowrap">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporans as $i => $row)
                <tr>
                    <td class="text-center">{{ $laporans->firstItem() + $i }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ $row->tipe === 'aspirasi' ? 'info' : 'warning' }} text-dark">
                            {{ ucfirst($row->tipe) }}
                        </span>
                    </td>
                    <td>{{ $row->tipe === 'aspirasi' ? ($row->judul ?? '-') : ($row->nama ?? '-') }}</td>
                    <td>{{ $row->tipe === 'aspirasi' ? ($row->user->name ?? '-') : ($row->asal_sekolah ?? '-') }}</td>
                    <td>{{ $row->tipe === 'aspirasi' ? ($row->alamat ?? '-') : ($row->email ?? '-') }}</td>
                    <td class="text-nowrap text-center">{{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $laporans->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
