<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Jasa - LokalFreelancer</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f3ee;
            color: #333;
            margin: 0;
        }

        .navbar {
            background-color: white;
            padding: 20px 7%;
            border-bottom: 1px solid #eee5de;
        }

        .logo {
            color: #6b4f3a;
            font-size: 22px;
            font-weight: bold;
        }

        .container {
            padding: 40px 7%;
        }

        h1 {
            color: #4a3428;
        }

        .jasa-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background-color: white;
            border: 1px solid #e5d8cc;
            border-radius: 12px;
            padding: 20px;
        }

        .card h3 {
            color: #6b4f3a;
        }

        .card p {
            color: #777;
            font-size: 14px;
        }

        .harga {
            font-weight: bold;
            color: #6b4f3a;
        }

        .btn {
            display: inline-block;
            background-color: #6b4f3a;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="logo">LokalFreelancer</div>
    </div>

    <div class="container">

        <h1>Daftar Jasa</h1>

        <p>
            Temukan jasa freelancer lokal sesuai kebutuhan kamu.
        </p>

        <div class="jasa-list">

            <div class="card">
                <h3>Desain Logo</h3>
                <p>Freelancer: Andi</p>
                <p>Jasa pembuatan logo sederhana.</p>
                <p class="harga">Mulai Rp100.000</p>
                <a href="/jasa/detail" class="btn">Lihat Detail</a>
            </div>

            <div class="card">
                <h3>Website Sederhana</h3>
                <p>Freelancer: Budi</p>
                <p>Pembuatan website menggunakan HTML dan CSS.</p>
                <p class="harga">Mulai Rp500.000</p>
                <a href="/jasa/detail" class="btn">Lihat Detail</a>
            </div>

            <div class="card">
                <h3>Edit Video</h3>
                <p>Freelancer: Citra</p>
                <p>Jasa editing video untuk kebutuhan konten.</p>
                <p class="harga">Mulai Rp150.000</p>
                <a href="/jasa/detail" class="btn">Lihat Detail</a>
            </div>

        </div>

    </div>

</body>

</html>