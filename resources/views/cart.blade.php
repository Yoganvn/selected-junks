@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold mb-8">Shopping Cart</h1>

    @if($cartItems->count() > 0)
        <div class="flex flex-col lg:flex-row gap-12">
            
            <div class="lg:w-2/3">
                <div class="bg-white border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                    @foreach($cartItems as $item)
                    <div class="flex items-center p-6 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">
                        <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                            <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/150' }}" 
                                 class="h-full w-full object-cover object-center">
                        </div>

                        <div class="ml-4 flex-1 flex flex-col">
                            <div>
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <h3>{{ $item->product->name }}</h3>
                                    <p class="ml-4">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">{{ $item->product->brand }} | Size {{ $item->product->size }}</p>
                            </div>
                            
<form action="{{ route('cart.remove', $item->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="font-medium text-red-600 hover:text-red-500 transition duration-150 ease-in-out">
        Remove
    </button>
</form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 mb-6">Order Summary</h2>
                    
                    <div class="flex items-center justify-between border-b border-gray-200 pb-4 mb-4">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-base font-bold text-gray-900">Order Total</span>
                        <span class="text-xl font-bold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

<a href="{{ route('checkout.show') }}" class="block w-full bg-black text-white py-4 rounded-xl font-bold text-lg text-center shadow-lg hover:bg-gray-800 transition">
    Checkout Now
</a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-20 bg-gray-50 rounded-xl border border-dashed border-gray-300">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Keranjang kosong</h3>
            <p class="mt-1 text-sm text-gray-500">Yuk mulai belanja sepatu impianmu.</p>
            <div class="mt-6">
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-black hover:bg-gray-800">
                    Mulai Belanja
                </a>
            </div>
        </div>
    @endif
</div>
@endsection