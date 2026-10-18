<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Freelancer</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #F7F6FF;
            color: #30264B;
        }

        .workspace {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 250px;
            padding: 25px 18px;
            background: #fff;
            border-right: 1px solid #E9E5F5;
        }

        .logo {
            padding: 0 15px;
            margin-bottom: 35px;
            font-size: 24px;
            font-weight: bold;
            color: #7047EB;
        }

        .menu-title {
            margin: 0 15px 12px;
            color: #89829E;
            font-size: 12px;
            text-transform: uppercase;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 6px;
            padding: 13px 15px;
            border-radius: 9px;
            color: #5D5577;
            text-decoration: none;
            font-size: 14px;
            transition: background .2s, color .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #7047EB;
            color: #fff;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
        }

        .profile-main {
            flex: 1;
            min-width: 0;
            margin-left: 250px;
            padding: 35px;
        }

        .container {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
        }

        .title {
            margin-bottom: 30px;
        }

        .title h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .title p {
            color: #89829E;
        }

        .profile-card {
            background: white;
            border-radius: 18px;
            padding: 35px;
            border: 1px solid #E9E5F5;
            box-shadow: 0 8px 24px rgba(48, 38, 75, 0.04);
        }

        .avatar {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #7047EB;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 38px;
            font-weight: bold;
        }

        .profile-name {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-role {
            text-align: center;
            color: #89829E;
            margin-bottom: 30px;
        }

        .data-box {
            background: #F7F6FF;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 15px;
        }

        .data-box small {
            display: block;
            color: #89829E;
            margin-bottom: 5px;
        }

        .data-box strong {
            font-size: 16px;
            color: #30264B;
        }

        .status {
            display: inline-block;
            background: #e8f5e9;
            color: #388e3c;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .btn {
            display: block;
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            text-align: center;

            background: #7047EB;
            color: white;
            text-decoration: none;

            border-radius: 10px;
            font-weight: bold;
        }

        .btn:hover {
            background: #5030B5;
        }

        @media (max-width: 760px) {
            .workspace {
                display: block;
            }

            .sidebar {
                position: static;
                width: 100%;
                padding: 18px;
            }

            .menu {
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
            }

            .menu a {
                margin: 0;
            }

            .profile-main {
                margin-left: 0;
                padding: 24px 16px;
            }

            .profile-card {
                padding: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="workspace">
        <aside class="sidebar">
            <div class="logo">FreelanceHub</div>
            <p class="menu-title">Menu Utama</p>
            <nav class="menu">
                <a href="/freelancer/dashboard"><span class="menu-icon">▣</span>Dashboard</a>
                <a href="/freelancer/profil" class="active"><span class="menu-icon">♙</span>Profil Saya</a>
                <a href="/freelancer/jasa"><span class="menu-icon">▤</span>Jasa Saya</a>
                <a href="/freelancer/pesanan"><span class="menu-icon">▧</span>Pesanan Masuk</a>
                <a href="/freelancer/portofolio"><span class="menu-icon">▧</span>Portofolio</a>
                <form method="POST" action="{{ route('logout') }}" style="display: contents;">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        <span class="menu-icon">↪</span>Logout
                    </a>
                </form>
            </nav>
        </aside>

        <main class="profile-main">
            <div class="container">
                <div class="title">
                    <h1>Profil Saya</h1>
                    <p>Informasi akun freelancer</p>
                </div>
                <div class="profile-card">
                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="profile-name">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="profile-role">
                        {{ ucfirst(Auth::user()->role) }}
                    </div>

                    <div class="data-box">
                        <small>Nama Lengkap</small>
                        <strong>{{ Auth::user()->name }}</strong>
                    </div>

                    <div class="data-box">
                        <small>Email</small>
                        <strong>{{ Auth::user()->email }}</strong>
                    </div>

                    <div class="data-box">
                        <small>Role</small>
                        <strong>{{ ucfirst(Auth::user()->role) }}</strong>
                    </div>

                    <div class="data-box">
                        <small>Status Akun</small>
                        <span class="status">Aktif</span>
                    </div>

                    <a href="/freelancer/dashboard" class="btn">Kembali ke Dashboard</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>