<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Transaksi | Library-Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f1f6;
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

        /* Kartu transaksi */
        .transactions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.2s ease;
            cursor: pointer;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        .card-content {
            padding: 15px;
        }
        .card-content small {
            color: #6c757d;
        }
        .card-content h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 8px 0;
        }
        .price {
            font-weight: 600;
            color: #000;
            margin-bottom: 10px;
        }
        .card-content button {
            border: none;
            background-color: #0d6efd;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 0.9rem;
            transition: 0.2s;
        }
        .card-content button:hover {
            background-color: #0b5ed7;
        }
        .card-content .secondary {
            background-color: #e9ecef;
            color: #333;
            margin-right: 5px;
        }
        .card-content .secondary:hover {
            background-color: #d6d6d6;
        }

        footer {
            text-align: center;
            color: #888;
            margin-top: 50px;
            padding: 20px;
            border-top: 1px solid #ccc;
            background-color: #fff;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/homepage">
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
                    <li class="nav-item"><a class="nav-link fw-semibold" href="/swapbook">Swapbook</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="/mycollection">My Collection</a></li>
                </ul>

                <!-- 3 Icon Kanan -->
                <div class="d-flex align-items-center ms-3">
                    <a href="/keranjang" class="navbar-icon"><i class="bi bi-cart"></i></a>
                    <a href="/forumdiscuss" class="navbar-icon"><i class="bi bi-chat-dots"></i></a>
                    <a href="/profileadmin" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Riwayat Transaksi -->
    <div class="container mt-4">
        <h4 class="fw-semibold mb-3">Riwayat Transaksi</h4>

        <div class="transactions">
            <!-- Card 1 -->
            <div class="card" onclick="openDetail('detail.php?id=1')">
                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400" alt="Bumi">
                <div class="card-content">
                    <small>18/3/2025<br>Tere Liye</small>
                    <h4>Bumi</h4>
                    <div class="price">Rp. 99.000,00</div>
                    <button class="secondary">Swap Book</button>
                    <button>Konfirmasi</button>
                </div>
            </div>

             <!-- Card 2 -->
             <div class="card" onclick="openDetail('detail.php?id=2')">
                <img src="https://images-na.ssl-images-amazon.com/images/I/51Zymoq7UnL._SX379_.jpg" alt="Filosofi Teras">
                <div class="card-content">
                    <small>18/3/2025<br>Henry Manampiring</small>
                    <h4>Filosofi Teras</h4>
                    <div class="price">Rp. 99.000,00</div>
                    <button class="secondary" disabled>Selesai</button>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card" onclick="openDetail('detail.php?id=3')">
                <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=400" alt="Bumi">
                <div class="card-content">
                    <small>18/3/2025<br>Tere Liye</small>
                    <h4>Bumi</h4>
                    <div class="price">Rp. 99.000,00</div>
                    <button class="secondary">Proses Pengembalian</button>
                </div>
            </div>
        </div>
    </div>


    <footer>
        © 2025 Library-Hub
    </footer>

    <script>
        function openDetail(url) {
            window.location.href = url;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
