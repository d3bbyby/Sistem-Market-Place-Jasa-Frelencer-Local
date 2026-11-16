```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembayaran - FreelanceHub</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #FAF9FF;
            color: #30264B;
        }

        .navbar {
            background: #7047EB;
            color: white;
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            font-size: 14px;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .subtitle {
            color: #837B99;
            margin-bottom: 30px;
        }

        .table-box {
            background: white;
            padding: 25px;
            border-radius: 15px;
            border: 1px solid #E7E1F4;
            box-shadow: 0 4px 16px rgba(80, 48, 181, 0.06);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th {
            background: #7047EB;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #EDE8F7;
            font-size: 14px;
            color: #625976;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .menunggu {
            background: #FFF1DC;
            color: #9A641E;
        }

        .berhasil {
            background: #EAF8EF;
            color: #28643A;
        }

        .gagal {
            background: #FCE8EC;
            color: #A3344D;
        }

        .alert {
            padding: 12px 15px;
            margin-bottom: 18px;
            border-radius: 8px;
            background: #EAF8EF;
            color: #28643A;
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 18px 25px;
                flex-direction: column;
                gap: 15px;
            }

            .navbar a {
                margin: 0 8px;
            }

            .container {
                width: 92%;
            }

            .table-box {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <h2>FreelanceHub</h2>

        <div>
            <a href="{{ route('client.dashboard') }}">Dashboard</a>
            <a href="{{ route('client.orders.index') }}">Pesanan Saya</a>
            <a href="{{ route('client.profile') }}">Profil</a>

            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    Logout
                </a>
            </form>
        </div>
    </nav>

    <main class="container">

        <h1>Riwayat Pembayaran</h1>

        <p class="subtitle">
            Lihat riwayat pembayaran dari pesanan jasa kamu.
        </p>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jasa</th>
                        <th>Freelancer</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $payment->order?->service?->title ?? 'Jasa tidak tersedia' }}
                            </td>

                            <td>
                                {{ $payment->order?->service?->freelancer?->name ?? '-' }}
                            </td>

                            <td>
                                Rp{{ number_format($payment->amount, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ $payment->payment_method
                                    ? ucfirst($payment->payment_method)
                                    : '-' }}
                            </td>

                            <td>
                                <span class="status {{ strtolower($payment->status) }}">
                                    {{ $payment->status }}
                                </span>
                            </td>

                            <td>
                                {{ $payment->created_at->format('d-m-Y') }}
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 35px;">
                                Belum ada riwayat pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

</body>
</html>
```