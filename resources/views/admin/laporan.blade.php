
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Admin - FreelanceHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6fb;
            color: #26334d;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #17243d;
            position: fixed;
            padding: 30px 20px;
            color: white;
        }

        .sidebar h2 {
            color: #e7bd67;
            margin-bottom: 40px;
            font-size: 23px;
        }

        .sidebar a {
            display: block;
            color: #dce2ed;
            text-decoration: none;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #263957;
            color: #e7bd67;
        }

        .main {
            margin-left: 250px;
            padding: 35px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 27px;
            margin-bottom: 8px;
        }

        .header p {
            color: #7b8495;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            padding: 23px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        .stat-card p {
            color: #7b8495;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .stat-card h2 {
            font-size: 27px;
            color: #17243d;
        }

        .content {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
            overflow-x: auto;
        }

        .content h2 {
            margin-bottom: 20px;
            font-size: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #edf0f5;
            font-size: 14px;
        }

        th {
            background: #f8f9fc;
            color: #7b8495;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            background: #edf0f5;
            color: #526078;
        }

        .empty {
            text-align: center;
            color: #8992a2;
            padding: 30px;
        }

        @media(max-width: 1000px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 768px) {
            .sidebar {
                width: 190px;
            }

            .main {
                margin-left: 190px;
                padding: 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <h2>FreelanceHub</h2>

        <a href="/admin/dashboard">▦ Dashboard</a>
        <a href="/admin/orders">▤ Pesanan</a>
        <a href="/admin/freelancers">♙ Freelancer</a>
        <a href="/admin/review">☆ Review dan Rating</a>
        <a href="/admin/laporan" class="active">▥ Laporan</a>
        <a href="/admin/profil">⚙ Profil</a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="
                width:100%;
                padding:13px;
                margin-top:20px;
                background:#263957;
                color:white;
                border:0;
                border-radius:8px;
                cursor:pointer;
                text-align:left;
            ">
                ↪ Logout
            </button>
        </form>
    </aside>

    <main class="main">

        <div class="header">
            <h1>Laporan</h1>
            <p>Ringkasan data dan aktivitas marketplace FreelanceHub.</p>
        </div>

        <div class="stats">

            <div class="stat-card">
                <p>Total Pengguna</p>
                <h2>{{ $totalPengguna }}</h2>
            </div>

            <div class="stat-card">
                <p>Total Client</p>
                <h2>{{ $totalClient }}</h2>
            </div>

            <div class="stat-card">
                <p>Total Freelancer</p>
                <h2>{{ $totalFreelancer }}</h2>
            </div>

            <div class="stat-card">
                <p>Total Pesanan</p>
                <h2>{{ $totalPesanan }}</h2>
            </div>

            <div class="stat-card">
                <p>Pesanan Selesai</p>
                <h2>{{ $pesananSelesai }}</h2>
            </div>

            <div class="stat-card">
                <p>Pesanan Dibatalkan</p>
                <h2>{{ $pesananDibatalkan }}</h2>
            </div>

            <div class="stat-card">
                <p>Total Pendapatan dari Pesanan Selesai</p>
                <h2 style="font-size:22px;">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h2>
            </div>

        </div>

        <div class="content">

            <h2>Riwayat Pesanan</h2>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Client</th>
                        <th>Nama Jasa</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->client->name ?? '-' }}</td>
                            <td>{{ $order->service->title ?? '-' }}</td>
                            <td>
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="status">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                {{ $order->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada data pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </main>

</body>
</html>
