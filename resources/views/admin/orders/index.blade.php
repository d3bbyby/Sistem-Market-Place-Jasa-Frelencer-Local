<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Admin</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #777;
            font-size: 14px;
        }

        .back-button {
            display: inline-block;
            padding: 10px 16px;
            background: #374151;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            overflow-x: auto;
        }

        .alert {
            padding: 12px 15px;
            margin-bottom: 18px;
            border-radius: 6px;
            background: #dcfce7;
            color: #166534;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8fafc;
            font-size: 13px;
            color: #555;
        }

        td {
            font-size: 14px;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .processing {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .completed {
            background: #dcfce7;
            color: #166534;
        }

        .cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        select {
            padding: 9px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 7px;
        }

        .update-button {
            padding: 9px 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .empty {
            padding: 30px;
            text-align: center;
            color: #777;
        }

        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <div>
            <h1>Kelola Pesanan</h1>
            <p class="subtitle">
                Kelola dan pantau pesanan pada marketplace jasa freelancer.
            </p>
        </div>

        <a href="/admin/dashboard" class="back-button">
            Kembali ke Dashboard
        </a>
    </div>

    @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Klien</th>
                    <th>Jasa</th>
                    <th>Freelancer</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Ubah Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $order->client->name ?? 'Klien tidak ditemukan' }}
                        </td>

                        <td>
                            {{ $order->service->nama ?? $order->service->name ?? 'Jasa tidak ditemukan' }}
                        </td>

                        <td>
                            {{ $order->service->freelancer->name ?? 'Freelancer tidak ditemukan' }}
                        </td>

                        <td>
                            Rp {{ number_format($order->total_price ?? 0, 0, ',', '.') }}
                        </td>

                        <td>
                            <span class="status {{ $order->status }}">
                                {{ $order->status }}
                            </span>
                        </td>

                        <td>
                            <form
                                action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                method="POST"
                            >
                                @csrf
                                @method('PATCH')

                                <select name="status" required>
                                    <option value="pending"
                                        {{ $order->status === 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="processing"
                                        {{ $order->status === 'processing' ? 'selected' : '' }}>
                                        Diproses
                                    </option>

                                    <option value="completed"
                                        {{ $order->status === 'completed' ? 'selected' : '' }}>
                                        Selesai
                                    </option>

                                    <option value="cancelled"
                                        {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                                        Dibatalkan
                                    </option>
                                </select>

                                <button type="submit" class="update-button">
                                    Simpan
                                </button>

                                @error('status')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty">
                            Belum ada data pesanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>