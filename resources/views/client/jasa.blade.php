<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Jasa</title>

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
            background: #6b4226;
            color: white;
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
        }

        .search-box {
            display: flex;
            gap: 10px;
        }

        .search-box input {
            width: 250px;
            padding: 12px;
            border: 1px solid #d6c2b2;
            border-radius: 8px;
            font-size: 14px;
        }

        .btn {
            background: #6b4226;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #4b2e1f;
        }

        .judul {
            margin-bottom: 20px;
        }

        .jasa-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .card {
            background: white;
            border: 1px solid #eadbd0;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(75, 46, 31, 0.08);
        }

        .card h3 {
            margin-top: 0;
            color: #6b4226;
        }

        .card p {
            color: #76665c;
            line-height: 1.6;
        }

        .harga {
            font-weight: bold;
            color: #6b4226 !important;
            font-size: 18px;
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 18px 25px;
                flex-direction: column;
                gap: 15px;
            }

            .navbar a {
                margin: 0 8px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-box {
                width: 100%;
            }

            .search-box input {
                width: 100%;
            }

            .jasa-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <h2>Freelance Lokal</h2>

        <div>
            <a href="/client/dashboard">Dashboard</a>
            <a href="/client/pesanan">Pesanan Saya</a>
            <a href="/client/profil">Profil</a>
            <a href="/logout">Logout</a>
        </div>
    </nav>

    <main class="container">

        <div class="header">
            <h1>Cari Jasa Freelancer</h1>

            <form class="search-box">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama jasa..."
                >

                <button class="btn" type="submit">
                    Cari
                </button>
            </form>
        </div>

        <h2 class="judul">Daftar Jasa</h2>

        <div class="jasa-container">

            <div class="card">
                <h3>Jasa Pembuatan Website</h3>
                <p>Freelancer: Budi</p>
                <p>
                    Membuat website sederhana untuk toko,
                    sekolah, atau usaha.
                </p>
                <p class="harga">Rp500.000</p>

                <a href="/client/detail-jasa" class="btn">
                    Lihat Detail
                </a>
            </div>

            <div class="card">
                <h3>Jasa Desain Poster</h3>
                <p>Freelancer: Sinta</p>
                <p>
                    Membuat desain poster untuk acara,
                    promosi, dan media sosial.
                </p>
                <p class="harga">Rp100.000</p>

                <a href="/client/detail-jasa" class="btn">
                    Lihat Detail
                </a>
            </div>

        </div>

    </main>

</body>
</html>