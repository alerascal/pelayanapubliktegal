@extends('layouts.app')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header bg-primary text-white p-3 rounded">
            <h1>Preview Laporan Gabungan</h1>
        </div>

        <div class="section-body">
            <!-- Form Pencarian -->
            <div class="mb-4">
                <form method="GET" action="{{ route('laporan.preview-laporan') }}" class="d-flex gap-2 flex-wrap align-items-center">
                    <input type="text" name="search" class="form-control" placeholder="Cari laporan..." value="{{ $search ?? '' }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                    <a href="{{ route('laporan.preview-laporan', ['tahun' => $tahun, 'bulan' => $bulan]) }}" class="btn btn-secondary"><i class="fas fa-sync"></i> Reset</a>
                </form>
            </div>

            <!-- Informasi Periode -->
            <div class="mb-3 card p-3 shadow-sm">
                <p class="mb-0"><strong>Periode:</strong> {{ $bulan ? \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') : 'Semua Bulan' }} {{ $tahun ?? 'Semua Tahun' }}</p>
                @if($search)
                    <p class="mb-0"><strong>Pencarian:</strong> {{ $search }}</p>
                @endif
            </div>

            <!-- Tombol Unduh -->
            <div class="mb-3 d-flex flex-wrap gap-2">
                <form action="{{ route('laporan.export.pdf') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tab" value="laporan">
                    <input type="hidden" name="search" value="{{ $search }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                    <button class="btn btn-danger btn-icon">
                        <span class="icon"><i class="fas fa-file-pdf"></i></span>
                        <span class="text">Unduh PDF</span>
                    </button>
                </form>
                <form action="{{ route('laporan.export.excel') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tab" value="laporan">
                    <input type="hidden" name="search" value="{{ $search }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                    <button class="btn btn-success btn-icon">
                        <span class="icon"><i class="fas fa-file-excel"></i></span>
                        <span class="text">Unduh Excel</span>
                    </button>
                </form>
                <a href="{{ route('laporan.index', ['tab' => 'laporan', 'search' => $search, 'tahun' => $tahun, 'bulan' => $bulan]) }}" class="btn btn-secondary btn-icon">
                    <span class="icon"><i class="fas fa-arrow-left"></i></span>
                    <span class="text">Kembali</span>
                </a>
            </div>

            <!-- Tabel Data -->
            @forelse($laporanByMonth as $month => $laporans)
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">{{ $month }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Tipe</th>
                                        <th>Judul</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Detail</th>
                                        <th>Status</th>
                                        <th>Tanggal Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($laporans as $index => $item)
                                        <tr>
                                            <td>{{ $paginator->firstItem() + $index }}</td>
                                            <td>{{ $item->tipe === 'aspirasi' ? 'Aspirasi' : 'Magang' }}</td>
                                            <td>{{ $item->tipe === 'aspirasi' ? $item->judul : ($item->lowongan->judul ?? '-') }}</td>
                                            <td>{{ $item->tipe === 'aspirasi' ? ($item->user->name ?? '-') : $item->nama }}</td>
                                            <td>{{ $item->tipe === 'aspirasi' ? ($item->user->email ?? '-') : $item->email }}</td>
                                            <td>{{ $item->tipe === 'aspirasi' ? $item->isi : $item->asal_sekolah }}</td>
                                            <td>
                                                <span class="badge {{ $item->status === 'selesai' ? 'badge-success' : 'badge-warning' }}">
                                                    {{ $item->status ?? 'Diproses' }}
                                                </span>
                                            </td>
                                            <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">Tidak ada data ditemukan untuk periode ini.</div>
            @endforelse

            {{ $paginator->links() }}
        </div>
    </section>
</div>
@endsection

@push('styles')

@endpush