<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Manajemen Admin | Library-Hub')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .navbar-brand span {
      color: #0d6efd;
      font-weight: 700;
    }
    .navbar-icon {
      font-size: 1.3rem;
      margin-left: 10px;
      color: #333;
      transition: color 0.2s;
    }
    .navbar-icon:hover {
      color: #0d6efd;
    }
  </style>
</head>
<body>

<!-- Navbar Ringkas -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('homepage_admin') }}">
      Library-<span>Hub</span>
    </a>
    <div class="d-flex align-items-center ms-auto">
      <a href="{{ route('admin.profil') }}" class="navbar-icon">
        <i class="bi bi-person-circle"></i>
      </a>
    </div>
  </div>
</nav>

<!-- Konten Dinamis -->
<div class="container mt-4">
  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- ✅ Tambahkan baris ini supaya script dari halaman (seperti SweetAlert) bisa dimuat --}}
@yield('extra-scripts')
@stack('scripts')

</body>
</html>