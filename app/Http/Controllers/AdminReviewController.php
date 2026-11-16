<?php

namespace App\Http\Controllers;

use App\Models\Review;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with([
            'client',
            'freelancer',
            'order.service'
        ])->latest()->get();

        $totalReview = Review::count();

        $rataRating = Review::avg('rating') ?? 0;

        return view('admin.review', compact(
            'reviews',
            'totalReview',
            'rataRating'
        ));
    }
}
