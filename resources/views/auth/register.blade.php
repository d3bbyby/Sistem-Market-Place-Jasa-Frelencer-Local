<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar - Freelance Lokal</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f8f2ed;
            color: #4b2e20;
        }

        .navbar {
            height: 88px;
            background: #754522;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 75px;
        }

        .logo {
            color: white;
            font-size: 28px;
            font-weight: bold;
        }

        .nav-menu {
            display: flex;
            gap: 40px;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-size: 17px;
        }

        .container {
            min-height: calc(100vh - 88px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .register-card {
            width: 480px;
            max-width: 100%;
            background: white;
            border: 1px solid #eaded5;
            border-radius: 18px;
            padding: 38px 45px;
            box-shadow: 0 10px 30px rgba(75, 46, 32, 0.08);
        }

        .title {
            text-align: center;
        }

        .title h1 {
            color: #754522;
            font-size: 32px;
            margin-bottom: 8px;
        }

        .title p {
            color: #8b7769;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #dccabd;
            border-radius: 8px;
            background: #fffdfb;
            font-size: 14px;
            color: #4b2e20;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #754522;
        }

        .btn-daftar {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #754522;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }

        .btn-daftar:hover {
            background: #5d351b;
        }

        .login-text {
            text-align: center;
            margin-top: 25px;
            color: #8b7769;
            font-size: 14px;
        }

        .login-text a {
            color: #754522;
            font-weight: bold;
            text-decoration: none;
        }

        .error-box {
            background: #f9dfdc;
            color: #a34d43;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
        }

        .error-box ul {
            padding-left: 18px;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 0 20px;
            }

            .logo {
                font-size: 22px;
            }

            .nav-menu {
                gap: 15px;
            }

            .register-card {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">Freelance Lokal</div>
        <div class="nav-menu">
            <a href="/">Beranda</a>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </nav>

    <div class="container">
        <div class="register-card">
            <div class="title">
                <h1>Daftar Akun</h1>
                <p>Buat akun untuk bergabung dengan Freelance Lokal</p>
            </div>

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input id="name" type="text" name="name"
                           value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email"
                           value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password"
                           name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password"
                           name="password_confirmation" required>
                </div>

                <div class="form-group">
                    <label for="role">Daftar Sebagai</label>
                    <select id="role" name="role" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Client</option>
                        <option value="freelancer" {{ old('role') === 'freelancer' ? 'selected' : '' }}>Freelancer</option>
                    </select>
                </div>

                <button type="submit" class="btn-daftar">Daftar</button>
            </form>

            <div class="login-text">
                Sudah punya akun?
                <a href="{{ route('login') }}">Login sekarang</a>
            </div>
        </div>
    </div>
</body>
</html>
