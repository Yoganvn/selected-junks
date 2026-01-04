<x-guest-layout>
    <div class="min-h-screen flex bg-white">
        
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-white">
            <div class="w-full max-w-md space-y-8">
                
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
                        Join the Movement.
                    </h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Create your account and start collecting stories.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700"> Full Name </label>
                        <div class="mt-1">
                            <input id="name" name="name" type="text" required autofocus
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-black focus:border-black sm:text-sm transition duration-200"
                                value="{{ old('name') }}">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700"> Email Address </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" required
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-black focus:border-black sm:text-sm transition duration-200"
                                value="{{ old('email') }}">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" required
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-black focus:border-black sm:text-sm transition duration-200">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700"> Confirm Password </label>
                        <div class="mt-1">
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-black focus:border-black sm:text-sm transition duration-200">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-4 px-4 border border-transparent rounded-full shadow-sm text-sm font-bold text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition transform hover:-translate-y-0.5">
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-bold text-black hover:underline">
                            Log in
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="hidden lg:block w-1/2 relative bg-black">
            <div class="absolute inset-0 bg-black/50 z-10"></div>
            <img class="absolute inset-0 h-full w-full object-cover" 
                 src="https://images.unsplash.com/photo-1607522370940-f0441d0981f5?q=80&w=2070&auto=format&fit=crop" 
                 alt="Streetwear Vibes">
            
            <div class="relative z-20 flex flex-col justify-end h-full p-12 text-white pb-20">
                <h3 class="text-4xl font-bold tracking-tight">
                    Start Your Story Today.
                </h3>
                <p class="mt-4 text-lg text-gray-300 max-w-md">
                    Bergabunglah dengan komunitas thrift hunter terbaik. Temukan item langka sebelum orang lain.
                </p>
            </div>
        </div>

    </div>
</x-guest-layout>