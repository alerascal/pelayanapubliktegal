<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pemberitahuan Magang Diterima</title>
  <style>
    body, html {
      margin: 0; padding: 0; width: 100%; height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f4f8;
      color: #333;
    }

    .email-wrapper {
      background-color: #f0f4f8;
      width: 100%;
      padding: 40px 10px;
      box-sizing: border-box;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .email-container {
      background: #ffffff;
      max-width: 600px;
      width: 100%;
      border-radius: 12px;
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
      padding: 30px 40px;
      box-sizing: border-box;
      text-align: center;
    }

    h2 {
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 15px;
      font-size: 28px;
    }

    p {
      font-size: 16px;
      line-height: 1.6;
      margin: 0 0 20px 0;
      color: #4a5568;
    }

    .info-box {
      background-color: #edf2f7;
      border-radius: 8px;
      padding: 15px 20px;
      text-align: left;
      margin-top: 20px;
    }

    .info-box strong {
      display: inline-block;
      width: 120px;
      color: #2d3748;
    }

    .footer {
      margin-top: 35px;
      font-size: 13px;
      color: #a0aec0;
    }

    .footer a {
      color: #667eea;
      text-decoration: none;
    }

    @media only screen and (max-width: 480px) {
      .email-container {
        padding: 20px 20px;
      }
      h2 {
        font-size: 24px;
      }
    }
  </style>
</head>

<body>
  <div class="email-wrapper">
    <div class="email-container">
      <h2>Selamat, <?php echo e($pendaftaran->user->name); ?>! 🎉</h2>
      <p>Anda telah <strong>diterima</strong> untuk program magang di <strong>DPRD Kota Tegal</strong>.</p>

      <div class="info-box">
        <p><strong>Judul:</strong> <?php echo e($pendaftaran->lowongan->judul ?? '-'); ?></p>
        <p><strong>Lokasi:</strong> Sekretariat DPRD Kota Tegal</p>
        <p><strong>Temui:</strong> Bapak Turino, SH (Lantai 3 - Bagian Umum)</p>
        <p><strong>Jadwal Hadir:</strong> <?php echo e($start->translatedFormat('l, d F Y')); ?> s.d. <?php echo e($end->translatedFormat('l, d F Y')); ?></p>
      </div>

      <p class="text-danger" style="color: #e53e3e; font-weight: 600; margin-top: 25px;">
        ⚠ Harap hadir sesuai jadwal. Jika tidak hadir, kesempatan akan <strong>hangus</strong>.
      </p>

      <p class="footer">
        Email ini dikirim otomatis oleh sistem magang DPRD. Jika Anda merasa tidak pernah mendaftar, abaikan saja email ini.
      </p>
    </div>
  </div>
</body>

</html>
<?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/emails/magang_diterima.blade.php ENDPATH**/ ?>