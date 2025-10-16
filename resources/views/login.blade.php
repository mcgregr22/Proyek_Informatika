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
        }

        button:hover {
            background-color: #1d1dbe;
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

        /* ✨ Tambahan: pesan error */
        .error {
            color: red;
            font-size: 13px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            
            
            <h2>LOGIN</h2>

            <!-- ✅ Tambahan untuk tampilkan validasi error & pesan sukses -->
            @if ($errors->any())
                <p class="error">{{ $errors->first() }}</p>
            @endif

            @if (session('success'))
                <p class="error" style="color:green;">{{ session('success') }}</p>
            @endif
            <!-- ✅ END TAMBAHAN -->

            <form action="/login" method="POST">
                @csrf
                <label for="email">Email</label><br>
                <input type="email" name="email" placeholder="nama@contoh.com" required><br>

                <label for="password">Kata Sandi</label><br>
                <input type="password" name="password" placeholder="••••••" required><br>

                <button type="submit">MASUK</button>

                <!-- 🔻 tampilkan pesan error kalau login gagal -->
                @if(session('error'))
                    <p class="error">{{ session('error') }}</p>
                @endif
            </form>

            <div class="register-link">
                Belum punya akun? <a href="/register">Daftar</a>
            </div>
        </div>

        <div class="footer">
        &copy; <?= date('Y'); ?> Library-Hub
</div>
    </div>
</body>
</html>
