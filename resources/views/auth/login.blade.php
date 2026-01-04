<x-guest-layout>
    <div class="min-h-screen flex bg-white">
        
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-white">
            <div class="w-full max-w-md space-y-8">
                
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
                        Selected Junks.
                    </h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Welcome back! Please login to your account.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700"> Email Address </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required autofocus
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-black focus:border-black sm:text-sm transition duration-200"
                                value="{{ old('email') }}">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
                            @if (Route::has('password.request'))
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}" class="font-medium text-gray-600 hover:text-black">
                                        Forgot password?
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-black focus:border-black sm:text-sm transition duration-200">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" 
                            class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-4 px-4 border border-transparent rounded-full shadow-sm text-sm font-bold text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition transform hover:-translate-y-0.5">
                            Sign in to your account
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-bold text-black hover:underline">
                            Sign up for free
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="hidden lg:block w-1/2 relative bg-black">
            <div class="absolute inset-0 bg-black/40 z-10"></div> <img class="absolute inset-0 h-full w-full object-cover" 
                 src="https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=2000&auto=format&fit=crop" 
                 alt="Selected Junks Vibes">
            
            <div class="relative z-20 flex flex-col justify-end h-full p-12 text-white pb-20">
                <blockquote class="mt-6">
                    <p class="text-3xl font-bold italic">
                        "Good shoes take you good places."
                    </p>
                    <footer class="mt-3 text-lg font-medium text-gray-300">
                        — Selected Junks
                    </footer>
                </blockquote>
                <p class="mt-6 text-sm text-gray-400 uppercase tracking-widest font-bold">
                    Walk With Stories.
                </p>
            </div>
        </div>
        
    </div>
</x-guest-layout>