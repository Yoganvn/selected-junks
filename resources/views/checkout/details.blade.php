@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold mb-8">Checkout Details</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        
        <div>
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <h2 class="text-xl font-bold mb-6">Shipping Information</h2>
                
                <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="phone" placeholder="0812..." class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Shipping Address</label>
                        <textarea name="address" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black" required placeholder="Street, City, Province, Zip Code"></textarea>
                    </div>

                    <h2 class="text-xl font-bold mb-4 mt-8">Payment Method</h2>
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" value="bank_transfer" checked class="text-black focus:ring-black">
                            <div class="ml-3">
                                <span class="block font-medium">Bank Transfer</span>
                                <span class="block text-xs text-gray-500">BCA, Mandiri, BNI</span>
                            </div>
                        </label>
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="payment_method" value="qris" class="text-black focus:ring-black">
                            <div class="ml-3">
                                <span class="block font-medium">QRIS</span>
                                <span class="block text-xs text-gray-500">Gopay, OVO, Dana, ShopeePay</span>
                            </div>
                        </label>
                    </div>
                </form>
            </div>
        </div>

        <div>
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 sticky top-24">
                <h2 class="text-lg font-medium text-gray-900 mb-6">Order Summary</h2>
                
                <div class="space-y-6 mb-8">
                    @foreach($cart->items as $item)
                        <div class="flex gap-4 bg-white p-3 rounded-lg border border-gray-100 shadow-sm">
                            
                            <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/150' }}" 
                                     alt="{{ $item->product->name }}"
                                     class="h-full w-full object-cover object-center">
                            </div>

                            <div class="flex-1 flex flex-col justify-center">
                                <h3 class="font-bold text-gray-900 text-sm mb-1">{{ $item->product->name }}</h3>
                                <p class="text-xs text-gray-500 mb-1">
                                    Brand: {{ $item->product->brand }} | Size: {{ $item->product->size }}
                                </p>
                                <p class="text-xs text-gray-500 bg-gray-100 inline-block px-2 py-0.5 rounded w-fit">
                                    Condition: {{ $item->product->condition }}
                                </p>
                            </div>

                            <div class="flex items-center">
                                <span class="font-semibold text-sm">Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-200 pt-4 space-y-2">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Shipping (Flat Rate)</span>
                        <span>Rp 20.000</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200 mt-4">
                        <span class="text-lg font-bold text-gray-900">Total Payment</span>
                        <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($total + 20000, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button type="submit" form="checkout-form" class="w-full bg-black text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-gray-800 transition transform hover:-translate-y-1 mt-8">
                    Confirm & Pay
                </button>
            </div>
        </div>

    </div>
</div>
@endsection