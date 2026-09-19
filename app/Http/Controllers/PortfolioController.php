<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('service')->latest()->get();

        return view('portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('portfolios.create', [
            'services' => Service::orderBy('title')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'file_path' => ['required', 'string', 'max:255'],
            'caption' => ['required', 'string', 'max:255'],
        ]);

        Portfolio::create($data);

        return redirect()->route('portfolios.index')->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('portfolios.edit', [
            'portfolio' => $portfolio,
            'services' => Service::orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'file_path' => ['required', 'string', 'max:255'],
            'caption' => ['required', 'string', 'max:255'],
        ]);

        $portfolio->update($data);

        return redirect()->route('portfolios.index')->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return redirect()->route('portfolios.index')->with('success', 'Portofolio berhasil dihapus!');
    }
}
