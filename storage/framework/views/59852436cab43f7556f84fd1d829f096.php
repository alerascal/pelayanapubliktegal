

<?php $__env->startSection('title', 'Edit Anggota Dewan'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="text-primary">Edit Anggota Dewan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="<?php echo e(route('anggota.index')); ?>">Data Anggota</a>
                </div>
                <div class="breadcrumb-item">Edit Anggota</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <form action="<?php echo e(route('anggota.update', $anggota->id)); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            
                            <h5 class="text-dark">📋 Informasi Umum</h5>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="<?php echo e(old('nama', $anggota->nama)); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" value="<?php echo e(old('jabatan', $anggota->jabatan)); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Fraksi</label>
                                <input type="text" name="fraksi" class="form-control" value="<?php echo e(old('fraksi', $anggota->fraksi)); ?>">
                            </div>

                            
                            <div class="form-group">
                                <label>Foto Anggota</label>
                                <input type="file" name="gambar_anggota" id="gambar_anggota" class="form-control-file">
                                <?php if($anggota->gambar_anggota): ?>
                                    <img src="<?php echo e(asset('storage/' . $anggota->gambar_anggota)); ?>" id="gambar-preview" class="img-fluid mt-3 rounded shadow-sm" style="max-height: 200px;">
                                <?php endif; ?>
                            </div>

                            
                            <h5 class="text-dark mt-4">🎓 Riwayat Pendidikan</h5>
                            <div id="pendidikan-container">
                                <?php $pendidikan = is_array($anggota->pendidikan) ? $anggota->pendidikan : []; ?>
                                <?php $__empty_1 = true; $__currentLoopData = $pendidikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="form-group d-flex align-items-center">
                                    <input type="text" name="pendidikan[]" class="form-control mr-2" value="<?php echo e($item); ?>">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusElemen(this)">Hapus</button>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="form-group d-flex align-items-center">
                                    <input type="text" name="pendidikan[]" class="form-control mr-2" placeholder="Contoh: S1 Ekonomi - UGM">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusElemen(this)">Hapus</button>
                                </div>
                                <?php endif; ?>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mb-3" onclick="tambahPendidikan()">+ Tambah Pendidikan</button>

                            
                            <h5 class="text-dark mt-4">🧪 Pengalaman</h5>
                            <div id="pengalaman-container">
                                <?php $pengalaman = is_array($anggota->pengalaman) ? $anggota->pengalaman : []; ?>
                                <?php $__empty_1 = true; $__currentLoopData = $pengalaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="form-group d-flex align-items-center">
                                    <textarea name="pengalaman[]" class="form-control mr-2" rows="2"><?php echo e($item); ?></textarea>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusElemen(this)">Hapus</button>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="form-group d-flex align-items-center">
                                    <textarea name="pengalaman[]" class="form-control mr-2" rows="2" placeholder="Contoh: Ketua Panitia XYZ"></textarea>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusElemen(this)">Hapus</button>
                                </div>
                                <?php endif; ?>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mb-3" onclick="tambahPengalaman()">+ Tambah Pengalaman</button>

                            
                            <h5 class="text-dark mt-4">🌐 Sosial Media</h5>
                            <p class="text-muted mb-2">Pilih jenis sosial media dan isi link-nya (boleh dikosongkan jika tidak punya).</p>
                            <?php 
                                $sosmedList = ['Facebook', 'Instagram', 'TikTok', 'Twitter'];
                                $sosmedData = is_array($anggota->sosmed) ? $anggota->sosmed : [];
                            ?>
                            <?php $__currentLoopData = $sosmedList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sosmed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                                <label><?php echo e($sosmed); ?></label>
                                <input type="url" name="sosmed[<?php echo e(strtolower($sosmed)); ?>]" class="form-control" value="<?php echo e(old('sosmed.' . strtolower($sosmed), $sosmedData[strtolower($sosmed)] ?? '')); ?>" placeholder="https://<?php echo e(strtolower($sosmed)); ?>.com/namauser (opsional)">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            
                            <h5 class="text-dark mt-4">📜 Biografi Lengkap</h5>
                            <div class="form-group">
                                <label>Latar Belakang</label>
                                <textarea name="bio_latar" class="form-control" rows="3"><?php echo e(old('bio_latar', $anggota->bio_latar)); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Perjalanan Karier</label>
                                <textarea name="bio_karier" class="form-control" rows="3"><?php echo e(old('bio_karier', $anggota->bio_karier)); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Jabatan & Penghargaan</label>
                                <textarea name="bio_jabatan" class="form-control" rows="3"><?php echo e(old('bio_jabatan', $anggota->bio_jabatan)); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Visi dan Motivasi</label>
                                <textarea name="bio_visi" class="form-control" rows="3"><?php echo e(old('bio_visi', $anggota->bio_visi)); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Fokus Perjuangan</label>
                                <textarea name="bio_fokus" class="form-control" rows="3"><?php echo e(old('bio_fokus', $anggota->bio_fokus)); ?></textarea>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/pages/backend/anggota_dewan/edit.blade.php ENDPATH**/ ?>