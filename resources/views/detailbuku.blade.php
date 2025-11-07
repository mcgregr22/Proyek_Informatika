<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Buku - {{ $book->title }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body{background:#f3f4f6;font-family:'Poppins',sans-serif}
    .navbar-brand span{color:#0d6efd;font-weight:700}
    .page-wrap{max-width:1100px;margin:24px auto;padding:0 16px}
    .panel{background:#fff;border:1px solid #e9ecef;border-radius:12px;padding:28px}
    .title{font-weight:700;color:#111}
    .price{color:#0d6efd;font-weight:700;font-size:24px}
    .qty .btn{width:36px;height:36px}
    .thumb{width:100%;max-width:280px;border-radius:10px;object-fit:cover;border:1px solid #eee}
    .muted{color:#6b7280}
    .info-grid .label{color:#6b7280}
    .info-grid .val{font-weight:600;color:#111}
    .btn-outline{border-color:#c7d2fe;color:#3b5bdb}
    .btn-outline:hover{background:#eef2ff}
  </style>
</head>
<body>

  {{-- Navbar (konsisten dengan homepage) --}}
  <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="/homepage">Library-<span>Hub</span></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div id="nav" class="collapse navbar-collapse">
        <ul class="navbar-nav ms-4">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-semibold" href="#" data-bs-toggle="dropdown">Kategori</a>
            <ul class="dropdown-menu">
              <li><span class="dropdown-item-text text-muted">Pilih di halaman khusus</span></li>
            </ul>
          </li>
        </ul>

        <form class="d-flex ms-auto me-3" role="search" action="{{ route('homepage') }}" method="GET">
          <input class="form-control" type="search" name="q" placeholder="Cari Buku">
        </form>

        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a class="nav-link fw-semibold" href="/swapbook">Swapbook</a></li>
          <li class="nav-item"><a class="nav-link fw-semibold" href="/mycollection">My Collection</a></li>
        </ul>

        <div class="d-flex align-items-center ms-3">
          <a href="/keranjang" class="me-2 text-decoration-none text-dark"><i class="bi bi-cart"></i></a>
          <a href="/forumdiscuss" class="me-2 text-decoration-none text-dark"><i class="bi bi-chat-dots"></i></a>
          <a href="#" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
        </div>
      </div>
    </div>
  </nav>

  <div class="page-wrap">
    <div class="panel">
      <div class="row g-4">
        {{-- Kiri: Gambar --}}
        <div class="col-12 col-md-4 text-center">
          @if($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}" class="thumb" alt="cover">
          @else
            <div class="thumb d-flex align-items-center justify-content-center bg-light" style="height:380px;">📘</div>
          @endif
        </div>

        {{-- Kanan: Judul + Info + Aksi --}}
        <div class="col-12 col-md-8">
          <h2 class="title mb-2">{{ $book->title }}</h2>
          <div class="muted mb-2">{{ $book->author }}</div>
          <div class="price mb-3">Rp {{ number_format($book->harga,0,',','.') }}</div>

          {{-- Qty + aksi --}}
          <div class="d-flex align-items-center mb-3">
            <span class="me-2 muted">Jumlah:</span>
            <div class="qty input-group" style="width:140px;">
              <button class="btn btn-outline-secondary" type="button" id="minus">-</button>
              <input type="number" min="1" value="1" class="form-control text-center" id="qty">
              <button class="btn btn-outline-secondary" type="button" id="plus">+</button>
            </div>
          </div>

          <div class="d-flex flex-wrap gap-2">
            <form action="/mycollection" method="POST">
              @csrf
              <input type="hidden" name="book_id" value="{{ $book->id_buku }}">
              <button class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah ke Koleksi
              </button>
            </form>

            <form action="/keranjang" method="POST" class="ms-1">
              @csrf
              <input type="hidden" name="book_id" value="{{ $book->id_buku }}">
              <input type="hidden" name="qty" id="qtyField" value="1">
              <button class="btn btn-outline">
                <i class="bi bi-bag me-2"></i>Beli Sekarang
              </button>
            </form>
          </div>
        </div>
      </div>

      {{-- Deskripsi --}}
      <div class="mt-5">
        <h5 class="mb-2">Deskripsi</h5>
        <p class="muted mb-0" style="line-height:1.8">
          {{ $book->deskripsi ?: 'Belum ada deskripsi untuk buku ini.' }}
        </p>
      </div>

      {{-- Info buku --}}
      <div class="mt-4">
        <h5 class="mb-3">Informasi Buku</h5>
        <div class="row row-cols-1 row-cols-md-2 g-3 info-grid">
          <div class="col d-flex justify-content-between">
            <span class="label">Bahasa:</span><span class="val">Indonesia</span>
          </div>
          <div class="col d-flex justify-content-between">
            <span class="label">Penerbit:</span><span class="val">—</span>
          </div>
          <div class="col d-flex justify-content-between">
         <span class="label">Terdaftar Oleh:</span>
        <span class="val">{{ $book->user->name ?? '—' }}</span>
          </div>
          <div class="col d-flex justify-content-between">
            <span class="label">Tanggal Rilis:</span><span class="val">—</span>
          </div>
          <div class="col d-flex justify-content-between">
            <span class="label">ISBN:</span><span class="val">{{ $book->isbn ?: '—' }}</span>
          </div>
          <div class="col d-flex justify-content-between">
            <span class="label">Penulis:</span><span class="val">{{ $book->author ?: '—' }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="text-center text-muted py-4">© 2025 Library-Hub</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // qty control
    const qty   = document.getElementById('qty');
    const plus  = document.getElementById('plus');
    const minus = document.getElementById('minus');
    const qtyField = document.getElementById('qtyField');

    plus?.addEventListener('click', ()=>{ qty.value = (+qty.value||1)+1; qtyField.value = qty.value; });
    minus?.addEventListener('click', ()=>{ qty.value = Math.max(1,(+qty.value||1)-1); qtyField.value = qty.value; });
    qty?.addEventListener('input', ()=>{ if(qty.value<1) qty.value=1; qtyField.value = qty.value; });
  </script>
</body>
</html>
