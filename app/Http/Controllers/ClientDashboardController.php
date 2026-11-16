<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Http\Request;

class ClientDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $clientId = $request->user()->id;

        // DATA PESANAN
        $pesanan = Order::where('client_id', $clientId);

        $totalPesanan = (clone $pesanan)->count();

        $pesananDiproses = (clone $pesanan)
            ->whereIn('status', ['DIPROSES', 'SUBMITTED', 'REVISI'])
            ->count();

        $pesananSelesai = (clone $pesanan)
            ->where('status', 'SELESAI')
            ->count();

        $totalPembayaran = (clone $pesanan)->sum('total_price');

        // PESANAN TERBARU
        $pesananTerbaru = Order::with('service.freelancer')
            ->where('client_id', $clientId)
            ->latest()
            ->take(3)
            ->get();

        // FREELANCER FAVORIT
        $freelancerFavorit = Favorite::with('freelancer')
            ->where('client_id', $clientId)
            ->whereNotNull('freelancer_id')
            ->latest()
            ->take(3)
            ->get();

        // AKTIVITAS TERBARU
        $aktivitasTerbaru = collect();

        // Aktivitas pesanan
        $daftarPesanan = Order::with('service')
            ->where('client_id', $clientId)
            ->latest('updated_at')
            ->take(10)
            ->get();

        foreach ($daftarPesanan as $item) {
            $status = strtoupper($item->status);

            $judul = match ($status) {
                'SELESAI' => 'Pesanan telah selesai',
                'DIPROSES', 'SUBMITTED' => 'Pesanan sedang diproses',
                'REVISI' => 'Pesanan dalam revisi',
                'MENUNGGU' => 'Pesanan menunggu',
                default => 'Pesanan diperbarui',
            };

            $aktivitasTerbaru->push([
                'ikon' => '▧',
                'judul' => $judul,
                'keterangan' => 'Jasa: ' . ($item->service->title ?? 'Tidak tersedia'),
                'tanggal' => $item->updated_at,
            ]);
        }

        // Aktivitas favorit
        $daftarFavorit = Favorite::with(['freelancer', 'service'])
            ->where('client_id', $clientId)
            ->latest()
            ->take(10)
            ->get();

        foreach ($daftarFavorit as $item) {
            if ($item->freelancer_id) {
                $nama = $item->freelancer->name ?? 'Freelancer';

                $keterangan = 'Freelancer: ' . $nama;
            } else {
                $nama = $item->service->title ?? 'Jasa';

                $keterangan = 'Jasa: ' . $nama;
            }

            $aktivitasTerbaru->push([
                'ikon' => '♡',
                'judul' => 'Menambahkan ke favorit',
                'keterangan' => $keterangan,
                'tanggal' => $item->created_at,
            ]);
        }

        // Aktivitas review
        $daftarReview = Review::with('order.service')
            ->where('client_id', $clientId)
            ->latest()
            ->take(10)
            ->get();

        foreach ($daftarReview as $item) {
            $namaJasa = $item->order->service->title ?? 'Jasa';

            $aktivitasTerbaru->push([
                'ikon' => '★',
                'judul' => 'Review berhasil diberikan',
                'keterangan' => 'Jasa: ' . $namaJasa,
                'tanggal' => $item->created_at,
            ]);
        }

        // Urutkan berdasarkan aktivitas paling baru
        $aktivitasTerbaru = $aktivitasTerbaru
            ->sortByDesc('tanggal')
            ->take(5)
            ->values();

        return view('client.dashboard', compact(
            'totalPesanan',
            'pesananDiproses',
            'pesananSelesai',
            'totalPembayaran',
            'pesananTerbaru',
            'freelancerFavorit',
            'aktivitasTerbaru'
        ));
    }
}
