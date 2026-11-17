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
// Total omzet dari pesanan yang sudah selesai
$totalOmzet = Order::where('status', 'SELESAI')
    ->sum('total_price');

// Rekap status pesanan
$pesananStatus = [
    'MENUNGGU' => Order::where('status', 'MENUNGGU')->count(),
    'DIPROSES' => Order::where('status', 'DIPROSES')->count(),
    'SUBMITTED' => Order::where('status', 'SUBMITTED')->count(),
    'REVISI' => Order::where('status', 'REVISI')->count(),
    'SELESAI' => Order::where('status', 'SELESAI')->count(),
];

    // Rekap performa setiap freelancer
$rekapFreelancer = User::where('role', 'freelancer')
    ->withCount([
        'services as total_jasa',
    ])
    ->get()
    ->map(function ($freelancer) {
        $orders = Order::whereHas('service', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        });

        $freelancer->total_pesanan = (clone $orders)->count();

        $freelancer->pesanan_selesai = (clone $orders)
            ->where('status', 'SELESAI')
            ->count();

        $freelancer->total_pendapatan = (clone $orders)
            ->where('status', 'SELESAI')
            ->sum('total_price');

        return $freelancer;
    });
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
            'totalOmzet',      // Ditambahkan ke view
            'pesananStatus',   // Ditambahkan ke view
            'rekapFreelancer', // Ditambahkan ke view
            'pesananTerbaru',
            'penggunaTerbaru'
        ));
    }
}