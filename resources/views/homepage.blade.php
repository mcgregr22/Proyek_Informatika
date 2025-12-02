@extends('layouts.homepage')

@section('title', 'Library-Hub Home')

{{-- 1. Menyuntikkan CSS khusus Homepage --}}
@push('styles')
<style>
  /* Menghilangkan margin/padding bawaan browser */
  body {
    background-color: #f0f3f5;
    /* Warna latar yang lebih lembut dari #f8f9fa */
  }

  /* Menghilangkan jarak header di atas banner */
  .banner {
    /* Menjaga styling gradient & warna */
    background: linear-gradient(135deg, #0b2256 0%, #3e64ff 100%);
    color: white;
    border-radius: 16px;
    padding: 50px 40px;
    margin-top: 0px;
    box-shadow: 0 10px 30px rgba(13, 30, 86, 0.4);
    transition: transform 0.3s ease;

    text-align: center;
  }

  .banner:hover {
    transform: scale(1.005);
    box-shadow: 0 12px 35px rgba(13, 30, 86, 0.55);
  }

  .banner h2 {
    font-weight: 800;
    font-size: 2.2rem;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
  }

  /* ========================================
   SEARCH FORM
   ======================================== */
  .search-form {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    max-width: 600px;
  }

  .search-form select,
  .search-form input {
    border-radius: 10px;
    /* Lebih membulat */
    padding: 8px 14px;
    border: 1px solid #d1d5db;
    /* Border abu-abu halus */
    background-color: #fff;
    transition: all 0.3s ease;
  }

  .search-form input {
    width: 55%;
  }

  .search-form select:focus,
  .search-form input:focus {
    border-color: #4f46e5;
    /* Biru Indigo */
    box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
    outline: none;
  }

  /* ========================================
   SECTION HEADERS & BUTTONS
   ======================================== */
  .section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 3.5rem;
    margin-bottom: 1rem;
    padding-bottom: 8px;
    border-bottom: 2px solid #e5e7eb;
    /* Garis pemisah yang bersih */
  }

  .section-header h5 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1f2937;
    /* Warna teks gelap */
  }

  .section-header a {
    color: #4f46e5;
    /* Warna tautan Indigo */
    font-weight: 500;
    transition: color 0.3s ease;
  }

  .section-header a:hover {
    color: #3730a3;
    text-decoration: underline;
  }

  /* Tombol Pengelolaan (Mencolok dan Modern) */
  .btn-manage {
    background: linear-gradient(90deg, #4f46e5 0%, #3e64ff 100%);
    /* Gradien Indigo */
    color: #fff;
    border: none;
    border-radius: 25px;
    font-size: 0.9rem;
    padding: 10px 20px;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
    transition: all 0.3s ease;
  }

  .btn-manage:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(79, 70, 229, 0.6);
    filter: brightness(1.1);
  }

  /* Tombol Kembali */
  .btn-back {
    background: linear-gradient(90deg, #ffffff 0%, #ffffffff 100%);
    /* Gradien abu-abu */
    color: #fff;
    border: none;
    border-radius: 25px;
    font-size: 0.9rem;
    padding: 8px 16px;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(50, 53, 59, 0.4);
    transition: all 0.3s ease;
  }

  .btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(107, 114, 128, 0.6);
    filter: brightness(1.1);
  }

  /* ========================================
    BOOK CARDS
   ======================================== */
  .book-card {
    border: 1px solid #f3f4f6;
    /* Border sangat halus */
    border-radius: 12px;
    background-color: #fff;
    box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
    /* Shadow halus saat diam */
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    /* Mengamankan sudut */
  }

  .book-card:hover {
    transform: translateY(-6px);
    /* Mengangkat lebih tinggi */
    box-shadow: 0 18px 30px rgba(0, 0, 0, 0.15);
    /* Shadow dramatis saat hover */
  }

  /* Gambar Buku */
  .book-thumb {
    width: 100%;
    height: 250px;
    /* Tinggi yang lebih vertikal */
    object-fit: cover;
    border-radius: 10px;
    /* Menyesuaikan sudut card */
  }

  .price {
    color: #ef4444;
    /* Warna merah yang kontras (merah Tailwind 500) */
    font-weight: 700;
    font-size: 1.1rem;
    margin-top: 5px;
  }

  /* Listing Badges */
  .listing-badge {
    position: absolute;
    top: 8px;
    left: 8px;
    font-size: 0.65rem;
    padding: 4px 10px;
    border-radius: 10px;
    font-weight: 700;
    color: #fff;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
  }

  .listing-badge.sell {
    background: linear-gradient(45deg, #f59e0b, #d97706);
    /* Orange/Amber */
  }

  .listing-badge.exchange {
    background: linear-gradient(45deg, #10b981, #059669);
    /* Hijau Teal/Emerald */
  }

  /* Footer styling sudah terintegrasi di Master Layout */

  @media (max-width: 768px) {
    .book-thumb {
      height: 180px;
    }

    .search-form input {
      width: 70%;
    }
  }
</style>
@endpush

{{-- 2. Menyuntikkan Search Form ke Header Master Layout --}}
@section('search_form')
<form id="searchForm" class="search-form mx-auto d-none d-lg-flex" role="search" action="{{ route('homepage') }}" method="GET">
  <select name="kategori" class="form-select" id="kategoriSelect">
    <option value="">Kategori</option>
    @foreach ($kategoriList as $kat)
    <option value="{{ $kat->nama_kategori }}"
      {{ $kategoriDipilih == $kat->nama_kategori ? 'selected' : '' }}>
      {{ $kat->nama_kategori }}
    </option>
    @endforeach
  </select>

  <input class="form-control" type="search" name="q" value="{{ $q ?? '' }}" placeholder="Cari Buku...">
  
  <!-- Tambahkan tombol submit untuk memudahkan -->
  <button type="submit" class="btn btn-primary">Cari</button>
</form>

{{-- JavaScript untuk submit form saat dropdown kategori berubah --}}
@push('scripts')
<script>
  document.getElementById('kategoriSelect').addEventListener('change', function() {
    document.getElementById('searchForm').submit();
  });
</script>
@endpush
@endsection

<!-- 3. Konten Utama -->
@section('content')

<div class="container-fluid p-0">

  <div class="banner">
    <h2>Selamat Datang di Library-Hub</h2>
  </div>

  <!-- 🔍 Pesan jika hasil pencarian kosong -->
  @if(($q || $kategoriDipilih) && $booksRecs->isEmpty())
    <div class="alert alert-warning mt-3 mx-3 text-center">
        @if($q)
          Buku "<strong>{{ $q }}</strong>" tidak ditemukan.
        @else
          Buku di kategori "<strong>{{ $kategoriDipilih }}</strong>" tidak ditemukan.
        @endif
    </div>
  @endif

  {{-- Jika ada query pencarian ($q) atau kategori dipilih, tampilkan hasil --}}
  @if($q || $kategoriDipilih)
    @if($booksRecs->isNotEmpty())
      <div class="section-header mt-4">
        <h5>
          @if($q)
            Hasil Pencarian untuk "{{ $q }}"
          @else
            Buku di Kategori "{{ $kategoriDipilih }}"
          @endif
        </h5>
        {{-- Tombol Kembali --}}
        <a href="{{ route('homepage') }}" class="btn btn-back">Kembali</a>
      </div>
      <div class="row g-3">
        @foreach ($booksRecs as $b)
        <div class="col-6 col-md-4 col-lg-2">
          <div class="card book-card h-100 position-relative">
            <a href="{{ route('buku.show', $b->id_buku) }}" class="text-decoration-none text-dark">

              {{-- 🔹 Label Listing Type --}}
              @php $types = explode(',', $b->listing_type ?? ''); @endphp
              <div class="position-absolute d-flex flex-column gap-1" style="top:8px; left:8px;">
                @foreach ($types as $type)
                @if (trim($type) === 'sell')
                <span class="listing-badge sell">Dijual</span>
                @elseif (trim($type) === 'exchange')
                <span class="listing-badge exchange">Tukar</span>
                @endif
                @endforeach
              </div>

              <div class="card-body text-center">
                @if($b->cover_image)
                <img src="{{ asset('storage/' . $b->cover_image) }}" alt="cover" class="book-thumb mb-2">
                @else
                <div class="py-5 bg-light rounded mb-2">📕</div>
                @endif
                <h6 class="fw-semibold text-truncate">{{ $b->title }}</h6>
                <div class="text-muted small">{{ $b->author }}</div>
                <div class="badge rounded-pill bg-light text-dark small fw-semibold">{{ $b->kondisi }}</div>
                <div class="price mt-1">Rp {{ number_format($b->harga,0,',','.') }}</div>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
    @endif
  {{-- Jika tidak ada query pencarian atau kategori, tampilkan daftar buku per kategori --}}
  @else
    {{-- ================================
      DAFTAR BUKU PER KATEGORI OTOMATIS
    ================================ --}}
    @foreach ($kategoriWithBooks as $kat)
      @if ($kat->books->isNotEmpty())
          <div class="section-header">
              <h5 class="fw-semibold">{{ $kat->nama_kategori }}</h5>
              <a href="{{ route('homepage', ['kategori' => $kat->nama_kategori]) }}" class="text-decoration-none small text-primary">Lihat Selengkapnya...</a>
          </div>

          <div class="row g-3 mb-4">
              @foreach ($kat->books as $b)
                  <div class="col-6 col-md-4 col-lg-2">
                      <div class="card book-card h-100 position-relative">
                          <a href="{{ route('buku.show', $b->id_buku) }}" class="text-decoration-none text-dark">

                              {{-- 🔹 Label Listing Type --}}
                              @php $types = explode(',', $b->listing_type ?? ''); @endphp
                              <div class="position-absolute d-flex flex-column gap-1" style="top:8px; left:8px;">
                                @foreach ($types as $type)
                                @if (trim($type) === 'sell')
                                <span class="listing-badge sell">Dijual</span>
                                @elseif (trim($type) === 'exchange')
                                <span class="listing-badge exchange">Tukar</span>
                                @endif
                                @endforeach
                              </div>

                              <div class="card-body text-center">
                                  {{-- COVER --}}
                                  @if($b->cover_image)
                                      <img src="{{ asset('storage/' . $b->cover_image) }}"
                                           alt="cover" class="book-thumb mb-2">
                                  @else
                                      <div class="py-5 bg-light rounded mb-2">📕</div>
                                  @endif

                                  {{-- JUDUL --}}
                                  <h6 class="fw-semibold text-truncate">{{ $b->title }}</h6>

                                  {{-- AUTHOR --}}
                                  <div class="text-muted small">{{ $b->author }}</div>

                                  {{-- KONDISI --}}
                                  <div class="badge rounded-pill bg-light text-dark small fw-semibold">
                                      {{ $b->kondisi }}
                                  </div>

                                  {{-- HARGA --}}
                                  <div class="price mt-1">
                                      Rp {{ number_format($b->harga, 0, ',', '.') }}
                                  </div>

                              </div>
                          </a>
                      </div>
                  </div>
              @endforeach
          </div>
      @endif
    @endforeach
  @endif

</div>
@endsection