<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rating;
use App\Models\Service;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FreelancerDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        abort_unless($request->user()->role === 'freelancer', 403);

        $freelancer = $request->user();
        $freelancerId = $freelancer->id;

        // DATA JASA FREELANCER
        $services = Service::query()
            ->where('freelancer_id', $freelancerId)
            ->withCount('orders')
            ->latest()
            ->limit(5)
            ->get();

        // DATA PESANAN
        $freelancerOrders = fn () => Order::query()
            ->whereHas('service', fn ($query) =>
                $query->where('freelancer_id', $freelancerId)
            );

        $completedOrderStats = $freelancerOrders()
            ->where('status', 'SELESAI')
            ->selectRaw('COUNT(*) as completed_orders_count, COALESCE(SUM(total_price), 0) as total_income')
            ->first();

        $totalOrders = $freelancerOrders()->count();

        $latestOrders = $freelancerOrders()
            ->with(['client:id,name', 'service:id,title,freelancer_id'])
            ->latest()
            ->limit(5)
            ->get();

        // DATA RATING PROYEK DARI CLIENT
        $ratings = Rating::query()
            ->where('reviewed_id', $freelancerId)
            ->whereHas('order', function ($query) {
                $query->where('status', 'SELESAI');
            });

        $ratingStats = (clone $ratings)
            ->selectRaw('COUNT(*) as ratings_count, COALESCE(AVG(rating), 0) as average_rating')
            ->first();

        $latestRatings = $ratings
            ->with(['reviewer:id,name', 'order.service:id,title'])
            ->latest()
            ->limit(5)
            ->get();

        // AKTIVITAS TERBARU FREELANCER
        $aktivitasTerbaru = UserActivity::query()
            ->where('user_id', $freelancerId)
            ->where('role', 'freelancer')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'ikon' => '●',
                    'judul' => $item->title,
                    'keterangan' => $item->description ?? '',
                    'tanggal' => $item->created_at,
                ];
            });

        return view('freelancer.dashboard', [
            'freelancer' => $freelancer,
            'totalServices' => $freelancer->services()->count(),
            'completedOrdersCount' => (int) $completedOrderStats->completed_orders_count,
            'totalIncome' => (float) $completedOrderStats->total_income,
            'totalOrders' => $totalOrders,
            'latestOrders' => $latestOrders,
            'services' => $services,

            // RATING PROYEK
            'ratingsCount' => (int) $ratingStats->ratings_count,
            'averageRating' => (float) $ratingStats->average_rating,
            'latestRatings' => $latestRatings,

            'aktivitasTerbaru' => $aktivitasTerbaru,
        ]);
    }

    // HALAMAN PENDAPATAN
    public function income(Request $request): View
    {
        abort_unless($request->user()->role === 'freelancer', 403);

        $freelancerId = $request->user()->id;

        $completedOrders = Order::query()
            ->where('status', 'SELESAI')
            ->whereHas('service', function ($query) use ($freelancerId) {
                $query->where('freelancer_id', $freelancerId);
            })
            ->with(['client:id,name', 'service:id,title'])
            ->latest()
            ->get();

        return view('freelancer.pendapatan', [
            'completedOrders' => $completedOrders,
            'totalIncome' => $completedOrders->sum('total_price'),
            'completedOrdersCount' => $completedOrders->count(),
        ]);
    }
}
