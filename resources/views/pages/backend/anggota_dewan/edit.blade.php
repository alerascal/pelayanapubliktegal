@extends('layouts.app')

@section('title', 'Edit Anggota Dewan')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="text-primary">Edit Anggota Dewan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('anggota.index') }}">Data Anggota</a>
                </div>
                <div class="breadcrumb-item">Edit Anggota</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- DATA UTAMA --}}
                            <h5 class="text-dark">📋 Informasi Umum</h5>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', $anggota->nama) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $anggota->jabatan) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Fraksi</label>
                                <input type="text" name="fraksi" class="form-control" value="{{ old('fraksi', $anggota->fraksi) }}">
                            </div>

                            {{-- FOTO --}}
                            <div class="form-group">
                                <label>Foto Anggota</label>
                                <input type="file" name="gambar_anggota" id="gambar_anggota" class="form-control-file">
                                @if($anggota->gambar_anggota)
                                    <img src="{{ asset('storage/' . $anggota->gambar_anggota) }}" id="gambar-preview" class="img-fluid mt-3 rounded shadow-sm" style="max-height: 200px;">
                                @endif
                            </div>

                            {{-- PENDIDIKAN --}}
                            <h5 class="text-dark mt-4">🎓 Riwayat Pendidikan</h5>
                            <div id="pendidikan-container">
                                @php $pendidikan = is_array($anggota->pendidikan) ? $anggota->pendidikan : []; @endphp
                                @forelse($pendidikan as $item)
                                <div class="form-group d-flex align-items-center">
                                    <input type="text" name="pendidikan[]" class="form-control mr-2" value="{{ $item }}">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusElemen(this)">Hapus</button>
                                </div>
                                @empty
                                <div class="form-group d-flex align-items-center">
                                    <input type="text" name="pendidikan[]" class="form-control mr-2" placeholder="Contoh: S1 Ekonomi - UGM">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusElemen(this)">Hapus</button>
                                </div>
                                @endforelse
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mb-3" onclick="tambahPendidikan()">+ Tambah Pendidikan</button>

                            {{-- PENGALAMAN --}}
                            <h5 class="text-dark mt-4">🧪 Pengalaman</h5>
                            <div id="pengalaman-container">
                                @php $pengalaman = is_array($anggota->pengalaman) ? $anggota->pengalaman : []; @endphp
                                @forelse($pengalaman as $item)
                                <div class="form-group d-flex align-items-center">
                                    <textarea name="pengalaman[]" class="form-control mr-2" rows="2">{{ $item }}</textarea>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusElemen(this)">Hapus</button>
                                </div>
                                @empty
                                <div class="form-group d-flex align-items-center">
                                    <textarea name="pengalaman[]" class="form-control mr-2" rows="2" placeholder="Contoh: Ketua Panitia XYZ"></textarea>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusElemen(this)">Hapus</button>
                                </div>
                                @endforelse
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mb-3" onclick="tambahPengalaman()">+ Tambah Pengalaman</button>

                            {{-- SOSIAL MEDIA --}}
                            <h5 class="text-dark mt-4">🌐 Sosial Media</h5>
                            <p class="text-muted mb-2">Pilih jenis sosial media dan isi link-nya (boleh dikosongkan jika tidak punya).</p>
                            @php 
                                $sosmedList = ['Facebook', 'Instagram', 'TikTok', 'Twitter'];
                                $sosmedData = is_array($anggota->sosmed) ? $anggota->sosmed : [];
                            @endphp
                            @foreach ($sosmedList as $sosmed)
                            <div class="form-group">
                                <label>{{ $sosmed }}</label>
                                <input type="url" name="sosmed[{{ strtolower($sosmed) }}]" class="form-control" value="{{ old('sosmed.' . strtolower($sosmed), $sosmedData[strtolower($sosmed)] ?? '') }}" placeholder="https://{{ strtolower($sosmed) }}.com/namauser (opsional)">
                            </div>
                            @endforeach

                            {{-- BIOGRAFI --}}
                            <h5 class="text-dark mt-4">📜 Biografi Lengkap</h5>
                            <div class="form-group">
                                <label>Latar Belakang</label>
                                <textarea name="bio_latar" class="form-control" rows="3">{{ old('bio_latar', $anggota->bio_latar) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Perjalanan Karier</label>
                                <textarea name="bio_karier" class="form-control" rows="3">{{ old('bio_karier', $anggota->bio_karier) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Jabatan & Penghargaan</label>
                                <textarea name="bio_jabatan" class="form-control" rows="3">{{ old('bio_jabatan', $anggota->bio_jabatan) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Visi dan Motivasi</label>
                                <textarea name="bio_visi" class="form-control" rows="3">{{ old('bio_visi', $anggota->bio_visi) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Fokus Perjuangan</label>
                                <textarea name="bio_fokus" class="form-control" rows="3">{{ old('bio_fokus', $anggota->bio_fokus) }}</textarea>
                            </div>

                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    // Preview Gambar
    document.getElementById("gambar_anggota")?.addEventListener("change", function (event) {
        const input = event.target;
        const preview = document.getElementById("gambar-preview");

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove("d-none");
            };
            reader.readAsDataURL(input.files[0]);
        }
    });

    // Tambah Pendidikan
    function tambahPendidikan() {
        const container = document.getElementById("pendidikan-container");
        const div = document.createElement("div");
        div.classList.add("form-group", "d-flex", "align-items-center", "mt-2");
        div.innerHTML = `
            <input type="text" name="pendidikan[]" class="form-control mr-2" placeholder="Contoh: S1 Hukum - UNDIP">
            <button type="button" class="btn btn-sm btn-danger" onclick="hapusElemen(this)">Hapus</button>`;
        container.appendChild(div);
    }

    // Tambah Pengalaman
    function tambahPengalaman() {
        const container = document.getElementById("pengalaman-container");
        const div = document.createElement("div");
        div.classList.add("form-group", "d-flex", "align-items-center", "mt-2");
        div.innerHTML = `
            <textarea name="pengalaman[]" class="form-control mr-2" rows="2" placeholder="Contoh: Ketua Komisi A"></textarea>
            <button type="button" class="btn btn-sm btn-danger" onclick="hapusElemen(this)">Hapus</button>`;
        container.appendChild(div);
    }

    // Hapus Elemen
    function hapusElemen(el) {
        el.parentElement.remove();
    }
</script>
@endpush