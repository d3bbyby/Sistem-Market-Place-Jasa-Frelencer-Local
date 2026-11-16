<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\ServiceRequestApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceRequestApplicationController extends Controller
{
    // Freelancer mengajukan diri
    
public function store(Request $request, ServiceRequest $serviceRequest)
{
    if ($serviceRequest->status !== 'open') {
        return back()->with('error', 'Posting ini sudah tidak menerima pengajuan.');
    }

    $sudahMengajukan = ServiceRequestApplication::where(
        'service_request_id',
        $serviceRequest->id
    )->where('freelancer_id', Auth::id())->exists();

    if ($sudahMengajukan) {
        return back()->with('error', 'Kamu sudah mengajukan proposal pada proyek ini.');
    }

    $validated = $request->validate([
        'message' => 'required|string|max:1000',
        'price' => 'required|numeric|min:1',
        'duration' => 'required|string|max:100',
    ]);

    ServiceRequestApplication::create([
        'service_request_id' => $serviceRequest->id,
        'freelancer_id' => Auth::id(),
        'message' => $validated['message'],
        'price' => $validated['price'],
        'duration' => $validated['duration'],
        'status' => 'pending',
    ]);

    return back()->with('success', 'Proposal berhasil dikirim.');
}

    // Client melihat daftar freelancer yang mengajukan
    public function index(ServiceRequest $serviceRequest)
    {
        if ($serviceRequest->client_id !== Auth::id()) {
            abort(403);
        }

        $applications = $serviceRequest->applications()
            ->with('freelancer')
            ->latest()
            ->get();

        return view(
            'client.service_requests.applications',
            compact('serviceRequest', 'applications')
        );
    }

    // Client memilih freelancer
    public function select(ServiceRequest $serviceRequest, ServiceRequestApplication $application)
    {
        if ($serviceRequest->client_id !== Auth::id()) {
            abort(403);
        }

        if ($application->service_request_id !== $serviceRequest->id) {
            abort(404);
        }

        if ($serviceRequest->status !== 'open' || $application->status !== 'pending') {
            return back()->with('error', 'Posting atau pengajuan ini sudah diproses.');
        }

        $serviceRequest->applications()
            ->where('status', 'pending')
            ->update(['status' => 'rejected']);

        $application->update(['status' => 'accepted']);

        $serviceRequest->update(['status' => 'closed']);

        return back()->with('success', 'Freelancer berhasil dipilih.');
    }
}
