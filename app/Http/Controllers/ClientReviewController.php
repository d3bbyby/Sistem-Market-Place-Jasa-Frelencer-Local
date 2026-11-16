<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;

class ClientReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['freelancer', 'order'])
            ->where('client_id', auth()->id())
            ->latest()
            ->get();

        return view('client.review', compact('reviews'));
    }

    public function store(Request $request, Order $order)
    {
        abort_unless($order->client_id === $request->user()->id, 403);

        if ($order->status !== 'SELESAI') {
            return back()->withErrors([
                'review' => 'Review hanya bisa diberikan setelah pesanan selesai.',
            ]);
        }

        if ($order->review()->exists()) {
            return back()->withErrors([
                'review' => 'Pesanan ini sudah memiliki review.',
            ]);
        }

        $data = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        if (! $order->service) {
            return back()->withErrors([
                'review' => 'Data jasa tidak ditemukan.',
            ]);
        }

        Review::create([
            'order_id' => $order->id,
            'client_id' => $request->user()->id,
            'freelancer_id' => $order->service->freelancer_id,
            'rating' => $data['rating'],
            'comment' => $data['comment'] ?? null,
        ]);

        return back()->with('success', 'Review berhasil dikirim!');
    }
}