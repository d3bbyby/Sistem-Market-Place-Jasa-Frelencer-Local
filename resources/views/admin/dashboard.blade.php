<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Freelance Lokal</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f8f2ed;
            color: #4b2e20;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #ffffff;
            border-right: 1px solid #e5d8ce;
            padding: 25px 18px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #754522;
            padding: 0 15px;
            margin-bottom: 35px;
        }

        .menu-title {
            font-size: 12px;
            color: #9b887b;
            text-transform: uppercase;
            margin: 0 15px 12px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #6c5a4d;
            padding: 13px 15px;
            border-radius: 9px;
            margin-bottom: 6px;
            font-size: 14px;
            transition: 0.3s;
        }

        .menu a:hover,
        .menu a.active {
            background: #754522;
            color: white;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
        }

        .logout {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 25px;
        }

        .logout a {
            color: #a34d43;
        }

        .logout a:hover {
            background: #a34d43;
            color: white;
        }

        /* MAIN CONTENT */
        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .topbar {
            height: 78px;
            background: white;
            border-bottom: 1px solid #e5d8ce;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .page-title {
            font-size: 22px;
            font-weight: bold;
            color: #4b2e20;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-photo {
            width: 40px;
            height: 40px;
            background: #ead8ca;
            color: #754522;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
        }

        .profile-info strong {
            font-size: 14px;
        }

        .profile-info span {
            font-size: 12px;
            color: #9b887b;
        }

        .content {
            padding: 35px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h1 {
            font-size: 28px;
            margin-bottom: 8px;
            color: #754522;
        }

        .welcome p {
            color: #8b7769;
            font-size: 14px;
        }

        /* STATISTICS */
        .stats {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border: 1px solid #eaded5;
            border-radius: 14px;
            padding: 22px;
            min-height: 125px;
        }

        .stat-card .stat-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f2e5db;
            color: #754522;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .stat-card h3 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #4b2e20;
        }

        .stat-card p {
            color: #8b7769;
            font-size: 13px;
        }

        /* CONTENT GRID */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 22px;
        }

        .panel {
            background: white;
            border: 1px solid #eaded5;
            border-radius: 14px;
            overflow: hidden;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 22px;
            border-bottom: 1px solid #eee4dd;
        }

        .panel-header h2 {
            font-size: 17px;
            color: #4b2e20;
        }

        .panel-header a {
            color: #754522;
            font-size: 13px;
            text-decoration: none;
            font-weight: bold;
        }

        .panel-body {
            padding: 20px 22px;
        }

        /* ORDER TABLE */
        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 12px;
            color: #9b887b;
            padding: 12px 10px;
            border-bottom: 1px solid #eee4dd;
        }

        td {
            padding: 15px 10px;
            font-size: 13px;
            border-bottom: 1px solid #f1e9e3;
            color: #5e4a3d;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .status.pending {
            background: #fff1d6;
            color: #9a6718;
        }

        .status.process {
            background: #e3efff;
            color: #346da8;
        }

        .status.done {
            background: #dff3e7;
            color: #287447;
        }

        /* USER LIST */
        .user-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid #f1e9e3;
        }

        .user-item:last-child {
            border-bottom: none;
        }

        .user-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-photo {
            width: 38px;
            height: 38px;
            background: #ead8ca;
            color: #754522;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
            font-size: 13px;
        }

        .user-name {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .user-email {
            font-size: 11px;
            color: #9b887b;
        }

        .role {
            font-size: 11px;
            color: #754522;
            background: #f5e9df;
            padding: 6px 9px;
            border-radius: 15px;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .stats {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
                width: calc(100% - 210px);
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 25px;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                padding-bottom: 80px;
            }

            .layout {
                display: block;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .logout {
                position: absolute;
            }

            .topbar {
                padding: 0 20px;
            }

            .page-title {
                font-size: 18px;
            }

            .profile-info {
                display: none;
            }

            .content {
                padding: 20px;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .stat-card {
                padding: 17px;
            }

            .stat-card h3 {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

    <div class="layout">
        <aside class="sidebar">
            <div class="logo">
                FreelanceHub
            </div>
            <p class="menu-title">
                Menu Utama
            </p>
            <div class="menu">
                <a href="/admin/dashboard" class="active">
                    <span class="menu-icon">▣</span>
                    Dashboard
                </a>
                <a href="/admin/pengguna">
                    <span class="menu-icon">♙</span>
                    Pengguna
                </a>

                <a href="/admin/client">
                    <span class="menu-icon">♙</span>
                    Client
                </a>
                <a href="/admin/jasa">
                    <span class="menu-icon">▤</span>
                    Jasa
                </a>
                <a href="/admin/pesanan">
                    <span class="menu-icon">▧</span>
                    Pesanan
                </a>
                <a href="/admin/kategori">
                    <span class="menu-icon">▦</span>
                    Kategori
                </a>
                <a href="/admin/review">
                    <span class="menu-icon">☆</span>
                    Review dan Rating
                </a>
                <a href="/admin/laporan">
                    <span class="menu-icon">▥</span>
                    Laporan
                </a>
                <a href="/admin/profil">
                    <span class="menu-icon">⚙</span>
                    Pengaturan
                </a>

            </div>

            <div class="menu logout">
                <a href="/logout">
                    <span class="menu-icon">↪</span>
                    Logout
                </a>
            </div>
        </aside>


        <main class="main">
            <header class="topbar">
                <div class="page-title">
                    Dashboard Admin
                </div>
                <div class="profile">
                    <div class="profile-photo">
                        @auth
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @else
                            A
                        @endauth
                    </div>
                    <div class="profile-info">
                        @auth
                            <strong>
                                {{ Auth::user()->name }}
                            </strong>
                            <span>
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        @else
                            <strong>
                                Admin
                            </strong>
                            <span>
                                Administrator
                            </span>
                        @endauth
                    </div>
                </div>
            </header>


            <section class="content">

                <div class="welcome">
                    @auth
                        <h1>
                            Selamat Datang, {{ Auth::user()->name }}!
                        </h1>
                    @else
                        <h1>
                            Selamat Datang, Admin!
                        </h1>
                    @endauth
                    <p>
                        Kelola aktivitas dan data Freelance Lokal melalui halaman ini.
                    </p>
                </div>


                <div class="stats">
                    <div class="stat-card">
                        <div class="stat-icon">
                            ♙
                        </div>
                        <h3>
                            120
                        </h3>
                        <p>
                            Total Pengguna
                        </p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            ♧
                        </div>
                        <h3>
                            45
                        </h3>
                        <p>
                            Total Freelancer
                        </p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            ♙
                        </div>
                        <h3>
                            75
                        </h3>
                        <p>
                            Total Client
                        </p>
                    </div>


                <div class="stat-card">
                        <div class="stat-icon">
                            ▤
                        </div>
                        <h3>
                            86
                        </h3>
                        <p>
                            Total Jasa
                        </p>
                    </div>


                    <div class="stat-card">
                        <div class="stat-icon">
                            ▧
                        </div>
                        <h3>
                            32
                        </h3>
                        <p>
                            Total Pesanan
                        </p>
                    </div>
                </div>


                <!-- PESANAN DAN PENGGUNA -->
                <div class="dashboard-grid">
                    <div class="panel">
                        <div class="panel-header">
                            <h2>
                                Pesanan Terbaru
                            </h2>
                            <a href="/admin/pesanan">
                                Lihat semua
                            </a>
                        </div>

                        <div class="panel-body">
                            <div class="table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                Client
                                            </th>
                                            <th>
                                                Jasa
                                            </th>
                                            <th>
                                                Tanggal
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>
                                                Deby
                                            </td>
                                            <td>
                                                Desain Logo
                                            </td>
                                            <td>
                                                08 Sep 2026
                                            </td>
                                            <td>
                                                <span class="status pending">
                                                    Menunggu
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                Andi
                                            </td>
                                            <td>
                                                Website Laravel
                                            </td>
                                            <td>
                                                07 Sep 2026
                                            </td>

                                            <td>
                                                <span class="status process">
                                                    Diproses
                                                </span>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                Sinta
                                            </td>
                                            <td>
                                                Editing Video
                                            </td>
                                            <td>
                                                06 Sep 2026
                                            </td>
                                            <td>

                                                <span class="status done">
                                                    Selesai
                                                </span>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                Rizky
                                            </td>
                                            <td>
                                                Desain Poster
                                            </td>
                                            <td>
                                                05 Sep 2026
                                            </td>

                                            <td>
                                                <span class="status pending">
                                                    Menunggu
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="panel">
                        <div class="panel-header">
                            <h2>
                                Pengguna Terbaru
                            </h2>
                            <a href="/admin/pengguna">
                                Lihat semua
                            </a>
                        </div>


                        <div class="panel-body">
                            <div class="user-item">
                                <div class="user-left">
                                    <div class="user-photo">
                                        D
                                    </div>
                                    <div>
                                        <p class="user-name">
                                            Deby
                                        </p>
                                        <p class="user-email">
                                            deby@email.com
                                        </p>
                                    </div>
                                </div>
                                <span class="role">
                                    Client
                                </span>
                            </div>


                            <div class="user-item">
                                <div class="user-left">
                                    <div class="user-photo">
                                        A
                                    </div>
                                    <div>
                                        <p class="user-name">
                                            Andi
                                        </p>
                                        <p class="user-email">
                                            andi@email.com
                                        </p>
                                    </div>
                                </div>
                                <span class="role">
                                    Freelancer
                                </span>
                            </div>


                            <div class="user-item">
                                <div class="user-left">
                                    <div class="user-photo">
                                        S
                                    </div>
                                    <div>
                                        <p class="user-name">
                                            Sinta
                                        </p>
                                        <p class="user-email">
                                            sinta@email.com
                                        </p>
                                    </div>
                                </div>
                                <span class="role">
                                    Client
                                </span>
                            </div>
                            <div class="user-item">
                                <div class="user-left">
                                    <div class="user-photo">
                                        R
                                    </div>
                                    <div>
                                        <p class="user-name">
                                            Rizky
                                        </p>
                                        <p class="user-email">
                                            rizky@email.com
                                        </p>
                                    </div>
                                </div>
                                <span class="role">
                                    Freelancer
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>