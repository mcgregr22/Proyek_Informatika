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
        .banner { background: linear-gradient(90deg, #001f54, #003f88); color: white; border-radius: 12px; padding: 40px 20px; margin-top: 30px; }
        .banner h2 { font-weight: 700; }
        .book-card { border: none; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1); transition: transform 0.2s ease; height: 100%; }
        .book-card:hover { transform: translateY(-5px); }
        .book-thumb { width: 90%; height: 120px; object-fit: cover; border-radius: 8px; }
        .footer { margin-top: 60px; text-align: center; padding: 20px 0; border-top: 1px solid #ddd; color: #777; }
        .navbar-icon { font-size: 1.2rem; margin-left: 15px; color: #333; transition: color 0.2s; }
        .navbar-icon:hover { color: #0d6efd; }
        .section-title { margin-top: 2rem; margin-bottom: .75rem; font-weight: 600; }
        .price { color:#0d6efd; font-weight:600; }
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
                <!-- Dropdown Kategori (statis, opsional) -->
                <ul class="navbar-nav ms-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                            Kategori
                        </a>
                        <ul class="dropdown-menu">
                            <li><span class="dropdown-item-text text-muted">Pilih di halaman khusus</span></li>
                        </ul>
                    </li>
                </ul>

                <!-- Search ke controller -->
                <form class="d-flex ms-auto me-3" role="search" action="{{ route('homepage') }}" method="GET">
                    <input class="form-control" type="search" name="q" value="{{ $q ?? '' }}" placeholder="Cari Buku (judul/penulis/ISBN)">
                </form>

                <!-- Menu kanan -->
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link fw-semibold" href="/swapbook">Swapbook</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="/mycollection">My Collection</a></li>
                </ul>

                <!-- 3 Icon Kanan -->
                <div class="d-flex align-items-center ms-3">
                    <a href="/keranjang" class="navbar-icon"><i class="bi bi-cart"></i></a>
                    <a href="/forumdiscuss" class="navbar-icon"><i class="bi bi-chat-dots"></i></a>
                    <form action="{{ route('logout') }}" method="POST" class="ms-2">
                        @csrf
                        <button class="btn btn-sm btn-outline-secondary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="container">
        <div class="banner text-center mt-4">
            <h2>WELCOME TO LIBRARY-HUB</h2>
            <p>"The only thing that you absolutely have to know, is the location of the library."</p>
            <a href="#" class="btn btn-light btn-sm mt-3">SHOP NOW</a>
        </div>
    </div>

    <!-- Sections -->
    <div class="container mt-4">

        {{-- HUMOR & COMEDY --}}
        <h4 class="section-title">Humor & Comedy</h4>
        <div class="row g-3">
            @forelse ($booksHumor as $b)
            <div class="col-6 col-md-3">
                <div class="card book-card">
                    <div class="card-body text-center">
                        <div class="bg-light p-2 rounded mb-2">
                            @if($b->cover_image)
                                <img src="{{ $b->cover_image }}" class="book-thumb" alt="cover">
                            @else
                                <div class="py-5">📘</div>
                            @endif
                        </div>
                        <h6 class="fw-semibold text-truncate" title="{{ $b->title }}">{{ $b->title }}</h6>
                        <div class="text-muted small">{{ $b->author }}</div>
                        <div class="price mt-1">Rp {{ number_format($b->harga,0,',','.') }}</div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12"><p class="text-muted">Belum ada buku kategori ini.</p></div>
            @endforelse
        </div>

        {{-- HISTORY --}}
        <h4 class="section-title">History</h4>
        <div class="row g-3">
            @forelse ($booksHistory as $b)
            <div class="col-6 col-md-2">
                <div class="card book-card">
                    <div class="card-body text-center">
                        <div class="bg-light p-2 rounded mb-2">
                            @if($b->cover_image)
                                <img src="{{ $b->cover_image }}" class="book-thumb" alt="cover">
                            @else
                                <div class="py-4">📗</div>
                            @endif
                        </div>
                        <h6 class="fw-semibold text-truncate" title="{{ $b->title }}">{{ $b->title }}</h6>
                        <div class="text-muted small">{{ $b->author }}</div>
                        <div class="text-muted small">ISBN: {{ $b->isbn }}</div>
                        <div class="price mt-1">Rp {{ number_format($b->harga,0,',','.') }}</div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12"><p class="text-muted">Belum ada buku kategori ini.</p></div>
            @endforelse
        </div>

        {{-- RECOMMENDATIONS --}}
        <h4 class="section-title">Recommendations</h4>
        <div class="row g-3">
            @forelse ($booksRecs as $b)
            <div class="col-6 col-md-2">
                <div class="card book-card">
                    <div class="card-body text-center">
                        <div class="bg-light p-2 rounded mb-2">
                            @if($b->cover_image)
                                <img src="{{ $b->cover_image }}" class="book-thumb" alt="cover">
                            @else
                                <div class="py-4">📕</div>
                            @endif
                        </div>
                        <h6 class="fw-semibold text-truncate" title="{{ $b->title }}">{{ $b->title }}</h6>
                        <div class="text-muted small">{{ $b->author }}</div>
                        <div class="price mt-1">Rp {{ number_format($b->harga,0,',','.') }}</div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12"><p class="text-muted">Belum ada rekomendasi.</p></div>
            @endforelse
        </div>

        {{-- Flash success minimal --}}
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 Library-Hub</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
