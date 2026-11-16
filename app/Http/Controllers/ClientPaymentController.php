<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class ClientPaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order.service')
            ->where('client_id', auth()->id())
            ->latest()
            ->get();

        return view('client.pembayaran', compact('payments'));
    }
}