<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\ServiceRequestApplication;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        )
            ->where('freelancer_id', Auth::id())
            ->exists();

        if ($sudahMengajukan) {
            return back()->with('error', 'Kamu sudah mengajukan proposal pada proyek ini.');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'price' => 'required|numeric|min:1',
            'duration' => 'required|string|max:100',
        ]);

        $application = DB::transaction(function () use (
            $serviceRequest,
            $validated
        ) {
            $application = ServiceRequestApplication::create([
                'service_request_id' => $serviceRequest->id,
                'freelancer_id' => Auth::id(),
                'message' => $validated['message'],
                'price' => $validated['price'],
                'duration' => $validated['duration'],
                'status' => 'pending',
            ]);

            // Aktivitas untuk Freelancer
            UserActivity::create([
                'user_id' => Auth::id(),
                'role' => 'freelancer',
                'title' => 'Mengajukan proposal',
                'description' => 'Mengajukan proposal pada posting: ' . $serviceRequest->title,
            ]);

            // Aktivitas untuk Client pemilik posting
            UserActivity::create([
                'user_id' => $serviceRequest->client_id,
                'role' => 'client',
                'title' => 'Menerima pengajuan freelancer',
                'description' => 'Ada freelancer yang mengajukan proposal pada posting: ' . $serviceRequest->title,
            ]);

            return $application;
        });

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
    public function select(
        ServiceRequest $serviceRequest,
        ServiceRequestApplication $application
    ) {
        if ($serviceRequest->client_id !== Auth::id()) {
            abort(403);
        }

        if ($application->service_request_id !== $serviceRequest->id) {
            abort(404);
        }

        if ($serviceRequest->status !== 'open' || $application->status !== 'pending') {
            return back()->with('error', 'Posting atau pengajuan ini sudah diproses.');
        }

        DB::transaction(function () use ($serviceRequest, $application) {

            // Tolak pengajuan lainnya yang masih menunggu
            $serviceRequest->applications()
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);

            // Terima freelancer yang dipilih
            $application->update(['status' => 'accepted']);

            // Tutup posting kebutuhan jasa
            $serviceRequest->update(['status' => 'closed']);

            // Aktivitas untuk Client
            UserActivity::create([
                'user_id' => Auth::id(),
                'role' => 'client',
                'title' => 'Memilih freelancer',
                'description' => 'Memilih freelancer untuk posting: ' . $serviceRequest->title,
            ]);

            // Aktivitas untuk Freelancer terpilih
            UserActivity::create([
                'user_id' => $application->freelancer_id,
                'role' => 'freelancer',
                'title' => 'Proposal diterima',
                'description' => 'Proposal kamu diterima untuk posting: ' . $serviceRequest->title,
            ]);
        });

        return back()->with('success', 'Freelancer berhasil dipilih.');
    }
}
