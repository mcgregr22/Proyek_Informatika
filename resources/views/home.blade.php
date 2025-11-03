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
      background-color: #6176da;   /* Warna sesuai logo */
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;         /* Posisikan di tengah vertikal */
    }

    .container {
      text-align: center;
      color: #fff;
    }

    /* Logo */
    .logo img {
      width: 220px;                /* Ukuran lebih kecil dan proporsional */
      height: auto;
      display: block;
      margin: 0 auto 50px;         /* Jarak bawah logo */
    }

    /* Tombol */
    .buttons {
      margin-top: 10px;
    }

    .btn {
      display: inline-block;
      padding: 10px 25px;
      margin: 0 8px;
      font-size: 15px;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
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
        width: 160px;
        margin-bottom: 30px;
      }
      .btn {
        display: block;
        width: 120px;
        margin: 8px auto;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Logo -->
    <div class="logo">
      <img src="{{ asset('images/Logo2.png') }}" alt="Logo Library Hub">
    </div>

    <!-- Tombol -->
    <div class="buttons">
      <a href="/login" class="btn btn-masuk">Masuk</a>
      <a href="/register" class="btn btn-daftar">Daftar</a>
    </div>
  </div>
</body>
</html>
