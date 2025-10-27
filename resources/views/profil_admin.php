<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin | Library-Hub</title>
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
        .profile-card {
            background-color: #fff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            margin-top: 40px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .profile-header img {
            width: 100px;
            border-radius: 50%;
            border: 2px solid #0d6efd;
        }
        .profile-header h4 {
            margin-top: 15px;
            color: #0d6efd;
            font-weight: 600;
        }
        .form-section {
            margin-top: 20px;
        }
        .form-section h5 {
            font-weight: 600;
            margin-bottom: 15px;
        }
        .btn-save {
            background-color: #0d6efd;
            color: white;
            padding: 10px 30px;
            border-radius: 6px;
            font-weight: 600;
        }
        .btn-save:hover {
            background-color: #004aad;
        }
    </style>
</head>
<body>

<<<<<<< HEAD
  <!-- Navbar -->
=======
<!-- Navbar -->
>>>>>>> 50cb22ed0ce8d30be1974ec7aa8867a37e645c50
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('homepage_admin') }}">
      Library-<span>Hub</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <form class="d-flex ms-auto me-3" role="search">
      <input class="form-control" type="search" placeholder="Cari Buku">
    </form>

    <ul class="navbar-nav align-items-center">
      <li class="nav-item"><a class="nav-link fw-semibold" href="/request_swap">Tukar Buku</a></li>
      <li class="nav-item"><a class="nav-link fw-semibold" href="/manajemen_admin">Akun & Role</a></li>
    </ul>

<<<<<<< HEAD
    <div class="d-flex align-items-center ms-3">
      <a href="/keranjang" class="navbar-icon"><i class="bi bi-cart"></i></a>
      <a href="/forumdiscuss" class="navbar-icon"><i class="bi bi-chat-dots"></i></a>
      <a href="/profil_admin" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
    </div>
  </div>
=======
   <div class="d-flex align-items-center ms-3">
   <a href="/keranjang" class="navbar-icon"><i class="bi bi-cart"></i></a>
   <a href="/forumdiscuss" class="navbar-icon"><i class="bi bi-chat-dots"></i></a>
   <a href="{{ route('profil_admin') }}" class="navbar-icon">
      <i class="bi bi-person-circle"></i>
   </a>
</div>
>>>>>>> 50cb22ed0ce8d30be1974ec7aa8867a37e645c50
</nav>

<!-- Konten Profil -->
<div class="container">
    <div class="profile-card mt-5">
        <div class="profile-header">
            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Profile Picture">
            <h4>{{ $admin->name }}</h4>
        </div>

        <div class="form-section">
            <h5>Profil</h5>
            <form>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{ $admin->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $admin->email }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" value="{{ $admin->phone ?? '-' }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <input type="text" class="form-control" value="{{ $admin->role ?? 'Admin' }}" readonly>
                </div>

                <hr>

                <h5>Account</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $admin->email }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input id="passwordInput" type="password" class="form-control" value="{{ $admin->password }}" readonly>
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                <i id="toggleIcon" class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="button" class="btn-save" disabled>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle tampil/sembunyi password
    document.addEventListener('DOMContentLoaded', function () {
        const pwd = document.getElementById('passwordInput');
        const btn = document.getElementById('togglePassword');
        const icon = document.getElementById('toggleIcon');

        btn.addEventListener('click', function () {
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                pwd.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });
</script>

</body>
</html>
    