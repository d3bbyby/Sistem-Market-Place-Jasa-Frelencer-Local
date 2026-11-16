<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $totalPengguna = User::count();

        $totalClient = User::where('role', 'client')->count();

        $totalFreelancer = User::where('role', 'freelancer')->count();

        $totalPesanan = Order::count();

        $pesananSelesai = Order::where('status', 'selesai')->count();

        $pesananDibatalkan = Order::where('status', 'dibatalkan')->count();

        $totalPendapatan = Order::where('status', 'selesai')
            ->sum('total_price');

        $orders = Order::with([
            'client',
            'service'
        ])->latest()->get();

        return view('admin.laporan', compact(
            'totalPengguna',
            'totalClient',
            'totalFreelancer',
            'totalPesanan',
            'pesananSelesai',
            'pesananDibatalkan',
            'totalPendapatan',
            'orders'
        ));
    }
}
