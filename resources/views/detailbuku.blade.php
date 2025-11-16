@extends('layouts.detailbuku') 

@section('title', 'Detail Buku - ' . $book->title)

{{-- 1. Menyuntikkan CSS khusus Detail Buku --}}
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
  /* Base styles sudah diatur di Master Layout */
  
  /* Layout Specific Styles */
  .page-wrap{max-width:1100px;margin:24px auto;padding:0 16px}
  .panel{background:#fff;border:1px solid #e9ecef;border-radius:12px;padding:28px}
  
  /* Typography & Colors */
  .title{font-weight:700;color:#111}
  .price{color:#0d6efd;font-weight:700;font-size:24px}
  .muted{color:#6b7280}
  
  /* Controls & Buttons */
  .qty .btn{width:36px;height:36px}
  .thumb{width:100%;max-width:280px;border-radius:10px;object-fit:cover;border:1px solid #eee}
  .info-grid .label{color:#6b7280}
  .info-grid .val{font-weight:600;color:#111}
  .btn-outline{border-color:#c7d2fe;color:#3b5bdb}
  .btn-outline:hover{background:#eef2ff}
  
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

          {{-- Tombol Beli Sekarang (Membuka Modal) --}}
          <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#purchaseModal">
            <i class="bi bi-bag me-2"></i>Beli Sekarang
          </button>
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
          <span class="label">Penulis:</span><span class="val">{{ $book->author ?: '—' }}</span>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="text-center text-muted py-4">© 2025 Library-Hub</footer>


{{-- Modal Pembelian --}}
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 shadow-lg border-0">
      <div class="modal-header bg-dark text-white rounded-top-4">
        <h5 class="modal-title" id="purchaseModalLabel">🛒 Informasi Pembelian</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('purchase.payment', $book->id_buku) }}" method="POST">
      @csrf
        <div class="modal-body p-4">
          <div class="mb-3">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="{{ Auth::user()->name ?? '' }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Alamat Pengiriman</label>
            <textarea name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Nomor Telepon</label>
            <input type="text" name="phone" class="form-control" placeholder="Masukkan nomor HP aktif" required>
          </div>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Jumlah</label>
              <input type="number" name="qty" id="qtyModal" min="1" value="1" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Metode Pembayaran</label>
              <select name="payment_method" class="form-select" required>
                <option value="">Pilih Metode</option>
                <option value="transfer">Transfer Bank</option>
                <option value="cod">Bayar di Tempat (COD)</option>
                <option value="ewallet">E-Wallet (GoPay/OVO/Dana)</option>
              </select>
            </div>
          </div>
          <div class="mt-4 text-end">
            <h5>Total: Rp <span id="totalPriceModal">{{ number_format($book->harga, 0, ',', '.') }}</span></h5>
            <input type="hidden" name="total" id="totalHiddenModal" value="{{ $book->harga }}">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle me-2"></i>Lanjutkan ke Pembayaran
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

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
// Script perhitungan total otomatis
const qtyModal = document.getElementById('qtyModal');
const totalPriceModal = document.getElementById('totalPriceModal');
const totalHiddenModal = document.getElementById('totalHiddenModal');
const hargaBuku = {{ $book->harga }};

qtyModal.addEventListener('input', () => {
  const qty = parseInt(qtyModal.value) || 1;
  const total = hargaBuku * qty;
  totalPriceModal.textContent = total.toLocaleString('id-ID');
  totalHiddenModal.value = total;
});

// Qty Plus Minus controls
const qtyInput = document.getElementById('qty');
const qtyInlineInput = document.getElementById('qtyInline');
document.getElementById('plus').addEventListener('click', () => {
  qtyInput.value = parseInt(qtyInput.value) + 1;
  qtyInlineInput.value = qtyInput.value;
});
document.getElementById('minus').addEventListener('click', () => {
  if (parseInt(qtyInput.value) > 1) {
    qtyInput.value = parseInt(qtyInput.value) - 1;
    qtyInlineInput.value = qtyInput.value;
  }
});
qtyInput.addEventListener('change', () => {
    qtyInlineInput.value = qtyInput.value;
});


// Script untuk Toast notifikasi keranjang
document.getElementById('addCartInline').addEventListener('submit', async function(e) {
  e.preventDefault();

  const form = this;
  const formData = new FormData(form);
  
  // Update qty before submitting
  formData.set('qty', document.getElementById('qty').value);

  try {
    const res = await fetch(form.action, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
      },
      body: formData
    });

    if (res.ok) {
      const toastEl = document.getElementById('cartToast');
      const toast = new bootstrap.Toast(toastEl);
      toast.show();
    } else {
      alert('❌ Gagal menambahkan ke keranjang. Pastikan Anda sudah login.');
    }
  } catch (error) {
    console.error(error);
    alert('Terjadi kesalahan saat menambahkan ke keranjang.');
  }
});
</script>
@endpush