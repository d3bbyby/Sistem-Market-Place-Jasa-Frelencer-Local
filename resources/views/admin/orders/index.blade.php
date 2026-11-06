<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - FreelanceHub</title>
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #F4F6FA;
        color: #1E2C3D;
    }

    .navbar {
        background: #142B49;
        color: white;
        padding: 18px 6%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .navbar h2 {
        margin: 0;
        color: #E5C477;
    }

    .navbar a {
        color: white;
        text-decoration: none;
        margin-left: 18px;
        transition: 0.2s;
    }

    .navbar a:hover {
        color: #E5C477;
    }

    .container {
        width: 90%;
        max-width: 1200px;
        margin: 40px auto;
    }

    .container h1 {
        color: #1E2C3D;
    }

    .subtitle {
        color: #7A8798;
        margin: 8px 0 25px;
    }

    .table-box {
        background: white;
        padding: 22px;
        border-radius: 15px;
        border: 1px solid #E1E6EE;
        overflow-x: auto;
        box-shadow: 0 5px 18px rgba(16, 39, 68, 0.04);
    }

    table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    th {
        background: #142B49;
        color: white;
        text-align: left;
        padding: 13px;
        font-size: 13px;
    }

    td {
        padding: 14px 13px;
        border-bottom: 1px solid #E6EBF2;
        color: #4A5A70;
    }

    tbody tr:hover {
        background: #F4F6FA;
    }

    select {
        padding: 9px;
        border: 1px solid #D9C99F;
        border-radius: 7px;
        color: #1E2C3D;
        background: #FFFFFF;
        cursor: pointer;
    }

    select:focus {
        outline: none;
        border-color: #C49A45;
    }

    .button {
        border: 0;
        border-radius: 7px;
        background: #C49A45;
        color: #142B49;
        padding: 9px 13px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.2s;
    }

    .button:hover {
        background: #A87922;
        color: white;
    }

    .muted {
        color: #7A8798;
        font-size: 12px;
    }

    .alert {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 18px;
        background: #EAF8EF;
        color: #28643A;
        border: 1px solid #C5E8CE;
    }

    .empty {
        text-align: center;
        padding: 35px;
        color: #7A8798;
    }

    @media (max-width: 600px) {
        .container {
            width: 94%;
        }

        .table-box {
            padding: 12px;
        }
    }
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
                            <td>
                                @if ($order->package)
                                    <span class="muted">Paket {{ ucfirst($order->package) }}</span><br>
                                @endif
                                Rp{{ number_format((float) ($order->total_price ?? $order->service?->price ?? 0), 0, ',', '.') }}
                            </td>
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
