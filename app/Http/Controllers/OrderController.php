<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends Controller
{
    public function clientIndex(Request $request): View
    {
        abort_unless($request->user()->role === 'client', 403);

        $orders = Order::with(['service.freelancer'])
            ->where('client_id', $request->user()->id)
            ->latest()
            ->get();

        return view('client.pesanan', compact('orders'));
    }

    public function freelancerIndex(Request $request): View
    {
        abort_unless($request->user()->role === 'freelancer', 403);

        $orders = Order::with(['client', 'service'])
            ->whereHas('service', fn ($query) => $query->where('freelancer_id', $request->user()->id))
            ->latest()
            ->get();

        return view('freelancer.orders.index', compact('orders'));
    }

    public function adminIndex(Request $request): View
    {
        abort_unless($request->user()->role === 'admin', 403);

        $orders = Order::with(['client', 'service.freelancer'])->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function freelancers(Request $request): View
    {
        abort_unless($request->user()->role === 'admin', 403);

        $freelancers = User::where('role', 'freelancer')->latest()->get();

        return view('admin.freelancers.index', compact('freelancers'));
    }

    public function showService(Request $request, Service $service): View
    {
        abort_unless($request->user()->role === 'client', 403);

        $service->load(['freelancer', 'category']);

        return view('client.detail_jasa', compact('service'));
    }

    public function store(Request $request, Service $service): RedirectResponse
    {
        abort_unless($request->user()->role === 'client', 403);
        abort_if($service->freelancer_id === $request->user()->id, 403);

        Order::create([
            'client_id' => $request->user()->id,
            'service_id' => $service->id,
            'total_price' => $service->price,
            'status' => 'MENUNGGU',
        ]);

        return redirect()->route('client.orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $user = $request->user();
        $attributes = [];

        if ($user->role === 'freelancer') {
            abort_unless($order->service()->where('freelancer_id', $user->id)->exists(), 403);

            $data = $request->validate([
                'status' => ['required', 'in:DIPROSES,SUBMITTED'],
                'work_result_file' => [
                    'required_if:status,SUBMITTED',
                    'file',
                    'mimes:pdf,zip,doc,docx,jpg,jpeg,png,txt',
                    'max:10240',
                ],
            ], [
                'work_result_file.required_if' => 'Unggah file hasil sebelum mengirim pesanan ke client.',
                'work_result_file.mimes' => 'File hasil harus berupa PDF, ZIP, DOC, DOCX, JPG, PNG, atau TXT.',
                'work_result_file.max' => 'Ukuran file hasil maksimal 10 MB.',
            ]);

            $allowedTransitions = [
                'MENUNGGU' => 'DIPROSES',
                'DIPROSES' => 'SUBMITTED',
                'REVISI' => 'DIPROSES',
            ];

            abort_unless(($allowedTransitions[$order->status] ?? null) === $data['status'], 403);

            $attributes['status'] = $data['status'];

            if ($data['status'] === 'SUBMITTED') {
                $newFilePath = $request->file('work_result_file')->store('order-deliverables', 'local');

                if (! is_string($newFilePath)) {
                    throw new RuntimeException('File hasil pesanan gagal disimpan.');
                }

                $previousFilePath = $order->work_result_file;
                $attributes['work_result_file'] = $newFilePath;
                $attributes['revision_notes'] = null;
            }
        } elseif ($user->role === 'client') {
            abort_unless($order->client_id === $user->id, 403);

            $data = $request->validate([
                'status' => ['required', 'in:REVISI,SELESAI'],
                'revision_notes' => ['required_if:status,REVISI', 'nullable', 'string', 'max:2000'],
            ], [
                'revision_notes.required_if' => 'Tuliskan catatan agar freelancer mengetahui revisi yang diperlukan.',
            ]);

            $allowedTransitions = [
                'SUBMITTED' => ['REVISI', 'SELESAI'],
            ];

            abort_unless(in_array($data['status'], $allowedTransitions[$order->status] ?? [], true), 403);

            $attributes['status'] = $data['status'];

            if ($data['status'] === 'REVISI') {
                $attributes['revision_notes'] = $data['revision_notes'];
            }
        } else {
            abort(403);
        }

        $order->update($attributes);

        if (isset($previousFilePath) && $previousFilePath !== $newFilePath) {
            if (! Storage::disk('local')->delete($previousFilePath)) {
                Log::warning('Unable to remove the previous order deliverable.', [
                    'order_id' => $order->id,
                    'file_path' => $previousFilePath,
                ]);
            }
        }

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function downloadDeliverable(Request $request, Order $order): StreamedResponse
    {
        abort_unless(is_string($order->work_result_file) && $order->work_result_file !== '', 404);

        $user = $request->user();
        $isAuthorized = match ($user->role) {
            'admin' => true,
            'client' => $order->client_id === $user->id,
            'freelancer' => $order->service()
                ->where('freelancer_id', $user->id)
                ->exists(),
            default => false,
        };

        abort_unless($isAuthorized, 404);

        abort_unless(Storage::disk('local')->exists($order->work_result_file), 404);

        return Storage::disk('local')->download(
            $order->work_result_file,
            'hasil-pesanan-'.$order->id.'.'.pathinfo($order->work_result_file, PATHINFO_EXTENSION),
        );
    }

    public function adminUpdateStatus(Request $request, Order $order): RedirectResponse
    {
        abort_unless($request->user()->role === 'admin', 403);

        $data = $request->validate([
            'status' => ['required', 'in:MENUNGGU,DIPROSES,SUBMITTED,REVISI,SELESAI'],
        ]);

        $order->update($data);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function updateFreelancerVerification(Request $request, User $user): RedirectResponse
    {
        abort_unless($request->user()->role === 'admin', 403);
        abort_unless($user->role === 'freelancer', 404);

        $data = $request->validate([
            'verification_status' => ['required', 'in:verified,rejected'],
        ]);

        $user->verification_status = $data['verification_status'];
        $user->save();

        return back()->with('success', 'Status verifikasi freelancer berhasil diperbarui.');
    }
}
