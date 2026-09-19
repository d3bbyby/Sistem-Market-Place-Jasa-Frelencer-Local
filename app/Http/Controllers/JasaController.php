<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class JasaController extends Controller
{
    public function index()
    {
        $jasa = Service::with(['category', 'freelancer'])->latest()->get();

        return view('jasa.index', compact('jasa'));
    }

    public function create()
    {
        return view('jasa.create', [
            'categories' => Category::orderBy('category_name')->get(),
            'freelancers' => User::where('role', 'freelancer')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'freelancer_id' => ['required', 'exists:users,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        Service::create($data);

        return redirect()->route('jasa.index')->with('success', 'Jasa berhasil ditambahkan!');
    }

    public function edit(Service $jasa)
    {
        return view('jasa.edit', [
            'jasa' => $jasa,
            'categories' => Category::orderBy('category_name')->get(),
            'freelancers' => User::where('role', 'freelancer')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Service $jasa)
    {
        $data = $request->validate([
            'freelancer_id' => ['required', 'exists:users,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $jasa->update($data);

        return redirect()->route('jasa.index')->with('success', 'Jasa berhasil diperbarui!');
    }

    public function destroy(Service $jasa)
    {
        $jasa->delete();

        return redirect()->route('jasa.index')->with('success', 'Jasa berhasil dihapus!');
    }
}
