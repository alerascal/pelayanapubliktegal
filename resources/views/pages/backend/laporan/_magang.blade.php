<div class="table-responsive">
    <table class="table table-bordered table-striped table-sm align-middle">
        <thead class="bg-primary bg-opacity-25 text-primary text-center">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Lowongan</th>
                <th>Status</th>
                <th class="text-nowrap">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftarans as $i => $row)
                <tr>
                    <td>{{ $pendaftarans->firstItem() + $i }}</td>
                    <td>{{ $row->nama ?? '-' }}</td>
                    <td>{{ $row->asal_sekolah ?? '-' }}</td>
                    <td>{{ $row->email ?? '-' }}</td>
                    <td>{{ $row->telepon ?? '-' }}</td>
                    <td>{{ $row->lowongan->judul ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ match($row->status ?? 'unknown') {
                            'menunggu' => 'warning',
                            'ditolak' => 'danger',
                            'diterima', 'selesai' => 'success',
                            default => 'secondary'
                        } }}">
                            {{ ucfirst($row->status ?? '-') }}
                        </span>
                    </td>
                    <td class="text-nowrap">{{ $row->created_at?->format('d M Y') ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3 d-flex justify-content-center">
        {{ $pendaftarans->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
