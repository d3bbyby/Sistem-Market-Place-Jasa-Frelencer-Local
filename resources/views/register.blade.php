<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar - FreelanceHub</title>

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
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
            grid-template-columns: 0.9fr 1.1fr;
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
            max-width: 445px;
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
            font-size: clamp(34px, 4vw, 51px);
            line-height: 1.16;
            letter-spacing: -1.4px;
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

        .benefits {
            margin-top: 32px;
        }

        .benefit {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 17px;
            color: #625976;
            font-size: 13px;
            font-weight: 600;
        }

        .benefit-icon {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: white;
            color: var(--purple);
            display: flex;
            align-items: center;
            justify-content: center;
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
            right: -90px;
            top: 12%;
            background: #9878FF22;
        }

        .decor-two {
            width: 180px;
            height: 180px;
            bottom: -60px;
            left: -60px;
            background: #8AE3C145;
        }

        .form-side {
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 35px 8%;
        }

        .form-box {
            width: 100%;
            max-width: 450px;
        }

        .mobile-logo {
            display: none;
        }

        .form-heading {
            margin-bottom: 23px;
        }

        .form-heading .tag {
            font-size: 12px;
            font-weight: 800;
            color: var(--purple);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .form-heading h2 {
            font-size: 30px;
            margin-bottom: 9px;
        }

        .form-heading p {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.7;
        }

        .message {
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 12px;
            line-height: 1.6;
        }

        .error-message {
            background: #FFF0F1;
            color: #B42332;
        }

        .field {
            margin-bottom: 15px;
        }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .field input,
        .field select {
            width: 100%;
            height: 46px;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0 13px;
            background: #FFFEFF;
            color: var(--text);
            font-size: 13px;
            outline: none;
            transition: 0.2s;
        }

        .field input:focus,
        .field select:focus {
            border-color: var(--purple);
            box-shadow: 0 0 0 3px #7047EB17;
        }

        .field input::placeholder {
            color: #B0A9C0;
        }

        .field-error {
            display: block;
            color: #B42332;
            font-size: 11px;
            margin-top: 6px;
        }

        .role-note {
            background: #F5F1FF;
            border-radius: 9px;
            padding: 11px 12px;
            color: #786B99;
            font-size: 11px;
            line-height: 1.6;
            margin-top: 8px;
        }

        .submit {
            width: 100%;
            height: 49px;
            margin-top: 5px;
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

        .login-link {
            margin-top: 19px;
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        .login-link a {
            color: var(--purple);
            font-weight: bold;
        }

        .back-home {
            display: inline-block;
            color: #887F9F;
            font-size: 12px;
            margin-top: 19px;
        }

        .back-home:hover {
            color: var(--purple);
        }

        @media (max-width: 850px) {
            .page {
                grid-template-columns: 1fr;
            }

            .visual {
                display: none;
            }

            .form-side {
                min-height: 100vh;
                padding: 30px 7%;
            }

            .form-box {
                max-width: 470px;
            }

            .mobile-logo {
                display: flex;
                margin-bottom: 30px;
            }
        }

        @media (max-width: 480px) {
            .form-side {
                padding: 25px 6%;
            }

            .form-heading h2 {
                font-size: 27px;
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
            <div class="visual-badge">✦ Mulai perjalananmu</div>

            <h1>
                Banyak peluang, <span>satu langkah awal.</span>
            </h1>

            <p>
                Buat akun FreelanceHub dan temukan peluang baru.
                Bergabunglah sebagai Client untuk mencari jasa,
                atau sebagai Freelancer untuk menawarkan keahlianmu.
            </p>

            <div class="benefits">
                <div class="benefit">
                    <span class="benefit-icon">✓</span>
                    Temukan layanan sesuai kebutuhan
                </div>

                <div class="benefit">
                    <span class="benefit-icon">✦</span>
                    Tampilkan keahlian dan portofoliomu
                </div>

                <div class="benefit">
                    <span class="benefit-icon">↗</span>
                    Bangun kolaborasi dengan talenta lokal
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
                <div class="tag">Buat akun baru</div>
                <h2>Gabung bersama kami ✨</h2>
                <p>
                    Isi informasi berikut untuk memulai menggunakan FreelanceHub.
                </p>
            </div>

            @if ($errors->any())
                <div class="message error-message">
                    <strong>Periksa kembali data kamu:</strong>

                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('error'))
                <div class="message error-message">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ url('/register') }}" method="POST">
                @csrf

                <div class="field">
                    <label for="name">Nama Lengkap</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        autocomplete="name"
                        maxlength="255"
                        required
                    >

                    @error('name')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

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
                    >

                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <label for="role">Daftar Sebagai</label>

                    <select id="role" name="role" required>
                        <option value="">Pilih jenis akun</option>

                        <option
                            value="client"
                            {{ old('role') === 'client' ? 'selected' : '' }}
                        >
                            Client — mencari jasa
                        </option>

                        <option
                            value="freelancer"
                            {{ old('role') === 'freelancer' ? 'selected' : '' }}
                        >
                            Freelancer — menawarkan jasa
                        </option>
                    </select>

                    @error('role')
                        <span class="field-error">{{ $message }}</span>
                    @enderror

                    <div class="role-note">
                        Pilih Client untuk memesan jasa atau Freelancer
                        untuk menawarkan keahlianmu. Akun Admin tidak
                        dibuat melalui formulir ini.
                    </div>
                </div>

                <div class="field">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimal 6 karakter"
                        autocomplete="new-password"
                        minlength="6"
                        required
                    >

                    @error('password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Konfirmasi Password</label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Masukkan ulang password"
                        autocomplete="new-password"
                        minlength="6"
                        required
                    >
                </div>

                <button type="submit" class="submit">
                    Buat Akun →
                </button>
            </form>

            <div class="login-link">
                Sudah punya akun?
                <a href="{{ url('/login') }}">Masuk di sini</a>
            </div>

            <a href="/" class="back-home">← Kembali ke halaman utama</a>

        </div>
    </section>

</div>

</body>
</html>