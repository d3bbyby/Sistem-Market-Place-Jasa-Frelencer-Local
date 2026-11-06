<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ClientDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $clientId = $request->user()->id;

        $pesanan = Order::where('client_id', $clientId);

        $totalPesanan = (clone $pesanan)->count();

        $pesananDiproses = (clone $pesanan)
            ->where('status', 'DIPROSES')
            ->count();

        $pesananSelesai = (clone $pesanan)
            ->where('status', 'SELESAI')
            ->count();

        $totalPembayaran = (clone $pesanan)->sum('total_price');

        $pesananTerbaru = Order::with([
            'service.freelancer'
        ])
            ->where('client_id', $clientId)
            ->latest()
            ->take(3)
            ->get();

        return view('client.dashboard', compact(
            'totalPesanan',
            'pesananDiproses',
            'pesananSelesai',
            'totalPembayaran',
            'pesananTerbaru'
        ));
    }
}
