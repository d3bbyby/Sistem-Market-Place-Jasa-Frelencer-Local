<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - FreelanceHub</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #FAF9FF;
            color: #30264B;
        }

        .navbar {
            background: #7047EB;
            color: white;
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(80, 48, 181, 0.12);
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            font-size: 14px;
        }

        .navbar a:hover {
            color: #EDE7FF;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .container h1 {
            margin-bottom: 10px;
            color: #30264B;
        }

        .subtitle {
            color: #837B99;
            margin-bottom: 30px;
        }

        .table-box {
            background: white;
            padding: 25px;
            border-radius: 15px;
            border: 1px solid #E7E1F4;
            box-shadow: 0 4px 16px rgba(80, 48, 181, 0.06);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th {
            background: #7047EB;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #EDE8F7;
            font-size: 14px;
            color: #625976;
        }

        tbody tr:hover {
            background: #FAF8FF;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status {
            display: inline-block;
            background: #FFF1DC;
            color: #9A641E;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
        }

        .btn {
            display: inline-block;
            background: #7047EB;
            color: white;
            padding: 9px 15px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn:hover {
            background: #5030B5;
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
        <h2>FreelanceHub</h2>

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