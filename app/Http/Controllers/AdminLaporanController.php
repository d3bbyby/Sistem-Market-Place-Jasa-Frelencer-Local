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

        $pesananSelesai = Order::where('status', 'SELESAI')->count();

        $pesananDibatalkan = 0;

        $totalPendapatan = Order::where('status', 'SELESAI')
            ->sum('total_price');

        $orders = Order::with(['client', 'service'])
            ->latest()
            ->get();

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