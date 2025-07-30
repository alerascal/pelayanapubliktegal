<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftar Magang</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #2c3e50;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 70px;
            height: auto;
            margin-bottom: 8px;
        }

        .header h1 {
            font-size: 18px;
            margin: 5px 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header h2 {
            font-size: 14px;
            margin: 0;
            font-weight: normal;
        }

        .contact-info {
            font-size: 10px;
            color: #555;
            text-align: center;
            margin-top: 4px;
        }

        hr {
            border: 1px solid #bdc3c7;
            margin: 10px 0 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 7px 10px;
            text-align: left;
        }

        th {
            background-color: #e0e0e0;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>
    
    <div class="header">
        <img src="<?php echo e(public_path('assets/logo.png')); ?>" alt="Logo DPRD">
        <h1>Dewan Perwakilan Rakyat Daerah</h1>
        <h2>Kota Tegal</h2>
        <div class="contact-info">
            Jl. Pemuda No. 4, Kota Tegal · 
            Website: <span>dprd.tegalkota.go.id</span> · 
            Telp: +62283 321505
        </div>
    </div>

    <hr>

    
    <h3 style="text-align:center; margin-bottom: 10px;">DAFTAR PENDAFTAR MAGANG</h3>

    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Asal Sekolah</th>
                <th>Lowongan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $pendaftar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($key + 1); ?></td>
                <td><?php echo e($data->nama); ?></td>
                <td><?php echo e($data->email); ?></td>
                <td><?php echo e($data->telepon); ?></td>
                <td><?php echo e($data->asal_sekolah); ?></td>
                <td><?php echo e($data->lowongan->judul ?? '-'); ?></td>
                <td><?php echo e(ucfirst($data->status)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    
    <div class="footer">
        Dicetak pada: <?php echo e(\Carbon\Carbon::now()->translatedFormat('d F Y, H:i')); ?>

    </div>
</body>
</html>
<?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/pages/backend/magang/export_semua_pdf.blade.php ENDPATH**/ ?>