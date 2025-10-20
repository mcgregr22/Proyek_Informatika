<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang | Library-Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body{background-color:#f8f9fa;font-family:'Poppins',sans-serif}
        .navbar-brand span{color:#0d6efd;font-weight:700}
        .navbar-icon{font-size:1.2rem;margin-left:15px;color:#333;transition:color .2s}
        .navbar-icon:hover{color:#0d6efd}
        .empty-cart{text-align:center;margin-top:80px}
        .empty-cart img{max-width:280px;opacity:.9}
        .empty-cart h5{margin-top:25px;font-weight:600;color:#333}
        .empty-cart p{color:#777}
        .btn-shop{background-color:#0d6efd;color:#fff;border-radius:8px;padding:10px 20px;transition:.3s}
        .btn-shop:hover{background-color:#003f88;color:#fff}
        .summary-card{border:none;border-radius:12px;box-shadow:0 3px 10px rgba(0,0,0,.1);margin-top:40px;background:#fff;padding:25px}
        .summary-card h6{font-weight:600}
        .footer{margin-top:70px;text-align:center;padding:20px 0;border-top:1px solid #ddd;color:#777}
        .btn-checkout{width:100%;background-color:#0d6efd;color:#fff;border-radius:8px;padding:12px;font-weight:600;transition:.3s}
        .btn-checkout:hover{background-color:#003f88}
        .cart-item + .cart-item{border-top:1px solid #eee}
    </style>
</head>
<body>

    {{-- Navbar (tetap) --}}
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/homepage">Library-<span>Hub</span></a>
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
                    <a href="#" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">

        {{-- Notifikasi sukses (opsional) --}}
        @if(session('success'))
            <div class="alert alert-success mt-4">{{ session('success') }}</div>
        @endif

        {{-- ==== JIKA ADA ITEM DI KERANJANG ==== --}}
        @if(isset($items) && $items->count() > 0)

            {{-- Daftar item --}}
            <div class="card mt-4 shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Keranjang Kamu</h5>

                    @foreach($items as $item)
                        <div class="cart-item d-flex align-items-center py-3">
                            {{-- Cover --}}
                            <img src="{{ asset(optional($item->buku)->cover_image ?? '') }}"
                                 onerror="this.src='https://via.placeholder.com/64x90?text=No+Cover'"
                                 width="64" height="90" class="rounded me-3">

                            {{-- Detail --}}
                            <div class="flex-grow-1">
                                <div class="fw-semibold">
                                    {{ optional($item->buku)->title ?? 'Buku' }}
                                </div>
                                <div class="text-muted small">
                                    ISBN: {{ optional($item->buku)->isbn ?? '—' }}
                                </div>
                                <div class="mt-1">
                                    Rp {{ number_format($item->harga,0,',','.') }} × {{ $item->qty }}
                                </div>
                            </div>

                            {{-- Subtotal + Hapus --}}
                            <div class="text-end">
                                <div class="fw-bold">
                                    Rp {{ number_format($item->harga * $item->qty,0,',','.') }}
                                </div>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="mt-2">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Ringkasan (pakai angka dari controller) --}}
            <div class="summary-card col-md-6 mx-auto mt-4">
                <h6 class="mb-3">Ringkasan Pesanan</h6>
                <div class="d-flex justify-content-between">
                    <span>Subtotal (item):</span>
                    <strong>Rp {{ number_format($subtotal,0,',','.') }}</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Pajak (10%):</span>
                    <strong>Rp {{ number_format($tax,0,',','.') }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Pengiriman:</span>
                    <strong>Rp0</strong>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <h6>Total:</h6>
                    <h6 class="text-primary fw-bold">Rp {{ number_format($total,0,',','.') }}</h6>
                </div>
                <a href="/checkout" class="btn-checkout text-center text-decoration-none d-block">
                    Lanjutkan ke Checkout
                </a>
            </div>

        {{-- ==== JIKA KOSONG (tampilan asli dipertahankan) ==== --}}
        @else

            <div class="empty-cart">
                <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Empty Cart">
                <h5>Keranjang Belanja Kosong</h5>
                <p>Yuk, temukan buku favoritmu dan tambahkan ke keranjang!</p>
                <a href="{{ url('/homepage') }}" class="btn btn-shop mt-3">
                    <i class="bi bi-arrow-left"></i> Beranda
                </a>
            </div>

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
                <button class="btn-checkout">Lanjutkan ke Checkout</button>
            </div>

        @endif
    </div>

    <div class="footer"><p>© 2025 Library-Hub</p></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
