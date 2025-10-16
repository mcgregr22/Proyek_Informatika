<!-- resources/views/register.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Library-Hub</title>
    <style>
        /* Gaya dasar */
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

        /* Container utama formulir */
        .register-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin-top: 50px;
            /* Tambahkan margin bawah agar ada jarak ke copyright di bawahnya */
            margin-bottom: 20px; 
        }

        /* Judul Register */
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
            position: relative;
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
            padding-right: 40px;
            margin-bottom: 0;
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
        }

        /* Styling input umum yang lain */
        .form-group input[type="text"],
        .form-group input[type="tel"],
        .form-group input[type="email"],
        .form-group select {
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

        /* PERBAIKAN: Styling Copyright Footer */
        .copyright-footer {
            /* Pastikan lebar sama dengan register-container */
            width: 100%; 
            max-width: 480px; /* Lebar = max-width container (400px) + padding kiri/kanan (2x40px = 80px) */
            text-align: center;
            font-size: 12px;
            color: #6c757d; /* Warna abu-abu yang lebih cocok */
            margin-top: 20px; /* Jarak dari register-container di atasnya */
        }
    </style>
</head>
<body>

    <div class="header">Library-Hub</div>

    <div class="register-container">
        <h2>REGISTER</h2>

        {{-- Pesan sukses dari session --}}
        @if (session('success'))
            <div class="message" style="background:#e7f7ee;color:#065f46;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validasi error Laravel --}}
        @if ($errors->any())
            <div class="message" style="background:#fde8e8;color:#b91c1c;text-align:left;">
                <ul style="margin:0 0 0 18px;padding:0;">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input
                    type="text"
                    id="nama_lengkap"
                    name="nama_lengkap"
                    placeholder="Nama Lengkap Anda"
                    value="{{ old('nama_lengkap') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input
                    type="tel"
                    id="nomor_telepon"
                    name="nomor_telepon"
                    placeholder="Nomor Telepon"
                    value="{{ old('nomor_telepon') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Email Anda"
                    value="{{ old('email') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    {{-- Label tetap seperti desainmu; value diset lowercase agar cocok dengan DB/validasi --}}
                    <option value="pengguna" {{ old('role','pengguna')=='pengguna' ? 'selected' : '' }}>Pengguna</option>
                    <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kata_sandi">Kata Sandi</label>
                <div class="password-container">
                    <input
                        type="password"
                        id="kata_sandi"
                        name="kata_sandi"
                        placeholder="Kata Sandi"
                        required>
                    <span class="toggle-password" data-target="kata_sandi" onclick="togglePassword(this)">👁️</span>
                </div>
            </div>

            <div class="form-group">
                <label for="kata_sandi_confirmation">Konfirmasi Kata Sandi</label>
                <div class="password-container">
                    <input
                        type="password"
                        id="kata_sandi_confirmation"
                        name="kata_sandi_confirmation"
                        placeholder="Konfirmasi Kata Sandi"
                        required>
                    <span class="toggle-password" data-target="kata_sandi_confirmation" onclick="togglePassword(this)">👁️</span>
                </div>
            </div>

            <button type="submit" class="btn-daftar">Daftar</button>
        </form>
        
        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login.show') }}">Masuk</a>
        </div>
    </div>
    
    <div class="copyright-footer">
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
            // Ubah ikon/teks menjadi 'sembunyikan'
            iconElement.textContent = '🔒';
        } else {
            passwordInput.type = 'password';
            // Ubah ikon/teks menjadi 'tampilkan'
            iconElement.textContent = '👁️';
        }
    }
</script>

</body>
</html>
