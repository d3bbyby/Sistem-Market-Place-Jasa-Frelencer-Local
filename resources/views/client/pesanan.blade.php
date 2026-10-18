<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - FreelanceHub</title>

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
            box-shadow: 0 4px 15px rgba(80, 48, 181, 0.12);
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

        .navbar a:hover {
            color: #EDE7FF;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .container h1 {
            margin-bottom: 10px;
            color: #30264B;
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
            min-width: 650px;
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

        tbody tr:hover {
            background: #FAF8FF;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status {
            display: inline-block;
            background: #FFF1DC;
            color: #9A641E;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
        }

        .btn {
            display: inline-block;
            background: #7047EB;
            color: white;
            padding: 9px 15px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn:hover {
            background: #5030B5;
        }

        .alert {
            padding: 12px 15px;
            margin-bottom: 18px;
            border-radius: 8px;
            background: #EAF8EF;
            color: #28643A;
        }

        .error {
            color: #A3344D;
            font-size: 13px;
            margin: 8px 0;
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
            <a href="/client/dashboard">Dashboard</a>
            <a href="/client/jasa">Cari Jasa</a>
            <a href="/client/profil">Profil</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
            </form>
        </div>
    </nav>

    <main class="container">
        <h1>Pesanan Saya</h1>

        <p class="subtitle">
            Lihat dan pantau status pesanan jasa kamu.
        </p>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert" role="alert" style="background: #FFF1DC; color: #805515;">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jasa</th>
                        <th>Freelancer</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->service?->title ?? 'Jasa telah dihapus' }}</td>
                            <td>{{ $order->service?->freelancer?->name ?? '-' }}</td>
                            <td>Rp{{ number_format((float) ($order->total_price ?? $order->service?->price ?? 0), 0, ',', '.') }}</td>
                            <td><span class="status">{{ $order->status }}</span></td>
                            <td>
                                @if ($order->service)
                                    <a href="{{ route('client.orders.service', $order->service) }}" class="btn">Detail</a>
                                @endif
                                @if ($order->work_result_file)
                                    <a href="{{ route('orders.deliverable', $order) }}" class="btn">Unduh Hasil</a>
                                @endif
                                @if ($order->status === 'SUBMITTED')
                                    <form method="POST" action="{{ route('client.orders.updateStatus', $order) }}" style="display: inline-block; margin-top: 8px;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="SELESAI">
                                        <button class="btn" type="submit">Selesaikan</button>
                                    </form>
                                    <form method="POST" action="{{ route('client.orders.updateStatus', $order) }}" style="display: inline-block; margin-top: 8px;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="REVISI">
                                        <input name="revision_notes" value="{{ old('revision_notes') }}" maxlength="2000" required placeholder="Jelaskan revisi yang diminta" aria-label="Catatan revisi" style="max-width: 220px; padding: 8px; border: 1px solid #DCD4EF; border-radius: 7px;">
                                        <button class="btn" type="submit">Minta Revisi</button>
                                    </form>
                                    @error('revision_notes')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 35px;">Kamu belum memiliki pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>