<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Perpustakaan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #B1C9EF;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-card {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(17,24,39,0.08);
            border: 1px solid #E5E7EB;
            max-width: 400px;
            width: 100%;
            animation: fadeIn 0.6s ease-out;
        }
        h1 {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            color: #0f172a;
        }
        p.subtitle {
            text-align: center;
            color: #334155;
            margin-bottom: 1.5rem;
        }
        label {
            font-weight: 600;
            color: #1f2937;
            display: block;
            margin-bottom: 0.5rem;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        input:focus {
            border-color: #7AA6E0;
            box-shadow: 0 0 5px rgba(122, 166, 224, 0.5);
            outline: none;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        .checkbox-group label {
            margin-left: 0.5rem;
            font-weight: normal;
            color: #555;
        }
        .btn {
            width: 100%;
            padding: 0.75rem;
            background: #1E40AF; /* dark blue */
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            color: white;
            cursor: pointer;
            transition: background 0.3s, transform 0.1s;
        }
        .btn:hover {
            background: #1E3A8A; /* darker */
        }
        .btn:active {
            transform: scale(0.98);
        }
        .link-register {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #666;
        }
        .link-register a {
            color: #1d4ed8;
            font-weight: bold;
            text-decoration: none;
        }
        .link-register a:hover {
            text-decoration: underline;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h1>📚 Masuk ke Sistem Perpustakaan</h1>
        <p class="subtitle">Kelola peminjaman buku Anda dengan mudah</p>

        @if (session('status'))
            <div style="color: green; margin-bottom: 1rem; font-size: 0.9rem;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div style="color: red; font-size: 0.85rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password">
                @error('password')
                    <div style="color: red; font-size: 0.85rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="checkbox-group">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Ingat saya</label>
            </div>

            <!-- Tombol -->
            <button type="submit" class="btn">Masuk</button>

            <!-- Link Register -->
            <div class="link-register">
                Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
            </div>
        </form>
    </div>

</body>
</html>