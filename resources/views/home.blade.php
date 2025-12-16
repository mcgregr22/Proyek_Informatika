<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Library Hub - Marketplace buku peer-to-peer terpercaya. Jual dan beli eBook dari user lainnya dengan mudah. Temukan ribuan buku digital di berbagai kategori.">
  <title>Library Hub - Marketplace Buku Peer-to-Peer</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background: #f4f6ff;
      color: #333;
      line-height: 1.6;
    }

    /* NAVBAR */
    nav {
      width: 100%;
      padding: 20px 6%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #ffffff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    nav .logo {
      font-size: 22px;
      font-weight: 700;
      color: #060607;
    }

    nav .logo1 {
      font-size: 22px;
      font-weight: 700;
      color: #6176da;
    }

    nav ul {
      display: flex;
      gap: 30px;
      list-style: none;
    }

    nav ul li a {
      text-decoration: none;
      font-weight: 500;
      color: #333;
      transition: 0.2s;
    }

    nav ul li a:hover {
      color: #6176da;
    }

    /* Hamburger Menu untuk Mobile */
    .hamburger {
      display: none;
      flex-direction: column;
      cursor: pointer;
    }

    .hamburger span {
      width: 25px;
      height: 3px;
      background: #333;
      margin: 3px 0;
      transition: 0.3s;
    }

    /* HERO SECTION */
    .hero {
      width: 100%;
      padding: 100px 10%;
      background: linear-gradient(90deg, #6176da, #3f54c5, #2c3ea4);
      color: white;
      text-align: center;
    }

    .hero h1 {
      font-size: 48px;
      line-height: 1.3;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 18px;
      max-width: 600px;
      margin: 0 auto 30px;
      opacity: 0.95;
    }

    .hero-buttons {
      display: flex;
      gap: 15px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .hero-buttons a {
      padding: 15px 30px;
      background: white;
      color: #273c75;
      text-decoration: none;
      font-weight: 600;
      border-radius: 8px;
      transition: 0.25s;
    }

    .hero-buttons a:hover {
      opacity: 0.85;
      transform: translateY(-2px);
    }

    /* FEATURED BOOKS */
    .featured {
      padding: 80px 10%;
      text-align: center;
    }

    .featured h2 {
      font-size: 32px;
      color: #273c75;
      margin-bottom: 40px;
    }

    .book-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 30px;
    }

    .book-item {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      padding: 20px;
      transition: transform 0.3s;
    }

    .book-item:hover {
      transform: translateY(-5px);
    }

    .book-item img {
  width: 100%;
  height: 250px;
  object-fit: contain;   /* gambar tampil full tanpa cropping */
  background: #fff;      /* beri background putih biar rapi */
  border-radius: 5px;
  margin-bottom: 15px;
  padding: 5px;          /* memberi jarak agar tidak mepet */
}

    .book-item h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .book-item p {
      font-size: 14px;
      color: #666;
      margin-bottom: 15px;
    }

    .book-item a {
      display: inline-block;
      padding: 8px 15px;
      background: #6176da;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: 500;
      transition: 0.3s;
    }

    .book-item a:hover {
      background: #3f54c5;
    }

    /* CATEGORIES */
    .categories {
      padding: 80px 10%;
      background: #ffffff;
      text-align: center;
    }

    .categories h2 {
      font-size: 32px;
      color: #273c75;
      margin-bottom: 40px;
    }

    .cat-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 20px;
    }

    .cat-item {
      padding: 20px;
      background: #f4f6ff;
      border-radius: 10px;
      transition: 0.3s;
    }

    .cat-item:hover {
      background: #6176da;
      color: white;
    }

    .cat-item i {
      font-size: 40px;
      margin-bottom: 10px;
    }

    .cat-item h3 {
      font-size: 18px;
    }

    /* HOW IT WORKS */
    .how-it-works {
      padding: 80px 10%;
      text-align: center;
    }

    .how-it-works h2 {
      font-size: 32px;
      color: #273c75;
      margin-bottom: 40px;
    }

    .steps {
      display: flex;
      gap: 40px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .step {
      max-width: 250px;
    }

    .step i {
      font-size: 50px;
      color: #6176da;
      margin-bottom: 15px;
    }

    .step h3 {
      font-size: 20px;
      margin-bottom: 10px;
    }

    /* HOW TO EXCHANGE BOOKS (Tambahan Baru) */
    .exchange {
      padding: 80px 10%;
      background: #ffffff;
      text-align: center;
    }

    .exchange h2 {
      font-size: 32px;
      color: #273c75;
      margin-bottom: 40px;
    }

    .exchange-steps {
      display: flex;
      gap: 40px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .exchange-step {
      max-width: 250px;
      background: #f4f6ff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }

    .exchange-step:hover {
      transform: translateY(-5px);
    }

    .exchange-step i {
      font-size: 50px;
      color: #6176da;
      margin-bottom: 15px;
    }

    .exchange-step h3 {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .exchange-step p {
      font-size: 14px;
      color: #666;
    }

    /* TESTIMONIALS */
    .testimonials {
      padding: 80px 10%;
      background: #f9f9f9;
      text-align: center;
    }

    .testimonials h2 {
      font-size: 32px;
      color: #273c75;
      margin-bottom: 40px;
    }

    .testimonial {
      margin: 20px 0;
      font-style: italic;
      font-size: 16px;
    }

    /* FOOTER */
    footer {
      background: #273c75;
      color: white;
      padding: 40px 10%;
      text-align: center;
    }

    footer .social-icons {
      margin: 20px 0;
    }

    footer .social-icons a {
      color: white;
      margin: 0 10px;
      font-size: 20px;
      transition: 0.3s;
    }

    footer .social-icons a:hover {
      color: #6176da;
    }

    /* RESPONSIVE */
    @media (max-width: 900px) {
      .hero h1 {
        font-size: 36px;
      }

      .steps, .exchange-steps {
        flex-direction: column;
      }

      nav ul {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 60px;
        right: 6%;
        background: white;
        width: 200px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
      }

      nav ul.active {
        display: flex;
      }

      .hamburger {
        display: flex;
      }
    }
  </style>
</head>

<body>

  <!-- NAVBAR -->
  <nav>
    <a href="/homepage" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
      <div style="display: flex; gap: 3px; align-items: center; font-size: 22px; font-weight: 700;">
        <span style="color:#060607;">Library-</span>
        <span style="color:#6176da;">Hub</span>
      </div>
    </a>

    <ul id="nav-menu">
      <li><a href="/beranda">Beranda</a></li>
      <li><a href="/kontak">Kontak</a></li>
      <li><a href="/login">Masuk</a></li>
      <li><a href="/register">Daftar</a></li>
    </ul>

    <div class="hamburger" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <h1>Temukan dan Jual Buku Impian Anda</h1>
    <p>
      Di Library Hub, marketplace peer-to-peer terpercaya, jual dan beli eBook dari ribuan user lainnya. Dari fiksi hingga pengembangan diri, semua ada di sini!
    </p>
    <div class="hero-buttons">
      <a href="/login">Jelajahi Buku</a>
      <a href="/login">Jual Buku Anda</a>
      <a href="/login">Tukar Buku Anda</a>
    </div>
  </section>

  <!-- FEATURED BOOKS -->
  <section class="featured">
    <h2>Beberapa buku yang ada di Library-Hub</h2>

    <div class="book-grid">
      @forelse($featuredBooks as $book)
        <div class="book-item">

          <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-book.png') }}" />

          <h3>{{ $book->title }}</h3>
          <p>Harga: Rp{{ number_format($book->harga, 0, ',', '.') }} | Dijual oleh: {{ $book->user->name ?? 'User' }}</p>
          <a href="{{ route('login.show') }}">Lihat Detail</a>
        </div>
      @empty
        <p>Tidak ada buku tersedia saat ini.</p>
      @endforelse
    </div>

  </section>

  <!-- CATEGORIES -->
  <section class="categories">
    <h2>Jelajahi Kategori</h2>
    <div class="cat-grid">
      <div class="cat-item"><i class="fas fa-book"></i><h3>Fiksi</h3></div>
      <div class="cat-item"><i class="fas fa-brain"></i><h3>Pengembangan Diri</h3></div>
      <div class="cat-item"><i class="fas fa-briefcase"></i><h3>Bisnis</h3></div>
      <div class="cat-item"><i class="fas fa-heart"></i><h3>Romansa</h3></div>
      <div class="cat-item"><i class="fas fa-flask"></i><h3>Sains</h3></div>
      <div class="cat-item"><i class="fas fa-history"></i><h3>Sejarah</h3></div>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section class="how-it-works">
    <h2>Cara Kerja Library Hub</h2>
    <div class="steps">
      <div class="step"><i class="fas fa-upload"></i><h3>1. Unggah Buku</h3><p>Unggah detail buku dan harga.</p></div>
      <div class="step"><i class="fas fa-search"></i><h3>2. Cari & Beli</h3><p>Cari buku dan beli dengan aman.</p></div>
      <div class="step"><i class="fas fa-handshake"></i><h3>3. Transaksi Aman</h3><p>Proses pembayaran aman.</p></div>
    </div>
  </section>

  <!-- EXCHANGE -->
  <section class="exchange">
    <h2>Cara Tukar Buku</h2>
    <div class="exchange-steps">
      <div class="exchange-step"><i class="fas fa-plus-circle"></i><h3>1. Tambahkan Buku</h3><p>Unggah buku untuk ditukar.</p></div>
      <div class="exchange-step"><i class="fas fa-search"></i><h3>2. Cari Buku Tukar</h3><p>Jelajahi daftar buku yang tersedia.</p></div>
      <div class="exchange-step"><i class="fas fa-arrows-rotate"></i><h3>3. Tukar Buku</h3><p>Setujui pertukaran dan proses selesai.</p></div>
    </div>
  </section>

</body>
</html>
