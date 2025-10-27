{{-- resources/views/pengelolaan.blade.php --}}
<!DOCTYPE html>
<html lang="id" x-data="{ openSidebar: true }">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Library-Hub</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    *::-webkit-scrollbar { width: 8px; height: 8px; }
    *::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 9999px; }
    *::-webkit-scrollbar-track { background: transparent; }
  </style>
</head>
<body class="bg-zinc-50 text-zinc-800">

  {{-- HEADER: brand kiri + hamburger kanan --}}
  <header class="sticky top-0 z-40 bg-white border-b border-zinc-200">
    <div class="flex items-center justify-between px-6 h-16">

      {{-- KIRI: Brand + hamburger --}}
      <div class="flex items-center gap-3">
        <span class="text-2xl font-extrabold tracking-tight">
          <span class="text-indigo-600">Library-</span>
          <span class="italic text-zinc-900">Hub</span>
        </span>
        <button
          class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-zinc-200 hover:bg-zinc-50"
          @click="openSidebar = !openSidebar"
          aria-label="Toggle sidebar">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>

      {{-- KANAN: Chat + Profil --}}
      <div class="flex items-center gap-4">
        <a href="/forumdiscuss" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-zinc-100 text-zinc-500" aria-label="Chat">
          <i class="bi bi-chat-dots text-xl"></i>
        </a>
        <a href="/profil_user" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-zinc-100 text-zinc-500" aria-label="Profile">
          <i class="bi bi-person-circle text-xl"></i>
        </a>
      </div>
    </div>
  </header>

  <div class="flex min-h-screen">

    {{-- SIDEBAR penuh kiri --}}
    <aside class="w-72 bg-white border-r border-zinc-200 shadow-sm flex flex-col"
           x-show="openSidebar"
           x-transition.duration.200ms>
      <nav class="flex-1 px-4 py-5 space-y-1 text-[1.05rem]">
        <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6c-1.5-1-3.5-2-6-2-1.657 0-3 .895-3 2v12c0-1.105 1.343-2 3-2 2.5 0 4.5 1 6 2m0-12c1.5-1 3.5-2 6-2 1.657 0 3 .895 3 2v12c0-1.105-1.343-2-3-2-2.5 0-4.5 1-6 2"/>
            </svg>
          </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Koleksi Buku</span>
        </a>

        <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200">
          <span class="w-6 h-6 text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6c-1.5-1-3.5-2-6-2-1.657 0-3 .895-3 2v12c0-1.105 1.343-2 3-2 2.5 0 4.5 1 6 2m0-12c1.5-1 3.5-2 6-2 1.657 0 3 .895 3 2v12c0-1.105-1.343-2-3-2-2.5 0-4.5 1-6 2M12 10h6M15 7v6"/>
            </svg>
          </span>
          <span class="font-semibold">Tambah Buku</span>
        </a>

        <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h3.586a2 2 0 011.414.586l6.828 6.828a2 2 0 010 2.828l-2.586 2.586a2 2 0 01-2.828 0L6.586 13A2 2 0 016 11.586V8a1 1 0 011-1z"/><circle cx="9" cy="9" r="1.25"/>
            </svg>
          </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Purchases</span>
        </a>

        <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-4-8a4 4 0 018 0c0 2.209-1.791 4-4 4s-4 1.791-4 4"/>
            </svg>
          </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Sales</span>
        </a>

        {{-- Book Swaps --}}
        <a href="/pengelolaan/swapbook" id="bookSwapsLink" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 7l2.5-2.5L9 7M20 17l-2.5 2.5L15 17M6.5 4.5A7.5 7.5 0 112 12"/>
            </svg>
          </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Book Swaps</span>
        </a>

        <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20 12v8a2 2 0 01-2 2H6a2 2 0 01-2-2v-8m16 0H4m16 0h-5a3 3 0 100-6c-2 0-3 2-3 3 0-1-1-3-3-3a3 3 0 100 6H4"/>
            </svg>
          </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Book Requests</span>
        </a>
      </nav>

      {{-- LOGOUT --}}
      <div class="px-4 py-4 border-t border-zinc-100">
        <a href="#logout" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50">
          <span class="w-6 h-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
              <path d="M16 17v-1a4 4 0 00-4-4H5.5a.5.5 0 010-1H12a5 5 0 015 5v1h1a1 1 0 110 2H6a1 1 0 110-2h10z"/>
              <path d="M7 7a5 5 0 1110 0v1H7V7z"/>
            </svg>
          </span>
          <span class="font-semibold">Logout</span>
        </a>
      </div>
    </aside>

    {{-- MAIN --}}
    <main id="mainContent" class="flex-1 p-8">
      <h2 class="text-2xl font-semibold mb-2">My Books</h2>
      <p class="text-sm text-zinc-500 mb-6">Manage your book collection and listings</p>

      <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-10 text-center text-zinc-500">
        Belum ada buku yang ditambahkan.
      </div>
    </main>
  </div>
</body>
</html>
