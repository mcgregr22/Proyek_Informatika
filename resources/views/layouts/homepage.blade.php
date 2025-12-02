<!DOCTYPE html>
<html lang="id" x-data="{ openSidebar: true }">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <title>@yield('title', 'Library-Hub')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  
  {{-- Bootstrap CSS & Icons: Dipakai oleh konten homepage dan ikon di layout --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  
  <style>
    /* Global Styles */
    *::-webkit-scrollbar { width: 8px; height: 8px; }
    *::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 9999px; }
    *::-webkit-scrollbar-track { background: transparent; }
    
    /* Styling untuk Footer (agar konsisten dengan sidebar border) */
    .footer {
      margin-top: 60px;
      text-align: center;
      padding: 20px 0;
      border-top: 1px solid #e4e4e7; /* Disamakan dengan zinc-200 */
      color: #777;
    }
  </style>
  
  {{-- Tempat untuk STYLE TAMBAHAN dari halaman anak (Homepage) --}}
  @stack('styles')
</head>
<body class="bg-zinc-50 text-zinc-m-0 p-0">

  {{-- HEADER (Sama di semua halaman) --}}
  <header class="sticky top-0 z-40 bg-white border-b border-zinc-200">
    <div class="flex items-center justify-between px-6 h-16">
      
      <div class="flex items-center gap-3">
        <a href="/homepage" class="flex items-center gap-3">
        <span class="text-2xl font-extrabold tracking-tight">
          <span class="text-indigo-600">Library-</span>
          <span class="italic text-zinc-900">Hub</span>
        </span>
        </a>
        
        {{-- TOMBOL TOGGLE SIDEBAR --}}
        <button
          class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-zinc-200 hover:bg-zinc-50"
          @click="openSidebar = !openSidebar"
          aria-label="Toggle sidebar">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>

      {{-- AREA SEARCH FORM KHUSUS --}}
      @yield('search_form')

      {{-- CHAT & PROFIL --}}
      <div class="flex items-center gap-2">
        <a href="/forumdiscuss" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-zinc-100 text-zinc-500">
          <i class="bi bi-chat-dots text-3xl"></i>
        </a>
        <a href="{{ route('profil_user') }}" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-zinc-100 text-zinc-500">
          <i class="bi bi-person-circle text-3xl"></i>
        </a>
      </div>
    </div>
  </header>

    {{-- SIDEBAR + KONTEN --}}
  <div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-white border-r border-zinc-200 shadow-sm flex flex-col"
      x-show="openSidebar"
      x-transition.duration.200ms>
      <nav class="flex-1 px-4 py-5 space-y-1 text-[1.05rem]">

        {{-- Koleksi Buku --}}
        <a href="/pengelolaan/mycollection" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <i class="bi bi-bookmarks text-xl text-zinc-400 group-hover:text-indigo-600"></i>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Koleksi Buku</span>
        </a>

        {{-- Tambah Buku --}}
        <a href="/pengelolaan/tambahbuku" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <i class="bi bi-journal-plus text-xl text-zinc-400 group-hover:text-indigo-600"></i>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Tambah Buku</span>
        </a>

        {{-- Keranjang --}}
        <a href="{{ route('cart.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <i class="bi bi-cart3 text-xl text-zinc-400 group-hover:text-indigo-600"></i>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Keranjang</span>
        </a>

        {{-- Riwayat Pembelian --}}
        <a href="{{ route('purchase.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <i class="bi bi-receipt text-xl text-zinc-400 group-hover:text-indigo-600"></i>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Riwayat Pembelian</span>
        </a>

        {{-- Riwayat Tukar Buku --}}
        <a href="{{ route('swap.history.user') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <i class="bi bi-arrow-left-right text-xl text-zinc-400 group-hover:text-indigo-600"></i>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Riwayat Tukar Buku</span>
        </a>

        {{-- Tukar Buku --}}
        <a href="/pengelolaan/swapbook" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <i class="bi bi-arrow-repeat text-xl text-zinc-400 group-hover:text-indigo-600"></i>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Tukar Buku</span>
        </a>

      </nav>



      {{-- LOGOUT --}}
      <div class="px-4 py-4 border-t border-zinc-100">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50">
            <i class="bi bi-box-arrow-right text-xl"></i>
            <span class="font-semibold">Keluar</span>
          </button>

        </form>
      </div>
    </aside>


    {{-- KONTEN UTAMA (p-8 sama di semua halaman) --}}
    <main class="flex-1 p-8">
      @yield('content')
    </main>
  </div>
  
  {{-- Tempat untuk JS TAMBAHAN dari halaman anak --}}
  @stack('scripts')
  
  {{-- JS Bootstrap diperlukan untuk dropdown/komponen jika ada --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>