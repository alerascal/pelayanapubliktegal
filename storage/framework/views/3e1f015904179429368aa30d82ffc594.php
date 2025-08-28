<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <title>Reset Password - DPRD Kota Tegal</title>
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
            rel="stylesheet"
        />
        <style>
            body {
                font-family: "Poppins", sans-serif;
                background-color: #f8f9fa;
                color: #333;
                margin: 0;
                padding: 0;
            }

            .email-container {
                max-width: 600px;
                margin: 40px auto;
                background-color: #ffffff;
                border-radius: 12px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.06);
                border: 1px solid #ddd;
                overflow: hidden;
            }

            .email-header {
                background-color: #b4adad;
                text-align: center;
                padding: 20px;
            }

            .email-header img {
                max-width: 80px;
                margin-bottom: 10px;
            }

            .email-header h2 {
                color: white;
                margin: 0;
                font-weight: 600;
            }

            .email-body {
                padding: 30px;
            }

            .email-body h3 {
                margin-top: 0;
                color: #0f35bd;
            }

            .email-body p {
                line-height: 1.7;
                margin-bottom: 20px;
            }

            .action-button {
                display: inline-block;
                background-color: #0131c0;
                color: white;
                padding: 12px 24px;
                text-decoration: none;
                border-radius: 8px;
                font-weight: 600;
            }

            .email-footer {
                text-align: center;
                font-size: 13px;
                color: #999;
                padding: 20px;
            }
        </style>
    </head>

    <body>
        <div class="email-container">
            <div class="email-body">
                <h3>Halo, <?php echo e($user->name ?? 'Pengguna'); ?></h3>

                <p>
                    Kami menerima permintaan untuk mereset password akun Anda
                    yang terdaftar dengan alamat email
                    <strong><?php echo e($user->email); ?></strong
                    >.
                </p>

                <p>
                    Silakan klik tombol di bawah ini untuk mengatur ulang
                    password Anda:
                </p>

                <div style="text-align: center; margin: 30px 0">
                    <a href="<?php echo e($url); ?>" class="action-button">
                        <?php echo e($actionText ?? "Reset Password"); ?>

                    </a>
                </div>

                <p>
                    Link reset password ini hanya berlaku selama
                    <strong>60 menit</strong>. Setelah itu, Anda perlu meminta
                    ulang jika masih membutuhkan reset.
                </p>

                <p>
                    Jika Anda tidak pernah meminta reset password, Anda dapat
                    mengabaikan email ini. Tidak ada perubahan yang akan
                    dilakukan pada akun Anda.
                </p>

                <p>Terima kasih,</p>
                <p><strong>DPRD Kota Tegal</strong></p>
            </div>

            <div class="email-footer">
                &copy; <?php echo e(date("Y")); ?> DPRD Kota Tegal. Semua hak dilindungi.
            </div>
        </div>
    </body>
</html>
<?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/emails/reset-password.blade.php ENDPATH**/ ?>