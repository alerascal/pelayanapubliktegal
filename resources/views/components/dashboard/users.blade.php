@push('style')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    .card-custom {
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .card-header-custom {
        font-size: 1.125rem;
        font-weight: 600;
        padding: 1rem;
    }
    .status-badge {
        padding: 6px 12px;
        border-radius: 9999px;
        font-weight: 500;
        font-size: 0.875rem;
    }
    .table-container {
        max-height: 300px; /* Fixed height for scrollable tables */
        overflow-y: auto;
    }
    .table th, .table td {
        vertical-align: middle;
        font-size: 0.875rem;
    }
    .fade-in-up {
        animation: fadeInUp 0.5s ease-in;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 640px) {
        .table th, .table td {
            font-size: 0.75rem;
        }
        .card-header-custom {
            font-size: 1rem;
        }
    }
</style>
@endpush

<div class="card card-custom shadow-sm mb-4 fade-in-up">
    <div class="card-header-custom bg-gradient-dark text-white d-flex align-items-center px-4 py-3">
        <i class="fas fa-users me-2"></i>
        <strong>Daftar User Terdaftar</strong>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <div class="table-container">
                <table class="table table-borderless table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-secondary text-uppercase small">
                            <th class="px-4 py-3">Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Terdaftar Sejak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-bottom">
                                <td class="px-4 py-3 fw-semibold text-dark">{{ $user->name }}</td>
                                <td class="text-muted">{{ $user->email }}</td>
                                <td>
                                    <span class="badge status-badge bg-secondary text-capitalize">
                                        <i class="fas fa-user-tag me-1"></i>{{ $user->role }}
                                    </span>
                                </td>
                                <td>
                                    @if(isset($user->is_banned) && $user->is_banned)
                                        <span class="badge status-badge bg-danger">
                                            <i class="fas fa-ban me-1"></i>Banned
                                        </span>
                                    @else
                                        <span class="badge status-badge bg-success">
                                            <i class="fas fa-check me-1"></i>Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                    Tidak ada user ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>