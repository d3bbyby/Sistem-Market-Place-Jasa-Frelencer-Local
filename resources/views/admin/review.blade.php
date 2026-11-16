
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review dan Rating - Admin</title>

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
            left: 0;
            top: 0;
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

        .sidebar a.active,
        .sidebar a:hover {
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
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        .stat-card p {
            color: #7b8495;
            margin-bottom: 12px;
        }

        .stat-card h2 {
            color: #17243d;
            font-size: 30px;
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
            min-width: 750px;
        }

        th, td {
            padding: 15px 12px;
            text-align: left;
            border-bottom: 1px solid #edf0f5;
            font-size: 14px;
        }

        th {
            color: #7b8495;
            background: #f8f9fc;
        }

        .stars {
            color: #e5ad39;
            font-size: 17px;
            white-space: nowrap;
        }

        .comment {
            max-width: 250px;
            color: #687386;
        }

        .empty {
            text-align: center;
            color: #8992a2;
            padding: 30px;
        }

        @media (max-width: 768px) {
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
        <a href="/admin/review" class="active">☆ Review dan Rating</a>
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
            <h1>Review dan Rating</h1>
            <p>Kelola dan pantau ulasan dari pengguna FreelanceHub.</p>
        </div>

        <div class="stats">

            <div class="stat-card">
                <p>Total Review</p>
                <h2>{{ $totalReview }}</h2>
            </div>

            <div class="stat-card">
                <p>Rata-rata Rating</p>
                <h2>
                    {{ number_format($rataRating, 1) }}
                    <span class="stars">★</span>
                </h2>
            </div>

        </div>

        <div class="content">
            <h2>Daftar Review Pengguna</h2>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Client</th>
                        <th>Freelancer</th>
                        <th>Nama Jasa</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($reviews as $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $review->client->name ?? '-' }}
                            </td>

                            <td>
                                {{ $review->freelancer->name ?? '-' }}
                            </td>

                            <td>
                                {{ $review->order->service->title ?? '-' }}
                            </td>

                            <td>
                                <span class="stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        {{ $i <= $review->rating ? '★' : '☆' }}
                                    @endfor
                                </span>
                            </td>

                            <td class="comment">
                                {{ $review->comment ?: 'Tidak ada komentar' }}
                            </td>

                            <td>
                                {{ $review->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty">
                                Belum ada review dari pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

</body>
</html>
