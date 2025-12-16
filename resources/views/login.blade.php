<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Hub</title>

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
            justify-content: center;
            align-items: center;
            padding: 20px;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* CARD LOGIN (Glassmorphism) */
        .login-card {
            width: 100%;
            max-width: 380px;
            padding: 40px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            color: #ffffff;
            animation: cardPop 0.7s ease;
        }

        @keyframes cardPop {
            0% { opacity: 0; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1); }
        }

        .title {
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 35px;
            letter-spacing: 1px;
        }

        label {
            font-size: 14px;
            margin-bottom: 6px;
            display: block;
            color: #f1f5f9;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 10px;
            border: none;
            background: rgba(255,255,255,0.85);
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        input:focus {
            background: #ffffff;
            box-shadow: 0 0 0 2px #3b82f6;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            font-size: 15px;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            transform: scale(1.03);
            background: linear-gradient(135deg, #1e40af, #2563eb);
        }

        .register {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #e2e8f0;
        }

        .register a {
            color: #ffffffff;
            text-decoration: none;
            font-weight: bold;
        }

        .register a:hover {
            text-decoration: underline;
        }

        .error {
            margin-top: -10px;
            margin-bottom: 15px;
            font-size: 13px;
            color: #ffb3b3;
            text-align: center;
        }
    </style>

</head>

<body>

    <div class="login-card">

        <div class="title">Masuk ke Library-Hub</div>

        <!-- Error & success -->
        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif

        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        @if (session('success'))
            <p class="error" style="color:#bbffbb;">{{ session('success') }}</p>
        @endif

        <form action="/login" method="POST">
            @csrf

            <label>Email</label>
            <input type="email" name="email" placeholder="nama@contoh.com" required>

            <label>Kata Sandi</label>
            <input type="password" name="password" placeholder="••••••••" required>

            <button type="submit">Masuk</button>
        </form>

        <div class="register">
            Belum punya akun? <a href="/register">Daftar</a>
        </div>
    </div>

</body>
</html>
