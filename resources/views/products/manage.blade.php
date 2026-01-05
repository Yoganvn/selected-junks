@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-2xl font-bold">Kelola Produk</h1>
            <p class="text-gray-500 text-sm mt-1">Daftar semua produk yang Anda jual.</p>
        </div>
        <a href="{{ route('products.create') }}" class="bg-black text-white px-6 py-3 rounded-xl font-medium hover:bg-gray-800 transition flex items-center gap-2">
            <span>+</span> Tambah Produk
        </a>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-500 tracking-wider">
                    <th class="p-4 font-medium pl-6">Produk</th>
                    <th class="p-4 font-medium">Harga</th>
                    <th class="p-4 font-medium">Kondisi</th>
                    <th class="p-4 font-medium text-right pr-6">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50/50 transition group">
                    <td class="p-4 pl-6">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 rounded-lg object-cover bg-gray-100 border border-gray-200">
                            <div>
                                <div class="font-bold text-gray-900">{{ $product->name }}</div>
                                <div class="text-gray-500 text-xs">{{ $product->brand }} • {{ $product->size }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 font-medium">Rp {{ number_format($product->price) }}</td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 rounded-md text-xs font-bold border 
                            {{ $product->condition == 'BNIB' ? 'bg-green-50 text-green-700 border-green-100' : 'bg-gray-50 text-gray-600 border-gray-100' }}">
                            {{ $product->condition }}
                        </span>
                    </td>
                    <td class="p-4 text-right pr-6">
                        <div class="flex justify-end gap-2 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-1.5 text-sm font-medium text-gray-600 hover:text-black hover:bg-gray-100 rounded-lg transition">
                                Edit
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-12 text-center text-gray-500">
                        Belum ada produk. 
                        <a href="{{ route('products.create') }}" class="text-black font-bold hover:underline">Upload produk pertamamu</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection