<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - FreelanceHub</title>

    
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

    /* MAIN CONTENT */
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
        background: linear-gradient(115deg, #F0EAFF, #FFF0EA 70%, #FFF9E8);
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

    /* SECTION HEADING */
    .section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin: 0 0 14px;
    }

    .section-heading h2 {
        font-size: 16px;
        color: var(--text);
    }

    .section-heading p {
        font-size: 12px;
        color: var(--muted);
        margin-top: 4px;
    }

    /* STATISTICS */
    .stats {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
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

    .stat-card:nth-child(5) {
        border-top-color: #F0BB43;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 11px 24px rgba(77, 53, 140, 0.1);
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
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

    .stat-card:nth-child(5) .stat-icon {
        background: #FFF6DB;
        color: #B88812;
    }

    .stat-number {
        font-size: 25px;
        font-weight: 800;
        margin: 16px 0 5px;
        color: var(--text);
    }

    .stat-card p {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.4;
    }

    /* PANELS */
    .dashboard-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.5fr) minmax(280px, 1fr);
        gap: 20px;
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

    /* ORDER TABLE */
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

    /* USER LIST */
    .user-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 13px 0;
        border-bottom: 1px solid #F1EDF8;
    }

    .user-item:first-child {
        padding-top: 2px;
    }

    .user-item:last-child {
        border-bottom: none;
        padding-bottom: 2px;
    }

    .user-left {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }

    .user-photo {
        width: 39px;
        height: 39px;
        flex-shrink: 0;
        background: #EDE7FF;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        font-weight: bold;
        font-size: 13px;
    }

    .user-item:nth-child(2) .user-photo {
        background: #FFF0E9;
        color: #E87856;
    }

    .user-item:nth-child(3) .user-photo {
        background: #E5FAF1;
        color: #159B72;
    }

    .user-item:nth-child(4) .user-photo {
        background: #E4F7FC;
        color: #1E94B8;
    }

    .user-name {
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 4px;
    }

    .user-email {
        font-size: 10px;
        color: #948DA9;
        overflow-wrap: anywhere;
    }

    .role {
        flex-shrink: 0;
        font-size: 10px;
        font-weight: bold;
        color: var(--primary);
        background: #F0EBFF;
        padding: 6px 9px;
        border-radius: 15px;
    }

    /* RESPONSIVE */
    @media (max-width: 1250px) {
        .stats {
            grid-template-columns: repeat(3, minmax(0, 1fr));
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

        .content {
            padding: 25px 22px;
        }

        .topbar {
            padding: 14px 22px;
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
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

        .page-subtitle {
            font-size: 11px;
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

        .stat-number {
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

                <a href="/admin/dashboard" class="active">
                    <span class="menu-icon">▣</span>
                    Dashboard
                </a>

                <a href="/admin/pengguna">
                    <span class="menu-icon">♙</span>
                    Pengguna
                </a>

                <a href="/admin/client">
                    <span class="menu-icon">♧</span>
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

            <!-- LOGOUT -->
            <div class="menu logout">
                <a href="/logout">
                    <span class="menu-icon">↪</span>
                    Logout
                </a>
            </div>

        </aside>


        <!-- MAIN CONTENT -->
        <main class="main">

            <!-- TOPBAR -->
            <header class="topbar">

                <div>
                    <div class="page-title">Dashboard Admin</div>
                    <div class="page-subtitle">
                        Ringkasan aktivitas FreelanceHub
                    </div>
                </div>

                <!-- PROFIL ADMIN -->
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
                            <strong>{{ Auth::user()->name }}</strong>
                            <span>{{ ucfirst(Auth::user()->role) }}</span>
                        @else
                            <strong>Admin</strong>
                            <span>Administrator</span>
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
                            Panel Administrasi
                        </span>

                        @auth
                            <h1>
                                Selamat Datang, {{ Auth::user()->name }}!
                            </h1>
                        @else
                            <h1>Selamat Datang, Admin!</h1>
                        @endauth

                        <p>
                            Kelola aktivitas dan pantau ringkasan data
                            FreelanceHub dari satu halaman.
                        </p>

                    </div>

                    <div class="welcome-mark">✦</div>

                </div>


                <!-- STATISTIK -->
                <div class="section-heading">
                    <div>
                        <h2>Ringkasan Platform</h2>
                        <p>Ikhtisar data pada marketplace</p>
                    </div>
                </div>

                <!-- Angka berikut masih berupa data contoh -->
                <div class="stats">

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">♙</div>
                        </div>
                        <h3 class="stat-number">120</h3>
                        <p>Total Pengguna</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">♧</div>
                        </div>
                        <h3 class="stat-number">45</h3>
                        <p>Total Freelancer</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">♙</div>
                        </div>
                        <h3 class="stat-number">75</h3>
                        <p>Total Client</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">▤</div>
                        </div>
                        <h3 class="stat-number">86</h3>
                        <p>Total Jasa</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">▧</div>
                        </div>
                        <h3 class="stat-number">32</h3>
                        <p>Total Pesanan</p>
                    </div>

                </div>


                <!-- PESANAN DAN PENGGUNA -->
                <div class="dashboard-grid">

                    <!-- PESANAN TERBARU -->
                    <div class="panel">

                        <div class="panel-header">
                            <h2>Pesanan Terbaru</h2>
                            <a href="/admin/pesanan">Lihat semua →</a>
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

                                        <tr>
                                            <td>Rizky</td>
                                            <td>Desain Poster</td>
                                            <td>05 Sep 2026</td>
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


                    <!-- PENGGUNA TERBARU -->
                    <div class="panel">

                        <div class="panel-header">
                            <h2>Pengguna Terbaru</h2>
                            <a href="/admin/pengguna">Lihat semua →</a>
                        </div>

                        <div class="panel-body">

                            <div class="user-item">

                                <div class="user-left">
                                    <div class="user-photo">D</div>

                                    <div>
                                        <p class="user-name">Deby</p>
                                        <p class="user-email">
                                            deby@email.com
                                        </p>
                                    </div>
                                </div>

                                <span class="role">Client</span>

                            </div>


                            <div class="user-item">

                                <div class="user-left">
                                    <div class="user-photo">A</div>

                                    <div>
                                        <p class="user-name">Andi</p>
                                        <p class="user-email">
                                            andi@email.com
                                        </p>
                                    </div>
                                </div>

                                <span class="role">Freelancer</span>

                            </div>


                            <div class="user-item">

                                <div class="user-left">
                                    <div class="user-photo">S</div>

                                    <div>
                                        <p class="user-name">Sinta</p>
                                        <p class="user-email">
                                            sinta@email.com
                                        </p>
                                    </div>
                                </div>

                                <span class="role">Client</span>

                            </div>


                            <div class="user-item">

                                <div class="user-left">
                                    <div class="user-photo">R</div>

                                    <div>
                                        <p class="user-name">Rizky</p>
                                        <p class="user-email">
                                            rizky@email.com
                                        </p>
                                    </div>
                                </div>

                                <span class="role">Freelancer</span>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </main>

    </div>

</body>
</html>