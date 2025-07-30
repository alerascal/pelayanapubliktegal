<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Aspirasi dan Pendaftar Magang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #444;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #ddd;
        }
        .section-title {
            background-color: #f2f2f2;
            padding: 6px 8px;
            margin-top: 30px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Laporan Gabungan Aspirasi dan Pendaftar Magang</h2>

    
    <div class="section-title">Data Aspirasi</div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pengirim</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $aspirasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $aspirasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($i + 1); ?></td>
                    <td><?php echo e($aspirasi->user->name ?? '-'); ?></td>
                    <td><?php echo e($aspirasi->judul ?? '-'); ?></td>
                    <td><?php echo e(\Illuminate\Support\Str::limit(strip_tags($aspirasi->isi), 50)); ?></td>
                    <td><?php echo e($aspirasi->alamat ?? '-'); ?></td>
                    <td><?php echo e(ucfirst($aspirasi->status ?? '-')); ?></td>
                    <td><?php echo e($aspirasi->created_at?->format('d-m-Y') ?? '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data aspirasi</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    
    <div class="section-title">Data Pendaftar Magang</div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Lowongan</th>
                <th>Status</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $pendaftar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($i + 1); ?></td>
                    <td><?php echo e($pendaftar->nama ?? '-'); ?></td>
                    <td><?php echo e($pendaftar->asal_sekolah ?? '-'); ?></td>
                    <td><?php echo e($pendaftar->email ?? '-'); ?></td>
                    <td><?php echo e($pendaftar->telepon ?? '-'); ?></td>
                    <td><?php echo e($pendaftar->lowongan->judul ?? '-'); ?></td>
                    <td><?php echo e(ucfirst($pendaftar->status ?? '-')); ?></td>
                    <td><?php echo e($pendaftar->created_at?->format('d-m-Y') ?? '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data pendaftar magang</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/pages/backend/laporan/export_all_combined_pdf.blade.php ENDPATH**/ ?>