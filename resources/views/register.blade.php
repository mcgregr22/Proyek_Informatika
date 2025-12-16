<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Library Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6, #60a5fa);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 20px;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Glass Card */
        .register-card {
            width: 100%;
            max-width: 420px;
            padding: 40px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.17);
            backdrop-filter: blur(14px);
            box-shadow: 0px 8px 25px rgba(0,0,0,0.25);
            color: #ffffff;
            animation: cardPop 0.7s ease;
            margin-top: 40px;
        }

        @keyframes cardPop {
            0% { opacity: 0; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1); }
        }

        h2 {
            text-align: center;
            font-size: 26px;
            margin-bottom: 28px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: #f1f5f9;
            font-weight: 500;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 10px;
            border: none;
            background: rgba(255,255,255,0.85);
            font-size: 14px;
            outline: none;
            transition: .2s;
        }

        input:focus, select:focus {
            background: #ffffff;
            box-shadow: 0 0 0 2px #3b82f6;
        }

        /* Password container */
        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
            font-size: 18px;
        }

        /* Button */
        .btn-submit {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: .25s;
        }

        .btn-submit:hover {
            transform: scale(1.03);
            background: linear-gradient(135deg, #1e40af, #2563eb);
        }

        /* Login Text */
        .login-text {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
            color: #e2e8f0;
        }

        .login-text a {
            color: #ffffffff;
            text-decoration: none;
            font-weight: bold;
        }

        .login-text a:hover {
            text-decoration: underline;
        }

        /* Error & success messages */
        .message {
            padding: 10px;
            margin-bottom: 18px;
            border-radius: 8px;
            font-size: 14px;
        }

        /* Footer */
        footer {
            margin-top: 25px;
            font-size: 13px;
            color: #e0e7ff;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="register-card">
        <h2>Daftar Akun</h2>

        {{-- Success message --}}
        @if (session('success'))
            <div class="message" style="background:#d1fae5;color:#065f46;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="message" style="background:#fee2e2;color:#b91c1c;">
                <ul style="margin-left: 20px;">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" placeholder="Nama lengkap" value="{{ old('nama_lengkap') }}" required>

            <label>Nomor Telepon</label>
            <input type="tel" name="nomor_telepon" placeholder="08xxxx" value="{{ old('nomor_telepon') }}" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="nama@example.com" value="{{ old('email') }}" required>

            <label>Role</label>
            <select name="role" required>
                <option value="pengguna" {{ old('role','pengguna')=='pengguna' ? 'selected' : '' }}>Pengguna</option>
                <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
            </select>

            <label>Kata Sandi</label>
            <div class="password-container">
                <input type="password" name="kata_sandi" id="kata_sandi" placeholder="Kata sandi" required>
                <span class="toggle-password" data-target="kata_sandi" onclick="togglePassword(this)">
                    <i class="bi bi-eye"></i>
                </span>
            </div>

            <label>Konfirmasi Kata Sandi</label>
            <div class="password-container">
                <input type="password" name="kata_sandi_confirmation" id="kata_sandi_confirmation" placeholder="Ulangi kata sandi" required>
                <span class="toggle-password" data-target="kata_sandi_confirmation" onclick="togglePassword(this)">
                    <i class="bi bi-eye"></i>
                </span>
            </div>

            <button type="submit" class="btn-submit">Daftar</button>
        </form>

        <div class="login-text">
            Sudah punya akun? <a href="{{ route('login.show') }}">Masuk</a>
        </div>
    </div>

    <footer>© 2025 Library-Hub</footer>

    <script>
        function togglePassword(el) {
            const target = document.getElementById(el.getAttribute('data-target'));
            const icon = el.querySelector("i");

            if (target.type === "password") {
                target.type = "text";
                icon.classList.replace("bi-eye", "bi-eye-slash");
            } else {
                target.type = "password";
                icon.classList.replace("bi-eye-slash", "bi-eye");
            }
        }
    </script>

</body>
</html>
