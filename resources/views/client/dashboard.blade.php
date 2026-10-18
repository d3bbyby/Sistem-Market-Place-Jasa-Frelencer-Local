<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Client - FreelanceHub</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        :root {
            --primary: #7047EB;
            --primary-dark: #5030B5;
            --purple-light: #EDE7FF;
            --text: #30264B;
            --muted: #89829E;
            --background: #F7F6FF;
            --border: #E9E5F5;
            --white: #FFFFFF;
            --peach: #FFB99F;
            --blue: #79D5EE;
            --mint: #8AE3C1;
            --yellow: #FFD778;
        }

        body {
            background: var(--background);
            color: var(--text);
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: var(--white);
            border-right: 1px solid var(--border);
            padding: 25px 18px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 10;
            box-shadow: 5px 0 24px rgba(77, 53, 140, 0.04);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
            padding: 0 12px;
            margin-bottom: 38px;
        }

        .logo-mark {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            background: linear-gradient(135deg, #9878FF, #623BDE);
            border-radius: 12px;
            box-shadow: 0 5px 12px rgba(112, 71, 235, 0.22);
        }

        .menu-title {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            color: #AAA3C0;
            text-transform: uppercase;
            margin: 0 15px 13px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #716987;
            padding: 12px 14px;
            border-radius: 11px;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .menu a:hover {
            background: #F1EDFF;
            color: var(--primary);
            transform: translateX(2px);
        }

        .menu a.active {
            background: linear-gradient(135deg, #8464F7, #6842E6);
            color: white;
            box-shadow: 0 7px 16px rgba(112, 71, 235, 0.2);
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 16px;
        }

        .logout {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 25px;
            padding-top: 14px;
            border-top: 1px solid #F0ECF8;
        }

        .logout a {
            color: #E56B75;
        }

        .logout a:hover {
            background: #FFF0F1;
            color: #D94E60;
            transform: none;
        }

        /* MAIN */
        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .topbar {
            min-height: 78px;
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 14px 35px;
            position: sticky;
            top: 0;
            z-index: 5;
            backdrop-filter: blur(10px);
        }

        .page-title {
            font-size: 21px;
            font-weight: 800;
            color: var(--text);
        }

        .page-subtitle {
            font-size: 12px;
            color: var(--muted);
            margin-top: 4px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 7px 11px 7px 7px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: #FCFBFF;
            max-width: 260px;
        }

        .profile-photo {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            background: linear-gradient(135deg, #E5D9FF, #C9B8FF);
            color: var(--primary-dark);
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 17px;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .profile-info strong {
            font-size: 13px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .profile-info span {
            font-size: 11px;
            color: var(--muted);
            margin-top: 3px;
        }

        .content {
            padding: 30px 35px 40px;
        }

        /* WELCOME */
        .welcome {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 27px;
            padding: 27px 28px;
            border-radius: 20px;
            border: 1px solid #E6DCFF;
            background: linear-gradient(
                115deg,
                #F0EAFF,
                #FFF0EA 70%,
                #FFF9E8
            );
            position: relative;
            overflow: hidden;
        }

        .welcome::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            right: -50px;
            top: -75px;
            border-radius: 50%;
            background: rgba(112, 71, 235, 0.09);
        }

        .welcome-copy {
            position: relative;
            z-index: 1;
        }

        .welcome-label {
            display: inline-block;
            color: var(--primary);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 9px;
        }

        .welcome h1 {
            font-size: 26px;
            line-height: 1.3;
            margin-bottom: 8px;
            color: var(--text);
        }

        .welcome p {
            color: #77708E;
            font-size: 13px;
            line-height: 1.6;
        }

        .welcome-mark {
            width: 62px;
            height: 62px;
            border-radius: 19px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.8);
            color: var(--primary);
            font-size: 28px;
            position: relative;
            z-index: 1;
        }

        /* STATISTIK */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-top: 4px solid var(--primary);
            border-radius: 15px;
            padding: 19px;
            min-height: 137px;
            box-shadow: 0 5px 18px rgba(77, 53, 140, 0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:nth-child(2) {
            border-top-color: #FF967A;
        }

        .stat-card:nth-child(3) {
            border-top-color: #44CBA3;
        }

        .stat-card:nth-child(4) {
            border-top-color: #51BDE0;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--purple-light);
            color: var(--primary);
            border-radius: 12px;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .stat-card:nth-child(2) .stat-icon {
            background: #FFF0E9;
            color: #E87856;
        }

        .stat-card:nth-child(3) .stat-icon {
            background: #E5FAF1;
            color: #159B72;
        }

        .stat-card:nth-child(4) .stat-icon {
            background: #E4F7FC;
            color: #1E94B8;
        }

        .stat-card h3 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 5px;
            color: var(--text);
        }

        .stat-card p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.4;
        }

        /* GRID */
        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(280px, 1fr);
            gap: 20px;
        }

        .right-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
            min-width: 0;
        }

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 17px;
            overflow: hidden;
            box-shadow: 0 5px 18px rgba(77, 53, 140, 0.035);
            min-width: 0;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 19px 21px;
            border-bottom: 1px solid #F0ECF8;
            background: #FFFEFF;
        }

        .panel-header h2 {
            font-size: 15px;
            color: var(--text);
        }

        .panel-header a {
            color: var(--primary);
            font-size: 12px;
            text-decoration: none;
            font-weight: bold;
            white-space: nowrap;
        }

        .panel-header a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .panel-body {
            padding: 18px 21px;
        }

        /* TABEL PESANAN */
        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 430px;
        }

        th {
            text-align: left;
            font-size: 11px;
            letter-spacing: 0.3px;
            color: #948DA9;
            padding: 12px 10px;
            background: #F8F6FF;
            border-bottom: 1px solid #ECE7F8;
        }

        td {
            padding: 14px 10px;
            font-size: 12px;
            border-bottom: 1px solid #F1EDF8;
            color: #5D5577;
        }

        tbody tr:hover {
            background: #FAF8FF;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .status {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap;
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

        /* FREELANCER FAVORIT */
        .favorite-item,
        .activity-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid #F1EDF8;
        }

        .favorite-item:first-child,
        .activity-item:first-child {
            padding-top: 2px;
        }

        .favorite-item:last-child,
        .activity-item:last-child {
            border-bottom: none;
            padding-bottom: 2px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            background: #EDE7FF;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .favorite-item:nth-child(2) .avatar {
            background: #FFF0E9;
            color: #E87856;
        }

        .favorite-item:nth-child(3) .avatar {
            background: #E5FAF1;
            color: #159B72;
        }

        .item-info {
            flex: 1;
            min-width: 0;
        }

        .item-info strong {
            display: block;
            font-size: 12px;
            margin-bottom: 5px;
            color: var(--text);
        }

        .item-info span {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.5;
        }

        .item-link {
            color: var(--primary);
            background: #F0EBFF;
            padding: 7px 10px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 11px;
            font-weight: bold;
            transition: 0.2s;
        }

        .item-link:hover {
            background: var(--primary);
            color: white;
        }

        /* AKTIVITAS */
        .activity-item {
            align-items: flex-start;
        }

        .activity-icon {
            width: 35px;
            height: 35px;
            background: #E5FAF1;
            color: #159B72;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .activity-item:nth-child(2) .activity-icon {
            background: #FFF6DB;
            color: #B88812;
        }

        .activity-item:nth-child(3) .activity-icon {
            background: #E4F7FC;
            color: #1E94B8;
        }

        .empty {
            text-align: center;
            color: var(--muted);
            padding: 40px 20px;
            font-size: 13px;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 950px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 25px 22px;
            }

            .topbar {
                padding: 14px 22px;
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
                padding: 20px 16px 78px;
            }

            .logo {
                margin-bottom: 22px;
            }

            .menu {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 4px;
            }

            .menu-title {
                margin-top: 0;
            }

            .menu a {
                margin-bottom: 0;
                padding: 11px 9px;
                font-size: 12px;
            }

            .logout {
                display: block;
                bottom: 16px;
            }

            .logout a {
                padding: 10px 12px;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                min-height: 70px;
                padding: 12px 17px;
            }

            .page-title {
                font-size: 17px;
            }

            .profile {
                padding: 5px;
                border: none;
                background: transparent;
            }

            .profile-photo {
                width: 38px;
                height: 38px;
            }

            .profile-info {
                display: none;
            }

            .content {
                padding: 20px 15px 28px;
            }

            .welcome {
                padding: 21px 19px;
            }

            .welcome h1 {
                font-size: 21px;
            }

            .welcome p {
                font-size: 12px;
            }

            .welcome-mark {
                width: 48px;
                height: 48px;
                font-size: 21px;
                border-radius: 14px;
            }

            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 11px;
            }

            .stat-card {
                padding: 15px;
                min-height: 125px;
            }

            .stat-card h3 {
                font-size: 22px;
            }

            .stat-card p {
                font-size: 11px;
            }

            .panel-header {
                padding: 16px;
            }

            .panel-body {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="layout">

        <!-- SIDEBAR -->
        <aside class="sidebar">

            <div class="logo">
                <span class="logo-mark">F</span>
                FreelanceHub
            </div>

            <p class="menu-title">Menu Utama</p>

            <div class="menu">

                <a href="/client/dashboard" class="active">
                    <span class="menu-icon">▣</span>
                    Dashboard
                </a>

                <a href="/client/jasa">
                    <span class="menu-icon">⌕</span>
                     Cari Freelancer
                </a>

                <a href="/client/pesanan">
                    <span class="menu-icon">▧</span>
                    Pesanan Saya
                </a>

                <a href="/client/chat">
                    <span class="menu-icon">▤</span>
                    Chat
                </a>

                <a href="/client/favorit">
                    <span class="menu-icon">♡</span>
                    Favorit
                </a>

                <a href="/client/review">
                    <span class="menu-icon">☆</span>
                    Review Saya
                </a>

                <a href="/client/pembayaran">
                    <span class="menu-icon">▣</span>
                    Pembayaran
                </a>

                <a href="/client/pengaturan">
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


        <!-- MAIN -->
        <main class="main">

            <!-- TOPBAR -->
            <header class="topbar">

                <div>
                    <div class="page-title">Dashboard Client</div>
                    <div class="page-subtitle">
                        Temukan jasa terbaik untuk kebutuhanmu
                    </div>
                </div>

                <!-- PROFIL USER -->
                <div class="profile">

                    <div class="profile-photo">
                        @auth
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @else
                            C
                        @endauth
                    </div>

                    <div class="profile-info">
                        @auth
                            <strong>{{ Auth::user()->name }}</strong>
                            <span>{{ ucfirst(Auth::user()->role) }}</span>
                        @else
                            <strong>Client</strong>
                            <span>Pelanggan</span>
                        @endauth
                    </div>

                </div>

            </header>


            <!-- CONTENT -->
            <section class="content">

                <!-- WELCOME -->
                <div class="welcome">

                    <div class="welcome-copy">
                        <span class="welcome-label">
                            Selamat datang di FreelanceHub
                        </span>

                        @auth
                            <h1>
                                Selamat Datang, {{ Auth::user()->name }}!
                            </h1>
                        @else
                            <h1>Selamat Datang, Client!</h1>
                        @endauth

                        <p>
                            Temukan freelancer terbaik untuk membantu
                            menyelesaikan kebutuhanmu.
                        </p>
                    </div>

                    <div class="welcome-mark">✦</div>

                </div>


                <!-- STATISTIK -->
                <div class="stats">

                    <div class="stat-card">
                        <div class="stat-icon">▧</div>
                        <h3>12</h3>
                        <p>Total Pesanan</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">↻</div>
                        <h3>3</h3>
                        <p>Pesanan Diproses</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">✓</div>
                        <h3>9</h3>
                        <p>Pesanan Selesai</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">Rp</div>
                        <h3>2,5 Jt</h3>
                        <p>Total Pembayaran</p>
                    </div>

                </div>


                <!-- GRID DASHBOARD -->
                <div class="dashboard-grid">

                    <!-- PESANAN TERBARU -->
                    <div class="panel">

                        <div class="panel-header">
                            <h2>Pesanan Terbaru</h2>
                            <a href="/client/pesanan">Lihat semua →</a>
                        </div>

                        <div class="panel-body">
                            <div class="table-wrapper">

                                <table>
                                    <thead>
                                        <tr>
                                            <th>Freelancer</th>
                                            <th>Jasa</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>Andi Design</td>
                                            <td>Desain Logo</td>
                                            <td>08 Sep 2026</td>
                                            <td>
                                                <span class="status pending">
                                                    Menunggu
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Sinta Web</td>
                                            <td>Website Laravel</td>
                                            <td>07 Sep 2026</td>
                                            <td>
                                                <span class="status process">
                                                    Diproses
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Rizky Editor</td>
                                            <td>Editing Video</td>
                                            <td>05 Sep 2026</td>
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


                    <!-- KOLOM KANAN -->
                    <div class="right-column">

                        <!-- FREELANCER FAVORIT -->
                        <div class="panel">

                            <div class="panel-header">
                                <h2>Freelancer Favorit</h2>
                                <a href="/client/favorit">Lihat semua →</a>
                            </div>

                            <div class="panel-body">

                                <div class="favorite-item">

                                    <div class="avatar">A</div>

                                    <div class="item-info">
                                        <strong>Andi Design</strong>
                                        <span>Desain Grafis</span>
                                    </div>

                                    <a href="/client/jasa" class="item-link">
                                        Lihat
                                    </a>

                                </div>


                                <div class="favorite-item">

                                    <div class="avatar">S</div>

                                    <div class="item-info">
                                        <strong>Sinta Web</strong>
                                        <span>Web Developer</span>
                                    </div>

                                    <a href="/client/jasa" class="item-link">
                                        Lihat
                                    </a>

                                </div>


                                <div class="favorite-item">

                                    <div class="avatar">R</div>

                                    <div class="item-info">
                                        <strong>Rizky Editor</strong>
                                        <span>Video Editor</span>
                                    </div>

                                    <a href="/client/jasa" class="item-link">
                                        Lihat
                                    </a>

                                </div>

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
                                        <strong>Pesanan telah selesai</strong>
                                        <span>Desain logo - 2 jam lalu</span>
                                    </div>

                                </div>


                                <div class="activity-item">

                                    <div class="activity-icon">★</div>

                                    <div class="item-info">
                                        <strong>Review berhasil diberikan</strong>
                                        <span>Website Laravel - Kemarin</span>
                                    </div>

                                </div>


                                <div class="activity-item">

                                    <div class="activity-icon">▧</div>

                                    <div class="item-info">
                                        <strong>Pesanan baru dibuat</strong>
                                        <span>Editing video - 2 hari lalu</span>
                                    </div>

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