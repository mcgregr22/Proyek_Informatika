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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  @stack('styles')
</head>

  {{-- KONTEN UTAMA (p-8 sama di semua halaman) --}}
  <main class="flex-1 p-8">
    @yield('content')
  </main>

{{-- Tempat untuk JS TAMBAHAN dari halaman anak --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

{{-- JS Bootstrap diperlukan untuk dropdown/komponen jika ada --}}
</body>

</html>