<?php
// Data dummy pengguna dan role
$pengguna = [
    ["nama" => "Andi Nugraha", "email" => "andi.nugraha@libhub.com", "peran" => "Admin"],
    ["nama" => "Budi Santoso", "email" => "budi.santoso@libhub.com", "peran" => "Pengguna"],
    ["nama" => "Citra Dewi", "email" => "citra.dewi@libhub.com", "peran" => "Pengguna"],
    ["nama" => "Dian Permata", "email" => "dian.permata@libhub.com", "peran" => "Pengguna"],
    ["nama" => "Eka Wijaya", "email" => "eka.wijaya@libhub.com", "peran" => "Pengguna"]
];

$roles = ["Admin", "Pengguna"];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Akun | Library-Hub</title>
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
        font-size: 1.2rem;
        margin-left: 15px;
        color: #333;
        transition: color 0.2s;
    }
    .navbar-icon:hover {
        color: #0d6efd;
    }
    .page-title {
        font-weight: 700;
        margin-top: 30px;
    }
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.05);
    }
    .btn-primary, .btn-success {
        border-radius: 8px;
    }
    .table th {
        color: #0d6efd;
    }
    .footer {
        margin-top: 60px;
        text-align: center;
        padding: 20px 0;
        border-top: 1px solid #ddd;
        color: #777;
    }
    .section-title {
    color: #003f88; 
    font-weight: 700;
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
      <input class="form-control" type="search" placeholder="Cari Buku">
    </form>

    <ul class="navbar-nav align-items-center">
      <li class="nav-item"><a class="nav-link fw-semibold" href="/manajemen_admin">Pengaturan</a></li>
    </ul>

    <div class="d-flex align-items-center ms-3">
      <a href="/keranjang" class="navbar-icon"><i class="bi bi-cart"></i></a>
      <a href="/forumdiscuss" class="navbar-icon"><i class="bi bi-chat-dots"></i></a>
      <a href="/profil_admin" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
    </div>
  </div>
</nav>

<!-- Konten -->
<div class="container py-5">
  <h3 class="section-title mb-4">Manajemen Akun</h3>

  <!-- Daftar Pengguna -->
  <div class="card mb-4">
    <div class="card-body">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Peran</th>
            <th class="text-center">Tindakan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($pengguna as $user): ?>
            <tr>
              <td><?= $user['nama']; ?></td>
              <td><?= $user['email']; ?></td>
              <td><span class="badge bg-secondary"><?= $user['peran']; ?></span></td>
              <td class="text-center">
                <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="bi bi-pencil"></i></button>
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Tambah Akun Baru -->
  <div class="card shadow-sm mb-5">
    <div class="card-body">
      <h5 class="mb-3 fw-semibold">Tambah Akun Pengguna Baru</h5>
      <form>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" placeholder="Masukkan nama pengguna">
          </div>
          <div class="col-md-4">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="Masukkan email pengguna">
          </div>
          <div class="col-md-3">
            <label class="form-label">Peran</label>
            <select class="form-select">
              <?php foreach($roles as $r): ?>
                <option><?= $r; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-1 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-plus-circle"></i> Tambah</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Manajemen Role -->
  <h4 class="section-title mb-5">Manajemen Role</h4>
  <div class="card mb-4">
    <div class="card-body">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Nama Role</th>
            <th class="text-center">Tindakan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($roles as $r): ?>
            <tr>
              <td><?= $r; ?></td>
              <td class="text-center">
                <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editRoleModal"><i class="bi bi-pencil"></i></button>
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Tambah Role Baru -->
  <div class="card mb-5">
    <div class="card-body">
      <h5 class="mb-3 fw-semibold">Tambah Role Baru</h5>
      <form>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nama Role</label>
            <input type="text" class="form-control" placeholder="Masukkan nama role baru">
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-success w-100"><i class="bi bi-plus-circle"></i> Tambah Role</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Akun Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" value="Andi Nugraha">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="andi.nugraha@libhub.com">
          </div>
          <div class="mb-3">
            <label class="form-label">Peran</label>
            <select class="form-select">
              <option>Admin</option>
              <option>Pengguna</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Role -->
<div class="modal fade" id="editRoleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Nama Role</label>
            <input type="text" class="form-control" value="Admin">
          </div>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="footer">
  &copy; <?= date('Y'); ?> Library-Hub
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
