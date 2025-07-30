@extends('layouts.app')

@section('title', 'Edit Anggota Dewan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1> Anggota Dewan</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Struktur Anggota</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('anggota.update', $anggota->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        value="{{ $anggota->nama }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control"
                                        value="{{ $anggota->jabatan }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="fraksi">Fraksi</label>
                                    <input type="text" name="fraksi" id="fraksi" class="form-control"
                                        value="{{ $anggota->fraksi }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_anggota">Gambar Anggota</label>
                                    <input type="file" name="gambar_anggota" id="gambar_anggota" class="form-control">
                                    @if ($anggota->gambar_anggota)
                                        <img src="{{ asset('storage/' . $anggota->gambar_anggota) }}" alt="gambar"
                                            width="100" class="mt-2">
                                    @else
                                        <p>No image available</p>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
