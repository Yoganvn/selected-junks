@extends('layouts.app')

@section('content')

<section class="relative h-[80vh] flex items-center justify-center overflow-hidden bg-white text-black">
    
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1554068865-24cecd4e34b8?q=80&w=2070&auto=format&fit=crop" 
             alt="Aesthetic Sneaker Sunlight" 
             class="w-full h-full object-cover object-center scale-110"> </div>

    <div class="absolute inset-0 z-10 bg-white/30 backdrop-blur-[1px]"></div>

    <div class="relative z-20 text-center px-4 max-w-4xl mx-auto animate-fade-in-up">
        
        <span class="inline-block py-1 px-3 border border-black rounded-full text-xs font-bold tracking-wider mb-6 bg-white/50">
            EST. 2026
        </span>
        
        <h1 class="text-5xl md:text-7xl font-extrabold mb-6 tracking-tight leading-tight text-black drop-shadow-sm">
            WALK WITH <br> 
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-black to-gray-700">
                STORIES.
            </span>
        </h1>
        
        <p class="text-lg text-gray-800 mb-10 max-w-xl mx-auto font-semibold leading-relaxed drop-shadow-sm">
            Temukan sepatu second pilihan dengan kualitas yang telah terkurasi ketat. 
            Because good style doesn't expire.
        </p>
        
        <div class="flex justify-center gap-4">
            <a href="#collection" class="bg-black text-white px-8 py-4 rounded-full font-bold hover:bg-gray-800 transition transform hover:-translate-y-1 shadow-xl">
                Shop Collection
            </a>
            <a href="#" class="bg-white/80 border-2 border-black text-black px-8 py-4 rounded-full font-bold hover:bg-white transition">
                Learn More
            </a>
        </div>
    </div>
</section>

<section id="collection" class="py-24 bg-white text-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-bold tracking-tight mb-2">Latest Drop</h2>
                <p class="text-gray-500">Update setiap minggu. Siapa cepat dia dapat.</p>
            </div>
            <a href="#" class="hidden md:flex items-center gap-2 text-sm font-medium border-b border-black pb-0.5 hover:opacity-70 transition">
                View All Products <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12">
            @foreach($products as $product)
            <div class="group relative">
                <div class="aspect-square w-full overflow-hidden rounded-2xl bg-gray-100 relative mb-4">
                    
                    @if($product->status == 'sold')
                        <div class="absolute top-3 right-3 bg-black text-white text-[10px] font-bold px-2 py-1 uppercase tracking-wider z-10">
                            SOLD OUT
                        </div>
                    @else
                         <div class="absolute top-3 left-3 bg-white/80 backdrop-blur-sm px-2 py-1 text-[10px] font-semibold tracking-wide border border-gray-100 rounded-md">
                            {{ $product->condition }}
                        </div>
                    @endif

                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x400?text=No+Image' }}" 
                         alt="{{ $product->name }}" 
                         class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500 ease-in-out">
                    
                    <div class="absolute bottom-4 left-0 right-0 px-4 opacity-100 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity duration-300 z-20">
                        @if($product->status != 'sold')
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-black text-white py-3 rounded-xl text-sm font-medium shadow-xl hover:bg-gray-800 transition transform active:scale-95">
                                Add to Cart
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-500 mb-1 font-medium">{{ $product->brand }}</p>
                        <h3 class="text-sm font-bold text-gray-900 leading-tight">
                            <a href="{{ route('product.detail', $product->id) }}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $product->name }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">Size {{ $product->size }}</p>
                    </div>
                    <p class="text-sm font-semibold text-gray-900">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endsection