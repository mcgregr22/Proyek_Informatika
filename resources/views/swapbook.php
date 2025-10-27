<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Swaps - Library-Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }

    /* === NAVBAR === */
    .navbar {
      background-color: #fff;
      border-bottom: 1px solid #e6e6e6;
      padding: 0.8rem 2rem;
    }
    .navbar-brand {
      font-weight: 700;
      font-size: 1.25rem;
    }
    .navbar-brand span:first-child {
      color: #000;
    }
    .navbar-brand span:last-child {
      color: #2b52ff;
      font-style: italic;
    }
    .form-control-search {
      background-color: #f1f2f4;
      border: 1px solid #e0e0e0;
      border-radius: 6px;
      width: 250px;
    }
    .form-control-search:focus {
      box-shadow: none;
      background-color: #f1f2f4;
    }
    .nav-link {
      color: #444 !important;
      font-weight: 500;
      margin-right: 12px;
    }
    .nav-link:hover {
      color: #000 !important;
    }

    /* === PAGE BODY === */
    .tab-button {
      border: none;
      background-color: transparent;
      font-weight: 600;
      padding: 10px 20px;
      border-bottom: 3px solid transparent;
      cursor: pointer;
    }
    .tab-button.active {
      border-bottom: 3px solid #000;
    }
    .empty-box {
      border: 1px dashed #ccc;
      border-radius: 10px;
      padding: 60px 20px;
      text-align: center;
      color: #6c757d;
      background: #fff;
    }
  </style>
</head>
<body>

<!-- ================= NAVBAR ================= -->
<!-- <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
  <div class="container"> -->

    <!-- Brand -->
    <!-- <a class="navbar-brand fw-bold" href="/homepage" style="font-size: 1.25rem;">
      Library-<span style="color: #2b52ff;">Hub</span>
    </a> -->

    <!-- Toggler (mobile) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="navbarNav">

      <!-- Dropdown Kategori -->
      <ul class="navbar-nav ms-4">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-semibold text-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kategori
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Fiksi</a></li>
            <li><a class="dropdown-item" href="#">Non-Fiksi</a></li>
            <li><a class="dropdown-item" href="#">Edukasi</a></li>
          </ul>
        </li>
      </ul>

      <!-- Search -->
      <!-- Search ke controller -->
      <form class="d-flex ms-auto me-3" role="search" action="{{ route('swapbook') }}" method="GET">
                    <input class="form-control" type="search" name="q" value="" placeholder="Cari Buku">
                </form>
      </form>

      <!-- Menu Kanan -->
      <ul class="navbar-nav align-items-center">
        <li class="nav-item"><a class="nav-link fw-semibold text-secondary" href="/swapbook">Swapbook</a></li>
        <li class="nav-item"><a class="nav-link fw-semibold text-secondary" href="/mycollection">My Collection</a></li>
      </ul>

      <!-- Icons -->
      <div class="d-flex align-items-center ms-3">
        <a href="/keranjang" class="text-dark mx-2"><i class="bi bi-cart3 fs-5"></i></a>
        <a href="/forumdiscuss" class="text-dark mx-2"><i class="bi bi-chat-dots fs-5"></i></a>
        <a href="/profil_user" class="text-dark mx-2"><i class="bi bi-person-circle fs-5"></i></a>
      </div>

    </div>
  </div>
</nav>




<!-- ============ PAGE CONTENT ============ -->
<div class="container mt-5">
  <h2 class="fw-bold">Book Swaps</h2>
  <p class="text-muted">Manage your book swap requests</p>

  <!-- Tabs -->
  <div class="d-flex mb-4">
    <button id="incomingBtn" class="tab-button active">Incoming Requests</button>
    <button id="outgoingBtn" class="tab-button">Outgoing Requests</button>
  </div>

  <!-- Content box -->
  <div id="incoming" class="empty-box">
    <i class="bi bi-arrow-repeat display-4"></i>
    <h5 class="mt-3 fw-semibold">No incoming swap requests</h5>
    <p>When someone requests to swap with one of your books, it will appear here.</p>
    <a href="/homepage" class="btn btn-dark px-4">Browse Books</a>
  </div>

  <div id="outgoing" class="empty-box d-none">
    <i class="bi bi-book display-4"></i>
    <h5 class="mt-3 fw-semibold">No outgoing swap requests</h5>
    <p>You haven’t requested any swaps yet. Browse and request a book swap.</p>
    <a href="/homepage" class="btn btn-dark px-4">Browse Books</a>
  </div>
</div>

<!-- Script -->
<script>
  const incomingBtn = document.getElementById('incomingBtn');
  const outgoingBtn = document.getElementById('outgoingBtn');
  const incoming = document.getElementById('incoming');
  const outgoing = document.getElementById('outgoing');

  incomingBtn.onclick = () => {
    incomingBtn.classList.add('active');
    outgoingBtn.classList.remove('active');
    incoming.classList.remove('d-none');
    outgoing.classList.add('d-none');
  };

  outgoingBtn.onclick = () => {
    outgoingBtn.classList.add('active');
    incomingBtn.classList.remove('active');
    outgoing.classList.remove('d-none');
    incoming.classList.add('d-none');
  };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
