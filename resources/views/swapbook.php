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
                            <li><a class="dropdown-item" href="#">Fiction</a></li>
                            <li><a class="dropdown-item" href="#">Romance</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Search -->
                <form class="d-flex ms-auto me-3 search-bar" role="search">
                    <input class="form-control" type="search" placeholder="Cari Buku">
                </form>

                <!-- Menu kanan -->
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link fw-semibold" href="swapbook">Swapbook</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="mycollection">My Collection</a></li>
                </ul>

                <!-- 3 Icon Kanan -->
                <div class="d-flex align-items-center ms-3">
                    <!-- tombol keranjang -->
                    <a href="/keranjang" class="navbar-icon"><i class="bi bi-cart"></i></a>
                    <a href="/forumdiscuss" class="navbar-icon"><i class="bi bi-chat-dots"></i></a>
                    <a href="#" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-primary">Swapbook Collection</h3>
            <p class="text-muted">Find books from other users and request a swap!</p>
        </div>

        <!-- Book Grid -->
        <div class="row g-4">
            <?php
            // Contoh data dummy buku
            $books = [
                ["title" => "Book Title", "author" => "Author Name", "img" => "https://picsum.photos/200/300?random=1"],
                ["title" => "The Silent Library", "author" => "John Doe", "img" => "https://picsum.photos/200/300?random=2"],
                ["title" => "History of Time", "author" => "Stephen Hawking", "img" => "https://picsum.photos/200/300?random=3"],
                ["title" => "Ocean Tales", "author" => "Jane Austen", "img" => "https://picsum.photos/200/300?random=4"],
                ["title" => "Modern Myths", "author" => "Neil Gaiman", "img" => "https://picsum.photos/200/300?random=5"],
                ["title" => "Romance in Paris", "author" => "Emma Love", "img" => "https://picsum.photos/200/300?random=6"],
                ["title" => "The Lost Library", "author" => "Arthur Lee", "img" => "https://picsum.photos/200/300?random=7"],
                ["title" => "Mind of a Genius", "author" => "Isaac Newton", "img" => "https://picsum.photos/200/300?random=8"],
            ];

            foreach ($books as $book) {
                echo '
                <div class="col-md-3 col-sm-6">
                    <div class="card book-card">
                        <img src="'.$book['img'].'" class="book-img" alt="Book Cover">
                        <div class="card-body text-center">
                            <h6 class="fw-semibold">'.$book['title'].'</h6>
                            <p class="text-muted mb-1">'.$book['author'].'</p>
                            <button class="btn btn-swap btn-sm">Request Swap</button>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 Library-Hub</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
