<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function __invoke()
    {
        $totalPengguna = User::count();

        $totalFreelancer = User::where('role', 'freelancer')->count();

        $totalClient = User::where('role', 'client')->count();

        $totalJasa = Service::count();

        $totalPesanan = Order::count();

        $pesananTerbaru = Order::with(['client', 'service'])
            ->latest()
            ->take(4)
            ->get();

        $penggunaTerbaru = User::latest()
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'totalPengguna',
            'totalFreelancer',
            'totalClient',
            'totalJasa',
            'totalPesanan',
            'pesananTerbaru',
            'penggunaTerbaru'
        ));
    }
}