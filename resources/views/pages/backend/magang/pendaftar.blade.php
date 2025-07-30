@extends('layouts.app')

@section('title', 'Daftar Pendaftar Magang')

@section('main')
<div class="main-content">
    <section class="section">

        {{-- Header dan Filter --}}
        <div class="section-header d-flex justify-content-between align-items-center flex-wrap">
            <h1><i class="fas fa-users"></i> Pendaftar Magang</h1>
              <a href="{{ route('magang.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <form method="GET" class="mb-3 d-flex gap-2 flex-wrap">
                <div class="input-group" style="width: 250px;">
                    <span class="input-group-text bg-primary text-white">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                    <select name="tahun" class="form-select border-primary" onchange="this.form.submit()">
                        <option value="">📆 Semua Tahun</option>
                        @foreach ($tahunList as $tahun)
                            <option value="{{ $tahun }}" {{ $tahun == $tahunFilter ? 'selected' : '' }}>
                                Tahun {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-info text-white">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-info"
                           value="{{ request('search') }}" placeholder="🔍 Cari nama atau ID lowongan...">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </form>
        </div>

        {{-- Tombol Export --}}
        <div class="mb-3 d-flex gap-2 flex-wrap">
            <form action="{{ route('magang.export.all.pdf') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger">
                    <i class="fas fa-file-pdf"></i> Export Semua PDF
                </button>
            </form>

            <form action="{{ route('magang.export.all.excel') }}" method="POST">
                @csrf
                <button class="btn btn-outline-success">
                    <i class="fas fa-file-excel"></i> Export Semua Excel
                </button>
            </form>
        </div>

        {{-- Tombol Hapus Tahun --}}
        @if ($tahunFilter)
            <form action="{{ route('magang.hapusTahun', $tahunFilter) }}" method="POST" class="mb-3"
                  onsubmit="return confirm('Yakin ingin menghapus semua data tahun {{ $tahunFilter }}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i> Hapus Semua Tahun {{ $tahunFilter }}
                </button>
            </form>
        @endif

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Loop Lowongan --}}
        @foreach ($lowongans as $lowongan)
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                    <h5 class="mb-0">
                        <i class="fas fa-briefcase"></i> {{ $lowongan->judul }} ({{ $lowongan->created_at->year }})
                    </h5>

                    <div class="d-flex gap-2">
                        {{-- Export Per Lowongan --}}
                        <form action="{{ route('magang.export.lowongan.pdf', $lowongan->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">
                                <i class="fas fa-file-pdf"></i> PDF
                            </button>
                        </form>

                        <form action="{{ route('magang.export.lowongan.excel', $lowongan->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">
                                <i class="fas fa-file-excel"></i> Excel
                            </button>
                        </form>

                      
                        {{-- Hapus Semua Pendaftar --}}
                        <form action="{{ route('pendaftar.hapus.semua', $lowongan->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus semua pendaftar?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-light btn-sm">
                                <i class="fas fa-trash"></i> Hapus Semua
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    @if ($lowongan->pendaftar->count())
                        <div class="table-responsive">
                            <table id="table-{{ $lowongan->id }}" class="table table-striped table-hover align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>CV</th>
                                        <th>Surat Izin</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lowongan->pendaftar as $pendaftar)
                                        <tr>
                                            <td>{{ $pendaftar->nama }}</td>
                                            <td>{{ $pendaftar->alamat }}</td>
                                            <td class="text-center">
                                                @if ($pendaftar->cv)
                                                    <a href="{{ asset('storage/' . $pendaftar->cv) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-file"></i> Lihat CV
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($pendaftar->surat_izin)
                                                    <a href="{{ asset('storage/' . $pendaftar->surat_izin) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                                        <i class="fas fa-file-alt"></i> Lihat Surat
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ 
                                                    $pendaftar->status == 'diterima' ? 'success' :
                                                    ($pendaftar->status == 'ditolak' ? 'danger' :
                                                    ($pendaftar->status == 'diproses' ? 'info' : 'warning')) }}">
                                                    {{ ucfirst($pendaftar->status) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                {{-- Ubah Status --}}
                                                <form action="{{ route('magang.status', $pendaftar->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="btn-group btn-group-sm">
                                                        @foreach(['menunggu', 'diproses', 'diterima', 'ditolak'] as $status)
                                                            <button type="submit" name="status" value="{{ $status }}"
                                                                    class="btn btn-outline-{{ 
                                                                        $status == 'menunggu' ? 'warning' :
                                                                        ($status == 'diproses' ? 'info' :
                                                                        ($status == 'diterima' ? 'success' : 'danger')) }}
                                                                    {{ $pendaftar->status == $status ? 'active' : '' }}">
                                                                <i class="fas fa-{{ 
                                                                    $status == 'menunggu' ? 'clock' :
                                                                    ($status == 'diproses' ? 'spinner' :
                                                                    ($status == 'diterima' ? 'check' : 'times')) }}">
                                                                </i>
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                </form>

                                                {{-- Detail Pendaftar --}}
                                                <a href="{{ route('pendaftar.detail', $pendaftar->id) }}" class="btn btn-outline-dark btn-sm" title="Lihat Detail">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>

                                                {{-- Hapus Pendaftar --}}
                                                <form action="{{ route('pendaftar.hapus', $pendaftar->id) }}" method="POST" class="d-inline"
                                                      onsubmit="return confirm('Hapus pendaftar ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" title="Hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-user-slash fa-2x mb-2"></i><br>
                            Belum ada pendaftar untuk lowongan ini.
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

    </section>
</div>
@endsection

@push('scripts')
    @foreach ($lowongans as $lowongan)
        @if ($lowongan->pendaftar->count())
        <script>
            $(document).ready(function () {
                $('#table-{{ $lowongan->id }}').DataTable({
                    responsive: true,
                    language: {
                        search: "🔍 Cari:",
                        lengthMenu: "_MENU_ entri per halaman",
                        zeroRecords: "Tidak ditemukan",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                        infoEmpty: "Tidak ada data",
                        paginate: {
                            first: "Awal",
                            last: "Akhir",
                            next: "→",
                            previous: "←"
                        }
                    }
                });
            });
        </script>
        @endif
    @endforeach
@endpush
