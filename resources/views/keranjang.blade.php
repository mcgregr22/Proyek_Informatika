@extends('layouts.pengelolaan')

@section('content')
<style>
    body {
        background-color: #f9fafb;
    }
    .empty-cart {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 80vh;
        text-align: center;
        margin-bottom: 40px;
    }
    .empty-cart img {
        max-width: 160px;
        margin-bottom: 16px;
    }
    .empty-cart h5 {
        font-weight: 700;
        margin-bottom: 8px;
        color: #212529;
    }
    .empty-cart p {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 24px;
    }
    .btn-shop {
        background-color: #0d6efd;
        color: #fff;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }
    .btn-shop:hover {
        background-color: #0b5ed7;
        text-decoration: none;
        color: #fff;
    }
    .summary-card {
        max-width: 420px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
        padding: 20px 28px;
        margin: 0 auto 60px auto;
        font-size: 0.95rem;
        color: #212529;
    }
    .summary-card strong {
        font-weight: 700;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    .summary-divider {
        border-top: 1px solid #dee2e6;
        margin: 14px 0;
    }
    .summary-total {
        font-weight: 700;
        font-size: 1.1rem;
        color: #0d6efd;
        margin-bottom: 20px;
    }
    .btn-checkout {
        width: 100%;
        background-color: #0d6efd;
        color: #fff;
        font-weight: 700;
        padding: 12px 0;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn-checkout:hover:not(:disabled) {
        background-color: #0b5ed7;
    }
    .btn-checkout:disabled {
        background-color: #6c757d;
        cursor: not-allowed;
    }
    .footer {
        text-align: center;
        padding: 20px 0;
        border-top: 1px solid #dee2e6;
        color: #6c757d;
        font-size: 0.9rem;
        margin-top: 40px;
    }
</style>

@if(empty($items))
<div class="container">
    <div class="empty-cart">
        <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Keranjang Kosong">
        <h5>Keranjang Belanja Kosong</h5>
        <p>Yuk, temukan buku favoritmu dan tambahkan ke keranjang!</p>
        <a href="{{ url('/homepage') }}" class="btn-shop">
            <i class="bi bi-arrow-left"></i> Beranda
        </a>
    </div>

    <div class="summary-card">
        <div class="summary-row">
            <span>Subtotal (item):</span>
            <strong>Rp0</strong>
        </div>
        <div class="summary-row">
            <span>Pajak (10%):</span>
            <strong>Rp0</strong>
        </div>
        <div class="summary-row">
            <span>Pengiriman:</span>
            <strong>Rp0</strong>
        </div>
        <div class="summary-divider"></div>
        <div class="summary-total d-flex justify-content-between">
            <span>Total:</span>
            <strong>Rp0</strong>
        </div>
        <button class="btn-checkout" disabled>Lanjutkan ke Checkout</button>
    </div>
</div>
@else
<!-- Jika Ada Item di Keranjang -->
<div class="container">
    @if(session('success'))
        <div class="alert alert-success mt-4">{{ session('success') }}</div>
    @endif

    <!-- Daftar Item, bisa disesuaikan -->
    <div class="card mt-4 p-3" style="border:none;border-radius:12px;box-shadow:0 3px 10px rgba(0,0,0,.06);background:#fff">
        <h5 class="mb-3">Keranjang Kamu</h5>

        @foreach($items as $it)
            <div class="d-flex align-items-center py-3 border-bottom">
                <img
                    src="{{ !empty($it['cover']) ? Storage::url(str_replace('\\','/',$it['cover'])) : asset('images/placeholder-cover.png') }}"
                    alt="{{ $it['title'] ?? 'Buku' }}"
                    style="width:72px;height:104px;object-fit:cover;border-radius:8px"
                    class="me-3"
                >
                <div class="flex-grow-1">
                    <div class="fw-semibold">{{ $it['title'] ?? '-' }}</div>
                    <div class="text-muted small">{{ $it['author'] ?? '-' }}</div>
                    @if(!empty($it['isbn']))
                        <div class="text-muted small">ISBN: {{ $it['isbn'] }}</div>
                    @endif
                    <div class="mt-1">Rp {{ number_format((int)($it['price'] ?? 0),0,',','.') }} × {{ (int)($it['qty'] ?? 1) }}</div>
                </div>

                <div class="fw-semibold me-3">
                    Rp {{ number_format((int)($it['subtotal'] ?? 0),0,',','.') }}
                </div>

                @if(!empty($it['id_buku']))
                    <form action="{{ route('cart.remove', $it['id_buku']) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-light border" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>

    <div class="summary-card">
        <div class="summary-row">
            <span>Subtotal (item):</span>
            <strong>Rp {{ number_format((int)$subtotal,0,',','.') }}</strong>
        </div>
        <div class="summary-row">
            <span>Pajak (10%):</span>
            <strong>Rp {{ number_format((int)$tax,0,',','.') }}</strong>
        </div>
        <div class="summary-row">
            <span>Pengiriman:</span>
            <strong>Rp {{ number_format((int)$shipping,0,',','.') }}</strong>
        </div>
        <div class="summary-divider"></div>
        <div class="summary-total d-flex justify-content-between">
            <span>Total:</span>
            <strong>Rp {{ number_format((int)$total,0,',','.') }}</strong>
        </div>
        <button class="btn-checkout">Lanjutkan ke Checkout</button>
    </div>
</div>
@endif

<!-- Footer -->
<div class="footer">
    <p>© 2025 Library-Hub</p>
</div>

@endsection