<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PortfolioRating;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FreelancerDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        abort_unless($request->user()->role === 'freelancer', 403);

        $freelancer = $request->user();
        $freelancerId = $freelancer->id;

        $services = Service::query()
            ->where('freelancer_id', $freelancerId)
            ->withCount('orders')
            ->latest()
            ->limit(5)
            ->get();

        $freelancerOrders = fn () => Order::query()
            ->whereHas('service', fn ($query) => $query->where('freelancer_id', $freelancerId));

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

        $portfolioRatings = PortfolioRating::query()
            ->whereHas('portfolio', fn ($query) => $query->where('user_id', $freelancerId));

        $portfolioRatingStats = (clone $portfolioRatings)
            ->selectRaw('COUNT(*) as ratings_count, COALESCE(AVG(rating), 0) as average_rating')
            ->first();

        $latestPortfolioRatings = $portfolioRatings
            ->with(['portfolio:id,user_id,title,caption', 'user:id,name'])
            ->latest()
            ->limit(5)
            ->get();

        return view('freelancer.dashboard', [
            'freelancer' => $freelancer,
            'totalServices' => $freelancer->services()->count(),
            'completedOrdersCount' => (int) $completedOrderStats->completed_orders_count,
            'totalIncome' => (float) $completedOrderStats->total_income,
            'totalOrders' => $totalOrders,
            'latestOrders' => $latestOrders,
            'services' => $services,
            'portfolioRatingsCount' => (int) $portfolioRatingStats->ratings_count,
            'averagePortfolioRating' => (float) $portfolioRatingStats->average_rating,
            'latestPortfolioRatings' => $latestPortfolioRatings,
        ]);
    }
}
