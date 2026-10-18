<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk - FreelanceHub</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #FAF9FF; color: #30264B; }
        .navbar { background: #7047EB; color: white; padding: 18px 6%; display: flex; justify-content: space-between; align-items: center; }
        .navbar h2 { margin: 0; }
        .navbar a { color: white; text-decoration: none; }
        .container { width: 90%; max-width: 1100px; margin: 40px auto; }
        .subtitle { color: #837B99; margin: 8px 0 25px; }
        .table-box { background: white; padding: 22px; border-radius: 15px; border: 1px solid #E7E1F4; overflow-x: auto; }
        table { width: 100%; min-width: 760px; border-collapse: collapse; }
        th { background: #7047EB; color: white; text-align: left; padding: 13px; font-size: 13px; }
        td { padding: 14px 13px; border-bottom: 1px solid #EDE8F7; color: #625976; vertical-align: top; }
        .button { border: 0; border-radius: 7px; background: #7047EB; color: white; padding: 9px 13px; cursor: pointer; }
        .button:hover { background: #5030B5; }
        .status { display: inline-block; color: #7047EB; background: #EDE7FF; padding: 6px 10px; border-radius: 20px; white-space: nowrap; }
        .muted { color: #837B99; font-size: 13px; }
        .alert { padding: 12px 15px; border-radius: 8px; margin-bottom: 18px; background: #EAF8EF; color: #28643A; }
        .error { color: #A3344D; font-size: 13px; margin-top: 6px; }
        .empty { text-align: center; padding: 35px; color: #837B99; }
        @media (max-width: 600px) { .container { width: 94%; } .table-box { padding: 12px; } }
    </style>
</head>
<body>
    <nav class="navbar">
        <h2>FreelanceHub</h2>
        <a href="/freelancer/dashboard">Dashboard</a>
    </nav>
    <main class="container">
        <h1>Pesanan Masuk</h1>
        <p class="subtitle">Kelola pesanan jasa yang diterima dari client.</p>
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert" role="alert" style="background: #FFF1DC; color: #805515;">
                {{ $errors->first() }}
            </div>
        @endif
        <section class="table-box">
            <table>
                <thead>
                    <tr>
                        <th>Jasa</th>
                        <th>Client</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Catatan Revisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->service?->title ?? 'Jasa telah dihapus' }}</td>
                            <td>{{ $order->client?->name ?? '-' }}</td>
                            <td>Rp{{ number_format((float) ($order->total_price ?? $order->service?->price ?? 0), 0, ',', '.') }}</td>
                            <td><span class="status">{{ $order->status }}</span></td>
                            <td>
                                @if ($order->revision_notes)
                                    {{ $order->revision_notes }}
                                @else
                                    <span class="muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($order->work_result_file)
                                    <a class="button" href="{{ route('orders.deliverable', $order) }}" style="display: inline-block; text-decoration: none; margin-bottom: 8px;">Unduh Hasil</a>
                                @endif
                                @if (in_array($order->status, ['MENUNGGU', 'REVISI'], true))
                                    <form method="POST" action="{{ route('freelancer.orders.updateStatus', $order) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="DIPROSES">
                                        <button class="button" type="submit">Mulai Proses</button>
                                    </form>
                                @elseif ($order->status === 'DIPROSES')
                                    <form method="POST" action="{{ route('freelancer.orders.updateStatus', $order) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="SUBMITTED">
                                        <label for="work-result-{{ $order->id }}" class="muted" style="display: block; margin: 8px 0;">File hasil (maks. 10 MB)</label>
                                        <input id="work-result-{{ $order->id }}" type="file" name="work_result_file" accept=".pdf,.zip,.doc,.docx,.jpg,.jpeg,.png,.txt" required>
                                        @error('work_result_file')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                        <button class="button" type="submit">Kirim Hasil</button>
                                    </form>
                                @else
                                    <span class="muted">Menunggu client</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty">Belum ada pesanan masuk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
