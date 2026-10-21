<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;

class ClientOrderController extends Controller
{
    // Menampilkan pesanan milik client
    public function index()
    {
        $orders = Order::with(['service.freelancer'])
            ->where('client_id', auth()->id())
            ->latest()
            ->get();

        return view('client.pesanan', compact('orders'));
    }

    // Menampilkan detail jasa
    public function showService(Service $service)
    {
        $service->load('freelancer');

        return view('client.detail_jasa', compact('service'));
    }

    // Menyimpan pesanan baru
    public function store(Request $request, Service $service)
    {
        // Hanya client yang boleh memesan
        abort_unless(
            auth()->check() && auth()->user()->role === 'client',
            403,
            'Hanya client yang dapat memesan jasa.'
        );

        // Periksa apakah freelancer sudah diverifikasi admin
        $freelancer = $service->freelancer;

        if (
            !$freelancer ||
            $freelancer->role !== 'freelancer' ||
            $freelancer->verification_status !== 'verified'
        ) {
            return back()->with(
                'error',
                'Jasa belum dapat dipesan karena freelancer belum diverifikasi admin.'
            );
        }

        // Membuat pesanan jika freelancer sudah verified
        Order::create([
            'client_id' => auth()->id(),
            'service_id' => $service->id,
            'total_price' => $service->price,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('client.orders.index')
            ->with('success', 'Pesanan berhasil dibuat!');
    }
}
