@extends('layouts.detailbuku')

@section('title', 'Detail Buku - ' . $book->title)

{{-- 1. Menyuntikkan CSS khusus Detail Buku --}}
@push('styles')


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
  /* Base styles sudah diatur di Master Layout */

  /* Layout Specific Styles */
  .page-wrap {
    max-width: 1100px;
    margin: 24px auto;
    padding: 0 16px
  }

  .panel {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    padding: 28px
  }

  /* Typography & Colors */
  .title {
    font-weight: 700;
    color: #111
  }

  .price {
    color: #0d6efd;
    font-weight: 700;
    font-size: 24px
  }

  .muted {
    color: #6b7280
  }

  /* Controls & Buttons */
  .qty .btn {
    width: 36px;
    height: 36px
  }

  .thumb {
    width: 100%;
    max-width: 280px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid #eee
  }

  .info-grid .label {
    color: #6b7280
  }

  .info-grid .val {
    font-weight: 600;
    color: #111
  }

  .btn-outline {
    border-color: #c7d2fe;
    color: #3b5bdb
  }

  .btn-outline:hover {
    background: #eef2ff
  }

  /* Toast/Notification */
  .toast {
    opacity: 0;
    transition: opacity 0.4s ease, transform 0.3s ease;
    transform: scale(0.95);
  }

  .toast.show {
    opacity: 1;
    transform: scale(1);
  }
</style>
@endpush

{{-- 2. Menyuntikkan Search Form ke Header Master Layout --}}
@section('search_form')
<form class="d-flex ms-auto me-3" role="search" action="{{ route('homepage') }}" method="GET">
  <input class="form-control" type="search" name="q" placeholder="Cari Buku">
</form>
@endsection

{{-- 3. Konten Utama Detail Buku --}}
@section('content')

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

          {{-- 🛒 ICON TAMBAH KE KERANJANG (BARU) --}}
          <form id="addCartInline" action="{{ route('cart.add') }}" method="POST" class="ms-2">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id_buku }}">
            <input type="hidden" name="qty" id="qtyInline" value="1">
            <button type="submit" class="btn btn-outline-success" title="Tambah ke Keranjang">
              <i class="bi bi-cart-plus"></i>
            </button>
          </form>

        </div>

        <div class="d-flex flex-wrap gap-2">

          {{-- Tombol Tukar Buku --}}
          <form action="{{ route('mycollection.index') }}" method="GET">
            <input type="hidden" name="requested" value="{{ $book->id_buku }}">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-arrow-repeat me-2"></i>Tukar Buku
            </button>
          </form>

          <form action="{{ route('midtrans.buyNow', $book->id_buku) }}" method="POST">
            @csrf
            <input type="hidden" id="qtyBuyNow" name="qty" value="1">
            <button type="submit" class="btn btn-primary w-100">Beli Sekarang</button>
          </form>

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
                <span class="label">Bahasa:</span><span class="val">{{ $book->bahasa ?: '_'}}</span>
              </div>
              <div class="col d-flex justify-content-between">
                <span class="label">Penerbit:</span><span class="val">{{ $book->penerbit ?: '—' }}</span>
              </div>
              <div class="col d-flex justify-content-between">
                <span class="label">Terdaftar oleh:</span><span class="val">{{ $book->user->name ?? '—' }}</span>
              </div>
              <div class="col d-flex justify-content-between">
                <span class="label">Tanggal Rilis:</span><span class="val">{{ $book->tanggal_rilis ?: '_'}}</span>
              </div>
              <div class="col d-flex justify-content-between">
                <span class="label">ISBN:</span><span class="val">{{ $book->isbn ?: '—' }}</span>
              </div>
              <div class="col d-flex justify-content-between">
                <span class="label">Kondisi:</span><span class="val">{{ $book->kondisi ?: '—' }}</span>
              </div>
              <div class="col d-flex justify-content-between">
                <span class="label">Penulis:</span><span class="val">{{ $book->author ?: '—' }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="text-center text-muted py-4">© 2025 Library-Hub</footer>


      <div class="toast-container position-fixed top-50 start-50 translate-middle">
          <div id="cartToast" class="toast align-items-center text-bg-success border-0 shadow-lg" role="alert">
              <div class="d-flex">
                  <div class="toast-body text-center fs-6">
                      🛒 Buku berhasil ditambahkan ke keranjang!
                    </div>
                  <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
      </div>

      @endsection

      @push('scripts')
      <script>
        // ===== Qty Utama =====
        const qtyInput = document.getElementById('qty');
        const qtyInlineInput = document.getElementById('qtyInline');
        const qtyBuyNow = document.getElementById('qtyBuyNow'); // 🔥 WAJIB ADA

        document.getElementById('plus').addEventListener('click', () => {
          qtyInput.value = parseInt(qtyInput.value) + 1;
          qtyInlineInput.value = qtyInput.value;
          qtyBuyNow.value = qtyInput.value; // 🔥 UPDATE BERHASIL
        });

        document.getElementById('minus').addEventListener('click', () => {
          if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
            qtyInlineInput.value = qtyInput.value;
            qtyBuyNow.value = qtyInput.value; // 🔥 UPDATE BERHASIL
          }
        });

        qtyInput.addEventListener('input', () => {
          qtyInlineInput.value = qtyInput.value;
          qtyBuyNow.value = qtyInput.value; // 🔥 UPDATE BERHASIL
        });
      </script>
      @endpush