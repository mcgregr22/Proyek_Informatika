<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library-Hub | Dashboard Admin</title>
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
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      transition: transform 0.2s ease;
      overflow: hidden;
    }
    .book-card:hover {
      transform: translateY(-5px);
    }
    .book-card img {
      height: 300px;
      width: 100%;
      object-fit: cover;
    }
    .book-card .card-body {
      text-align: center;
      padding: 15px;
    }
    .book-title {
      font-weight: 600;
      font-size: 0.95rem;
    }
    .book-author {
      color: #6c757d;
      font-size: 0.85rem;
    }
    .book-price {
      color: #000;
      font-weight: 600;
      margin-top: 4px;
    }
    .btn-hapus {
      background-color: #dc3545;
      color: white;
      font-size: 0.85rem;
      border-radius: 6px;
      width: 100%;
    }
    .btn-hapus:hover {
      background-color: #b02a37;
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
    <a class="navbar-brand fw-bold" href="{{ route('homepage_admin') }}">
      Library-<span>Hub</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <form class="d-flex ms-auto me-3" role="search">
      <input class="form-control" type="search" placeholder="Cari Buku">
    </form>

    <ul class="navbar-nav align-items-center">
      <li class="nav-item"><a class="nav-link fw-semibold" href="/request_swap">Swapbook</a></li>
      <li class="nav-item"><a class="nav-link fw-semibold" href="/manajemen_admin">Akun & Role</a></li>
    </ul>

    <div class="d-flex align-items-center ms-3">
      <a href="/keranjang" class="navbar-icon"><i class="bi bi-cart"></i></a>
      <a href="/forumdiscuss" class="navbar-icon"><i class="bi bi-chat-dots"></i></a>
      <a href="/profil_admin" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
    </div>
  </div>
</nav>

<!-- Koleksi Buku -->
<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold mb-0">Daftar Buku</h4>
    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahBuku">
      <i class="bi bi-plus-circle"></i> Tambah Buku
    </button>
  </div>

  <div class="row g-4">
    @forelse($books as $book)
    <div class="col-6 col-md-4 col-lg-3">
      <div class="card book-card">
        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
        <div class="card-body">
          <p class="book-title mb-0">{{ $book->title }}</p>
          <p class="book-author mb-1">{{ $book->author }}</p>
          <p class="book-price">{{ $book->harga_rupiah }}</p>

          <form action="{{ route('homepage_admin.destroy', $book->id_buku) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus buku ini?')">
              <i class="bi bi-trash"></i> Hapus
            </button>
          </form>
        </div>
      </div>
    </div>
    @empty
    <p class="text-muted text-center">Belum ada buku dalam koleksi.</p>
    @endforelse
  </div>
</div>

<!-- MODAL TAMBAH BUKU -->
<div class="modal fade" id="modalTambahBuku" tabindex="-1" aria-labelledby="modalTambahBukuLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 rounded-4 shadow">
      <div class="modal-header bg-light">
        <h5 class="modal-title fw-semibold" id="modalTambahBukuLabel">Form Tambah Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form action="{{ route('homepage_admin.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">ID Buku</label>
              <input type="text" name="id_buku" class="form-control" placeholder="Contoh: BK001" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">ID Kategori</label>
              <input type="text" name="id_kategori" class="form-control" placeholder="Contoh: KT01" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Judul Buku</label>
              <input type="text" name="title" class="form-control" placeholder="Masukkan judul buku" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Penulis</label>
              <input type="text" name="author" class="form-control" placeholder="Masukkan nama penulis" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">ISBN</label>
              <input type="text" name="isbn" class="form-control" placeholder="Masukkan nomor ISBN" required>
            </div>

            <div class="col-12">
              <label class="form-label">Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi buku" required></textarea>
            </div>

            <div class="col-md-6">
              <label class="form-label">Harga</label>
              <input type="number" name="harga" class="form-control" placeholder="Rp. 0" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Cover Buku</label>
              <input type="file" name="cover_image" class="form-control" accept="image/*" required>
            </div>
          </div>

          <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary">Tambah Buku</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<div class="footer">
  <p>© 2025 Library-Hub</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
