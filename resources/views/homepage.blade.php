<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library-Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                Library-<span>Hub</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex ms-auto me-3" role="search">
                    <input class="form-control" type="search" placeholder="Cari Buku">
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Swapbook</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">My Collection</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-cart"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-person-circle"></i></a></li>
                </ul>
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

    <!-- Book Categories -->
    <div class="container mt-5">
        <h4 class="mb-3 fw-semibold">Humor & Comedy</h4>
        <div class="row g-3">
            <!-- Placeholder for Books -->
            @for ($i = 0; $i < 4; $i++)
            <div class="col-md-3">
                <div class="card book-card">
                    <div class="card-body text-center">
                        <div class="bg-light p-5 rounded mb-2">📘</div>
                        <h6 class="fw-semibold">Judul Buku</h6>
                        <p class="text-muted mb-0">Rp. 99.000,00</p>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <h4 class="mb-3 mt-5 fw-semibold">History</h4>
        <div class="row g-3">
            @for ($i = 0; $i < 6; $i++)
            <div class="col-md-2">
                <div class="card book-card">
                    <div class="card-body text-center">
                        <div class="bg-light p-4 rounded mb-2">📗</div>
                        <h6 class="fw-semibold">Judul Buku</h6>
                        <p class="text-muted mb-0">Rp. 99.000,00</p>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <h4 class="mb-3 mt-5 fw-semibold">Recommendations</h4>
        <div class="row g-3">
            @for ($i = 0; $i < 5; $i++)
            <div class="col-md-2">
                <div class="card book-card">
                    <div class="card-body text-center">
                        <div class="bg-light p-4 rounded mb-2">📕</div>
                        <h6 class="fw-semibold">Judul Buku</h6>
                        <p class="text-muted mb-0">Rp. 99.000,00</p>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 Library-Hub</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
