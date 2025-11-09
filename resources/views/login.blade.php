<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Hub</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: #fff;
            padding: 120px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
            position: relative;
        }

        h2 {
            color: #000000ff;
            font-size: 20px;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #2b2bff;
            border: none;
            border-radius: 4px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s ease-in-out;
        }

        button:hover {
            background-color: #1d1dbe;
            transform: translateY(-2px);
        }

        .footer {
            margin-top: 40px;
            color: #666;
            font-size: 13px;
        }

        .register-link {
            margin-top: 10px;
            font-size: 14px;
        }

        .register-link a {
            color: #2b2bff;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 10px;
        }

        /* ✨ Alert bergaya modern dengan ikon segitiga */
        .alert {
            display: flex;
            align-items: center;
            gap: 8px;
            border-radius: 6px;
            padding: 10px 15px;
            font-size: 14px;
            margin-bottom: 20px;
            animation: fadeInDown 0.4s ease-out;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-icon {
            font-size: 16px;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-10px); }
        }

        .fade-out {
            animation: fadeOut 0.5s ease-in-out forwards;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">

            {{-- ✅ Alert warning atau sukses --}}
            @if (session('warning'))
                <div class="alert alert-warning" id="alertMessage">
                    <span class="alert-icon">⚠️</span>
                    <span>{{ session('warning') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" id="alertMessage">
                    <span class="alert-icon">✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <h2>LOGIN</h2>

            {{-- ✅ Validasi error --}}
            @if ($errors->any())
                <p class="error">{{ $errors->first() }}</p>
            @endif

            <form action="/login" method="POST">
                @csrf
                <label for="email">Email</label><br>
                <input type="email" name="email" placeholder="nama@contoh.com" required><br>

                <label for="password">Kata Sandi</label><br>
                <input type="password" name="password" placeholder="••••••" required><br>

                <button type="submit">MASUK</button>

                @if(session('error'))
                    <p class="error">{{ session('error') }}</p>
                @endif
            </form>

            <div class="register-link">
                Belum punya akun? <a href="/register">Daftar</a>
            </div>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Library-Hub
        </div>
    </div>

    <script>
        // ✨ Efek fade-out otomatis setelah 4 detik
        const alertBox = document.getElementById('alertMessage');
        if (alertBox) {
            setTimeout(() => {
                alertBox.classList.add('fade-out');
                setTimeout(() => alertBox.remove(), 500);
            }, 4000);
        }
    </script>
</body>
</html>
