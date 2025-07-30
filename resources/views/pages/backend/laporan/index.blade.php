@extends('layouts.app')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <div>
                <h1 class="mb-1">Laporan</h1>
                <p class="text-muted mb-0">Kelola dan ekspor data laporan sistem</p>
            </div>
        </div>

        <div class="section-body">
            @php
                $search = request()->get('search');
                $tab = request()->get('tab', 'aspirasi');
                $tahun = request()->get('tahun');
                $bulan = request()->get('bulan');
            @endphp

            <!-- Filter Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Search Bar -->
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('laporan.index') }}" class="position-relative">
                                <input type="text" name="search" class="form-control ps-5" 
                                       placeholder="Cari laporan..." 
                                       value="{{ old('search', $search ?? '') }}">
                                <input type="hidden" name="tab" value="{{ $tab ?? 'aspirasi' }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="bulan" value="{{ $bulan }}">
                                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                <button type="submit" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0">
                                    <i class="fas fa-arrow-right text-primary"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Year Filter -->
                        <div class="col-md-3">
                            <form method="GET" action="{{ route('laporan.index') }}" id="filterForm">
                                <input type="hidden" name="tab" value="{{ $tab }}">
                                <input type="hidden" name="search" value="{{ $search }}">
                                <select name="tahun" class="form-select" onchange="document.getElementById('filterForm').submit()">
                                    <option value="">Semua Tahun</option>
                                    @for ($year = date('Y'); $year >= 2020; $year--)
                                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                        </div>

                        <!-- Month Filter -->
                        <div class="col-md-3">
                                <select name="bulan" class="form-select" onchange="document.getElementById('filterForm').submit()">
                                    <option value="">Semua Bulan</option>
                                    @foreach ([
                                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                    ] as $num => $name)
                                        <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>

                        <!-- Reset Button -->
                        <div class="col-md-2">
                            <a href="{{ route('laporan.index', ['tab' => $tab ?? 'aspirasi']) }}" 
                               class="btn btn-outline-secondary w-100">
                                <i class="fas fa-refresh me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0">
                    <ul class="nav nav-pills card-header-pills mb-0" role="tablist">
                        <li class="nav-item">
                            <a href="{{ route('laporan.index', ['tab' => 'aspirasi', 'tahun' => $tahun, 'bulan' => $bulan]) }}"
                               class="nav-link rounded-pill px-4 {{ $tab === 'aspirasi' ? 'active' : '' }}">
                                <i class="fas fa-comment-dots me-2"></i>Aspirasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.index', ['tab' => 'magang', 'tahun' => $tahun, 'bulan' => $bulan]) }}"
                               class="nav-link rounded-pill px-4 {{ $tab === 'magang' ? 'active' : '' }}">
                                <i class="fas fa-graduation-cap me-2"></i>Pendaftaran Magang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.index', ['tab' => 'laporan', 'tahun' => $tahun, 'bulan' => $bulan]) }}"
                               class="nav-link rounded-pill px-4 {{ $tab === 'laporan' ? 'active' : '' }}">
                                <i class="fas fa-file-alt me-2"></i>Laporan
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="card-body border-top pt-3">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <!-- Export PDF -->
                        <form action="{{ route('laporan.export.pdf') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="tab" value="{{ $tab }}">
                            <input type="hidden" name="search" value="{{ $search }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                            <input type="hidden" name="bulan" value="{{ $bulan }}">
                            <button class="btn btn-danger btn-sm rounded-pill px-3">
                                <i class="fas fa-file-pdf me-2"></i>Export PDF
                            </button>
                        </form>

                        <!-- Export Excel -->
                        <form action="{{ route('laporan.export.excel') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="tab" value="{{ $tab }}">
                            <input type="hidden" name="search" value="{{ $search }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                            <input type="hidden" name="bulan" value="{{ $bulan }}">
                            <button class="btn btn-success btn-sm rounded-pill px-3">
                                <i class="fas fa-file-excel me-2"></i>Export Excel
                            </button>
                        </form>

                        <!-- Preview Button -->
                        @if ($tab === 'aspirasi')
                            <a href="{{ route('laporan.preview-aspirasi', ['search' => $search, 'tahun' => $tahun, 'bulan' => $bulan]) }}" 
                               class="btn btn-info btn-sm rounded-pill px-3">
                                <i class="fas fa-eye me-2"></i>Preview
                            </a>
                        @elseif ($tab === 'magang')
                            <a href="{{ route('laporan.preview-magang', ['search' => $search, 'tahun' => $tahun, 'bulan' => $bulan]) }}" 
                               class="btn btn-info btn-sm rounded-pill px-3">
                                <i class="fas fa-eye me-2"></i>Preview
                            </a>
                        @elseif ($tab === 'laporan')
                            <a href="{{ route('laporan.preview-laporan', ['search' => $search, 'tahun' => $tahun, 'bulan' => $bulan]) }}" 
                               class="btn btn-info btn-sm rounded-pill px-3">
                                <i class="fas fa-eye me-2"></i>Preview
                            </a>
                        @endif
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        @if ($tab === 'aspirasi')
                            @include('pages.backend.laporan._aspirasi', ['aspirasis' => $aspirasis])
                        @elseif ($tab === 'magang')
                            @include('pages.backend.laporan._magang', ['pendaftarans' => $pendaftarans])
                        @elseif ($tab === 'laporan')
                            @include('pages.backend.laporan._laporan', ['laporans' => $laporans])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('styles')
<style>
    .section-header h1 {
        font-size: 1.75rem;
        font-weight: 600;
        color: #2c3e50;
    }
    
    .card {
        border: none;
        border-radius: 12px;
    }
    
    .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px 12px 0 0 !important;
    }
    
    .nav-pills .nav-link {
        border: 1px solid #e9ecef;
        color: #6c757d;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        transform: translateY(-1px);
    }
    
    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border-color: #007bff;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
    }
    
    .btn {
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        border: none;
    }
    
    .btn-info {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        border: none;
    }
    
    .shadow-sm {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08) !important;
    }
    
    .position-relative .fas {
        z-index: 5;
    }
    
    .breadcrumb-item {
        font-size: 0.875rem;
        color: #6c757d;
    }
</style>
@endpush
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // DataTable configuration with modern styling
        const dataTableConfig = {
            responsive: true,
            pageLength: 10,
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(disaring dari total _MAX_ data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            columnDefs: [
                {
                    targets: '_all',
                    className: 'align-middle'
                }
            ]
        };

        // Initialize DataTables based on active tab
        if ($('#tableAspirasi').length && '{{ $tab }}' === 'aspirasi') {
            $('#tableAspirasi').DataTable(dataTableConfig);
        }

        if ($('#tableMagang').length && '{{ $tab }}' === 'magang') {
            $('#tableMagang').DataTable(dataTableConfig);
        }

        if ($('#tableLaporan').length && '{{ $tab }}' === 'laporan') {
            $('#tableLaporan').DataTable(dataTableConfig);
        }

        // Smooth transitions for form submissions
        $('form').on('submit', function() {
            $(this).find('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Memproses...');
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    });
</script>
@endpush