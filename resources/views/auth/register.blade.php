<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Baru - Sistem Perpustakaan</title>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #B1C9EF;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .register-card {
            background: #fff;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(17,24,39,0.08);
            border: 1px solid #E5E7EB;
            max-width: 420px;
            width: 100%;
            animation: fadeIn 0.6s ease-out;
        }
        h1 {
            font-size: 1.9rem;
            font-weight: bold;
            text-align: center;
            color: #0f172a;
        }
        p.subtitle {
            text-align: center;
            color: #334155;
            margin-top: 0.4rem;
            margin-bottom: 2rem;
        }
        label {
            font-weight: 600;
            color: #374151;
            display: block;
            margin-bottom: 0.5rem;
        }
        input {
            width: 100%;
            padding: 0.8rem;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            background-color: #f9fafb;
            transition: border-color 0.3s, box-shadow 0.3s, background 0.3s;
        }
        input:hover {
            background-color: #fff;
        }
        input:focus {
            border-color: #7AA6E0;
            box-shadow: 0 0 6px rgba(122, 166, 224, 0.5);
            outline: none;
            background-color: #fff;
        }
        .btn {
            width: 100%;
            padding: 0.85rem;
            background: #1E40AF; /* dark blue */
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
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
        .link-login {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #6b7280;
        }
        .link-login a {
            color: #1d4ed8;
            font-weight: bold;
            text-decoration: none;
        }
        .link-login a:hover {
            text-decoration: underline;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="register-card">
        <!-- Judul -->
        <h1>📝 Buat Akun Baru</h1>
        <p class="subtitle">Daftar untuk mulai meminjam buku</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label for="name">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required autocomplete="new-password">
                @error('password')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
                @error('password_confirmation')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div style="margin-top: 1.5rem;">
                <button type="submit" class="btn">Daftar</button>
            </div>

            <!-- Link ke Login -->
            <div class="link-login">
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk</a>
            </div>
        </form>
    </div>

</body>
</html>