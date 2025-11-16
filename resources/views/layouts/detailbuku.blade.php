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
          <i class="bi bi-chat-dots text-xl"></i>
        </a>
        <a href="{{ route('profil_user') }}" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-zinc-100 text-zinc-500">
          <i class="bi bi-person-circle text-xl"></i>
        </a>
      </div>
    </div>
  </header>

  <!-- <div class="flex min-h-screen">

    {{-- SIDEBAR (Sama di semua halaman) --}}
    <aside class="w-72 bg-white border-r border-zinc-200 shadow-sm flex flex-col"
        x-show="openSidebar"
        x-transition.duration.200ms>
      <nav class="flex-1 px-4 py-4 space-y-1 text-[1.05rem]">

        {{-- Navigasi Sidebar --}}
        <a href="/pengelolaan/mycollection" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6c-1.5-1-3.5-2-6-2-1.657 0-3 .895-3 2v12c0-1.105 1.343-2 3-2 2.5 0 4.5 1 6 2m0-12c1.5-1 3.5-2 6-2 1.657 0 3 .895 3 2v12c0-1.105-1.343-2-3-2-2.5 0-4.5 1-6 2"/>
            </svg>
          </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Koleksi Buku</span>
        </a>

        <a href="/pengelolaan/tambahbuku" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6c-1.5-1-3.5-2-6-2-1.657 0-3 .895-3 2v12c0-1.105 1.343-2 3-2 2.5 0 4.5 1 6 2m0-12c1.5-1 3.5-2 6-2 1.657 0 3 .895 3 2v12c0-1.105-1.343-2-3-2-2.5 0-4.5 1-6 2M12 10h6M15 7v6"/>
            </svg>
          </span>
          <span class="font-semibold">Tambah Buku</span>
        </a>

        <a href="/pengelolaan/keranjang" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m12-9l2 9M9 21h6"/>
          </svg>
        </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Keranjang</span>
        </a>

        <a href="/pengelolaan/purchase" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h3.586a2 2 0 011.414.586l6.828 6.828a2 2 0 010 2.828l-2.586 2.586a2 2 0 01-2.828 0L6.586 13A2 2 0 016 11.586V8a1 1 0 011-1z"/><circle cx="9" cy="9" r="1.25"/>
            </svg>
          </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Purchase</span>
        </a>

        <a href="/pengelolaan/swapbook" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 7l2.5-2.5L9 7M20 17l-2.5 2.5L15 17M6.5 4.5A7.5 7.5 0 112 12"/>
            </svg>
          </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Tukar Buku</span>
        </a>

        <a href="/pengelolaan/request_swap" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20 12v8a2 2 0 01-2 2H6a2 2 0 01-2-2v-8m16 0H4m16 0h-5a3 3 0 100-6c-2 0-3 2-3 3 0-1-1-3-3-3a3 3 0 100 6H4"/>
            </svg>
          </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Permintaan Tukar Buku</span>
        </a>
      </nav>

      {{-- LOGOUT --}}
      <div class="px-4 py-4 border-t border-zinc-100">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50">
            <span class="w-6 h-6">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M16 17v-1a4 4 0 00-4-4H5.5a.5.5 0 010-1H12a5 5 0 015 5v1h1a1 1 0 110 2H6a1 1 0 110-2h10z"/>
                <path d="M7 7a5 5 0 1110 0v1H7V7z"/>
              </svg>
            </span>
            <span class="font-semibold">Keluar</span>
          </button>
        </form>
      </div>
    </aside> -->

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