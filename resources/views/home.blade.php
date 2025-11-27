<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Hub</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    * {
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
      color: #060607ff;
      /* Brand blue */
    }

    nav .logo1 {
      font-size: 22px;
      font-weight: 700;
      color: #6176da;
      /* Brand blue */
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

    /* HERO SECTION */
    .hero {
      width: 100%;
      padding: 70px 10%;
      background: linear-gradient(90deg, #6176da, #3f54c5, #2c3ea4);
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 40px;
    }

    .hero-text h1 {
      font-size: 44px;
      line-height: 1.3;
      font-weight: 600;
      max-width: 450px;
    }

    .hero-text p {
      margin: 20px 0;
      font-size: 16px;
      max-width: 480px;
      opacity: 0.95;
    }

    .hero-buttons {
      margin-top: 25px;
    }

    .hero-buttons a {
      padding: 12px 22px;
      background: white;
      color: #273c75;
      /* deep blue button */
      text-decoration: none;
      font-weight: 600;
      border-radius: 8px;
      margin-right: 15px;
      transition: 0.25s;
    }

    .hero-buttons a:hover {
      opacity: 0.85;
    }

    .hero img {
      width: 350px;
      height: auto;
      filter: drop-shadow(0 8px 25px rgba(0, 0, 0, 0.25));
    }

    /* LOOK INSIDE */
    .section {
      width: 100%;
      padding: 80px 10%;
      text-align: center;
    }

    .section h2 {
      font-size: 28px;
      margin-bottom: 15px;
      font-weight: 600;
      color: #273c75;
    }

    .pages {
      display: flex;
      gap: 20px;
      justify-content: center;
      margin-top: 40px;
    }

    .pages img {
      width: 180px;
      border-radius: 5px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* ABOUT AUTHOR */
    .about-section {
      padding: 80px 10%;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px;
      align-items: center;
    }

    .author-photo img {
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .author-info h3 {
      font-size: 26px;
      font-weight: 600;
      margin-bottom: 10px;
      color: #273c75;
    }

    .author-info p {
      margin-bottom: 15px;
    }

    /* MORE BOOKS */
    .gallery {
      padding: 60px 10%;
    }

    .gallery h2 {
      text-align: center;
      margin-bottom: 40px;
      font-size: 26px;
      color: #273c75;
    }

    .gallery-items {
      display: flex;
      gap: 25px;
      justify-content: center;
    }

    .gallery-items img {
      width: 140px;
      border-radius: 6px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border: 2px solid #6176da22;
    }

    /* RESPONSIVE */
    @media (max-width: 900px) {
      .hero {
        flex-direction: column;
        text-align: center;
      }

      .about-section {
        grid-template-columns: 1fr;
        text-align: center;
      }

      .hero img {
        width: 260px;
      }

      nav ul {
        display: none;
      }
    }
  </style>
</head>

<body>

  <!-- NAVBAR -->
  <nav>
    <a href="/homepage" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">

      <!-- TEXT LOGO -->
      <div style="display: flex; gap: 3px; align-items: center; font-size: 22px; font-weight: 700;">
        <span style="color:#060607;">Library-</span>
        <span style="color:#6176da;">Hub</span>
      </div>

    </a>

    <ul>
      <li><a href="/beranda">Beranda</a></li>
      <li><a href="/kontak">Kontak</a></li>
      <li><a href="/login">Masuk</a></li>
      <li><a href="/register">Daftar</a></li>
    </ul>
  </nav>


  <!-- HERO SECTION -->
  <section class="hero">
    <div class="hero-text">
      <h1>How to get rid of Stress and its side effects</h1>
      <p>
        Discover simple yet effective techniques to reduce stress and enhance your well-being.
      </p>

      <div class="hero-buttons">
        <a href="/login">Tukar eBook</a>
        <a href="/login">Beli eBook</a>
      </div>
    </div>

    <img src="{{ asset('images/your-book.png') }}" alt="Book">
  </section>

  <!-- LOOK INSIDE -->
  <section class="section">
    <h2>Look Inside</h2>
    <p>Preview beberapa halaman dari isi buku.</p>

    <div class="pages">
      <img src="{{ asset('images/page1.png') }}">
      <img src="{{ asset('images/page2.png') }}">
      <img src="{{ asset('images/page3.png') }}">
      <img src="{{ asset('images/page4.png') }}">
    </div>
  </section>

  <!-- ABOUT THE AUTHOR -->
  <section class="about-section">
    <div class="author-info">
      <h3>About the Author</h3>
      <p>
        Penulis adalah seorang ahli pengembangan diri dengan pengalaman lebih dari 10 tahun
        dalam memberikan pelatihan mental dan mindset.
      </p>
      <p>
        Buku ini membantu pembaca memahami bagaimana mengelola stres secara efektif
        dan mencapai ketenangan dalam hidup sehari-hari.
      </p>
    </div>

    <div class="author-photo">
      <img src="{{ asset('images/author.jpg') }}" alt="Author">
    </div>
  </section>

  <!-- MORE BOOKS -->
  <div class="gallery">
    <h2>More Books from This Author</h2>
    <div class="gallery-items">
      <img src="{{ asset('images/book1.png') }}">
      <img src="{{ asset('images/book2.png') }}">
      <img src="{{ asset('images/book3.png') }}">
      <img src="{{ asset('images/book4.png') }}">
    </div>
  </div>

</body>

</html>