<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelance Lokal</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fffaf5;
            color: #4b2e1f;
        }

        .navbar {
            background: white;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eadbd0;
        }

        .logo {
            color: #6b4226;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .navbar-menu a {
            color: #4b2e1f;
            text-decoration: none;
            font-size: 14px;
        }

        .navbar-menu a:hover {
            color: #6b4226;
        }

        .btn-login {
            background: #6b4226;
            color: white !important;
            padding: 11px 20px;
            border-radius: 8px;
        }

        .btn-login:hover {
            background: #4b2e1f;
        }

        .hero {
            min-height: 480px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            padding: 70px 8%;
        }

        .hero-text {
            max-width: 550px;
        }

        .hero-text h1 {
            font-size: 46px;
            line-height: 1.2;
            margin: 0 0 20px;
            color: #4b2e1f;
        }

        .hero-text h1 span {
            color: #a66a3f;
        }

        .hero-text p {
            color: #806f63;
            font-size: 17px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-primary,
        .btn-secondary {
            display: inline-block;
            padding: 14px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-primary {
            background: #6b4226;
            color: white;
        }

        .btn-primary:hover {
            background: #4b2e1f;
        }

        .btn-secondary {
            background: white;
            color: #6b4226;
            border: 1px solid #6b4226;
        }

        .btn-secondary:hover {
            background: #f5e9df;
        }

        .hero-image {
            width: 400px;
            height: 300px;
            background: #eadbd0;
            border-radius: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 30px;
        }

        .hero-image h2 {
            color: #6b4226;
            font-size: 28px;
        }

        .features {
            background: white;
            padding: 60px 8%;
            text-align: center;
        }

        .features h2 {
            color: #6b4226;
            margin-bottom: 10px;
        }

        .features-description {
            color: #806f63;
            margin-bottom: 35px;
        }

        .feature-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .feature-card {
            background: #fffaf5;
            padding: 30px 20px;
            border-radius: 15px;
            border: 1px solid #eadbd0;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #eadbd0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 26px;
        }

        .feature-card h3 {
            color: #6b4226;
            margin-bottom: 12px;
        }

        .feature-card p {
            color: #806f63;
            font-size: 14px;
            line-height: 1.6;
        }

        .category {
            padding: 60px 8%;
            text-align: center;
        }

        .category h2 {
            color: #6b4226;
            margin-bottom: 30px;
        }

        .category-list {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .category-card {
            background: white;
            border: 1px solid #eadbd0;
            padding: 25px 15px;
            border-radius: 12px;
            color: #6b4226;
            font-weight: bold;
        }

        .category-card:hover {
            background: #f5e9df;
        }

        .cta {
            background: #6b4226;
            color: white;
            text-align: center;
            padding: 55px 20px;
        }

        .cta h2 {
            margin-top: 0;
            font-size: 30px;
        }

        .cta p {
            margin-bottom: 25px;
        }

        .cta a {
            display: inline-block;
            background: white;
            color: #6b4226;
            padding: 13px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .footer {
            background: #4b2e1f;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 13px;
        }

        @media (max-width: 800px) {
            .navbar {
                padding: 20px 25px;
                flex-direction: column;
                gap: 18px;
            }

            .navbar-menu {
                gap: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero {
                flex-direction: column;
                text-align: center;
                padding: 50px 25px;
            }

            .hero-text h1 {
                font-size: 36px;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-image {
                width: 100%;
                max-width: 400px;
            }

            .feature-list {
                grid-template-columns: 1fr;
            }

            .category-list {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="/" class="logo">Freelance Lokal</a>

        <div class="navbar-menu">
            <a href="/">Beranda</a>
            <a href="/client/jasa">Cari Jasa</a>
            <a href="/login" class="btn-login">Login</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-text">
            <h1>
                Temukan Jasa Freelancer
                <span>Terbaik</span>
            </h1>

            <p>
                Freelance Lokal adalah tempat untuk menemukan
                berbagai jasa freelancer lokal yang terpercaya,
                mudah, dan sesuai kebutuhan kamu.
            </p>

            <div class="hero-buttons">
                <a href="/client/jasa" class="btn-primary">
                    Cari Jasa
                </a>

                <a href="/register" class="btn-secondary">
                    Daftar Sekarang
                </a>
            </div>
        </div>

        <div class="hero-image">
            <div>
                <h2>Jasa Lokal<br>Untuk Kebutuhanmu</h2>
                <p>Temukan freelancer sesuai keahlian yang kamu butuhkan.</p>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features">
        <h2>Mengapa Memilih Freelance Lokal?</h2>

        <p class="features-description">
            Solusi mudah untuk mencari dan menawarkan jasa.
        </p>

        <div class="feature-list">

            <div class="feature-card">
                <div class="feature-icon">🔎</div>
                <h3>Mudah Mencari Jasa</h3>
                <p>
                    Cari berbagai jasa freelancer sesuai
                    kebutuhan dengan mudah.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🤝</div>
                <h3>Freelancer Terpercaya</h3>
                <p>
                    Temukan freelancer lokal dengan
                    kemampuan dan keahlian yang sesuai.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">💼</div>
                <h3>Pasarkan Keahlianmu</h3>
                <p>
                    Tawarkan jasa dan dapatkan peluang
                    pekerjaan dari client.
                </p>
            </div>

        </div>
    </section>

    <!-- Kategori Jasa -->
    <section class="category">
        <h2>Kategori Jasa</h2>

        <div class="category-list">

            <div class="category-card">
                Website
            </div>

            <div class="category-card">
                Desain Grafis
            </div>

            <div class="category-card">
                Editing Video
            </div>

            <div class="category-card">
                Penulisan
            </div>

        </div>
    </section>

    <!-- Call To Action -->
    <section class="cta">
        <h2>Siap Menemukan Jasa yang Kamu Butuhkan?</h2>

        <p>
            Bergabung sekarang dan temukan berbagai jasa
            freelancer lokal.
        </p>

        <a href="/register">
            Mulai Sekarang
        </a>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>
            © 2026 Freelance Lokal. Semua Hak Dilindungi.
        </p>
    </footer>

</body>
</html>