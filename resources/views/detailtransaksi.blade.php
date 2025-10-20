<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi | Library-Hub</title>
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
            font-size: 1.3rem;
            margin-left: 15px;
            color: #333;
            transition: color 0.2s;
        }

        .navbar-icon:hover {
            color: #0d6efd;
        }

        .transactions {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 40px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            width: 48%;
            transition: transform 0.2s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100px;
            height: 140px;
            border-radius: 8px;
            object-fit: cover;
        }

        .card-body small {
            color: #6c757d;
        }

        .card-body h5 {
            font-weight: 600;
            margin-top: 5px;
        }

        .price {
            font-weight: 600;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-secondary {
            background-color: #e9ecef;
            color: #333;
            border: none;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #ddd;
            color: #777;
        }

        @media (max-width: 768px) {
            .card {
                width: 100%;
            }
        }
    </style>

    <script>
        function openDetail(url) {
            window.location.href = url;
        }
    </script>
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
                    <li class="nav-item"><a class="nav-link fw-semibold" href="swapbook">Swapbook</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="mycollection">My Collection</a></li>
                </ul>

                <!-- 3 Icon kanan -->
                <div class="d-flex align-items-center ms-3">
                    <a href="/keranjang" class="navbar-icon"><i class="bi bi-cart"></i></a>
                    <a href="/forumdiscuss" class="navbar-icon"><i class="bi bi-chat-dots"></i></a>
                    <a href="/profiladmin" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Riwayat Transaksi -->
    <div class="container mt-5">
        <h4 class="fw-semibold mb-4">Riwayat Transaksi</h4>

        <div class="transactions">
            <!-- Card 1 -->
            <div class="card p-3 d-flex align-items-center" onclick="openDetail('detail.php?id=1')">
                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400" alt="Bumi">
                <div class="card-body ms-3">
                    <small>18/3/2025<br>Tere Liye</small>
                    <h5>Bumi</h5>
                    <div class="price">Rp. 99.000,00</div>
                    <div class="mt-2">
                        <button class="btn btn-secondary btn-sm">Swap Book</button>
                        <button class="btn btn-primary btn-sm">Konfirmasi</button>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card p-3 d-flex align-items-center" onclick="openDetail('detail.php?id=2')">
                <img src="https://images-na.ssl-images-amazon.com/images/I/51Zymoq7UnL._SX379_.jpg" alt="Filosofi Teras">
                <div class="card-body ms-3">
                    <small>18/3/2025<br>Henry Manampiring</small>
                    <h5>Filosofi Teras</h5>
                    <div class="price">Rp. 99.000,00</div>
                    <div class="mt-2">
                        <button class="btn btn-secondary btn-sm" disabled>Selesai</button>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card p-3 d-flex align-items-center" onclick="openDetail('detail.php?id=3')">
                <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=400" alt="Bumi">
                <div class="card-body ms-3">
                    <small>18/3/2025<br>Tere Liye</small>
                    <h5>Bumi</h5>
                    <div class="price">Rp. 99.000,00</div>
                    <div class="mt-2">
                        <button class="btn btn-secondary btn-sm">Proses Pengembalian</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        © 2025 Library-Hub
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
