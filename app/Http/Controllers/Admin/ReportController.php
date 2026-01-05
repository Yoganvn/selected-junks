<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;     // <--- Import Model Order
use App\Models\OrderItem; // <--- Import Model OrderItem
use Carbon\Carbon;        // <--- Untuk urusan tanggal

class ReportController extends Controller
{
    public function index()
    {
        // 1. HITUNG OMZET (Hanya yang statusnya 'success' atau 'paid')
        // Sesuaikan 'success' dengan status order sukses di sistem checkout kamu
        $revenue = Order::where('status', 'success')->sum('total_price');

        // 2. TOTAL TRANSAKSI (Semua status)
        $transactions = Order::count();

        // 3. ITEM TERJUAL (Dari order yang sukses saja)
        // Kita hitung baris di tabel order_items milik order yang sukses
        $itemsSold = OrderItem::whereHas('order', function ($query) {
            $query->where('status', 'success');
        })->count();

        // 4. HITUNG KENAIKAN (GROWTH) BULAN INI VS BULAN LALU
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;

        $revenueThisMonth = Order::where('status', 'success')
                                ->whereMonth('created_at', $currentMonth)
                                ->sum('total_price');

        $revenueLastMonth = Order::where('status', 'success')
                                ->whereMonth('created_at', $lastMonth)
                                ->sum('total_price');

        // Rumus persentase kenaikan (cegah pembagian dengan nol)
        if ($revenueLastMonth > 0) {
            $growth = (($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100;
        } else {
            $growth = $revenueThisMonth > 0 ? 100 : 0; // Kalau bulan lalu 0, bulan ini ada, berarti naik 100%
        }

        // 5. AMBIL 5 TRANSAKSI TERBARU (Real Data)
        $recentOrders = Order::with('user') // Load relasi user biar bisa ambil namanya
                             ->latest()
                             ->take(5)
                             ->get();

        // Masukkan ke array stats biar rapi di view
        $stats = [
            'revenue' => $revenue,
            'transactions' => $transactions,
            'items_sold' => $itemsSold,
            'growth' => round($growth, 1) // Bulatkan 1 desimal
        ];

        return view('admin.reports.index', compact('stats', 'recentOrders'));
    }
}