@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16">
        
        <div>
            <div class="aspect-square rounded-3xl overflow-hidden bg-gray-50 border border-gray-100 shadow-sm relative group">
                <img src="{{ asset('storage/' . $product->image) }}" 
                     class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-in-out" 
                     alt="{{ $product->name }}">
            </div>
        </div>

        <div class="flex flex-col justify-center">
            
            <div class="mb-2">
                <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">{{ $product->brand }}</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold mb-4 tracking-tight text-gray-900">{{ $product->name }}</h1>
            
            <p class="text-3xl text-gray-900 mb-8 font-medium">Rp {{ number_format($product->price) }}</p>
            
            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <span class="block text-xs text-gray-500 uppercase font-bold mb-1">Size</span>
                    <span class="text-lg font-bold">{{ $product->size }} EUR</span>
                </div>
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <span class="block text-xs text-gray-500 uppercase font-bold mb-1">Kondisi</span>
                    <span class="text-lg font-bold">{{ $product->condition }}</span>
                </div>
            </div>

            <div class="mb-10">
                <h3 class="font-bold mb-3 text-sm uppercase text-gray-900">Deskripsi Produk</h3>
                <p class="text-gray-600 leading-relaxed text-base">{{ $product->description }}</p>
            </div>

            <div class="flex gap-4">
                
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-black text-white py-4 rounded-xl font-bold hover:bg-gray-800 transition shadow-lg shadow-gray-200">
                        Tambah ke Keranjang
                    </button>
                </form>

                @php
                    $isLiked = Auth::check() && Auth::user()->wishlists->contains($product->id);
                @endphp

                <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-16 h-full flex items-center justify-center rounded-xl border-2 transition duration-200 
                        {{ $isLiked ? 'border-red-500 bg-red-50 text-red-500' : 'border-gray-200 text-gray-400 hover:border-black hover:text-black' }}"
                        title="{{ $isLiked ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}">
                        
                        <svg class="w-7 h-7 {{ $isLiked ? 'fill-current' : 'fill-none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>
                </form>

            </div>
            
        </div>
    </div>
</div>
@endsection