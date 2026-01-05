@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">

    <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col flex-shrink-0">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-8 h-8 bg-black text-white flex items-center justify-center rounded-lg font-bold">A</div>
                <div>
                    <h2 class="font-bold text-gray-900 text-sm">Admin Panel</h2>
                    <p class="text-xs text-gray-400">Manage System</p>
                </div>
            </div>

            <nav class="space-y-1">
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-black rounded-lg text-sm font-medium transition">
                    Users & Roles
                </a>
                
                <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-2.5 bg-black text-white rounded-lg text-sm font-medium transition">
                    Reports & Omzet
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Laporan Bisnis</h1>
            <p class="text-sm text-gray-500 mt-1">Pantau performa penjualan toko kamu.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <p class="text-xs text-gray-500 font-bold uppercase mb-2">Total Pendapatan</p>
                <h3 class="text-3xl font-bold text-gray-900">Rp {{ number_format($stats['revenue']) }}</h3>
                <span class="text-xs text-green-600 font-medium bg-green-50 px-2 py-1 rounded-full mt-2 inline-block">
                    +{{ $stats['growth'] }}% Bulan ini
                </span>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <p class="text-xs text-gray-500 font-bold uppercase mb-2">Total Transaksi</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $stats['transactions'] }} Order</h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <p class="text-xs text-gray-500 font-bold uppercase mb-2">Barang Terjual</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $stats['items_sold'] }} Pcs</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-900">Transaksi Terbaru</h3>
            </div>
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-mono font-bold">#{{ $order->id }}</td>
                        <td class="px-6 py-4">{{ optional($order->user)->name ?? 'Guest' }}</td>
                        <td class="px-6 py-4 font-bold">Rp {{ number_format($order->total_price) }}</td>
                        <td class="px-6 py-4 text-right">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $order->status == 'success' || $order->status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
</div>
@endsection