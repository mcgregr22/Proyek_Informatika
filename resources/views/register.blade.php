<?php
// Bagian ini adalah simulasi sederhana untuk menangani data yang dikirimkan
$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $nomor_telepon = trim($_POST['nomor_telepon']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $kata_sandi = $_POST['kata_sandi'];
    $konfirmasi_sandi = $_POST['konfirmasi_sandi'];

    // 1. Validasi Sederhana
    if (empty($nama_lengkap) || empty($nomor_telepon) || empty($email) || empty($kata_sandi) || empty($konfirmasi_sandi)) {
        $error_message = "Semua kolom harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Format email tidak valid.";
    } elseif ($kata_sandi !== $konfirmasi_sandi) {
        $error_message = "Kata Sandi dan Konfirmasi Kata Sandi tidak cocok.";
    } else {
        // --- SIMULASI PENYIMPANAN DATA (GANTIKAN DENGAN LOGIKA DATABASE ANDA) ---
        $success_message = "Registrasi berhasil! Data Anda: Nama: $nama_lengkap, Email: $email, Role: $role";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Library-Hub</title>
    <style>
        /* Gaya dasar (sebagian besar sama dengan kode asli) */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            width: 100%;
            padding: 20px 50px;
            box-sizing: border-box;
            color: #3f51b5;
            font-size: 24px;
            font-weight: bold;
            text-align: left;
        }

        .register-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin-top: 50px;
        }

        .register-container h2 {
            color: #3f51b5;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }

        /* Container untuk Input Sandi dan Ikon */
        .password-container {
            position: relative; /* Penting untuk memposisikan ikon */
            margin-bottom: 20px;
        }

        .password-container input[type="text"],
        .password-container input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            color: #6c757d;
            padding-right: 40px; /* Tambahkan ruang untuk ikon */
            margin-bottom: 0; /* Hapus margin bawah default */
        }

        /* Ikon Mata (Show/Hide) */
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
            font-size: 18px;
            /* Jika menggunakan Font Awesome, ganti dengan styling ikon */
        }

        /* Styling input umum yang lain */
        .form-group input[type="text"],
        .form-group input[type="tel"],
        .form-group input[type="email"],
        .form-group select {
             /* Semua input selain sandi tetap menggunakan gaya umum */
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            color: #6c757d;
        }

        .btn-daftar {
            width: 100%;
            padding: 12px;
            background-color: #3f51b5;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        
        /* Tambahan styling pesan error/sukses */
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            text-align: center;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>

    <div class="header">Library-Hub</div>

    <div class="register-container">
        <h2>REGISTER</h2>

        <?php
        if ($error_message) {
            echo '<div class="message error">' . $error_message . '</div>';
        }
        if ($success_message) {
            echo '<div class="message success">' . $success_message . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap Anda" required>
            </div>

            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="tel" id="nomor_telepon" name="nomor_telepon" placeholder="Nomor Telepon" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email Anda" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="Pengguna">Pengguna</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kata_sandi">Kata Sandi</label>
                <div class="password-container">
                    <input type="password" id="kata_sandi" name="kata_sandi" placeholder="Kata Sandi" required>
                    <span class="toggle-password" data-target="kata_sandi" onclick="togglePassword(this)">👁️</span>
                </div>
            </div>

            <div class="form-group">
                <label for="konfirmasi_sandi">Konfirmasi Kata Sandi</label>
                <div class="password-container">
                    <input type="password" id="konfirmasi_sandi" name="konfirmasi_sandi" placeholder="Konfirmasi Kata Sandi" required>
                    <span class="toggle-password" data-target="konfirmasi_sandi" onclick="togglePassword(this)">👁️</span>
                </div>
            </div>

            <button type="submit" class="btn-daftar">Daftar</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="login.php">Masuk</a>
        </div>
    </div>
    
    <div class="footer">
        © 2025 Library-Hub
    </div>

<script>
    /**
     * Fungsi untuk mengubah tipe input password menjadi text (show) atau sebaliknya (hide).
     * @param {HTMLElement} iconElement - Elemen ikon mata yang diklik.
     */
    function togglePassword(iconElement) {
        // Ambil ID dari input yang terhubung
        const targetId = iconElement.getAttribute('data-target');
        const passwordInput = document.getElementById(targetId);

        // Periksa tipe input saat ini
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            // Ubah ikon/teks menjadi 'sembunyikan' (misal: 🔒 atau teks)
            iconElement.textContent = '🔒';
        } else {
            passwordInput.type = 'password';
            // Ubah ikon/teks menjadi 'tampilkan' (misal: 👁️ atau teks)
            iconElement.textContent = '👁️';
        }
    }
</script>

</body>
</html>