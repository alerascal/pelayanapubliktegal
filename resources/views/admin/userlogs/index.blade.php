@extends('layouts.app')

@section('title', 'Riwayat Aktivitas')

@push('style')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('main')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Riwayat Aktivitas</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.userlogs.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="date" class="form-label">Filter Tanggal</label>
                    <input type="text" name="date" id="date" class="form-control" 
                           value="{{ request('date') }}" placeholder="Pilih tanggal" autocomplete="off">
                </div>
             <div class="col-md-4">
    <label for="user_id" class="form-label">Filter Pengguna (Admin)</label>
    <select name="user_id" id="user_id" class="form-select">
        <option value="">-- Semua Admin --</option>
        @foreach ($adminUsers as $admin)
            <option value="{{ $admin->id }}" {{ request('user_id') == $admin->id ? 'selected' : '' }}>
                {{ $admin->name }}
            </option>
        @endforeach
    </select>
</div>

           
                <div class="col-md-4 align-self-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('admin.userlogs.index') }}" class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </form>

            <div class="table-responsive mt-4">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Role</th>
                            <th>Aksi</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($userLogs as $index => $log)
                        <tr>
                            <td>{{ $index + $userLogs->firstItem() }}</td>
                            <td>{{ $log->user->name ?? 'Tidak Diketahui' }}</td>
                            <td>{{ $log->user->role ?? '-' }}</td>
                            <td>{{ $log->activity }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->activity_at)->format('d M Y - H:i') }}</td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada aktivitas ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $userLogs->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#date", {
        dateFormat: "Y-m-d",
        allowInput: false,
        locale: "id"
    });
</script>
@endpush
