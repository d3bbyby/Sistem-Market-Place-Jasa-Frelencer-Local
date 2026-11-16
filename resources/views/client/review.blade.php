
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Saya - FreelanceHub</title>

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
        }

        body {
            background: var(--background);
            color: var(--text);
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: white;
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
        }

        .menu-title {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            color: #AAA3C0;
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
        }

        .menu a:hover {
            background: #F1EDFF;
            color: var(--primary);
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

        /* MAIN */
        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .topbar {
            min-height: 78px;
            background: rgba(255,255,255,0.96);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 35px;
            position: sticky;
            top: 0;
            z-index: 5;
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
        }

        .profile-photo {
            width: 42px;
            height: 42px;
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
        }

        .profile-info strong {
            font-size: 13px;
        }

        .profile-info span {
            font-size: 11px;
            color: var(--muted);
            margin-top: 3px;
        }

        .content {
            padding: 30px 35px 40px;
        }

        /* HEADER REVIEW */
        .welcome {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 27px;
            padding: 27px 28px;
            border-radius: 20px;
            border: 1px solid #E6DCFF;
            background: linear-gradient(115deg, #F0EAFF, #FFF0EA 70%, #FFF9E8);
        }

        .welcome-mark {
            width: 62px;
            height: 62px;
            border-radius: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: var(--primary);
            font-size: 28px;
            flex-shrink: 0;
        }

        .welcome h1 {
            font-size: 26px;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #77708E;
            font-size: 13px;
        }

        /* PANEL */
        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 17px;
            overflow: hidden;
            box-shadow: 0 5px 18px rgba(77,53,140,0.035);
            margin-bottom: 20px;
        }

        .panel-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 19px 21px;
            border-bottom: 1px solid #F0ECF8;
        }

        .panel-header h2 {
            font-size: 15px;
        }

        .panel-body {
            padding: 20px;
        }

        .review-item {
            display: flex;
            gap: 16px;
            padding: 18px;
            border: 1px solid var(--border);
            border-radius: 13px;
            margin-bottom: 14px;
        }

        .review-item:last-child {
            margin-bottom: 0;
        }

        .avatar {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--purple-light);
            color: var(--primary);
            font-size: 20px;
            font-weight: bold;
        }

        .review-info {
            flex: 1;
        }

        .review-info strong {
            display: block;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .review-info .role {
            color: var(--muted);
            font-size: 11px;
        }

        .stars {
            color: #FFB52E;
            font-size: 19px;
            letter-spacing: 2px;
            margin: 8px 0;
        }

        .review-info p {
            font-size: 12px;
            color: #5D5577;
            line-height: 1.6;
        }

        .review-date {
            color: var(--muted);
            font-size: 11px;
            margin-top: 9px;
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
        }

        @media (max-width: 650px) {
            .layout {
                display: block;
            }

            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                padding: 20px 16px;
            }

            .menu {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .logout {
                position: static;
                margin-top: 15px;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                padding: 14px 17px;
            }

            .content {
                padding: 20px 15px;
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
            <a href="/client/dashboard">
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

            <a href="/client/review" class="active">
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
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    <span class="menu-icon">↪</span>
                    Logout
                </a>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <header class="topbar">
            <div>
                <div class="page-title">Review Saya</div>
                <div class="page-subtitle">
                    Lihat ulasan yang pernah kamu berikan kepada freelancer
                </div>
            </div>

            <div class="profile">
                <div class="profile-photo">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="profile-info">
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>{{ ucfirst(Auth::user()->role) }}</span>
                </div>
            </div>
        </header>

        <section class="content">

            <div class="welcome">
                <div class="welcome-mark">★</div>
                <div>
                    <h1>Review Saya</h1>
                    <p>
                        Lihat ulasan yang pernah kamu berikan kepada freelancer.
                    </p>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h2>★ &nbsp; Daftar Review</h2>
                </div>

                <div class="panel-body">

                    @if($reviews->count() > 0)

    @foreach($reviews as $review)
        <div class="review-item">
            <div class="avatar">
                {{ strtoupper(substr($review->freelancer->name ?? 'F', 0, 1)) }}
            </div>

            <div class="review-info">
                <strong>
                    {{ $review->freelancer->name ?? 'Freelancer' }}
                </strong>

                <span class="role">Freelancer</span>

                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= $review->rating ? '★' : '☆' }}
                    @endfor
                </div>

                <p>
                    {{ $review->comment ?? 'Tidak ada komentar.' }}
                </p>

                <div class="review-date">
                    {{ $review->created_at->format('d F Y') }}
                </div>
            </div>
        </div>
    @endforeach

@else

    <div style="text-align: center; padding: 35px 15px;">
        <div style="font-size: 35px; margin-bottom: 12px;">☆</div>

        <strong>Belum Ada Review</strong>

        <p style="margin-top: 8px; color: #89829E;">
            Kamu belum memberikan review kepada freelancer.
        </p>
    </div>

@endif

                </div>
            </div>

        </section>
    </main>
</div>
</body>
</html>
