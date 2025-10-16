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
        .book-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
            position: relative;
        }
        .book-card:hover {
            transform: translateY(-5px);
        }
        .book-card img {
            height: 350px;
            width: 100%;
            object-fit: cover;
        }
        .delete-icon {
        position: absolute;
        top: 8px;
        right: 8px;
        color: white; /* ubah ikon jadi putih agar kontras */
        background-color: rgba(0, 0, 0, 0.6); /* latar belakang semi-transparan */
        border-radius: 50%; /* bentuk bulat */
        font-size: 1.2rem;
        cursor: pointer;
        transition: transform 0.2s ease, background-color 0.2s;
        padding: 6px; /* jarak dalam agar ikon tidak terlalu rapat */
        }
        .delete-icon:hover {
            transform: scale(1.2);
            background-color: rgba(255, 0, 0, 0.7); /* saat hover berubah merah transparan */
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
                <li class="nav-item"><a class="nav-link fw-semibold" href="/swapbook">Swapbook</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="/mycollection">My Collection</a></li>
            </ul>

            <div class="d-flex align-items-center ms-3">
                <a href="/keranjang" class="navbar-icon"><i class="bi bi-cart"></i></a>
                <a href="/forumdiscuss" class="navbar-icon"><i class="bi bi-chat-dots"></i></a>
                <a href="/profil_user" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
            </div>
        </div>
    </div>
</nav>

<!-- CONTAINER -->
<div class="container my-5">
    <h4 class="fw-semibold mb-4">Koleksi Buku</h4>

    <!-- Grid Buku -->
    <div class="row g-4">

        <!-- Buku Asli -->
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card">
                <i class="bi bi-trash3 delete-icon" onclick="confirmDelete(1)"></i>
                <img src="{{ asset('images/bumi.jpg') }}" alt="Bumi">
                <div class="card-body text-center">
                    <h6 class="mb-0">Tere Liye</h6>
                    <small class="text-muted">Bumi</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card">
                <i class="bi bi-trash3 delete-icon" onclick="confirmDelete(2)"></i>
                <img src="{{ asset('images/filosofi_teras.jpg') }}" alt="Filosofi Teras">
                <div class="card-body text-center">
                    <h6 class="mb-0">Henry Manampiring</h6>
                    <small class="text-muted">Filosofi Teras</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card">
                <i class="bi bi-trash3 delete-icon" onclick="confirmDelete(3)"></i>
                <img src="{{ asset('images/laut_bercerita.jpg') }}" alt="Laut Bercerita">
                <div class="card-body text-center">
                    <h6 class="mb-0">Leila S. Chudori</h6>
                    <small class="text-muted">Laut Bercerita</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card">
                <i class="bi bi-trash3 delete-icon" onclick="confirmDelete(4)"></i>
                <img src="{{ asset('images/hujan.jpg') }}" alt="Hujan">
                <div class="card-body text-center">
                    <h6 class="mb-0">Tere Liye</h6>
                    <small class="text-muted">Hujan</small>
                </div>
            </div>
        </div>

        <!-- Buku Dummy -->
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card">
                <i class="bi bi-trash3 delete-icon" onclick ="confirmDelete(5)"></i>
                <img src="https://m.media-amazon.com/images/I/81wgcld4wxL.jpg" alt="Atomic Habits">
                <div class="card-body text-center">
                    <h6 class="mb-0">James Clear</h6>
                    <small class="text-muted">Atomic Habits</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card">
                <i class="bi bi-trash3 delete-icon"onclick ="confirmDelete(6)"></i>
                <img src="https://m.media-amazon.com/images/I/71aFt4+OTOL.jpg" alt="The Alchemist">
                <div class="card-body text-center">
                    <h6 class="mb-0">Paulo Coelho</h6>
                    <small class="text-muted">The Alchemist</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card">
                <i class="bi bi-trash3 delete-icon"onclick ="confirmDelete(7)"></i>
                <img src="https://m.media-amazon.com/images/I/91uwocAMtSL.jpg" alt="Harry Potter">
                <div class="card-body text-center">
                    <h6 class="mb-0">J.K. Rowling</h6>
                    <small class="text-muted">Harry Potter and the Sorcerer’s Stone</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card">
                <i class="bi bi-trash3 delete-icon"onclick ="confirmDelete(8)"></i>
                <img src="https://m.media-amazon.com/images/I/71kxa1-0mfL.jpg" alt="To Kill a Mockingbird">
                <div class="card-body text-center">
                    <h6 class="mb-0">Harper Lee</h6>
                    <small class="text-muted">To Kill a Mockingbird</small>
                </div>
            </div>
        </div>

        <!-- Tambahan Dummy Buku Baru -->
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card">
                <i class="bi bi-trash3 delete-icon"onclick ="confirmDelete(9)"></i>
                <img src="https://m.media-amazon.com/images/I/81WcnNQ-TBL.jpg" alt="Becoming">
                <div class="card-body text-center">
                    <h6 class="mb-0">Michelle Obama</h6>
                    <small class="text-muted">Becoming</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card">
                <i class="bi bi-trash3 delete-icon"onclick ="confirmDelete(10)"></i>
                <img src="https://m.media-amazon.com/images/I/81gepf1eMqL.jpg" alt="The Psychology of Money">
                <div class="card-body text-center">
                    <h6 class="mb-0">Morgan Housel</h6>
                    <small class="text-muted">The Psychology of Money</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card">
                <i class="bi bi-trash3 delete-icon"onclick ="confirmDelete(11)"></i>
                <img src="https://m.media-amazon.com/images/I/81drfTT9ZfL.jpg" alt="The Midnight Library">
                <div class="card-body text-center">
                    <h6 class="mb-0">Matt Haig</h6>
                    <small class="text-muted">The Midnight Library</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card book-card">
                <i class="bi bi-trash3 delete-icon"onclick ="confirmDelete(12   )"></i>
                <img src="https://m.media-amazon.com/images/I/91bYsX41DVL.jpg" alt="Deep Work">
                <div class="card-body text-center">
                    <h6 class="mb-0">Cal Newport</h6>
                    <small class="text-muted">Deep Work</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(bookId) {
    if (confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
        window.location.href = `/remove/${bookId}`;
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
