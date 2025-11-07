<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library-Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
    .navbar-brand span { color: #0d6efd; font-weight: 700; }

    /* --- Navbar --- */
    .navbar { padding: 0.8rem 0; }
    .search-form {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
    }
    .search-form select {
      border-radius: 8px;
      padding: 6px 10px;
      border: 1px solid #ccc;
      background-color: #f8f8f8;
    }
    .search-form input {
      width: 50%;
      border-radius: 20px;
      padding: 6px 14px;
      border: 1px solid #ccc;
    }

    /* --- Banner --- */
    .banner {
      background: linear-gradient(90deg, #0d1b4c, #2d4db0);
      color: white;
      border-radius: 12px;
      padding: 45px 30px;
      margin-top: 30px;
    }
    .banner h2 { font-weight: 700; font-size: 2rem; margin-bottom: 10px; }
    .banner p { font-size: 0.95rem; opacity: 0.9; margin-bottom: 20px; }
    .banner .btn {
      font-weight: 600;
      border-radius: 8px;
      padding: 8px 18px;
    }
    .banner .btn-light {
      background-color: #fff;
      color: #0d1b4c;
      border: none;
    }
    .banner .btn-outline {
      border: 1px solid #fff;
      color: #fff;
      background: transparent;
    }

    /* --- Section Header --- */
    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 2rem;
      margin-bottom: .75rem;
    }

    /* --- Tombol Pengelolaan --- */
    .btn-manage {
      background: #000;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 0.9rem;
      padding: 6px 10px;
      transition: 0.2s;
    }
    .btn-manage:hover { background: #0d6efd; }

    /* --- Buku Card --- */
    .book-card {
      border: none;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,.05);
      transition: transform 0.2s ease;
      position: relative;
    }
    .book-card:hover { transform: translateY(-4px); }
    .book-thumb {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 8px;
    }
    .price { color:#0d6efd; font-weight:600; }

    /* --- Label Listing Type --- */
    .listing-badge {
      position: absolute;
      top: 8px;
      left: 8px;
      background: #0d6efd;
      color: #fff;
      font-size: 0.7rem;
      font-weight: 600;
      padding: 3px 8px;
      border-radius: 6px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .listing-badge.sell { background: #198754; }
    .listing-badge.exchange { background: #0d6efd; }

    .footer {
      margin-top: 60px;
      text-align: center;
      padding: 20px 0;
      border-top: 1px solid #ddd;
      color: #777;
    }

    @media (max-width: 768px) {
      .book-thumb { height: 180px; }
      .search-form input { width: 70%; }
    }

     /* --- Logout CTA (bawah) --- */
    .logout-cta { margin-top: 48px; }
    .btn-logout-pro {
      border: none;
      padding: 12px 18px;
      border-radius: 14px;
      background: linear-gradient(135deg, #ff4d4f, #d9363e);
      color: #fff;
      box-shadow: 0 8px 20px rgba(217,54,62,0.25);
      transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
    }
    .btn-logout-pro:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 26px rgba(217,54,62,0.35);
      filter: brightness(1.05);
      color: #fff;
    }
    .btn-logout-pro:active {
      transform: translateY(0);
      box-shadow: 0 6px 16px rgba(217,54,62,0.25);
    }
    .btn-logout-pro i { margin-right: 8px; }
    .logout-card {
      border: 1px solid rgba(0,0,0,.06);
      border-radius: 16px;
      background: #fff;
      box-shadow: 0 6px 18px rgba(0,0,0,.06);
    }
    .logout-subtext { color:#6c757d; font-size:.925rem; }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="/homepage">Library-<span>Hub</span></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <form class="search-form mx-auto" role="search" action="{{ route('homepage') }}" method="GET">
          <select name="kategori">
            <option value="">Kategori</option>
            <option value="humor">Humor & Comedy</option>
            <option value="history">History</option>
            <option value="romance">Romance</option>
          </select>
          <input class="form-control" type="search" name="q" value="{{ $q ?? '' }}" placeholder="Cari Buku...">
        </form>

        <div class="d-flex align-items-center ms-3">
          <a href="/forumdiscuss" class="text-dark me-3"><i class="bi bi-chat-dots fs-5"></i></a>
          <a href="{{ route('profil_user') }}" class="text-dark">
            <i class="bi bi-person-circle fs-5"></i>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Banner -->
  <div class="container">
    <div class="banner mt-4">
      <h2>WELCOME TO LIBRARY-HUB</h2>
      <p>"The only thing that you absolutely have to know, is the location of the library."</p>
      <a href="#" class="btn btn-light">SHOP NOW</a>
      <a href="#" class="btn btn-outline ms-2">@LIBRARY-HUB</a>
    </div>
  </div>

  <!-- Sections -->
  <div class="container mt-4">

    <!-- + Pengelolaan -->
    <div class="text-end mb-3">
      <a href="/pengelolaan" class="flex-end mb-3">
        <button class="btn-manage"> Pengelolaan</button>
      </a>
    </div>

    <!-- Humor & Comedy -->
    <div class="section-header">
      <h5 class="fw-semibold">Humor & Komedi</h5>
    </div>

    <div class="row g-3">
      @forelse ($booksHumor as $b)
        <div class="col-6 col-md-4 col-lg-2">
          <div class="card book-card h-100 position-relative">
            <a href="{{ route('buku.show', $b->id_buku) }}" class="text-decoration-none text-dark">
              
              {{-- 🔹 Label Listing Type --}}
              @php $types = explode(',', $b->listing_type ?? ''); @endphp
              <div class="position-absolute d-flex flex-column gap-1" style="top:8px; left:8px;">
                @foreach ($types as $type)
                  @if (trim($type) === 'sell')
                    <span class="listing-badge sell">Sell</span>
                  @elseif (trim($type) === 'exchange')
                    <span class="listing-badge exchange">Exchange</span>
                  @endif
                @endforeach
              </div>

              <div class="card-body text-center">
                @if($b->cover_image)
                  <img src="{{ asset('storage/' . $b->cover_image) }}" alt="cover" class="book-thumb mb-2">
                @else
                  <div class="py-5 bg-light rounded mb-2">📘</div>
                @endif
                <h6 class="fw-semibold text-truncate" title="{{ $b->title }}">{{ $b->title }}</h6>
                <div class="text-muted small">{{ $b->author }}</div>
                <div class="price mt-1">Rp {{ number_format($b->harga,0,',','.') }}</div>
              </div>
            </a>
          </div>
        </div>
      @empty
        <div class="col-12"><p class="text-muted">Belum ada buku kategori ini.</p></div>
      @endforelse
    </div>

    <!-- History -->
    <div class="section-header mt-5">
      <h5 class="fw-semibold">Sejarah</h5>
    </div>

    <div class="row g-3">
      @forelse ($booksHistory as $b)
        <div class="col-6 col-md-4 col-lg-2">
          <div class="card book-card h-100 position-relative">
            <a href="{{ route('buku.show', $b->id_buku) }}" class="text-decoration-none text-dark">

              {{-- 🔹 Label Listing Type --}}
              @php $types = explode(',', $b->listing_type ?? ''); @endphp
              <div class="position-absolute d-flex flex-column gap-1" style="top:8px; left:8px;">
                @foreach ($types as $type)
                  @if (trim($type) === 'sell')
                    <span class="listing-badge sell">Sell</span>
                  @elseif (trim($type) === 'exchange')
                    <span class="listing-badge exchange">Exchange</span>
                  @endif
                @endforeach
              </div>

              <div class="card-body text-center">
                @if($b->cover_image)
                  <img src="{{ asset('storage/' . $b->cover_image) }}" alt="cover" class="book-thumb mb-2">
                @else
                  <div class="py-5 bg-light rounded mb-2">📘</div>
                @endif
                <h6 class="fw-semibold text-truncate">{{ $b->title }}</h6>
                <div class="text-muted small">{{ $b->author }}</div>
                <div class="price mt-1">Rp {{ number_format($b->harga,0,',','.') }}</div>
              </div>
            </a>
          </div>
        </div>
      @empty
        <div class="col-12"><p class="text-muted">Belum ada buku kategori ini.</p></div>
      @endforelse
    </div>

    <!-- Recommendations -->
    <div class="section-header mt-5">
      <h5 class="fw-semibold">Rekomendasi</h5>
      <a href="#" class="text-decoration-none small text-primary">Lihat Selengkapnya...</a>
    </div>

    <div class="row g-3">
      @forelse ($booksRecs as $b)
        <div class="col-6 col-md-4 col-lg-2">
          <div class="card book-card h-100 position-relative">
            <a href="{{ route('buku.show', $b->id_buku) }}" class="text-decoration-none text-dark">

              {{-- 🔹 Label Listing Type --}}
              @php $types = explode(',', $b->listing_type ?? ''); @endphp
              <div class="position-absolute d-flex flex-column gap-1" style="top:8px; left:8px;">
                @foreach ($types as $type)
                  @if (trim($type) === 'sell')
                    <span class="listing-badge sell">Sell</span>
                  @elseif (trim($type) === 'exchange')
                    <span class="listing-badge exchange">Exchange</span>
                  @endif
                @endforeach
              </div>

              <div class="card-body text-center">
                @if($b->cover_image)
                  <img src="{{ asset('storage/' . $b->cover_image) }}" alt="cover" class="book-thumb mb-2">
                @else
                  <div class="py-5 bg-light rounded mb-2">📕</div>
                @endif
                <h6 class="fw-semibold text-truncate">{{ $b->title }}</h6>
                <div class="text-muted small">{{ $b->author }}</div>
                <div class="price mt-1">Rp {{ number_format($b->harga,0,',','.') }}</div>
              </div>
            </a>
          </div>
        </div>
      @empty
        <div class="col-12"><p class="text-muted">Belum ada rekomendasi.</p></div>
      @endforelse
    </div>
  </div>

  <!-- Logout -->
  <div class="container logout-cta">
    <div class="logout-card p-4 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
      <div>
        <div class="fw-semibold">Selesai berkunjung?</div>
        <div class="logout-subtext">Klik tombol di kanan untuk keluar dengan aman.</div>
      </div>
      <form action="{{ route('logout') }}" method="POST" class="m-0">
        @csrf
        <button type="submit" class="btn btn-logout-pro">
          <i class="bi bi-box-arrow-right"></i>Keluar
        </button>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    <p>© 2025 Library-Hub</p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
