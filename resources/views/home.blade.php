<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Hub</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: #6176da;          /* Warna sesuai logo */
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;            /* Supaya bisa diberi margin top */
      padding-top: 300px;                 /* Jarak logo dari atas */
    }

    .container {
      text-align: center;
      color: #fff;
    }

    /* Logo */
    .logo img {
      width: 360px;                       /* Sesuaikan ukuran logo */
      height: auto;
      display: block;
      margin: 0 auto 100px;                /* Jarak bawah logo */
    }

    /* Tombol */
    .buttons {
      margin-top: 20px;
    }

    .btn {
      display: inline-block;
      padding: 12px 30px;
      margin: 0 10px;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;              /* Hilangkan underline untuk <a> */
      transition: background-color 0.3s ease, opacity 0.3s ease;
    }

    .btn-masuk {
      background-color: #ffffff;
      color: #273c75;
    }

    .btn-daftar {
      background-color: #273c75;
      color: #ffffff;
    }

    .btn:hover {
      opacity: 0.9;
    }

    /* Responsif */
    @media (max-width: 480px) {
      .logo img {
        width: 200px;
      }
      .btn {
        margin: 8px 0;
        width: 120px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Logo -->
    <div class="logo">
    <img src="{{ asset('images/Logo2.png') }}" alt="Logo Library Hub">

    <!-- Tombol -->
    <div class="buttons">
      <a href="/login" class="btn btn-masuk">Masuk</a>
      <a href="/register" class="btn btn-daftar">Daftar</a>
    </div>
  </div>
</body>
</html>
