<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // Menampilkan daftar favorit
    public function index()
    {
        $favorites = Favorite::with([
            'service.freelancer',
            'freelancer'
        ])
        ->where('client_id', auth()->id())
        ->latest()
        ->get();

        return view('client.favorit', compact('favorites'));
    }

    // Menambahkan jasa ke favorit
    public function storeService(Request $request)
    {
        $data = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
        ]);

        Favorite::firstOrCreate([
            'client_id' => auth()->id(),
            'service_id' => $data['service_id'],
        ]);

        return back()->with('success', 'Jasa berhasil ditambahkan ke favorit!');
    }

    // Menambahkan freelancer ke favorit
    public function storeFreelancer(Request $request)
    {
        $data = $request->validate([
            'freelancer_id' => ['required', 'exists:users,id'],
        ]);

        Favorite::firstOrCreate([
            'client_id' => auth()->id(),
            'freelancer_id' => $data['freelancer_id'],
        ]);

        return back()->with('success', 'Freelancer berhasil ditambahkan ke favorit!');
    }

    // Menghapus favorit
    public function destroy(Favorite $favorite)
    {
        abort_unless($favorite->client_id == auth()->id(), 403);

        $favorite->delete();

        return back()->with('success', 'Favorit berhasil dihapus!');
    }
}
