<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <title><?php echo e($subject ?? 'Notifikasi'); ?> - DPRD Kota Tegal</title>
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
                overflow: hidden;
                border: 1px solid #ddd;
            }

            .email-header {
                background-color: #b30000;
                padding: 20px;
                text-align: center;
            }

            .email-header img {
                max-width: 80px;
                margin-bottom: 10px;
            }

            .email-header h2 {
                color: #fff;
                margin: 0;
                font-weight: 600;
            }

            .email-body {
                padding: 30px;
            }

            .email-body h3 {
                margin-top: 0;
                color: #b30000;
            }

            .email-body p {
                line-height: 1.7;
                margin-bottom: 20px;
            }

            .verify-button {
                display: inline-block;
                background-color: #b30000;
                color: white;
                text-decoration: none;
                padding: 12px 24px;
                border-radius: 8px;
                font-weight: 600;
                transition: background-color 0.3s ease;
            }

            .verify-button:hover {
                background-color: #990000;
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
            <div class="email-header">
              <img src="<?php echo e(config('app.url')); ?>/assets/logo.png" alt="Logo DPRD" />
                <h2>DPRD Kota Tegal</h2>
            </div>

            <div class="email-body">
                <h3>
                    <?php echo e(isset($user) ? 'Halo, ' . $user->name : ($greeting ?? 'Halo!')); ?>

                </h3>

                
                <?php if(isset($introLines)): ?>
                    <?php $__currentLoopData = $introLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p><?php echo e($line); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p>Terima kasih telah mendaftar di layanan <strong>DPRD Kota Tegal</strong>.</p>
                    <p>Untuk mengaktifkan akun Anda, silakan klik tombol verifikasi di bawah ini:</p>
                <?php endif; ?>

                
                <?php if(isset($actionUrl)): ?>
                    <div style="text-align: center; margin: 30px 0">
                        <a href="<?php echo e($actionUrl); ?>" class="verify-button">
                            <?php echo e($actionText ?? 'Verifikasi Email'); ?>

                        </a>
                    </div>
                <?php elseif(isset($url)): ?>
                    <div style="text-align: center; margin: 30px 0">
                        <a href="<?php echo e($url); ?>" class="verify-button">
                            <?php echo e($actionText ?? 'Verifikasi Email'); ?>

                        </a>
                    </div>
                <?php endif; ?>

                
                <?php if(isset($outroLines)): ?>
                    <?php $__currentLoopData = $outroLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p><?php echo e($line); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p>Jika Anda tidak merasa melakukan pendaftaran, abaikan email ini.</p>
                <?php endif; ?>
            </div>

            <div class="email-footer">
                &copy; <?php echo e(date('Y')); ?> DPRD Kota Tegal. Semua hak dilindungi.
            </div>
        </div>
    </body>
</html>
<?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/vendor/notifications/email.blade.php ENDPATH**/ ?>