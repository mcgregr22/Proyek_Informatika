<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library-Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .navbar-brand span {
            color: #0d6efd;
            font-weight: 700;
        }
        .banner {
            background: linear-gradient(90deg, #001f54, #003f88);
            color: white;
            border-radius: 12px;
            padding: 40px 20px;
            margin-top: 30px;
        }
        .banner h2 {
            font-weight: 700;
        }
        .book-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }
        .book-card:hover {
            transform: translateY(-5px);
        }
        .footer {
            margin-top: 60px;
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #ddd;
            color: #777;
        }
        .navbar-icon {
            font-size: 1.2rem;
            margin-left: 15px;
            color: #333;
            transition: color 0.2s;
        }
        .navbar-icon:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="homepage">
                Library-<span>Hub</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Dropdown Kategori -->
                <ul class="navbar-nav ms-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                            Kategori
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Humor & Comedy</a></li>
                            <li><a class="dropdown-item" href="#">History</a></li>
                            <li><a class="dropdown-item" href="#">Science & Tech</a></li>
                            <li><a class="dropdown-item" href="#">Fiction</a></li>
                            <li><a class="dropdown-item" href="#">Romance</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Search -->
                <form class="d-flex ms-auto me-3" role="search">
                    <input class="form-control" type="search" placeholder="Cari Buku">
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
                    <a href="#" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
                </div>
            </div>
        </div>
    </nav>

<!-- CONTAINER -->
<div class="container my-5">
    <h4 class="fw-semibold mb-4">Koleksi Buku</h4>

    <!-- Grid Buku -->
    <div class="row g-4">
        <!-- Buku 1 -->
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card position-relative">
                <a href="{{ url('/remove/1') }}" class="position-absolute top-0 end-0 text-decoration-none text-dark fw-bold fs-4 me-2 mt-1">&times;</a>
                <img src="{{ asset('images/bumi.jpg') }}" class="card-img-top rounded-top" alt="Buku Bumi">
                <div class="card-body text-center">
                    <h6 class="mb-0">Tere Liye</h6>
                    <small class="text-muted">Bumi</small>
                </div>
            </div>
        </div>

        <!-- Buku 2 -->
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card position-relative">
                <a href="{{ url('/remove/2') }}" class="position-absolute top-0 end-0 text-decoration-none text-dark fw-bold fs-4 me-2 mt-1">&times;</a>
                <img src="{{ asset('images/filosofi_teras.jpg') }}" class="card-img-top rounded-top" alt="Filosofi Teras">
                <div class="card-body text-center">
                    <h6 class="mb-0">Henry Manampiring</h6>
                    <small class="text-muted">Filosofi Teras</small>
                </div>
            </div>
        </div>

        <!-- Buku 3 -->
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card position-relative">
                <a href="{{ url('/remove/3') }}" class="position-absolute top-0 end-0 text-decoration-none text-dark fw-bold fs-4 me-2 mt-1">&times;</a>
                <img src="{{ asset('images/laut_bercerita.jpg') }}" class="card-img-top rounded-top" alt="Laut Bercerita">
                <div class="card-body text-center">
                    <h6 class="mb-0">Leila S. Chudori</h6>
                    <small class="text-muted">Laut Bercerita</small>
                </div>
            </div>
        </div>

        <!-- Buku 4 (contoh tambahan) -->
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card position-relative">
                <a href="{{ url('/remove/4') }}" class="position-absolute top-0 end-0 text-decoration-none text-dark fw-bold fs-4 me-2 mt-1">&times;</a>
                <img src="{{ asset('images/hujan.jpg') }}" class="card-img-top rounded-top" alt="Hujan">
                <div class="card-body text-center">
                    <h6 class="mb-0">Tere Liye</h6>
                    <small class="text-muted">Hujan</small>
                </div>
            </div>
        </div>
    </div>
</div>
