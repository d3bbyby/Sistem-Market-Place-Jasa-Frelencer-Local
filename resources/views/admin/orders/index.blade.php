<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - FreelanceHub</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #FAF9FF; color: #30264B; }
        .navbar { background: #7047EB; color: white; padding: 18px 6%; display: flex; justify-content: space-between; align-items: center; }
        .navbar h2 { margin: 0; }
        .navbar a { color: white; text-decoration: none; margin-left: 18px; }
        .container { width: 90%; max-width: 1200px; margin: 40px auto; }
        .subtitle { color: #837B99; margin: 8px 0 25px; }
        .table-box { background: white; padding: 22px; border-radius: 15px; border: 1px solid #E7E1F4; overflow-x: auto; }
        table { width: 100%; min-width: 850px; border-collapse: collapse; }
        th { background: #7047EB; color: white; text-align: left; padding: 13px; font-size: 13px; }
        td { padding: 14px 13px; border-bottom: 1px solid #EDE8F7; color: #625976; }
        select { padding: 9px; border: 1px solid #DCD4EF; border-radius: 7px; color: #30264B; }
        .button { border: 0; border-radius: 7px; background: #7047EB; color: white; padding: 9px 13px; cursor: pointer; }
        .button:hover { background: #5030B5; }
        .alert { padding: 12px 15px; border-radius: 8px; margin-bottom: 18px; background: #EAF8EF; color: #28643A; }
        .empty { text-align: center; padding: 35px; color: #837B99; }
        @media (max-width: 600px) { .container { width: 94%; } .table-box { padding: 12px; } }
    </style>
</head>
<body>
    <nav class="navbar">
        <h2>FreelanceHub</h2>
        <div><a href="/admin/dashboard">Dashboard</a><a href="{{ route('admin.freelancers.index') }}">Verifikasi Freelancer</a></div>
    </nav>
    <main class="container">
        <h1>Kelola Pesanan</h1>
        <p class="subtitle">Pantau pesanan client dan freelancer.</p>
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        <section class="table-box">
            <table>
                <thead>
                    <tr><th>Jasa</th><th>Client</th><th>Freelancer</th><th>Harga</th><th>Status</th><th>Ubah Status</th></tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->service?->title ?? 'Jasa telah dihapus' }}</td>
                            <td>{{ $order->client?->name ?? '-' }}</td>
                            <td>{{ $order->service?->freelancer?->name ?? '-' }}</td>
                            <td>Rp{{ number_format((float) ($order->total_price ?? $order->service?->price ?? 0), 0, ',', '.') }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="display: flex; gap: 8px;">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" aria-label="Status pesanan">
                                        @foreach (['MENUNGGU', 'DIPROSES', 'SUBMITTED', 'REVISI', 'SELESAI'] as $status)
                                            <option value="{{ $status }}" @selected($order->status === $status)>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    <button class="button" type="submit">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty">Belum ada pesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
