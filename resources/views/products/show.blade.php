@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <nav class="text-sm text-gray-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-black transition">Home</a> 
        <span class="mx-2">/</span> 
        <span class="text-black font-medium">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
        
        <div class="relative group">
            <div class="aspect-square bg-gray-100 rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                @if($product->status == 'sold')
                    <div class="absolute top-4 left-4 bg-black text-white px-3 py-1 text-xs font-bold uppercase tracking-wider z-10">
                        SOLD OUT
                    </div>
                @else
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-black px-3 py-1 text-xs font-bold uppercase tracking-wider z-10 border border-gray-200 rounded">
                        {{ $product->condition }}
                    </div>
                @endif

                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600' }}" 
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-700 ease-in-out">
            </div>
        </div>

        <div class="flex flex-col justify-center">
            
            <div class="mb-6">
                <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-2">{{ $product->brand }}</h2>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight leading-none mb-4">{{ $product->name }}</h1>
                <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>

            <div class="border-t border-gray-100 my-6"></div>

            <div class="grid grid-cols-2 gap-4 mb-8">
                <div>
                    <span class="block text-xs text-gray-500 uppercase font-bold tracking-wider">Size</span>
                    <span class="text-lg font-medium">{{ $product->size }}</span>
                </div>
                <div>
                    <span class="block text-xs text-gray-500 uppercase font-bold tracking-wider">Condition</span>
                    <span class="text-lg font-medium">{{ $product->condition }}</span>
                </div>
            </div>

            <div class="prose prose-sm text-gray-600 mb-8 leading-relaxed">
                <p>{{ $product->description ?? 'Sepatu ini telah melalui proses kurasi ketat untuk memastikan kualitas dan keasliannya. Siap melangkah bersama cerita barumu.' }}</p>
            </div>

            @if($product->status != 'sold')
                <div class="flex gap-4">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-black text-white py-4 rounded-full font-bold text-lg shadow-xl hover:bg-gray-800 hover:-translate-y-1 transition transform duration-200">
                            Add to Cart
                        </button>
                    </form>
                    
                    <button class="w-14 h-14 flex items-center justify-center rounded-full border border-gray-200 hover:bg-gray-50 transition">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                </div>
                <p class="mt-4 text-xs text-gray-400 text-center flex items-center justify-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Originality Guaranteed • Instant Shipping
                </p>
            @else
                <button disabled class="w-full bg-gray-200 text-gray-400 py-4 rounded-full font-bold text-lg cursor-not-allowed">
                    Sold Out
                </button>
            @endif
        </div>
    </div>

    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <div class="mt-24 border-t border-gray-100 pt-16">
        <h3 class="text-2xl font-bold mb-8 tracking-tight">You Might Also Like</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedProducts as $related)
                <a href="{{ route('products.show', $related->id) }}" class="group block">
                    <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden mb-4 relative">
                        <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://via.placeholder.com/300' }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                         @if($related->status == 'sold')
                            <div class="absolute top-2 right-2 bg-black text-white text-[10px] px-2 py-1 font-bold uppercase">Sold</div>
                         @endif
                    </div>
                    <h4 class="font-bold text-sm text-gray-900 group-hover:underline decoration-1 underline-offset-4">{{ $related->name }}</h4>
                    <p class="text-gray-500 text-sm mt-1">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection