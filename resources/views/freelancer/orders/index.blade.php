<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk - Freelancer</title>

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
            top: 0;
            bottom: 0;
            left: 0;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #754522;
            margin-bottom: 35px;
            padding: 0 15px;
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
    white-space: nowrap;
}

.menu-icon {
    width: 20px;
    flex-shrink: 0;
    text-align: center;
}

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        .topbar {
            background: white;
            padding: 25px 35px;
            border-bottom: 1px solid #e5d8ce;
        }

        .content {
            padding: 35px;
        }

        .content h1 {
            color: #754522;
            margin-bottom: 10px;
        }

        .description {
            color: #8b7769;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .card {
            background: white;
            border: 1px solid #eaded5;
            border-radius: 14px;
            padding: 25px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 15px;
            border-bottom: 1px solid #eee4dd;
            font-size: 13px;
        }

        th {
            color: #9b887b;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .pending {
            background: #fff1d6;
            color: #9a6718;
        }

        .processing {
            background: #e3efff;
            color: #346da8;
        }

        .completed {
            background: #dff3e7;
            color: #287447;
        }

        .cancelled {
            background: #fce4e4;
            color: #a34d43;
        }

        button {
            background: #754522;
            color: white;
            border: none;
            border-radius: 7px;
            padding: 9px 13px;
            cursor: pointer;
        }

        button:hover {
            background: #5d351b;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #dff3e7;
            color: #287447;
        }

        .error {
            background: #fce4e4;
            color: #a34d43;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #8b7769;
        }

        @media (max-width: 800px) {
            .sidebar {
                position: relative;
                width: 100%;
            }

            .layout {
                display: block;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="layout">

        <aside class="sidebar">
            <div class="logo">FreelanceHub</div>

            <p class="menu-title">Menu Utama</p>

            <div class="menu">
                <a href="/freelancer/dashboard">
                    ▣ Dashboard
                </a>

                <a href="/freelancer/profil">
                    ♙ Profil Saya
                </a>

                <a href="/freelancer/jasa">
                    ▤ Jasa Saya
                </a>

               <a href="{{ route('freelancer.orders.index') }}">
                    <span class="menu-icon">▧</span>
                    Pesanan Masuk
                </a>
                <a href="/freelancer/proyek">
                    ▦ Proyek Saya
                </a>

                <a href="/freelancer/portofolio">
                    ▧ Portofolio
                </a>
            </div>
        </aside>

        <main class="main">

            <header class="topbar">
                <strong>Dashboard Freelancer / Pesanan Masuk</strong>
            </header>

            <section class="content">

                <h1>Pesanan Masuk</h1>

                <p class="description">
                    Kelola pesanan dari client yang menggunakan jasa kamu.
                </p>

                @if(session('success'))
                    <div class="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="card">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Client</th>
                                <th>Jasa</th>
                                <th>Harga</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $order->client->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $order->service->title ?? '-' }}
                                    </td>

                                    <td>
                                        Rp{{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        <span class="status {{ $order->status }}">
                                            @switch($order->status)
                                                @case('pending')
                                                    Menunggu
                                                    @break

                                                @case('processing')
                                                    Diproses
                                                    @break

                                                @case('completed')
                                                    Selesai
                                                    @break

                                                @case('cancelled')
                                                    Dibatalkan
                                                    @break

                                                @default
                                                    {{ $order->status }}
                                            @endswitch
                                        </span>
                                    </td>

                                    <td>
                                        @if($order->status === 'pending')
                                            <form method="POST"
                                                  action="{{ route('freelancer.orders.updateStatus', $order->id) }}">
                                                @csrf
                                                @method('PATCH')

                                                <input type="hidden"
                                                       name="status"
                                                       value="processing">

                                                <button type="submit">
                                                    Terima Pesanan
                                                </button>
                                            </form>

                                        @elseif($order->status === 'processing')
                                            <form method="POST"
                                                  action="{{ route('freelancer.orders.updateStatus', $order->id) }}">
                                                @csrf
                                                @method('PATCH')

                                                <input type="hidden"
                                                       name="status"
                                                       value="completed">

                                                <button type="submit">
                                                    Tandai Selesai
                                                </button>
                                            </form>

                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="empty">
                                        Belum ada pesanan masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </section>
        </main>
    </div>
</body>
</html>
