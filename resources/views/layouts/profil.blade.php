<!DOCTYPE html>
<html lang="id" x-data="{ openSidebar: true }">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>@yield('title', 'Library-Hub')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  {{-- Bootstrap CSS & Icons: Dipakai oleh konten homepage dan ikon di layout --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    /* Global Styles */
    *::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    *::-webkit-scrollbar-thumb {
      background: #d1d5db;
      border-radius: 9999px;
    }

    *::-webkit-scrollbar-track {
      background: transparent;
    }

    /* Styling untuk Footer (agar konsisten dengan sidebar border) */
    .footer {
      margin-top: 60px;
      text-align: center;
      padding: 20px 0;
      border-top: 1px solid #e4e4e7;
      /* Disamakan dengan zinc-200 */
      color: #777;
    }
  </style>

  {{-- Tempat untuk STYLE TAMBAHAN dari halaman anak (Homepage) --}}
  @stack('styles')
</head>

<body class="bg-zinc-50 text-zinc-m-0 p-0">

  <header class="sticky top-0 z-40 bg-white border-b border-zinc-200">
    <div class="flex items-center px-6 h-16">

      <!-- LOGO -->
      <a href="/homepage" class="flex items-center gap-3">
        <span class="text-2xl font-extrabold tracking-tight">
          <span class="text-indigo-600">Library-</span>
          <span class="italic text-zinc-900">Hub</span>
        </span>
      </a>

      <!-- SPACER: otomatis dorong menu ke kanan -->
      <div class="flex-1"></div>

      <div class="flex items-center gap-8">
        <!-- Forum Discuss button -->
        <a href="/forumdiscuss" class="w-1 h-1 flex items-center justify-center rounded-full hover:bg-zinc-100 text-zinc-500">
          <i class="bi bi-chat-dots text-xl"></i>
        </a>



        <a href="{{ route('profil_user') }}" class="w-1 h-1 flex items-center justify-center rounded-full hover:bg-zinc-100 text-zinc-500">
          <i class="bi bi-person-circle text-xl"></i>
        </a>
      </div>


    </div>
  </header>


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