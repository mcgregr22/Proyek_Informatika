@extends('layouts.detailbuku')

@section('title', 'Detail Buku - ' . $book->title)

{{-- 1. Menyuntikkan CSS khusus Detail Buku --}}
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
  body {
    background: #f5f7fa;
    font-family: "Inter", sans-serif;
  }

  .page-wrap {
    max-width: 1100px;
    margin: 32px auto;
  }

  .panel {
    background: #fff;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, .06);
  }

  h2.title {
    font-size: 28px;
    font-weight: 800;
  }

  .price {
    color: #2563eb;
    font-size: 28px;
    font-weight: 700;
  }

  .thumb {
    width: 100%;
    border-radius: 14px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .1);
    object-fit: cover;
  }

  .qty .btn {
    width: 40px;
    height: 40px;
    font-size: 18px;
  }

  .btn-modern {
    padding: 12px 20px;
    font-weight: 600;
    border-radius: 12px;
  }

  .info-grid .label {
    color: #6b7280;
    font-size: 14px;
  }

  .info-grid .val {
    font-weight: 600;
    color: #111;
  }

  .toast {
    opacity: 0;
    transform: translateY(10px);
    transition: all .35s ease;
  }

  .toast.show {
    opacity: 1;
    transform: translateY(0);
  }
</style>
@endpush


@section('content')

<a href="{{ url()->previous() }}"
  class="d-inline-flex align-items-center gap-2 mb-3 px-4 py-2 rounded-3 text-primary"
  style="background:#eef4ff; border:1px solid #d0dffe; font-weight:600;">
  <i class="bi bi-arrow-left fs-5"></i>
  Kembali
</a>


<div class="page-wrap">
  <div class="panel">

    <div class="row g-4">

      {{-- =======================
            BAGIAN KIRI (GAMBAR)
      ======================== --}}
      <div class="col-md-4 text-center">
        @if($book->cover_image)
        <img src="{{ asset('storage/' . $book->cover_image) }}" class="thumb" alt="cover">
        @else
        <div class="thumb d-flex align-items-center justify-content-center bg-light" style="height:380px;">
          📘
        </div>
        @endif
      </div>

      {{-- =======================
            BAGIAN KANAN (DETAIL)
      ======================== --}}
      <div class="col-md-8">

        <h2 class="title">{{ $book->title }}</h2>
        <div class="text-muted mb-1">oleh <strong>{{ $book->author }}</strong></div>

        @if(str_contains($book->listing_type, 'sell'))
        <div class="price mb-4">Rp {{ number_format($book->harga,0,',','.') }}</div>
        @endif

        @if(str_contains($book->listing_type, 'sell'))
        {{-- QTY + ADD TO CART --}}
        <div class="d-flex align-items-center mb-4">
          <span class="me-3 text-muted">Jumlah:</span>

          <div class="qty input-group" style="width:150px;">
            <button class="btn btn-outline-secondary" type="button" id="minus">−</button>
            <input type="number" min="1" value="1" class="form-control text-center" id="qty">
            <button class="btn btn-outline-secondary" type="button" id="plus">+</button>
          </div>

          <form id="addCartInline" action="{{ route('cart.add') }}" method="POST" class="ms-3">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id_buku }}">
            <input type="hidden" name="qty" id="qtyInline" value="1">
            <button type="submit" class="btn btn-success btn-modern d-flex align-items-center gap-2">
              <i class="bi bi-cart-plus fs-5"></i> Tambah
            </button>
          </form>
        </div>
        @endif

        {{-- BUTTONS --}}
        <div class="d-flex gap-3 flex-wrap mb-4">

          @if(str_contains($book->listing_type, 'exchange'))
          <form action="{{ route('mycollection.index') }}" method="GET">
            <input type="hidden" name="requested" value="{{ $book->id_buku }}">
            <button type="submit" class="btn btn-primary btn-modern d-flex align-items-center gap-2">
              <i class="bi bi-arrow-repeat"></i> Tukar Buku
            </button>
          </form>
          @endif

          @if(str_contains($book->listing_type, 'sell'))
          <form action="{{ route('midtrans.buyNow', $book->id_buku) }}" method="POST">
            @csrf
            <input type="hidden" id="qtyBuyNow" name="qty" value="1">
            <button type="submit" class="btn btn-warning btn-modern text-dark fw-bold">
              Beli Sekarang
            </button>
          </form>
          @endif

        </div>

        {{-- DESKRIPSI --}}
        <h5 class="fw-bold mt-4">Deskripsi Buku</h5>
        <p class="text-muted" style="line-height:1.7;">
          {{ $book->deskripsi ?: 'Belum ada deskripsi.' }}
        </p>

        {{-- INFO BUKU --}}
        <h5 class="fw-bold mt-4">Informasi Buku</h5>
        <div class="row row-cols-1 row-cols-md-2 g-3 info-grid">
          <div class="col d-flex justify-content-between">
            <span class="label">Bahasa:</span><span class="val">{{ $book->bahasa ?: '-'}}</span>
          </div>
          <div class="col d-flex justify-content-between">
            <span class="label">Penerbit:</span><span class="val">{{ $book->penerbit ?: '-' }}</span>
          </div>
          <div class="col d-flex justify-content-between">
            <span class="label">Terdaftar oleh:</span><span class="val">{{ $book->user->name ?? '-' }}</span>
          </div>
          <div class="col d-flex justify-content-between">
            <span class="label">Tanggal Rilis:</span><span class="val">{{ $book->tanggal_rilis ?: '-'}}</span>
          </div>
          <div class="col d-flex justify-content-between">
            <span class="label">ISBN:</span><span class="val">{{ $book->isbn ?: '-' }}</span>
          </div>
          <div class="col d-flex justify-content-between">
            <span class="label">Kondisi:</span><span class="val">{{ $book->kondisi ?: '-' }}</span>
          </div>
          <div class="col d-flex justify-content-between">
            <span class="label">Kategori:</span><span class="val">{{ $book->kategori?? '-' }}</span>
          </div>
        </div>

      </div>

    </div>

  </div>
</div>

{{-- TOAST NOTIFIKASI --}}
<div class="toast-container position-fixed top-0 start-50 translate-middle-x p-4" style="z-index:9999;">
  <div id="cartToast" class="toast align-items-center text-white bg-success border-0 shadow-lg">
    <div class="d-flex">
      <div class="toast-body">
        ✅ Buku berhasil ditambahkan ke keranjang!
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

  document.getElementById("addCartInline").addEventListener("submit", function(e) {
    e.preventDefault(); // cegah submit default

    let form = this;

    // Kirim form via AJAX agar tidak reload
    fetch(form.action, {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": form.querySelector('input[name="_token"]').value,
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          book_id: form.querySelector('input[name="book_id"]').value,
          qty: form.querySelector('input[name="qty"]').value
        })
      })
      .then(res => res.json())
      .then(() => {
        // Tampilkan TOAST
        let toastEl = document.getElementById('cartToast');
        let toast = new bootstrap.Toast(toastEl);
        toast.show();
      })
      .catch(err => console.error("Error:", err));
  });
</script>
@endpush