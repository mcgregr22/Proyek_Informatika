<!DOCTYPE html>
<html lang="id" x-data="{ openSidebar: true }">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Library-Hub')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    *::-webkit-scrollbar { width: 8px; height: 8px; }
    *::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 9999px; }
    *::-webkit-scrollbar-track { background: transparent; }
  </style>
  @stack('styles')
</head>
<body class="bg-zinc-50 text-zinc-800">

  {{-- HEADER --}}
  <header class="sticky top-0 z-40 bg-white border-b border-zinc-200">
    <div class="flex items-center justify-between px-6 h-16">
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

      <div class="flex items-center gap-4">
        <a href="/forumdiscuss" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-zinc-100 text-zinc-500">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75h6.75m-6.75 3h3.375M18.75 3H6.75A2.25 2.25 0 004.5 5.25v10.5A2.25 2.25 0 006.75 18h2.25l3.75 3 3.75-3h2.25a2.25 2.25 0 002.25-2.25V5.25A2.25 2.25 0 0018.75 3z"/>
          </svg>
        </a>
        <a href="/profil_user" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-zinc-100 text-zinc-500">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1115 0A17.94 17.94 0 0112 21.75c-2.69 0-5.26-.6-7.5-1.5z"/>
          </svg>
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
        <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            📚
          </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Koleksi Buku</span>
        </a>

        <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200">
          <span class="w-6 h-6 text-indigo-600">➕</span>
          <span class="font-semibold">Tambah Buku</span>
        </a>

        <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">💳</span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Purchases</span>
        </a>

        <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">💰</span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Sales</span>
        </a>

        <a href="/pengelolaan/swapbook" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">🔄</span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Book Swaps</span>
        </a>

        <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">📦</span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Book Requests</span>
        </a>
      </nav>

      <div class="px-4 py-4 border-t border-zinc-100">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50">
            🚪 <span class="font-semibold">Logout</span>
          </button>
        </form>
      </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-8">
      @yield('content')
    </main>
  </div>

  @stack('scripts')
</body>
</html>
