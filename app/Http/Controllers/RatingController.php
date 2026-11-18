<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Order $order): RedirectResponse
    {
        $user = $request->user();

        // Rating hanya bisa diberikan setelah pesanan selesai.
        abort_unless($order->status === 'SELESAI', 403);

        // Pastikan kedua pihak sudah mengonfirmasi.
        abort_unless(
            $order->freelancer_confirmed && $order->client_confirmed,
            403
        );

        // Tentukan siapa yang akan menerima rating.
        if ($user->role === 'client') {
            abort_unless($order->client_id === $user->id, 403);

            $reviewedId = $order->service->freelancer_id;

        } elseif ($user->role === 'freelancer') {
            abort_unless(
                $order->service()
                    ->where('freelancer_id', $user->id)
                    ->exists(),
                403
            );

            $reviewedId = $order->client_id;

        } else {
            abort(403);
        }

        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review' => ['nullable', 'string', 'max:1000'],
        ]);

        // Satu pengguna hanya boleh memberi satu rating
        // untuk setiap pesanan.
        abort_if(
            Rating::where('order_id', $order->id)
                ->where('reviewer_id', $user->id)
                ->exists(),
            403,
            'Kamu sudah memberikan rating untuk pesanan ini.'
        );

        Rating::create([
            'order_id' => $order->id,
            'reviewer_id' => $user->id,
            'reviewed_id' => $reviewedId,
            'rating' => $data['rating'],
            'review' => $data['review'] ?? null,
        ]);

        return back()->with(
            'success',
            'Rating berhasil dikirim. Terima kasih!'
        );
    }
}
