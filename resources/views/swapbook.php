{{-- resources/views/swapbook.blade.php --}}
<!DOCTYPE html>
<html lang="id" x-data="{ openSidebar: true }">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Book Swaps - Library-Hub</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    *::-webkit-scrollbar { width: 8px; height: 8px; }
    *::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 9999px; }
    *::-webkit-scrollbar-track { background: transparent; }
  </style>
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
        <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-zinc-100 text-zinc-500" aria-label="Chat">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75h6.75m-6.75 3h3.375M18.75 3H6.75A2.25 2.25 0 004.5 5.25v10.5A2.25 2.25 0 006.75 18h2.25l3.75 3 3.75-3h2.25a2.25 2.25 0 002.25-2.25V5.25A2.25 2.25 0 0018.75 3z"/>
          </svg>
        </button>
        <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-zinc-100 text-zinc-500" aria-label="Profile">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1115 0A17.94 17.94 0 0112 21.75c-2.69 0-5.26-.6-7.5-1.5z"/>
          </svg>
        </button>
      </div>
    </div>
  </header>

  <div class="flex min-h-screen">

    {{-- SIDEBAR 
    <aside class="w-72 bg-white border-r border-zinc-200 shadow-sm flex flex-col"
           x-show="openSidebar"
           x-transition.duration.200ms>
      <nav class="flex-1 px-4 py-5 space-y-1 text-[1.05rem]">
        <a href="/koleksi" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6c-1.5-1-3.5-2-6-2-1.657 0-3 .895-3 2v12c0-1.105 1.343-2 3-2 2.5 0 4.5 1 6 2m0-12c1.5-1 3.5-2 6-2 1.657 0 3 .895 3 2v12c0-1.105-1.343-2-3-2-2.5 0-4.5 1-6 2"/>
            </svg>
          </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Koleksi Buku</span>
        </a>

        <a href="/tambahbuku" class="group flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-50">
          <span class="w-6 h-6 text-zinc-400 group-hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6c-1.5-1-3.5-2-6-2-1.657 0-3 .895-3 2v12c0-1.105 1.343-2 3-2 2.5 0 4.5 1 6 2m0-12c1.5-1 3.5-2 6-2 1.657 0 3 .895 3 2v12c0-1.105-1.343-2-3-2-2.5 0-4.5 1-6 2M12 10h6M15 7v6"/>
            </svg>
          </span>
          <span class="font-medium text-zinc-700 group-hover:text-indigo-700">Tambah Buku</span>
        </a>

        <a href="/swapbook" class="group flex items-center gap-3 px-4 py-3 rounded-xl bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200">
          <span class="w-6 h-6 text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 7l2.5-2.5L9 7M20 17l-2.5 2.5L15 17M6.5 4.5A7.5 7.5 0 112 12"/>
            </svg>
          </span>
          <span class="font-semibold">Book Swaps</span>
        </a>
      </nav>

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

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-8">
      <h2 class="text-2xl font-semibold mb-2">Book Swaps</h2>
      <p class="text-sm text-zinc-500 mb-6">Manage your book swap requests</p>

      <div class="flex gap-4 mb-6">
        <button id="incomingBtn" class="px-4 py-2 font-semibold border-b-2 border-black">Incoming Requests</button>
        <button id="outgoingBtn" class="px-4 py-2 font-semibold text-zinc-500 hover:text-black">Outgoing Requests</button>
      </div>

      <div id="incoming" class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-10 text-center text-zinc-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto w-12 h-12 mb-3 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 12h16m-7-7l7 7-7 7" />
        </svg>
        <h5 class="text-lg font-semibold text-zinc-700 mb-1">No incoming swap requests</h5>
        <p class="text-sm mb-4">When someone requests to swap with one of your books, it will appear here.</p>
        <a href="/homepage" class="inline-block px-5 py-2.5 rounded-xl bg-black text-white hover:bg-zinc-800 transition">Browse Books</a>
      </div>

      <div id="outgoing" class="hidden rounded-2xl border border-zinc-200 bg-white shadow-sm p-10 text-center text-zinc-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto w-12 h-12 mb-3 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 12h16m-7-7l7 7-7 7" />
        </svg>
        <h5 class="text-lg font-semibold text-zinc-700 mb-1">No outgoing swap requests</h5>
        <p class="text-sm mb-4">You haven’t requested any swaps yet. Browse and request a book swap.</p>
        <a href="/homepage" class="inline-block px-5 py-2.5 rounded-xl bg-black text-white hover:bg-zinc-800 transition">Browse Books</a>
      </div>
    </main>
  </div>

  <script>
    const incomingBtn = document.getElementById('incomingBtn');
    const outgoingBtn = document.getElementById('outgoingBtn');
    const incoming = document.getElementById('incoming');
    const outgoing = document.getElementById('outgoing');

    incomingBtn.onclick = () => {
      incomingBtn.classList.add('border-black', 'text-black');
      outgoingBtn.classList.remove('border-black', 'text-black');
      incoming.classList.remove('hidden');
      outgoing.classList.add('hidden');
    };

    outgoingBtn.onclick = () => {
      outgoingBtn.classList.add('border-black', 'text-black');
      incomingBtn.classList.remove('border-black', 'text-black');
      outgoing.classList.remove('hidden');
      incoming.classList.add('hidden');
    };
  </script>
</body>
</html>
