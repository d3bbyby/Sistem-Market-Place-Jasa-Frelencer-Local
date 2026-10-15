<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FreelanceHub - Marketplace Jasa Lokal</title>

    <style>
        :root {
            --purple: #7047EB;
            --purple-dark: #5030B5;
            --lavender: #F0EBFF;
            --peach: #FFE7DC;
            --mint: #E1F8ED;
            --blue: #E2F5FC;
            --text: #30264B;
            --muted: #837B99;
            --white: #FFFFFF;
            --bg: #FAF9FF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--bg);
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        .navbar {
            width: 100%;
            min-height: 78px;
            padding: 16px 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: rgba(255, 255, 255, 0.94);
            border-bottom: 1px solid #EEE9FA;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 11px;
            color: var(--purple);
            font-size: 23px;
            font-weight: 800;
        }

        .logo-icon {
            width: 39px;
            height: 39px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #9B80FF, #6741E2);
            color: white;
            box-shadow: 0 5px 15px #7047EB30;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-links > a:not(.btn) {
            color: #6E6684;
            font-size: 14px;
            font-weight: 600;
        }

        .nav-links > a:not(.btn):hover {
            color: var(--purple);
        }

        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 20px;
            border-radius: 11px;
            font-weight: 700;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn-outline {
            color: var(--purple);
            border: 1px solid #DCD1FF;
            background: white;
        }

        .btn-outline:hover {
            background: var(--lavender);
        }

        .btn-primary {
            background: linear-gradient(135deg, #8464F7, #6842E6);
            color: white;
            box-shadow: 0 7px 18px #7047EB30;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px #7047EB40;
        }

        .hero {
            padding: 75px 7% 70px;
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            align-items: center;
            gap: 60px;
            max-width: 1500px;
            margin: auto;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 30px;
            background: var(--lavender);
            color: var(--purple);
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 23px;
        }

        .eyebrow span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #8A6AF5;
        }

        .hero h1 {
            font-size: clamp(37px, 4.5vw, 60px);
            line-height: 1.13;
            letter-spacing: -1.8px;
            margin-bottom: 22px;
            color: var(--text);
        }

        .hero h1 em {
            font-style: normal;
            color: var(--purple);
        }

        .hero-description {
            max-width: 500px;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 29px;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .hero-note {
            margin-top: 22px;
            color: #9189A5;
            font-size: 12px;
        }

        .hero-visual {
            min-height: 430px;
            border-radius: 32px;
            background: linear-gradient(145deg, #F0EBFF, #FFF0E7 70%, #FFF8DF);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 35px;
        }

        .decor {
            position: absolute;
            border-radius: 50%;
        }

        .decor-one {
            width: 165px;
            height: 165px;
            top: -44px;
            right: -30px;
            background: #FFB99F66;
        }

        .decor-two {
            width: 105px;
            height: 105px;
            bottom: -24px;
            left: -10px;
            background: #8AE3C166;
        }

        .service-stack {
            width: 100%;
            max-width: 385px;
            position: relative;
            z-index: 1;
        }

        .visual-label {
            display: inline-block;
            background: white;
            padding: 10px 15px;
            border-radius: 30px;
            margin-bottom: 18px;
            color: var(--purple);
            font-size: 12px;
            font-weight: bold;
            box-shadow: 0 5px 20px #5030B510;
        }

        .service-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: white;
            border: 1px solid #FFFFFF;
            padding: 17px;
            border-radius: 18px;
            margin-bottom: 13px;
            box-shadow: 0 12px 30px #5030B510;
            transition: transform 0.2s;
        }

        .service-card:hover {
            transform: translateX(5px);
        }

        .service-icon {
            width: 53px;
            height: 53px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            flex-shrink: 0;
        }

        .icon-purple { background: var(--lavender); }
        .icon-peach { background: var(--peach); }
        .icon-mint { background: var(--mint); }

        .service-info {
            flex: 1;
        }

        .service-info h3 {
            font-size: 14px;
            margin-bottom: 6px;
        }

        .service-info p {
            color: var(--muted);
            font-size: 12px;
        }

        .service-arrow {
            color: var(--purple);
            font-size: 20px;
        }

        .section {
            padding: 65px 7%;
        }

        .section-heading {
            text-align: center;
            max-width: 620px;
            margin: 0 auto 38px;
        }

        .section-tag {
            color: var(--purple);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .section-heading h2 {
            font-size: clamp(26px, 3vw, 37px);
            margin-bottom: 13px;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
        }

        .categories {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            max-width: 1100px;
            margin: auto;
        }

        .category-card {
            background: white;
            border: 1px solid #ECE7F8;
            border-radius: 20px;
            padding: 27px;
            transition: 0.2s;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 28px #5030B510;
        }

        .category-icon {
            width: 56px;
            height: 56px;
            border-radius: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            margin-bottom: 20px;
        }

        .category-card h3 {
            font-size: 17px;
            margin-bottom: 9px;
        }

        .category-card p {
            font-size: 13px;
            line-height: 1.8;
            color: var(--muted);
        }

        .steps {
            background: white;
            border-top: 1px solid #ECE7F8;
            border-bottom: 1px solid #ECE7F8;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 25px;
            max-width: 1100px;
            margin: auto;
        }

        .step {
            padding: 26px;
            border-radius: 18px;
            background: #FAF9FF;
        }

        .step-number {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            background: var(--purple);
            color: white;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }

        .step h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .step p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .cta {
            margin: 65px 7%;
            padding: 48px 30px;
            border-radius: 26px;
            background: linear-gradient(115deg, #EEE8FF, #FFF0E6);
            text-align: center;
        }

        .cta h2 {
            font-size: clamp(26px, 3vw, 37px);
            margin-bottom: 14px;
        }

        .cta p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 24px;
        }

        footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 25px 7%;
            background: white;
            border-top: 1px solid #ECE7F8;
            color: var(--muted);
            font-size: 12px;
        }

        footer .logo {
            font-size: 18px;
        }

        @media (max-width: 850px) {
            .navbar {
                padding: 16px 5%;
            }

            .nav-links {
                display: none;
            }

            .hero {
                padding: 50px 5%;
                grid-template-columns: 1fr;
                gap: 35px;
            }

            .hero-visual {
                min-height: 400px;
            }

            .section {
                padding: 50px 5%;
            }

            .categories,
            .steps-grid {
                grid-template-columns: 1fr;
            }

            .category-card {
                padding: 23px;
            }

            .cta {
                margin: 45px 5%;
            }

            footer {
                padding: 25px 5%;
            }
        }

        @media (max-width: 480px) {
            .logo {
                font-size: 19px;
            }

            .logo-icon {
                width: 34px;
                height: 34px;
            }

            .nav-buttons {
                gap: 6px;
            }

            .nav-buttons .btn {
                padding: 10px 12px;
                font-size: 12px;
            }

            .hero h1 {
                letter-spacing: -1px;
            }

            .hero-description {
                font-size: 14px;
            }

            .hero-visual {
                min-height: 360px;
                padding: 20px;
            }

            .service-card {
                padding: 13px;
            }

            .service-icon {
                width: 45px;
                height: 45px;
                font-size: 21px;
            }

            .cta {
                padding: 36px 20px;
            }
        }
    </style>
</head>

<body>

    <header class="navbar">
        <a href="/" class="logo">
            <span class="logo-icon">F</span>
            FreelanceHub
        </a>

        <nav class="nav-links">
            <a href="#layanan">Layanan</a>
            <a href="#cara-kerja">Cara Kerja</a>
            <a href="#tentang">Tentang</a>
        </nav>

        <div class="nav-buttons">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                    Dashboard →
                </a>
            @else
                <a href="{{ url('/login') }}" class="btn btn-outline">
                    Masuk
                </a>
                <a href="{{ url('/register') }}" class="btn btn-primary">
                    Daftar
                </a>
            @endauth
        </div>
    </header>


    <main>

        <section class="hero">
            <div>
                <div class="eyebrow">
                    <span></span>
                    Marketplace Jasa Freelancer Lokal
                </div>

                <h1>
                    Ide hebat dimulai dari <em>orang yang tepat.</em>
                </h1>

                <p class="hero-description">
                    Temukan freelancer lokal untuk membantu kebutuhan desain,
                    website, video, dan berbagai pekerjaan kreatifmu.
                    Mudah mencari, mudah terhubung.
                </p>

                <div class="hero-actions">
                    <a href="{{ url('/register') }}" class="btn btn-primary">
                        Mulai Sekarang →
                    </a>

                    <a href="{{ url('/login') }}" class="btn btn-outline">
                        Saya Sudah Punya Akun
                    </a>
                </div>

                <p class="hero-note">
                    ✦ Terhubung dengan talenta lokal dan kembangkan ide bersama.
                </p>
            </div>

            <div class="hero-visual">
                <div class="decor decor-one"></div>
                <div class="decor decor-two"></div>

                <div class="service-stack">
                    <div class="visual-label">
                        ✨ Temukan jasa sesuai kebutuhanmu
                    </div>

                    <div class="service-card">
                        <div class="service-icon icon-purple">🎨</div>

                        <div class="service-info">
                            <h3>Desain Grafis</h3>
                            <p>Logo, poster, dan identitas brand</p>
                        </div>

                        <span class="service-arrow">→</span>
                    </div>

                    <div class="service-card">
                        <div class="service-icon icon-peach">💻</div>

                        <div class="service-info">
                            <h3>Pengembangan Web</h3>
                            <p>Website untuk kebutuhan bisnismu</p>
                        </div>

                        <span class="service-arrow">→</span>
                    </div>

                    <div class="service-card">
                        <div class="service-icon icon-mint">🎬</div>

                        <div class="service-info">
                            <h3>Editing Video</h3>
                            <p>Konten kreatif untuk proyekmu</p>
                        </div>

                        <span class="service-arrow">→</span>
                    </div>
                </div>
            </div>
        </section>


        <section class="section" id="layanan">
            <div class="section-heading">
                <div class="section-tag">Kategori Layanan</div>
                <h2>Temukan jasa yang kamu butuhkan</h2>
                <p>
                    Beragam keahlian tersedia untuk mendukung proyek,
                    usaha, maupun ide kreatifmu.
                </p>
            </div>

            <div class="categories">
                <div class="category-card">
                    <div class="category-icon" style="background:#EDE7FF;">
                        🎨
                    </div>
                    <h3>Desain Grafis</h3>
                    <p>
                        Bantu wujudkan logo, poster, desain promosi,
                        dan kebutuhan visual lainnya.
                    </p>
                </div>

                <div class="category-card">
                    <div class="category-icon" style="background:#FFE7DC;">
                        💻
                    </div>
                    <h3>Website & Teknologi</h3>
                    <p>
                        Temukan bantuan untuk website, pengembangan
                        aplikasi, dan kebutuhan digital.
                    </p>
                </div>

                <div class="category-card">
                    <div class="category-icon" style="background:#E1F8ED;">
                        🎬
                    </div>
                    <h3>Video & Konten</h3>
                    <p>
                        Dukung kontenmu dengan editing video,
                        materi promosi, dan karya kreatif.
                    </p>
                </div>
            </div>
        </section>


        <section class="section steps" id="cara-kerja">
            <div class="section-heading">
                <div class="section-tag">Cara Kerja</div>
                <h2>Mudah memulai proyekmu</h2>
                <p>
                    Ikuti langkah sederhana untuk mulai terhubung
                    dengan freelancer lokal.
                </p>
            </div>

            <div class="steps-grid">
                <div class="step">
                    <div class="step-number">01</div>
                    <h3>Buat Akun</h3>
                    <p>
                        Daftar sebagai Client untuk mencari jasa,
                        atau Freelancer untuk menawarkan keahlian.
                    </p>
                </div>

                <div class="step">
                    <div class="step-number">02</div>
                    <h3>Temukan Kebutuhanmu</h3>
                    <p>
                        Jelajahi pilihan freelancer dan temukan
                        layanan yang sesuai dengan proyekmu.
                    </p>
                </div>

                <div class="step">
                    <div class="step-number">03</div>
                    <h3>Mulai Bekerja Sama</h3>
                    <p>
                        Lanjutkan proses pemesanan dan komunikasi
                        melalui fitur yang tersedia di platform.
                    </p>
                </div>
            </div>
        </section>


        <section class="cta" id="tentang">
            <h2>Siap memulai proyek pertamamu?</h2>
            <p>
                Bergabunglah dengan FreelanceHub dan temukan
                peluang kolaborasi bersama talenta lokal.
            </p>

            <a href="{{ url('/register') }}" class="btn btn-primary">
                Buat Akun Gratis →
            </a>
        </section>

    </main>


    <footer>
        <a href="/" class="logo">
            <span class="logo-icon">F</span>
            FreelanceHub
        </a>

        <p>Marketplace Jasa Freelancer Lokal.</p>
        <p>© {{ date('Y') }} FreelanceHub</p>
    </footer>

</body>
</html>