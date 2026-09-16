<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya</title>

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

        .container h1 {
            margin-bottom: 10px;
            color: #6b4226;
        }

        .subtitle {
            color: #806f63;
            margin-bottom: 30px;
        }

        .table-box {
            background: white;
            padding: 25px;
            border-radius: 15px;
            border: 1px solid #eadbd0;
            box-shadow: 0 4px 12px rgba(75, 46, 31, 0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th {
            background: #6b4226;
            color: white;
            padding: 15px;
            text-align: left;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eadbd0;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status {
            background: #fff0d9;
            color: #9a641e;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 13px;
        }

        .btn {
            background: #6b4226;
            color: white;
            padding: 9px 15px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn:hover {
            background: #4b2e1f;
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

            .container {
                width: 92%;
            }

            .table-box {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <h2>Freelance Lokal</h2>

        <div>
            <a href="/client/dashboard">Dashboard</a>
            <a href="/client/jasa">Cari Jasa</a>
            <a href="/client/profil">Profil</a>
            <a href="/logout">Logout</a>
        </div>
    </nav>

    <main class="container">
        <h1>Pesanan Saya</h1>
        <p class="subtitle">
            Lihat dan pantau status pesanan jasa kamu.
        </p>

        <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jasa</th>
                        <th>Freelancer</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Jasa Pembuatan Website</td>
                        <td>Budi</td>
                        <td>Rp500.000</td>
                        <td>
                            <span class="status">Menunggu</span>
                        </td>
                        <td>
                            <a href="/client/detail-jasa" class="btn">
                                Detail
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>