
@extends('layouts.freelancer')

@section('content')

<style>
    .income-header {
        margin-bottom: 25px;
    }

    .income-header h1 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .income-header p {
        color: #72918D;
    }

    .income-card {
        background: white;
        border: 1px solid #D8EAE7;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 8px 24px rgba(18, 81, 76, 0.05);
    }

    .income-label {
        color: #72918D;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .income-amount {
        color: #0E756D;
        font-size: 30px;
        font-weight: bold;
    }

    .income-count {
        font-size: 25px;
        font-weight: bold;
        color: #12514C;
    }

    .income-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .income-table th,
    .income-table td {
        padding: 14px 12px;
        text-align: left;
        border-bottom: 1px solid #E5EFED;
        font-size: 14px;
    }

    .income-table th {
        color: #72918D;
        background: #F2FAF9;
    }

    .income-table td {
        color: #183B3A;
    }

    .empty-income {
        text-align: center;
        padding: 30px 10px;
        color: #72918D;
    }

    .income-table-wrapper {
        overflow-x: auto;
    }
</style>

<div class="income-header">
    <h1>Pendapatan Saya</h1>
    <p>Lihat total pendapatan dan riwayat pesanan yang telah selesai.</p>
</div>

<div class="income-card">
    <p class="income-label">Total Pendapatan</p>

    <div class="income-amount">
        Rp{{ number_format($totalIncome, 0, ',', '.') }}
    </div>
</div>

<div class="income-card">
    <p class="income-label">Jumlah Pesanan Selesai</p>

    <div class="income-count">
        {{ $completedOrdersCount }} Pesanan
    </div>
</div>

<div class="income-card">
    <h2 style="font-size: 20px; font-weight: bold; color: #12514C;">
        Riwayat Pendapatan
    </h2>

    <div class="income-table-wrapper">
        <table class="income-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jasa</th>
                    <th>Client</th>
                    <th>Tanggal</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($completedOrders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $order->service->title ?? 'Jasa' }}
                        </td>

                        <td>
                            {{ $order->client->name ?? 'Client' }}
                        </td>

                        <td>
                            {{ $order->created_at->format('d/m/Y') }}
                        </td>

                        <td>
                            Rp{{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-income">
                            Belum ada riwayat pendapatan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
