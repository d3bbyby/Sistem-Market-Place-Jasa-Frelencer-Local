
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
            background: #F2FAF9;
            color: #183B3A;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #12514C;
            border-right: 1px solid #0E403D;
            padding: 25px 18px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            padding: 0 15px;
            margin-bottom: 35px;
        }

        .menu-title {
            font-size: 12px;
            color: #A9D4CE;
            text-transform: uppercase;
            margin: 0 15px 12px;
        }

        .menu a {
            display: flex;
            align-items: center;
            flex-direction: row;
            gap: 12px;
            text-decoration: none;
            color: #E0F0EE;
            padding: 13px 15px;
            border-radius: 9px;
            margin-bottom: 6px;
            font-size: 14px;
            transition: 0.3s;
            white-space: nowrap;
        }

        .menu a:hover,
        .menu a.active {
            background: #D9F3EF;
            color: #12514C;
        }

        .menu-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            min-width: 20px;
            flex-shrink: 0;
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
            border-bottom: 1px solid #D8EAE7;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .page-title {
            font-size: 22px;
            font-weight: bold;
            color: #183B3A;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-photo {
            width: 40px;
            height: 40px;
            background: #E0F5F1;
            color: #0E756D;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            overflow: hidden;
            flex-shrink: 0;
        }

        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
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
            color: #72918D;
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
            color: #0E756D;
        }

        .welcome p {
            color: #72918D;
            font-size: 14px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 18px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border: 1px solid #D8EAE7;
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
            background: #E0F5F1;
            color: #0E756D;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .stat-card h3 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #183B3A;
        }

        .stat-card p {
            color: #72918D;
            font-size: 13px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.5fr 1.5fr 1fr;
            gap: 22px;
        }

        .panel {
            background: white;
            border: 1px solid #D8EAE7;
            border-radius: 14px;
            overflow: hidden;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 22px;
            border-bottom: 1px solid #D8EAE7;
        }

        .panel-header h2 {
            font-size: 17px;
            color: #183B3A;
        }

        .panel-header a {
            color: #0E756D;
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
            color: #72918D;
            padding: 12px 10px;
            border-bottom: 1px solid #D8EAE7;
        }

        td {
            padding: 15px 10px;
            font-size: 13px;
            border-bottom: 1px solid #EAF3F1;
            color: #496B67;
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
            border-bottom: 1px solid #EAF3F1;
        }

        .service-item:last-child,
        .activity-item:last-child {
            border-bottom: none;
        }

        .rating-summary {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            border-radius: 12px;
            background: #FFFAE8;
        }

        .rating-summary .stat-icon {
            margin: 0;
            background: #FFF0B8;
            color: #A87300;
        }

        .rating-summary strong {
            display: block;
            color: #183B3A;
            font-size: 20px;
        }

        .rating-summary span {
            color: #72918D;
            font-size: 12px;
        }

        .rating-item {
            padding: 15px 0;
            border-bottom: 1px solid #D8EAE7;
        }

        .rating-item:last-child {
            border-bottom: none;
        }

        .rating-item-header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .rating-stars {
            color: #E5A900;
            letter-spacing: 2px;
            white-space: nowrap;
        }

        .rating-comment {
            margin-top: 8px;
            color: #45635F;
            font-size: 13px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .rating-meta {
            display: block;
            margin-top: 7px;
            color: #72918D;
            font-size: 11px;
        }

        .service-image {
            width: 48px;
            height: 48px;
            background: #E0F5F1;
            color: #0E756D;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 20px;
            flex-shrink: 0;
        }

        .item-info {
            flex: 1;
            min-width: 0;
        }

        .item-info strong {
            display: block;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .item-info span {
            font-size: 11px;
            color: #72918D;
            overflow-wrap: anywhere;
        }

        .item-link {
            color: #0E756D;
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
            background: #E0F5F1;
            color: #0E756D;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .button {
            display: inline-block;
            background: #0E756D;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            margin-top: 15px;
        }

        .button:hover {
            background: #095A55;
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

                <a href="{{ route('freelancer.service-requests.index') }}">
                    <span class="menu-icon">▦</span>
                    Posting Kebutuhan Client
                </a>

                <a href="{{ route('freelancer.orders.index') }}">
                    <span class="menu-icon">▧</span>
                    <span>Pesanan Masuk</span>
                </a>

                <a href="/freelancer/portofolio">
                    <span class="menu-icon">▧</span>
                    Portofolio
                </a>

                <a href="#rating-ulasan">
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
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();">
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
                            @if (Auth::user()->profile_photo)
                                <img
                                    src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                                    alt="Foto Profil"
                                >
                            @else
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @endif
                        @else
                            F
                        @endauth
                    </div>

                    <div class="profile-info">
                        @auth
                            <strong>{{ Auth::user()->name }}</strong>
                            <span>{{ ucfirst(Auth::user()->role) }}</span>
                        @else
                            <strong>Freelancer</strong>
                            <span>Penyedia Jasa</span>
                        @endauth
                    </div>
                </div>
            </header>

            <section class="content">

                <div class="welcome">
                    @auth
                        <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>
                    @else
                        <h1>Selamat Datang, Freelancer!</h1>
                    @endauth

                    <p>
                        Kelola jasa, pesanan, dan portofolio kamu melalui halaman ini.
                    </p>
                </div>

                <div class="stats">

                    <div class="stat-card">
                        <div class="stat-icon">▤</div>
                        <h3>{{ $totalServices }}</h3>
                        <p>Total Jasa Saya</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">✓</div>
                        <h3>{{ $completedOrdersCount }}</h3>
                        <p>Pesanan Selesai</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">▧</div>
                        <h3>{{ $totalOrders }}</h3>
                        <p>Total Pesanan Masuk</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">Rp</div>
                        <h3>Rp{{ number_format($totalIncome, 0, ',', '.') }}</h3>
                        <p>Total Pendapatan</p>
                    </div>

                    <div class="stat-card">
    <div class="stat-icon">★</div>
    <h3>
        {{ $ratingsCount > 0 ? number_format($averageRating, 1).' / 5' : '—' }}
    </h3>
    <p>Rating Proyek ({{ $ratingsCount }})</p>
</div>

                </div>

                <div class="dashboard-grid">

                    <div class="panel">
                        <div class="panel-header">
                            <h2>Pesanan Masuk</h2>
                           <a href="{{ route('freelancer.orders.index') }}">Lihat semua</a>
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
                                        <tbody>
    @forelse ($latestOrders as $order)
        @php
            $status = strtoupper($order->status ?? '');

            $statusClass = match ($status) {
                'MENUNGGU' => 'pending',
                'DIPROSES', 'SUBMITTED', 'REVISI' => 'process',
                'SELESAI' => 'done',
                default => 'pending',
            };

            $statusLabel = match ($status) {
                'MENUNGGU' => 'Menunggu',
                'DIPROSES' => 'Diproses',
                'SUBMITTED' => 'Menunggu Review',
                'REVISI' => 'Revisi',
                'SELESAI' => 'Selesai',
                default => $status ?: 'Tidak diketahui',
            };
        @endphp

        <tr>
            <td>{{ optional($order->client)->name ?? 'Client tidak tersedia' }}</td>

            <td>{{ optional($order->service)->title ?? 'Jasa tidak tersedia' }}</td>

            <td>{{ optional($order->created_at)->format('d M Y') ?? '-' }}</td>

            <td>
                <span class="status {{ $statusClass }}">
                    {{ $statusLabel }}
                </span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4">Belum ada pesanan masuk.</td>
        </tr>
    @endforelse
</tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-header">
                            <h2>Jasa Saya</h2>
                            <a href="/freelancer/jasa">Lihat semua</a>
                        </div>

                        <div class="panel-body">
                            @forelse ($services as $service)
                                <div class="service-item">
                                    <div class="service-image">▤</div>

                                    <div class="item-info">
                                        <strong>{{ $service->title }}</strong>
                                        <span>
                                            Mulai Rp{{ number_format((float) $service->price, 0, ',', '.') }}
                                            · {{ $service->orders_count }} pesanan
                                        </span>
                                    </div>

                                    <a href="{{ route('jasa.show', $service) }}" class="item-link">
                                        Detail
                                    </a>
                                </div>
                            @empty
                                <p>Belum ada jasa yang dibuat.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-header">
                            <h2>Aktivitas Terbaru</h2>
                        </div>

                        <div class="panel-body">
                            @forelse ($aktivitasTerbaru as $aktivitas)
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        {{ $aktivitas['ikon'] }}
                                    </div>

                                    <div class="item-info">
                                        <strong>
                                            {{ $aktivitas['judul'] }}
                                        </strong>

                                        <span>
                                            {{ $aktivitas['keterangan'] }}
                                            <br>
{{ optional($aktivitas['tanggal'] ?? null)->diffForHumans() ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p>Belum ada aktivitas terbaru.</p>
                            @endforelse
                        </div>
                    </div>

                </div>

                
<section class="panel" id="rating-ulasan" style="margin-top: 22px;">

    <div class="panel-header">
        <h2>Rating &amp; Ulasan Proyek</h2>
        <span>Ulasan dari Client</span>
    </div>

    <div class="panel-body">

        <div class="rating-summary">
            <div class="stat-icon" aria-hidden="true">★</div>

            <div>
                <strong>
                    {{ $ratingsCount > 0
                        ? number_format($averageRating, 1).' / 5'
                        : 'Belum ada rating' }}
                </strong>

                <span>
                    {{ $ratingsCount }} ulasan dari client untuk proyekmu
                </span>
            </div>
        </div>

        @forelse ($latestRatings as $rating)

            @php
                $nilaiRating = max(0, min(5, (int) $rating->rating));
            @endphp

            <article class="rating-item">

                <div class="rating-item-header">
                    <strong>
                        {{ optional(optional($rating->order)->service)->title ?? 'Proyek' }}
                    </strong>

                    <span class="rating-stars"
                          aria-label="{{ $nilaiRating }} dari 5 bintang">
                        {{ str_repeat('★', $nilaiRating) }}{{ str_repeat('☆', 5 - $nilaiRating) }}
                    </span>
                </div>

                <p class="rating-comment">
                    {{ $rating->review ?? 'Client tidak memberikan komentar.' }}
                </p>

                <span class="rating-meta">
                    Dari {{ optional($rating->reviewer)->name ?? 'Client' }}
                    · {{ optional($rating->created_at)->diffForHumans() ?? '-' }}
                </span>

            </article>

        @empty

            <p style="margin-top: 18px; color: #72918D;">
                Ulasan proyek akan muncul di sini setelah client memberikan rating pada pesanan yang selesai.
            </p>

        @endforelse

    </div>
</section>
            </section>
        </main>
    </div>
</body>
</html>
