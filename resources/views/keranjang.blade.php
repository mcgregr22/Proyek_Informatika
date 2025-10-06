<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang | Library-Hub</title>
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
        .navbar-icon {
            font-size: 1.2rem;
            margin-left: 15px;
            color: #333;
            transition: color 0.2s;
        }
        .navbar-icon:hover {
            color: #0d6efd;
        }
        .empty-cart {
            text-align: center;
            margin-top: 80px;
        }
        .empty-cart img {
            max-width: 280px;
            opacity: 0.9;
        }
        .empty-cart h5 {
            margin-top: 25px;
            font-weight: 600;
            color: #333;
        }
        .empty-cart p {
            color: #777;
        }
        .btn-shop {
            background-color: #0d6efd;
            color: white;
            border-radius: 8px;
            padding: 10px 20px;
            transition: 0.3s;
        }
        .btn-shop:hover {
            background-color: #003f88;
            color: white;
        }
        .summary-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            margin-top: 40px;
            background: white;
            padding: 25px;
        }
        .summary-card h6 {
            font-weight: 600;
        }
        .footer {
            margin-top: 70px;
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #ddd;
            color: #777;
        }
        .btn-checkout {
            width: 100%;
            background-color: #0d6efd;
            color: white;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-checkout:hover {
            background-color: #003f88;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                Library-<span>Hub</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
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

                <form class="d-flex ms-auto me-3" role="search">
                    <input class="form-control" type="search" placeholder="Cari Buku">
                </form>

                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#">Swapbook</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#">My Collection</a></li>
                </ul>

                <div class="d-flex align-items-center ms-3">
                    <a href="#" class="navbar-icon"><i class="bi bi-cart"></i></a>
                    <a href="#" class="navbar-icon"><i class="bi bi-chat-dots"></i></a>
                    <a href="#" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Halaman Keranjang Kosong -->
    <div class="container">
        <div class="empty-cart">
            <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Empty Cart">
            <h5>Keranjang Belanja Kosong</h5>
            <p>Yuk, temukan buku favoritmu dan tambahkan ke keranjang!</p>
            <a href="{{ url('/homepage') }}" class="btn btn-shop mt-3">
    <i class="bi bi-arrow-left"></i> Beranda
</a>

        </div>

        <!-- Ringkasan Pesanan -->
        <div class="summary-card col-md-6 mx-auto mt-5">
            <h6 class="mb-3">Ringkasan Pesanan</h6>
            <div class="d-flex justify-content-between">
                <span>Subtotal (item):</span>
                <strong>Rp0</strong>
            </div>
            <div class="d-flex justify-content-between">
                <span>Pajak (10%):</span>
                <strong>Rp0</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span>Pengiriman:</span>
                <strong>Rp0</strong>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-3">
                <h6>Total:</h6>
                <h6 class="text-primary fw-bold">Rp0</h6>
            </div>
            <button class="btn-checkout">
                Lanjutkan ke Checkout
            </button>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 Library-Hub</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
