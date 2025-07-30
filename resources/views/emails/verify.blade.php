<!DOCTYPE html>
<html lang="id" >

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Verifikasi Email Anda</title>
  <style>
    /* Reset dan font */
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
      margin: 0 0 25px 0;
      color: #4a5568;
    }

    a.button {
      display: inline-block;
      background: linear-gradient(90deg, #667eea, #764ba2);
      color: #fff !important;
      font-weight: 600;
      text-decoration: none;
      padding: 14px 30px;
      border-radius: 30px;
      font-size: 18px;
      transition: background 0.3s ease;
      box-shadow: 0 8px 15px rgba(102, 126, 234, 0.4);
    }

    a.button:hover {
      background: linear-gradient(90deg, #5a67d8, #6b46c1);
      box-shadow: 0 10px 20px rgba(107, 70, 193, 0.6);
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

    /* Responsif */
    @media only screen and (max-width: 480px) {
      .email-container {
        padding: 20px 20px;
      }
      h2 {
        font-size: 24px;
      }
      a.button {
        font-size: 16px;
        padding: 12px 25px;
      }
    }
  </style>
</head>

<body>
  <div class="email-wrapper">
    <div class="email-container">
      <h2>Terima kasih sudah mendaftar di platform kami! </h2>
      <p>Silakan klik tombol di bawah ini untuk memverifikasi email Anda dan mengaktifkan akun.</p>
      <a href="{{ $url }}" class="button" target="_blank" rel="noopener noreferrer">Verifikasi Email Saya</a>
      <p class="footer">Jika Anda tidak merasa melakukan pendaftaran ini, silakan abaikan email ini atau <a href="mailto:support@example.com">hubungi kami</a>.</p>
    </div>
  </div>
</body>

</html>
