k
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Freelance Lokal</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f8f1eb;
            color: #4b2e20;
        }

        .navbar {
            background: #754522;
            color: white;
            padding: 28px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
            font-size: 28px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 35px;
            font-size: 18px;
        }

        .container {
            max-width: 555px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 45px;
            border-radius: 22px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            font-size: 40px;
            color: #754522;
            margin: 0 0 15px;
        }

        .subtitle {
            text-align: center;
            color: #806b5d;
            margin-bottom: 38px;
            font-size: 18px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 18px;
        }

        input:not([type="checkbox"]) {
            width: 100%;
            padding: 16px;
            margin-bottom: 24px;
            border: 1px solid #ddc8b7;
            border-radius: 10px;
            font-size: 16px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        .remember label {
            margin: 0;
            font-size: 15px;
            font-weight: normal;
        }

        button {
            width: 100%;
            padding: 16px;
            background: #754522;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #5d351b;
        }

        .register {
            text-align: center;
            margin-top: 30px;
            color: #806b5d;
        }

        .register a {
            color: #754522;
            font-weight: bold;
            text-decoration: none;
        }

        .error {
            background: #f8d7da;
            color: #842029;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        @media (max-width: 600px) {
            .card {
                padding: 30px 25px;
            }

            .navbar {
                padding: 20px;
            }

            .navbar h2 {
                font-size: 20px;
            }

            .navbar a {
                margin-left: 12px;
                font-size: 15px;
            }

            h1 {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <h2>Freelance Lokal</h2>

    <div>
        <a href="/">Beranda</a>
        <a href="/register">Daftar</a>
    </div>
</nav>

<div class="container">
    <div class="card">

        <h1>Selamat Datang</h1>

        <p class="subtitle">
            Login untuk melanjutkan ke Freelance Lokal
        </p>

        @if(session('status'))
            <p>{{ session('status') }}</p>
        @endif

        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email"
                autocomplete="username"
                required
                autofocus
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                autocomplete="current-password"
                required
            >

            <div class="remember">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    value="1"
                >

                <label for="remember">
                    Ingat saya
                </label>
            </div>

            <button type="submit">Login</button>
        </form>

        <p class="register">
            Belum punya akun?
            <a href="/register">Daftar sekarang</a>
        </p>

    </div>
</div>

</body>
</html>

