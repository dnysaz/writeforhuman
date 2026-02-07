<x-guest-layout>
    <header class="mb-10">
        <h1 class="text-4xl font-bold tracking-tighter text-[#1a1a1a] mb-3">
            sign in.
        </h1>
        <div class="h-1 w-12 bg-[#1a1a1a] mb-4"></div>
        <p class="text-gray-500 font-light italic text-[16px] leading-relaxed">
            Welcome back to the sanctuary. Every word typed here is a testament to human focus.
        </p>
    </header>

    <x-auth-session-status class="mb-6 text-sm font-bold text-green-600 bg-green-50 p-4 rounded-xl" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-8">
        @csrf

        <div class="group">
            <label for="email" class="text-[12px] font-bold tracking-tight text-gray-400 group-focus-within:text-black transition-colors">
                Email address
            </label>
            <input id="email" 
                   class="block w-full mt-2 py-3 border-b-2 border-gray-100 focus:border-black outline-none transition-all text-lg bg-transparent rounded-none placeholder:text-gray-200" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username" 
                   placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[12px] font-bold text-red-500" />
        </div>

        <div class="group">
            <div class="flex justify-between items-end">
                <label for="password" class="text-[12px] font-bold tracking-tight text-gray-400 group-focus-within:text-black transition-colors">
                    Password
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[12px] font-bold text-gray-400 hover:text-black hover:underline transition-colors">
                        Forgot?
                    </a>
                @endif
            </div>
            <input id="password" 
                   class="block w-full mt-2 py-3 border-b-2 border-gray-100 focus:border-black outline-none transition-all text-lg bg-transparent rounded-none placeholder:text-gray-200"
                   type="password"
                   name="password"
                   required 
                   autocomplete="current-password"
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[12px] font-bold text-red-500" />
        </div>

        <div class="flex items-center group cursor-pointer">
            <input id="remember_me" type="checkbox" class="rounded border-gray-200 text-black focus:ring-0 focus:ring-offset-0 h-4 w-4 cursor-pointer" name="remember">
            <label for="remember_me" class="ms-3 text-[13px] font-medium text-gray-400 group-hover:text-black transition-colors cursor-pointer">
                Remember this device
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-[#1a1a1a] text-white py-4 rounded-full font-bold hover:bg-black transition-all shadow-lg shadow-black/5 active:scale-[0.98]">
                Sign in now
            </button>
            
            <p class="mt-10 text-center lg:text-left text-gray-400 font-medium">
                Don't have an account? <a href="{{ route('register') }}" class="text-black font-bold hover:underline">register</a>
            </p>
        </div>
    </form>
</x-guest-layout>