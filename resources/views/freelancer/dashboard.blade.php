<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Freelancer - Freelance Lokal</title>

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

        .sidebar {
            width: 250px;
            background: white;
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

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border: 1px solid #eaded5;
            border-radius: 14px;
            padding: 22px;
            min-height: 135px;
        }

        .stat-icon {
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

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.5fr 1.5fr 1fr;
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

        .service-item,
        .activity-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid #f1e9e3;
        }

        .service-item:last-child,
        .activity-item:last-child {
            border-bottom: none;
        }

        .service-image {
            width: 48px;
            height: 48px;
            background: #ead8ca;
            color: #754522;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 20px;
            flex-shrink: 0;
        }

        .item-info {
            flex: 1;
        }

        .item-info strong {
            display: block;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .item-info span {
            font-size: 11px;
            color: #9b887b;
        }

        .item-link {
            color: #754522;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
        }

        .activity-item {
            align-items: flex-start;
        }

        .activity-icon {
            width: 32px;
            height: 32px;
            background: #f2e5db;
            color: #754522;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .button {
            display: inline-block;
            background: #754522;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            margin-top: 15px;
        }

        .button:hover {
            background: #5d351b;
        }

        @media (max-width: 1200px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .dashboard-grid {
                grid-template-columns: 1fr 1fr;
            }

            .dashboard-grid .panel:last-child {
                grid-column: span 2;
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

            .dashboard-grid .panel:last-child {
                grid-column: auto;
            }

            .content {
                padding: 25px;
            }
        }

        @media (max-width: 650px) {
            .layout {
                display: block;
            }

            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                padding-bottom: 80px;
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

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="logo">FreelanceHub</div>

            <p class="menu-title">Menu Utama</p>

            <div class="menu">
                <a href="/freelancer/dashboard" class="active">
                    <span class="menu-icon">▣</span>
                    Dashboard
                </a>

                <a href="/freelancer/profil">
                    <span class="menu-icon">♙</span>
                    Profil Saya
                </a>

                <a href="/freelancer/jasa">
                    <span class="menu-icon">▤</span>
                    Jasa Saya
                </a>

                <a href="/freelancer/pesanan">
                    <span class="menu-icon">▧</span>
                    Pesanan Masuk
                </a>

                <a href="/freelancer/proyek">
                    <span class="menu-icon">▦</span>
                    Proyek Saya
                </a>

                <a href="/freelancer/portofolio">
                    <span class="menu-icon">▧</span>
                    Portofolio
                </a>

                <a href="/freelancer/rating">
                    <span class="menu-icon">☆</span>
                    Rating
                </a>

                <a href="/freelancer/pendapatan">
                    <span class="menu-icon">Rp</span>
                    Pendapatan
                </a>

                <a href="/freelancer/pengaturan">
                    <span class="menu-icon">⚙</span>
                    Pengaturan Akun
                </a>
            </div>

            <div class="menu logout">
                <a href="/logout">
                    <span class="menu-icon">↪</span>
                    Logout
                </a>
            </div>
        </aside>

        <!-- MAIN -->
        <main class="main">

            <header class="topbar">
                <div class="page-title">Dashboard Freelancer</div>

                <div class="profile">
                    <div class="profile-photo">F</div>

                    <div class="profile-info">
                        <strong>Freelancer</strong>
                        <span>Penyedia Jasa</span>
                    </div>
                </div>
            </header>

            <section class="content">

                <div class="welcome">
                    <h1>Selamat Datang, Freelancer!</h1>
                    <p>
                        Kelola jasa, pesanan, dan portofolio kamu melalui halaman ini.
                    </p>
                </div>

                <!-- STATISTIK -->
                <div class="stats">

                    <div class="stat-card">
                        <div class="stat-icon">▤</div>
                        <h3>8</h3>
                        <p>Total Jasa</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">✓</div>
                        <h3>24</h3>
                        <p>Pesanan Selesai</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">☆</div>
                        <h3>4.8</h3>
                        <p>Total Rating</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">Rp</div>
                        <h3>4,8 Jt</h3>
                        <p>Total Pendapatan</p>
                    </div>

                </div>

                <div class="dashboard-grid">

                    <!-- PESANAN MASUK -->
                    <div class="panel">
                        <div class="panel-header">
                            <h2>Pesanan Masuk</h2>
                            <a href="/freelancer/pesanan">Lihat semua</a>
                        </div>

                        <div class="panel-body">
                            <div class="table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Jasa</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Deby</td>
                                            <td>Desain Logo</td>
                                            <td>08 Sep 2026</td>
                                            <td>
                                                <span class="status pending">
                                                    Menunggu
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Andi</td>
                                            <td>Website Laravel</td>
                                            <td>07 Sep 2026</td>
                                            <td>
                                                <span class="status process">
                                                    Diproses
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Sinta</td>
                                            <td>Editing Video</td>
                                            <td>06 Sep 2026</td>
                                            <td>
                                                <span class="status done">
                                                    Selesai
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- JASA SAYA -->
                    <div class="panel">
                        <div class="panel-header">
                            <h2>Jasa Saya</h2>
                            <a href="/freelancer/jasa">Lihat semua</a>
                        </div>

                        <div class="panel-body">

                            <div class="service-item">
                                <div class="service-image">▤</div>

                                <div class="item-info">
                                    <strong>Desain Logo</strong>
                                    <span>Rp150.000 · 12 pesanan</span>
                                </div>

                                <a href="/freelancer/jasa" class="item-link">
                                    Detail
                                </a>
                            </div>

                            <div class="service-item">
                                <div class="service-image">⌘</div>

                                <div class="item-info">
                                    <strong>Website Laravel</strong>
                                    <span>Rp750.000 · 8 pesanan</span>
                                </div>

                                <a href="/freelancer/jasa" class="item-link">
                                    Detail
                                </a>
                            </div>

                            <div class="service-item">
                                <div class="service-image">▣</div>

                                <div class="item-info">
                                    <strong>Editing Video</strong>
                                    <span>Rp250.000 · 6 pesanan</span>
                                </div>

                                <a href="/freelancer/jasa" class="item-link">
                                    Detail
                                </a>
                            </div>

                            <a href="/freelancer/jasa/tambah" class="button">
                                + Tambah Jasa
                            </a>

                        </div>
                    </div>

                    <!-- AKTIVITAS TERBARU -->
                    <div class="panel">
                        <div class="panel-header">
                            <h2>Aktivitas Terbaru</h2>
                        </div>

                        <div class="panel-body">

                            <div class="activity-item">
                                <div class="activity-icon">✓</div>

                                <div class="item-info">
                                    <strong>Pesanan selesai</strong>
                                    <span>Desain logo - 2 jam lalu</span>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon">☆</div>

                                <div class="item-info">
                                    <strong>Mendapat rating baru</strong>
                                    <span>Rating 5 dari Deby - Kemarin</span>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon">▧</div>

                                <div class="item-info">
                                    <strong>Pesanan baru masuk</strong>
                                    <span>Website Laravel - 2 hari lalu</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </section>
        </main>

    </div>

</body>
</html>