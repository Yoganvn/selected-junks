@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-2xl font-bold mb-8">Wishlist Saya</h1>

    @if($products->isEmpty())
        <div class="text-center py-20 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
            <p class="text-gray-500">Belum ada barang yang kamu sukai.</p>
            <a href="{{ route('home') }}" class="text-black font-bold underline mt-2 inline-block">Cari Barang Dulu</a>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="group">
                    <div class="relative aspect-[4/5] bg-gray-100 rounded-xl overflow-hidden mb-4">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        
                        <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="absolute top-2 right-2">
                            @csrf
                            <button type="submit" class="bg-white p-2 rounded-full shadow-md text-red-500 hover:bg-gray-100">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            </button>
                        </form>
                    </div>

                    <a href="{{ route('product.detail', $product->id) }}" class="block">
                        <h3 class="font-bold text-gray-900 truncate">{{ $product->name }}</h3>
                        <p class="text-gray-500 text-sm">Rp {{ number_format($product->price) }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection