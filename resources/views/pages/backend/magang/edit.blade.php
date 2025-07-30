@extends('layouts.app')

@section('title', 'Edit Lowongan Magang')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1 style="font-size: 24px; font-weight: bold; color: #000000;">Edit Lowongan Magang</h1>
            <a href="{{ route('magang.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="col-12 mb-4">
            @if(session('success'))
                <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 5px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="card mx-auto" style="max-width: 700px; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0,0,0,0.1); border: none;">
            <div class="card-body">
                {{-- Menampilkan error validasi --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('magang.update', $lowongan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Lowongan</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $lowongan->judul) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="kuota" class="form-label">Kuota</label>
                        <input type="number" name="kuota" class="form-control" value="{{ old('kuota', $lowongan->kuota) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $lowongan->deadline) }}" required>
                    </div>
                    <div class="form-group">
    <label for="periode">Periode Magang</label>
    <input type="text" name="periode" id="periode" class="form-control" required placeholder="Contoh: 4 bulan" value="{{ old('periode') }}">
</div>


                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('magang.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>

    </section>
</div>
@endsection
