<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk - FreelanceHub</title>

    <style>
        :root {
            --purple: #7047EB;
            --purple-dark: #5030B5;
            --lavender: #F0EBFF;
            --text: #30264B;
            --muted: #89829E;
            --border: #E7E1F4;
            --white: #FFFFFF;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #FAF9FF;
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        .page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .visual {
            padding: 45px 9%;
            background: linear-gradient(145deg, #EDE7FF, #FFF0E7 72%, #FFF9E7);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 11px;
            color: var(--purple);
            font-size: 23px;
            font-weight: 800;
            position: relative;
            z-index: 1;
        }

        .logo-icon {
            width: 39px;
            height: 39px;
            border-radius: 13px;
            background: linear-gradient(135deg, #9878FF, #623BDE);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .visual-content {
            max-width: 490px;
            margin: 50px auto;
            position: relative;
            z-index: 1;
        }

        .visual-badge {
            display: inline-block;
            background: rgba(255,255,255,0.75);
            color: var(--purple);
            padding: 10px 14px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 22px;
        }

        .visual-content h1 {
            font-size: clamp(34px, 4vw, 52px);
            line-height: 1.15;
            letter-spacing: -1.5px;
            margin-bottom: 20px;
        }

        .visual-content h1 span {
            color: var(--purple);
        }

        .visual-content p {
            color: #756C8E;
            font-size: 15px;
            line-height: 1.9;
        }

        .visual-cards {
            margin-top: 35px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .visual-card {
            background: rgba(255,255,255,0.8);
            border: 1px solid white;
            border-radius: 16px;
            padding: 17px;
        }

        .visual-card span {
            display: block;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .visual-card strong {
            font-size: 13px;
        }

        .visual-footer {
            color: #817795;
            font-size: 12px;
            position: relative;
            z-index: 1;
        }

        .decor {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .decor-one {
            width: 240px;
            height: 240px;
            right: -95px;
            top: 15%;
            background: #9878FF22;
        }

        .decor-two {
            width: 180px;
            height: 180px;
            bottom: -60px;
            left: -65px;
            background: #FFB99F45;
        }

        .form-side {
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 45px 8%;
        }

        .form-box {
            width: 100%;
            max-width: 420px;
        }

        .mobile-logo {
            display: none;
        }

        .form-heading {
            margin-bottom: 28px;
        }

        .form-heading .tag {
            font-size: 12px;
            font-weight: 800;
            color: var(--purple);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .form-heading h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .form-heading p {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.7;
        }

        .message {
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 17px;
            font-size: 13px;
            line-height: 1.6;
        }

        .error-message {
            background: #FFF0F1;
            color: #B42332;
        }

        .field {
            margin-bottom: 19px;
        }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .field input {
            width: 100%;
            height: 49px;
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: 0 14px;
            background: #FFFEFF;
            color: var(--text);
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        .field input:focus {
            border-color: var(--purple);
            box-shadow: 0 0 0 3px #7047EB17;
        }

        .field input::placeholder {
            color: #B0A9C0;
        }

        .field-error {
            display: block;
            color: #B42332;
            font-size: 12px;
            margin-top: 7px;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 23px;
            font-size: 12px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #766E8A;
        }

        .remember input {
            accent-color: var(--purple);
            width: 15px;
            height: 15px;
        }

        .forgot {
            color: var(--purple);
            font-weight: bold;
        }

        .submit {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 11px;
            color: white;
            background: linear-gradient(135deg, #8464F7, #6842E6);
            box-shadow: 0 7px 18px #7047EB25;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .submit:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #7955F0, #5030B5);
        }

        .register-link {
            margin-top: 25px;
            color: var(--muted);
            font-size: 13px;
            text-align: center;
        }

        .register-link a {
            color: var(--purple);
            font-weight: bold;
        }

        .back-home {
            display: inline-block;
            color: #887F9F;
            font-size: 12px;
            margin-top: 25px;
        }

        .back-home:hover {
            color: var(--purple);
        }

        @media (max-width: 800px) {
            .page {
                grid-template-columns: 1fr;
            }

            .visual {
                display: none;
            }

            .form-side {
                min-height: 100vh;
                padding: 35px 7%;
            }

            .mobile-logo {
                display: flex;
                margin-bottom: 40px;
            }

            .form-heading h2 {
                font-size: 29px;
            }
        }

        @media (max-width: 420px) {
            .remember-row {
                align-items: flex-start;
            }

            .form-side {
                padding: 28px 6%;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <section class="visual">
        <div class="decor decor-one"></div>
        <div class="decor decor-two"></div>

        <a href="/" class="logo">
            <span class="logo-icon">F</span>
            FreelanceHub
        </a>

        <div class="visual-content">
            <div class="visual-badge">✦ Selamat datang kembali</div>

            <h1>
                Saatnya melanjutkan <span>ide hebatmu.</span>
            </h1>

            <p>
                Masuk ke akun FreelanceHub untuk menemukan jasa,
                mengelola pesanan, atau melanjutkan perjalananmu
                sebagai freelancer lokal.
            </p>

            <div class="visual-cards">
                <div class="visual-card">
                    <span>🎨</span>
                    <strong>Temukan Kreativitas</strong>
                </div>

                <div class="visual-card">
                    <span>🤝</span>
                    <strong>Bangun Kolaborasi</strong>
                </div>
            </div>
        </div>

        <div class="visual-footer">
            FreelanceHub · Marketplace Jasa Freelancer Lokal
        </div>
    </section>


    <section class="form-side">
        <div class="form-box">

            <a href="/" class="logo mobile-logo">
                <span class="logo-icon">F</span>
                FreelanceHub
            </a>

            <div class="form-heading">
                <div class="tag">Masuk ke akun</div>
                <h2>Halo lagi! 👋</h2>
                <p>
                    Masukkan email dan password untuk melanjutkan
                    ke akun kamu.
                </p>
            </div>

            @if (session('error'))
                <div class="message error-message">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="message error-message">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf

                <div class="field">
                    <label for="email">Alamat Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        autocomplete="email"
                        required
                        autofocus
                    >

                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >

                    @error('password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="remember-row">
                    <label class="remember">
                        <input type="checkbox" name="remember" value="1">
                        Ingat saya
                    </label>

                    <a href="{{ url('/forgot-password') }}" class="forgot">
                        Lupa password?
                    </a>
                </div>

                <button type="submit" class="submit">
                    Masuk ke Akun →
                </button>
            </form>

            <div class="register-link">
                Belum punya akun?
                <a href="{{ url('/register') }}">Daftar sekarang</a>
            </div>

            <a href="/" class="back-home">← Kembali ke halaman utama</a>

        </div>
    </section>

</div>

</body>
</html>