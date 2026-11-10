<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PortfolioRatingController extends Controller
{
    public function store(Request $request, Portfolio $portfolio): RedirectResponse
    {
        abort_unless($request->user()?->role === 'client', 403);
        abort_unless($portfolio->user_id !== $request->user()->id, 403);

        $hasCompletedOrder = Order::query()
            ->where('client_id', $request->user()->id)
            ->where('status', 'SELESAI')
            ->whereHas('service', fn ($query) => $query->where('freelancer_id', $portfolio->user_id))
            ->exists();

        abort_unless($hasCompletedOrder, 403);

        $data = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'max:1000'],
        ], [
            'rating.required' => 'Pilih rating bintang.',
            'rating.integer' => 'Rating harus berupa angka.',
            'rating.between' => 'Rating harus antara 1 sampai 5.',
            'comment.required' => 'Komentar wajib diisi.',
            'comment.max' => 'Komentar maksimal 1000 karakter.',
        ]);

        $portfolio->ratings()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $data,
        );

        return back()->with('success', 'Rating portofolio berhasil disimpan.');
    }
}
