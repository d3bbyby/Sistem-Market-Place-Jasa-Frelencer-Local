<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceRequestController extends Controller
{
    // Menampilkan posting kebutuhan jasa milik client
    public function index()
    {
        $serviceRequests = ServiceRequest::with('client')
            ->withCount('applications')
            ->where('client_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('client.service_requests.index', compact('serviceRequests'));
    }

    // Menampilkan form posting kebutuhan jasa
    public function create()
    {
        return view('client.service_requests.create');
    }

    // Menyimpan posting kebutuhan jasa
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:255',
            'budget' => 'nullable|numeric|min:0',
            'deadline' => 'nullable|date|after_or_equal:today',
        ]);

        $validated['client_id'] = Auth::id();
        $validated['status'] = 'open';

        ServiceRequest::create($validated);

        return redirect()
            ->route('client.service-requests.index')
            ->with('success', 'Posting kebutuhan jasa berhasil dibuat.');
    }

    // Menghapus posting milik client
    public function destroy(ServiceRequest $serviceRequest)
    {
        if ($serviceRequest->client_id !== Auth::id()) {
            abort(403);
        }

        $serviceRequest->delete();

        return back()->with('success', 'Posting berhasil dihapus.');
    }
    public function freelancerIndex()
{
    $serviceRequests = ServiceRequest::with('client')
        ->withCount('applications')
        ->where('status', 'open')
        ->latest()
        ->paginate(10);

    return view('freelancer.service_requests.index', compact('serviceRequests'));
}
}
