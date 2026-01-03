@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <nav class="text-sm text-gray-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-black">Home</a> / <span class="text-black">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="aspect-square bg-gray-100 rounded-2xl overflow-hidden relative">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600' }}" 
                 class="w-full h-full object-cover">
            
            @if($product->status == 'sold')
                <div class="absolute top-4 right-4 bg-black text-white px-4 py-2 font-bold uppercase tracking-widest">
                    Sold Out
                </div>
            @endif
        </div>

        <div>
            <h1 class="text-4xl font-bold mb-2">{{ $product->name }}</h1>
            <p class="text-xl text-gray-500 mb-6">{{ $product->brand }}</p>
            <p class="text-3xl font-bold mb-8">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            <div class="prose prose-lg text-gray-600 mb-8">
                <p>{{ $product->description ?? 'Tidak ada deskripsi detail untuk sepatu ini.' }}</p>
                <ul class="mt-4 space-y-2">
                    <li><strong>Condition:</strong> {{ $product->condition }}</li>
                    <li><strong>Size:</strong> {{ $product->size }}</li>
                    <li><strong>Color:</strong> {{ $product->color ?? 'N/A' }}</li>
                </ul>
            </div>

            @if($product->status != 'sold')
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-black text-white py-4 rounded-xl font-bold text-lg hover:bg-gray-800 transition transform active:scale-95 shadow-xl">
                        Add to Cart
                    </button>
                </form>
            @else
                <button disabled class="w-full bg-gray-300 text-gray-500 py-4 rounded-xl font-bold text-lg cursor-not-allowed">
                    Item Unavailable
                </button>
            @endif
        </div>
    </div>

    <div class="mt-24">
        <h2 class="text-2xl font-bold mb-8">You Might Also Like</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedProducts as $related)
                <a href="{{ route('products.show', $related->id) }}" class="group block">
                    <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden mb-4">
                        <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://via.placeholder.com/300' }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <h3 class="font-bold text-sm">{{ $related->name }}</h3>
                    <p class="text-gray-500 text-sm">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection