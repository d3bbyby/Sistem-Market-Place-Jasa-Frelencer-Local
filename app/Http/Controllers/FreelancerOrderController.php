<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class FreelancerOrderController extends Controller
{
    // Menampilkan pesanan milik freelancer yang login
    public function index()
    {
        $freelancerId = auth()->id();

        $orders = Order::with(['client', 'service'])
            ->whereHas('service', function ($query) use ($freelancerId) {
                $query->where('freelancer_id', $freelancerId);
            })
            ->latest()
            ->get();

        return view('freelancer.orders.index', compact('orders'));
    }

    // Freelancer memperbarui status pesanannya
    public function updateStatus(Request $request, Order $order)
    {
        $freelancerId = auth()->id();

        // Pastikan pesanan benar-benar milik freelancer ini
        $order->load('service');

        if (
            !$order->service ||
            $order->service->freelancer_id != $freelancerId
        ) {
            abort(403, 'Kamu tidak memiliki akses ke pesanan ini.');
        }

        $validated = $request->validate([
            'status' => 'required|in:processing,completed',
        ]);

        // Pending hanya bisa menjadi Processing
        // Processing hanya bisa menjadi Completed
        $allowed = [
            'pending' => 'processing',
            'processing' => 'completed',
        ];

        if (
            !isset($allowed[$order->status]) ||
            $allowed[$order->status] !== $validated['status']
        ) {
            return back()->withErrors([
                'status' => 'Perubahan status pesanan tidak diperbolehkan.',
            ]);
        }

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('freelancer.orders.index')
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
