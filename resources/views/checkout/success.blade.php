@extends('layouts.app')

@section('content')
<div class="h-[80vh] flex flex-col items-center justify-center text-center px-4">
    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-6">
        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    </div>
    <h1 class="text-3xl font-bold mb-4">Payment Successful!</h1>
    <p class="text-gray-500 max-w-md mb-8">
        Terima kasih sudah berbelanja di Selected Junks. <br>
        Sepatu impianmu sekarang resmi jadi milikmu.
    </p>
    <a href="{{ route('home') }}" class="bg-black text-white px-8 py-3 rounded-xl font-medium hover:bg-gray-800 transition">
        Back to Home
    </a>
</div>
@endsection