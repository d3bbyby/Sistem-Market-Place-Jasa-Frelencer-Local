<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LokalFreelancer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: white;
        }

        .navbar {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 60px;
            border-bottom: 1px solid #ddd;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .menu a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }

        .btn {
            border: 1px solid #999;
            border-radius: 20px;
            padding: 8px 18px;
            background-color: white;
        }

        .hero {
            display: flex;
            min-height: 300px;
            border-bottom: 1px solid #ddd;
        }

        .hero-left {
            width: 55%;
            padding: 60px;
        }

        .hero-left h1 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .hero-left p {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .search {
            display: flex;
            width: 100%;
            max-width: 600px;
        }

        .search input {
            flex: 1;
            padding: 14px;
            border: 1px solid #aaa;
            border-radius: 6px 0 0 6px;
            outline: none;
        }

        .search select {
            padding: 14px;
            border: 1px solid #aaa;
            border-left: none;
            background-color: white;
        }

        .search button {
            padding: 0 25px;
            border: 1px solid #aaa;
            background-color: white;
            border-radius: 0 6px 6px 0;
        }

        .hero-right {
            width: 45%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .illustration {
            width: 80%;
            height: 190px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #888;
        }

        /* ===== KEUNGGULAN ===== */
        .benefit {
            display: flex;
            justify-content: space-around;
            padding: 20px 60px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        .section {
            padding: 35px 60px;
            border-bottom: 1px solid #ddd;
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .category-list {
            display: flex;
            gap: 15px;
            justify-content: space-between;
        }

        .category-card {
            width: 16%;
            min-height: 70px;
            border: 1px solid #aaa;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 10px;
        }

        .category-card h3 {
            font-size: 13px;
            margin-bottom: 6px;
        }

        .category-card p {
            font-size: 11px;
            color: #777;
        }

        /* ===== FREELANCER ===== */
        .freelancer-list {
            display: flex;
            gap: 20px;
        }

        .freelancer-card {
            width: 25%;
            min-height: 140px;
            border: 1px solid #aaa;
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .profile {
            width: 55px;
            height: 55px;
            border: 1px solid #999;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 10px;
            flex-shrink: 0;
        }

        .freelancer-info {
            flex: 1;
        }

        .freelancer-info h3 {
            font-size: 14px;
            margin-bottom: 6px;
        }

        .freelancer-info p {
            font-size: 12px;
            margin-bottom: 5px;
        }

        .profile-button {
            font-size: 11px;
            padding: 6px 10px;
            border: 1px solid #999;
            border-radius: 5px;
            background-color: white;
        }

        /* ===== FOOTER ===== */

        footer {
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #777;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            LokalFreelancer
        </div>

        <div class="menu">
            <a href="#">Beranda</a>
            <a href="#">Freelancer</a>
            <a href="#">Kategori</a>
            <a href="#">Cara Kerja</a>
            <a href="#">Tentang Kami</a>

            <button class="btn">
                Cari
            </button>

            <button class="btn">
                Masuk
            </button>

            <button class="btn">
                Daftar
            </button>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-left">
            <h1>
                Temukan Jasa atau Freelancer
            </h1>

            <p>
                Temukan freelancer lokal yang sesuai
                dengan kebutuhan kamu.
            </p>

            <div class="search">
                <input
                    type="text"
                    placeholder="Cari jasa atau freelancer"
                >

                <select>
                    <option>Semua Kategori</option>
                    <option>Desain Grafis</option>
                    <option>Web Development</option>
                    <option>Video Editing</option>
                </select>

                <button>
                    Cari
                </button>
            </div>
        </div>

        <div class="hero-right">
            <div class="illustration">
                [ GAMBAR ]
            </div>
        </div>
    </section>

    <!-- KEUNGGULAN -->
    <div class="benefit">
        <p>✓ Freelancer Terverifikasi</p>
        <p>✓ Pembayaran Aman</p>
        <p>✓ Proses Cepat & Mudah</p>
    </div>

    <!-- KATEGORI -->
    <section class="section">
        <h2 class="section-title">
            Kategori Populer
        </h2>

        <div class="category-list">
            <div class="category-card">
                <h3>Desain Grafis</h3>
                <p>(Jumlah freelancer)</p>
            </div>

            <div class="category-card">
                <h3>Web Development</h3>
                <p>(Jumlah freelancer)</p>
            </div>

            <div class="category-card">
                <h3>Mobile Development</h3>
                <p>(Jumlah freelancer)</p>
            </div>

            <div class="category-card">
                <h3>Video Editing</h3>
                <p>(Jumlah freelancer)</p>
            </div>

            <div class="category-card">
                <h3>Fotografi</h3>
                <p>(Jumlah freelancer)</p>
            </div>

            <div class="category-card">
                <h3>Penulisan</h3>
                <p>(Jumlah freelancer)</p>
            </div>
        </div>
    </section>

    <!-- FREELANCER TERBAIK -->
    <section class="section">
        <h2 class="section-title">
            Freelancer Terbaik
        </h2>

        <div class="freelancer-list">
            <!-- Freelancer 1 -->
            <div class="freelancer-card">
                <div class="profile">
                    Profil
                </div>

                <div class="freelancer-info">
                    <h3>Nama Freelancer</h3>
                    <p>Web Developer</p>
                    <p>⭐ 4.8</p>
                    <p>Rp150.000</p>
                    <button class="profile-button">
                        Lihat Profil
                    </button>
                </div>
            </div>

            <!-- Freelancer 2 -->
            <div class="freelancer-card">
                <div class="profile">
                    Profil
                </div>

                <div class="freelancer-info">
                    <h3>Nama Freelancer</h3>
                    <p>Desain Grafis</p>
                    <p>⭐ 4.7</p>
                    <p>Rp100.000</p>
                    <button class="profile-button">
                        Lihat Profil
                    </button>
                </div>
            </div>

            <!-- Freelancer 3 -->
            <div class="freelancer-card">
                <div class="profile">
                    Profil
                </div>

                <div class="freelancer-info">
                    <h3>Nama Freelancer</h3>
                    <p>Video Editor</p>
                    <p>⭐ 4.9</p>
                    <p>Rp125.000</p>
                    <button class="profile-button">
                        Lihat Profil
                    </button>
                </div>
            </div>

            <!-- Freelancer 4 -->
            <div class="freelancer-card">
                <div class="profile">
                    Profil
                </div>
                <div class="freelancer-info">
                    <h3>Nama Freelancer</h3>
                    <p>Fotografer</p>
                    <p>⭐ 4.8</p>
                    <p>Rp200.000</p>
                    <button class="profile-button">
                        Lihat Profil
                    </button>
                </div>
            </div>
        </div>
    </section>
    <footer>
        © 2026 LokalFreelancer
    </footer>
</body>
</html>