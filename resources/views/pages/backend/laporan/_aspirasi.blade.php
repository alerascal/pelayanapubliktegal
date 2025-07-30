<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover table-sm align-middle" id="tableAspirasi">
        <caption class="text-muted">Daftar Aspirasi Pengguna</caption>
        <thead class="bg-primary-subtle text-primary text-center">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Alamat</th>
                <th>Status</th>
                <th class="text-nowrap">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aspirasis as $i => $item)
                <tr>
                    <td class="text-center">{{ $aspirasis->firstItem() + $i }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>{{ $item->user->phone ?? '-' }}</td>
                    <td>{{ $item->judul ?? '-' }}</td>
                    <td>{{ \Str::limit(strip_tags($item->isi), 50) }}</td>
                    <td>{{ $item->alamat ?? '-' }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ match($item->status ?? 'unknown') {
                            'menunggu' => 'warning',
                            'diproses' => 'info',
                            'ditolak' => 'danger',
                            'diterima', 'selesai' => 'success',
                            default => 'secondary'
                        } }}">
                            {{ ucfirst($item->status ?? '-') }}
                        </span>
                    </td>
                    <td class="text-nowrap text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Tidak ada data aspirasi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $aspirasis->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
