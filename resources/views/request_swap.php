<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin | Library Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      width: 220px;
      position: fixed;
      height: 100vh;
      background-color: #fff;
      border-right: 1px solid #dee2e6;
      padding-top: 20px;
    }
    .sidebar a {
      display: block;
      color: #333;
      padding: 12px 20px;
      text-decoration: none;
      font-weight: 500;
    }
    .sidebar a:hover {
      background-color: #e9ecef;
      border-radius: 8px;
    }
    .main-content {
      margin-left: 240px;
      padding: 30px;
    }
    .welcome-card {
      background-color: #eef3ff;
      border-radius: 12px;
      padding: 25px;
    }
    .stats-card {
      border-radius: 12px;
      text-align: center;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    footer {
      margin-top: 40px;
      text-align: center;
      color: #777;
    }
    .status-badge {
      padding: 5px 10px;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 600;
    }
    .pending { background-color: #fff3cd; color: #856404; }
    .accepted { background-color: #d4edda; color: #155724; }
    .rejected { background-color: #f8d7da; color: #721c24; }

    /* Navbar */
    .navbar-brand span {
      color: #0d6efd;
    }
    .navbar-icon {
      color: #333;
      margin-left: 10px;
      font-size: 1.3rem;
      text-decoration: none;
    }
    .navbar-icon:hover {
      color: #0d6efd;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="dashboard_admin">
      Library-<span>Hub</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <form class="d-flex ms-auto me-3" role="search">
    </form>

    <ul class="navbar-nav align-items-center">
      <li class="nav-item"><a class="nav-link fw-semibold" href="/manajemen_admin">Swapbook</a></li>
      <li class="nav-item"><a class="nav-link fw-semibold" href="/ma">Akun & Role</a></li>
    </ul>

    <div class="d-flex align-items-center ms-3">
      <a href="/keranjang" class="navbar-icon"><i class="bi bi-cart"></i></a>
      <a href="/forumdiscuss" class="navbar-icon"><i class="bi bi-chat-dots"></i></a>
      <a href="/profil_admin" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
  <a href="request_swap"><i class="bi bi-repeat me-2"></i> Permintaan</a>
  <a href="dashboard_admin"><i class="bi bi-book me-2"></i> Buku</a>
</div>

<!-- Main Content -->
<div class="main-content">

  <!-- Welcome Card -->
  <div class="welcome-card mb-4 d-flex justify-content-between align-items-center">
    <div>
      <h4 class="fw-bold">Selamat Datang di Dashboard Admin Library Hub!</h4>
      <p>Kelola permintaan tukar buku, pantau aktivitas pengguna, dan jaga koleksi buku Anda tetap teratur dengan mudah.</p>
    </div>
    <img src="https://cdn-icons-png.flaticon.com/512/4727/4727446.png" alt="Dashboard" width="130">
  </div>

  <!-- Statistik -->
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="stats-card">
        <i class="bi bi-list-task fs-3 text-primary"></i>
        <h5 class="mt-2">Total Permintaan</h5>
        <h3>6</h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="stats-card">
        <i class="bi bi-hourglass-split fs-3 text-warning"></i>
        <h5 class="mt-2">Permintaan Menunggu</h5>
        <h3>3</h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="stats-card">
        <i class="bi bi-check2-square fs-3 text-success"></i>
        <h5 class="mt-2">Permintaan Disetujui</h5>
        <h3>2</h3>
      </div>
    </div>
  </div>

  <!-- Tabel Permintaan Tukar Buku -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="fw-bold mb-3">Daftar Permintaan Tukar Buku</h5>
      <table class="table align-middle">
        <thead class="table-light">
          <tr>
            <th>Pengguna</th>
            <th>Buku</th>
            <th>Tanggal Permintaan</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $permintaan = [
              ["nama" => "Ahmad Faizal", "buku" => "Pengantar Sistem Informasi", "tanggal" => "2024-03-10", "status" => "Pending"],
              ["nama" => "Siti Aminah", "buku" => "Dasar-Dasar Pemrograman Python", "tanggal" => "2024-03-09", "status" => "Disetujui"],
              ["nama" => "Bambang Wiyogo", "buku" => "Ekonomi Mikro: Pendekatan Komprehensif", "tanggal" => "2024-03-08", "status" => "Ditolak"],
              ["nama" => "Dewi Lestari", "buku" => "Sejarah Kuna Indonesia", "tanggal" => "2024-03-07", "status" => "Pending"],
              ["nama" => "Cahyo Utomo", "buku" => "Algoritma dan Struktur Data", "tanggal" => "2024-03-06", "status" => "Pending"],
              ["nama" => "Endah Sukma", "buku" => "Manajemen Keuangan Lanjutan", "tanggal" => "2024-03-05", "status" => "Disetujui"],
            ];

            foreach ($permintaan as $p) {
              $badgeClass = '';
              if ($p['status'] == 'Pending') $badgeClass = 'pending';
              elseif ($p['status'] == 'Disetujui') $badgeClass = 'accepted';
              else $badgeClass = 'rejected';

              echo "<tr>
                      <td>{$p['nama']}</td>
                      <td>{$p['buku']}</td>
                      <td>{$p['tanggal']}</td>
                      <td><span class='status-badge $badgeClass'>{$p['status']}</span></td>
                      <td>
                        <button class='btn btn-success btn-sm'>Setujui</button>
                        <button class='btn btn-danger btn-sm'>Tolak</button>
                      </td>
                    </tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <footer class="mt-5">
    <p>© 2025 Library Hub</p>
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
