<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Selected Junks | Curated Thrift Store</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black font-sans antialiased">

    <header class="fixed w-full bg-white/90 backdrop-blur-md border-b border-gray-100 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <a href="/" class="font-bold text-xl tracking-tighter">Selected Junks</a>
                </div>

                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-900 hover:text-gray-500 transition">Shop</a>
                    <a href="#" class="text-sm font-medium text-gray-500 hover:text-black transition">Stories</a>
                    <a href="#" class="text-sm font-medium text-gray-500 hover:text-black transition">About</a>
                </nav>

                <div class="flex items-center gap-6">
                    
                    <a href="{{ route('cart.index') }}" class="relative text-gray-900 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span class="absolute -top-1 -right-1 bg-black text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full">
                            {{ Auth::check() && Auth::user()->cart ? Auth::user()->cart->items->count() : 0 }}
                        </span>
                    </a>

                    <div class="hidden md:flex items-center gap-4 text-sm font-medium border-l border-gray-200 pl-6">
                        @auth
                            <div class="relative" x-data="{ open: false }">
                                
                                <button @click="open = !open" class="flex items-center gap-2 text-gray-900 hover:text-gray-600 focus:outline-none transition">
                                    <span>Hi, {{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>

                                <div x-show="open" 
                                     @click.outside="open = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 origin-top-right"
                                     style="display: none;">
                                    
                                    <a href="{{ route('products.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-black transition">
                                        + Jual Produk
                                    </a>

                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-black transition">
                                        Profile Saya
                                    </a>

                                    <div class="border-t border-gray-100 my-1"></div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>

                        @else
                            <a href="{{ route('login') }}" class="hover:text-gray-600 transition">Log in</a>
                            <a href="{{ route('register') }}" class="bg-black text-white px-4 py-2 rounded-full hover:bg-gray-800 transition">Register</a>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </header>

    <main class="pt-20 min-h-screen relative">
        @if(session('success'))
            <div class="fixed top-24 right-4 z-50 animate-bounce">
                <div class="bg-black text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="fixed top-24 right-4 z-50 animate-bounce">
                <div class="bg-white border-2 border-black text-black px-6 py-4 rounded-lg shadow-2xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    <span class="font-bold">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-black text-white py-16 mt-20">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div>
                <h3 class="font-bold text-lg mb-4 tracking-tighter">SELECTED JUNKS.</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Curated second-hand footwear. 
                    Redefining value through stories and quality.
                </p>
            </div>
            <div>
                 <div class="text-gray-500 text-xs mt-10">
                     &copy; 2026 Selected Junks.
                 </div>
             </div>
        </div>
    </footer>

</body>
</html>