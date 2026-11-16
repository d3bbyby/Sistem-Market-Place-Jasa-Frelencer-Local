<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil - FreelanceHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #F2FAF9;
            color: #183B3A;
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
            background: #12514C;
        }

        .logo {
            padding: 0 15px;
            margin-bottom: 35px;
            font-size: 24px;
            font-weight: bold;
            color: white;
        }

        .menu-title {
            margin: 0 15px 12px;
            color: #A9D4CE;
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
            color: #E0F0EE;
            text-decoration: none;
            font-size: 14px;
        }

        .menu a:hover,
        .menu a.active {
            background: #D9F3EF;
            color: #12514C;
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
            max-width: 850px;
            margin: auto;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .page-title p {
            color: #72918D;
        }

        .profile-card {
            padding: 30px;
            background: white;
            border: 1px solid #D8EAE7;
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(18, 81, 76, 0.06);
        }

        @media (max-width: 760px) {
            .workspace {
                display: block;
            }

            .sidebar {
                position: static;
                width: 100%;
            }

            .menu {
                display: flex;
                flex-wrap: wrap;
            }

            .profile-main {
                margin-left: 0;
                padding: 24px 16px;
            }
            .logout-form {
    margin: 0;
}

.logout-button {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    margin-bottom: 6px;
    padding: 13px 15px;
    border: none;
    border-radius: 9px;
    background: transparent;
    color: #E0F0EE;
    font-size: 14px;
    text-align: left;
    cursor: pointer;
}

.logout-button:hover {
    background: #D9F3EF;
    color: #12514C;
}
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    /* Kartu pengaturan */
    .profile-card {
        margin-bottom: 22px;
        padding: 35px;
    }

    /* Judul dan deskripsi */
    .profile-card h2 {
        color: #12514C !important;
        font-size: 21px !important;
        font-weight: 700 !important;
        margin-bottom: 8px;
    }

    .profile-card header p {
        color: #72918D !important;
        line-height: 1.6;
    }

    /* Jarak antarform */
    .profile-card form.space-y-6 > div {
        margin-bottom: 22px !important;
    }

    /* Label */
    .profile-card label {
        display: block;
        margin-bottom: 8px;
        color: #183B3A !important;
        font-size: 14px;
        font-weight: 600;
    }

    /* Input nama, email, dan password */
    .profile-card input:not([type="file"]) {
        width: 100%;
        min-height: 44px;
        padding: 10px 14px;
        border: 1px solid #D8EAE7 !important;
        border-radius: 9px !important;
        background: #FAFDFC !important;
        color: #183B3A !important;
        outline: none;
        box-shadow: none !important;
    }

    .profile-card input:focus {
        border-color: #0E756D !important;
        box-shadow: 0 0 0 3px rgba(14, 117, 109, 0.12) !important;
    }

    /* Upload foto */
    .profile-card input[type="file"] {
        max-width: 100%;
        padding: 10px;
        border: 1px dashed #A9D4CE;
        border-radius: 9px;
        background: #F2FAF9;
        color: #183B3A;
    }

    /* Tombol simpan */
    .profile-card button[type="submit"] {
        padding: 11px 24px !important;
        border: none !important;
        border-radius: 9px !important;
        background: #0E756D !important;
        color: white !important;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s;
    }

    .profile-card button[type="submit"]:hover {
        background: #12514C !important;
    }

    /* Pesan validasi */
    .profile-card p.text-sm {
        line-height: 1.5;
    }

    /* Tampilan HP */
    @media (max-width: 760px) {
        .profile-card {
            padding: 22px;
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
                <a href="/freelancer/dashboard">
                    <span class="menu-icon">▣</span> Dashboard
                </a>

                <a href="/freelancer/profil">
                    <span class="menu-icon">♙</span> Profil Saya
                </a>

                <a href="/freelancer/jasa">
                    <span class="menu-icon">▤</span> Jasa Saya
                </a>

                <a href="/freelancer/pesanan">
                    <span class="menu-icon">▧</span> Pesanan Masuk
                </a>

                <a href="/freelancer/portofolio">
                    <span class="menu-icon">▧</span> Portofolio
                </a>

                <a href="{{ route('profile.edit') }}">
                    <span class="menu-icon">⚙</span> Pengaturan Akun
                </a>

                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                   @csrf
                    <button type="submit" class="logout-button">
                    <span class="menu-icon">↪</span> Logout
                </button>
                </form>
            </nav>
        </aside>

        <main class="profile-main">
            <div class="container">
                @yield('content')
            </div>
        </main>

    </div>
</body>
</html>
