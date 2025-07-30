@extends('layouts.app')

@section('title', 'Lowongan Magang')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-briefcase"></i> Lowongan Magang</h1>
            <div class="section-header-button">
                <a href="{{ route('magang.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Tambah Lowongan
                </a>
            </div>
        </div>

        {{-- Filter Tahun --}}
        <form method="GET" class="mb-3">
            <div class="input-group" style="max-width: 300px;">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary text-white">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                </div>
                <select name="tahun" onchange="this.form.submit()" class="form-control border-primary">
                    <option value="">📆 Tampilkan Semua Tahun</option>
                    @foreach ($tahunList as $tahun)
                        <option value="{{ $tahun }}" {{ $tahun == $tahunFilter ? 'selected' : '' }}>
                            Tahun {{ $tahun }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        {{-- Tombol Hapus Tahun --}}
        @if ($tahunFilter)
            <form action="{{ route('magang.hapusTahun', ['tahun' => $tahunFilter]) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus semua lowongan & pendaftar tahun {{ $tahunFilter }}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mb-3">
                    <i class="fas fa-trash"></i> Hapus Semua Tahun {{ $tahunFilter }}
                </button>
            </form>
        @endif

        {{-- Tombol Hapus Lowongan Expired --}}
        @php
            $expiredCount = $lowongan->where('deadline', '<', now())->count();
        @endphp
        @if ($expiredCount > 0)
            <form action="{{ route('magang.hapusExpired') }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus semua lowongan yang telah expired?')" class="mb-3">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger">
                    <i class="fas fa-trash-alt"></i> Hapus {{ $expiredCount }} Lowongan Expired
                </button>
            </form>
        @endif

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if ($expiredCount > 0)
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> Ada {{ $expiredCount }} lowongan yang sudah <strong>melewati deadline</strong>.
            </div>
        @endif

        {{-- Tabel --}}
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-list"></i> Daftar Lowongan Magang</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Judul & Deskripsi</th>
                                <th>Periode</th>
                                <th>Kuota</th>
                                <th>Deadline</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lowongan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                {{-- Link ke halaman pendaftar atau detail --}}
                                <td class="text-start clickable-cell" 
                                    onclick="window.location='{{ route('magang.pendaftar', $item->id) }}'">
                                    <strong>{{ $item->judul }}</strong><br>
                                    <small class="text-muted">{{ Str::limit($item->deskripsi, 80) }}</small>
                                </td>

                                <td>
                                    <span class="badge bg-info text-white">
                                        {{ $item->periode }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-success text-white">
                                        {{ $item->kuota }} Orang
                                    </span>
                                </td>
                                <td>
                                    @if(\Carbon\Carbon::parse($item->deadline)->lt(now()))
                                        <span class="badge bg-danger text-white animate-expired">
                                            {{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}<br>
                                            <small>(Expired)</small>
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            {{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('magang.show', $item->id) }}" class="btn btn-sm btn-info animate__animated animate__fadeIn" 
                                       style="margin-right: 5px; border-radius: 5px;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('magang.edit', $item->id) }}" class="btn btn-sm btn-warning" 
                                       style="margin-right: 5px; border-radius: 5px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('magang.destroy', $item->id) }}" method="POST"
                                          class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lowongan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" style="border-radius: 5px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada lowongan magang.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- CSS tambahan --}}
<style>
    .animate-expired {
        animation: pulse-red 1.5s infinite;
    }

    @keyframes pulse-red {
        0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.5); }
        70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
    }

    .clickable-cell {
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .clickable-cell:hover {
        background-color: #f8f9fa;
    }

    /* Styling for Show button */
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }
</style>
@endsection