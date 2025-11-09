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
    .search-form {
      display: flex;
      align-items: center;
      gap: 8px;
      width: 400px;
    }
    .search-form select {
      border: 1px solid #ced4da;
      border-radius: 6px;
      padding: 6px 10px;
    }
    .search-form input {
      flex: 1;
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
  </style>
</head>
<body>
    
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
  <div class="container">
    <!-- Logo kiri -->
    <a class="navbar-brand fw-bold" href="/homepage">Library-<span>Hub</span></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    

      <!-- Ikon kanan -->
      <div class="d-flex align-items-center ms-3">
        <a href="/forumdiscuss" class="text-dark me-3"><i class="bi bi-chat-dots fs-5"></i></a>
        <a href="{{ route('profil_user') }}" class="text-dark"><i class="bi bi-person-circle fs-5"></i></a>
      </div>
    </div>
  </div>
</nav>

<!-- Konten Profil -->
<div class="container">
  <div class="profile-card mt-5">

    <div class="profile-header">
      <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Profile Picture">
      <h4>{{ $user->name }}</h4>
    </div>

    <div class="form-section">
    <h5>Profil</h5>
    <form action="{{ route('profil_user.update') }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Nomor Telepon</label>
        <input type="text" class="form-control" name="phone" value="{{ $user->phone ?? '' }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Role</label>
        <input type="text" class="form-control" name="role" value="{{ $user->role }}" readonly>
      </div>

      <hr>

      <h5>Akun</h5>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email_confirm" value="{{ $user->email }}">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Password</label>
          <div class="input-group">
            <input id="passwordInput" type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
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
</div>
<script>
  document.getElementById("togglePassword").addEventListener("click", function() {
    const passwordInput = document.getElementById("passwordInput");
    const toggleIcon = document.getElementById("toggleIcon");

    // Ganti tipe input password <-> text
    const isPassword = passwordInput.type === "password";
    passwordInput.type = isPassword ? "text" : "password";

    // Ganti ikon mata
    toggleIcon.classList.toggle("bi-eye");
    toggleIcon.classList.toggle("bi-eye-slash");
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
