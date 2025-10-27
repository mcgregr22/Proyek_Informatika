<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil User | Library-Hub</title>
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
    .profile-card {
      background-color: #fff;
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      margin-top: 40px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
      position: relative;
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
    .btn-logout {
      position: absolute;
      top: 20px;
      right: 20px;
      border: none;
      background-color: #f8f9fa;
      color: #dc3545;
      font-weight: 600;
      padding: 8px 16px;
      border-radius: 6px;
      transition: all 0.3s;
    }
    .btn-logout:hover {
      background-color: #dc3545;
      color: white;
    }
  </style>
</head>
<body>

  <!-- Konten Profil -->
  <div class="container">
    <div class="profile-card mt-5">
      <button class="btn-logout" id="logoutBtn"><i class="bi bi-box-arrow-right"></i> Keluar</button>

      <div class="profile-header">
        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Profile Picture">
        <h4>{{ $user->name }}</h4>
      </div>

      <div class="form-section">
        <h5>Profil</h5>
        <form>
          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
          </div>

          <div class="mb-3">
            <label class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" value="{{ $user->telepon ?? '-' }}" readonly>
          </div>

          <div class="mb-3">
            <label class="form-label">Role</label>
            <input type="text" class="form-control" value="{{ $user->role ?? 'pengguna' }}" readonly>
          </div>

          <hr>

          <h5>Account</h5>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" value="{{ $user->email }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Password</label>
              <div class="input-group">
                <input id="passwordInput" type="password" class="form-control" value="{{ $user->password }}" readonly>
                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                  <i id="toggleIcon" class="bi bi-eye"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="text-center mt-4">
            <button type="submit" class="btn-save">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const pwd = document.getElementById('passwordInput');
      const btn = document.getElementById('togglePassword');
      const icon = document.getElementById('toggleIcon');
      btn.addEventListener('click', function () {
        if (pwd.type === 'password') {
          pwd.type = 'text';
          icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
          pwd.type = 'password';
          icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
      });
      const logoutBtn = document.getElementById('logoutBtn');
      logoutBtn.addEventListener('click', function () {
        if (confirm('Apakah Anda yakin ingin keluar dari akun ini?')) {
          window.location.href = "/login";
        }
      });
    });
  </script>

</body>
</html>