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
            background: #F7F6FF;
            color: #30264B;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: white;
            border-right: 1px solid #E9E5F5;
            padding: 25px 18px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #7047EB;
            padding: 0 15px;
            margin-bottom: 35px;
        }

        .menu-title {
            font-size: 12px;
            color: #89829E;
            text-transform: uppercase;
            margin: 0 15px 12px;
        }

        .menu a {
            display: flex;
            align-items: center;
            flex-direction: row;
            gap: 12px;
            text-decoration: none;
            color: #5D5577;
            padding: 13px 15px;
            border-radius: 9px;
            margin-bottom: 6px;
            font-size: 14px;
            transition: 0.3s;
            white-space: nowrap;
        }

        .menu a:hover,
        .menu a.active {
            background: #7047EB;
            color: white;
        }

        .menu-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            min-width: 20px;
            flex-shrink: 0;
        }
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
            color: #D94E60;
        }

        .logout a:hover {
            background: #D94E60;
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
            border-bottom: 1px solid #E9E5F5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .page-title {
            font-size: 22px;
            font-weight: bold;
            color: #30264B;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-photo {
            width: 40px;
            height: 40px;
            background: #EDE7FF;
            color: #7047EB;
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
            color: #89829E;
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
            color: #7047EB;
        }

        .welcome p {
            color: #89829E;
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
            border: 1px solid #E9E5F5;
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
            background: #EDE7FF;
            color: #7047EB;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .stat-card h3 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #30264B;
        }

        .stat-card p {
            color: #89829E;
            font-size: 13px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.5fr 1.5fr 1fr;
            gap: 22px;
        }

        .panel {
            background: white;
            border: 1px solid #E9E5F5;
            border-radius: 14px;
            overflow: hidden;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 22px;
            border-bottom: 1px solid #F0ECF8;
        }

        .panel-header h2 {
            font-size: 17px;
            color: #30264B;
        }

        .panel-header a {
            color: #7047EB;
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
            color: #89829E;
            padding: 12px 10px;
            border-bottom: 1px solid #F0ECF8;
        }

        td {
            padding: 15px 10px;
            font-size: 13px;
            border-bottom: 1px solid #F1EDF8;
            color: #5D5577;
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
            background: #FFF3D6;
            color: #996C0D;
        }

        .status.process {
            background: #E4F4FF;
            color: #2479B5;
        }

        .status.done {
            background: #E0F8EC;
            color: #17835A;
        }

        .service-item,
        .activity-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid #F1EDF8;
        }

        .service-item:last-child,
        .activity-item:last-child {
            border-bottom: none;
        }

        .service-image {
            width: 48px;
            height: 48px;
            background: #EDE7FF;
            color: #7047EB;
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
            color: #89829E;
        }

        .item-link {
            color: #7047EB;
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
            background: #EDE7FF;
            color: #7047EB;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .button {
            display: inline-block;
            background: #7047EB;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            margin-top: 15px;
        }

        .button:hover {
            background: #5030B5;
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
        <aside class="sidebar">
            <div class="logo">
                FreelanceHub
            </div>
            <p class="menu-title">
                Menu Utama
            </p>
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
                <a href="{{ route('freelancer.orders.index') }}">
                    <span class="menu-icon">▧</span>
                     <span>Pesanan Masuk</span>
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
                <a href="/freelancer/profil">
                    <span class="menu-icon">⚙</span>
                    Pengaturan Akun
                </a>
            </div>

            <div class="menu logout">
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    <span class="menu-icon">↪</span>
                    Logout
                    </a>
                </form>
            </div>
        </aside>


        
        <main class="main">
            <header class="topbar">
                <div class="page-title">
                    Dashboard Freelancer
                </div>

                
                <div class="profile">
                    <div class="profile-photo">
                        @auth
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @else
                            F
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
                                Freelancer
                            </strong>
                            <span>
                                Penyedia Jasa
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
                            Selamat Datang, Freelancer!
                        </h1>
                    @endauth
                    <p>
                        Kelola jasa, pesanan, dan portofolio kamu melalui halaman ini.
                    </p>
                </div>


                
                <div class="stats">
                    <div class="stat-card">
                        <div class="stat-icon">
                            ▤
                        </div>
                        <h3>
                            8
                        </h3>
                        <p>
                            Total Jasa
                        </p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            ✓
                        </div>
                        <h3>
                            24
                        </h3>
                        <p>
                            Pesanan Selesai
                        </p>
                    </div>


                    <div class="stat-card">
                        <div class="stat-icon">
                            ☆
                        </div>
                        <h3>
                            4.8
                        </h3>
                        <p>
                            Total Rating
                        </p>
                    </div>


                    <div class="stat-card">
                        <div class="stat-icon">
                            Rp
                        </div>
                        <h3>
                            4,8 Jt
                        </h3>
                        <p>
                            Total Pendapatan
                        </p>
                    </div>
                </div>


                <div class="dashboard-grid">
                    <div class="panel">
                        <div class="panel-header">
                            <h2>
                                Pesanan Masuk
                            </h2>
                            <a href="/freelancer/pesanan">
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    
                    <div class="panel">
                        <div class="panel-header">
                            <h2>
                                Jasa Saya
                            </h2>
                            <a href="/freelancer/jasa">
                                Lihat semua
                            </a>
                        </div>


                        <div class="panel-body">
                            <div class="service-item">
                                <div class="service-image">
                                    ▤
                                </div>
                                <div class="item-info">
                                    <strong>
                                        Desain Logo
                                    </strong>
                                    <span>
                                        Rp150.000 · 12 pesanan
                                    </span>
                                </div>

                                <a href="/freelancer/jasa" class="item-link">
                                    Detail
                                </a>
                            </div>


                            <div class="service-item">
                                <div class="service-image">
                                    ⌘
                                </div>
                                <div class="item-info">
                                    <strong>
                                        Website Laravel
                                    </strong>
                                    <span>
                                        Rp750.000 · 8 pesanan
                                    </span>
                                </div>
                                <a href="/freelancer/jasa" class="item-link">
                                    Detail
                                </a>
                            </div>


                            <div class="service-item">
                                <div class="service-image">
                                    ▣
                                </div>
                                <div class="item-info">
                                    <strong>
                                        Editing Video
                                    </strong>
                                    <span>
                                        Rp250.000 · 6 pesanan
                                    </span>
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


            
                <div class="panel">
                        <div class="panel-header">
                            <h2>
                                Aktivitas Terbaru
                            </h2>
                        </div>


                        <div class="panel-body">
                            <div class="activity-item">
                                <div class="activity-icon">
                                    ✓
                                </div>
                                <div class="item-info">
                                    <strong>
                                        Pesanan selesai
                                    </strong>
                                    <span>
                                        Desain logo - 2 jam lalu
                                    </span>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon">
                                    ☆
                                </div>
                                <div class="item-info">
                                    <strong>
                                        Mendapat rating baru
                                    </strong>
                                    <span>
                                        Rating 5 dari Deby - Kemarin
                                    </span>
                                </div>
                            </div>


                            <div class="activity-item">
                                <div class="activity-icon">
                                    ▧
                                </div>
                                <div class="item-info">
                                    <strong>
                                        Pesanan baru masuk
                                    </strong>
                                    <span>
                                        Website Laravel - 2 hari lalu
                                    </span>
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