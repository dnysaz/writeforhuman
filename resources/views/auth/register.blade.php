<x-guest-layout>
    <header class="mb-10">
        <h1 class="text-4xl font-bold tracking-tighter text-[#1a1a1a] mb-3">
            register.
        </h1>
        <div class="h-1 w-12 bg-[#1a1a1a] mb-4"></div>
        <p class="text-gray-500 font-light italic text-[16px] leading-relaxed">
            Join the sanctuary. Establish your human presence in the digital landscape.
        </p>
    </header>

    <form method="POST" action="{{ route('register') }}" class="space-y-8">
        @csrf

        <div class="group">
            <label for="name" class="text-[12px] font-bold tracking-tight text-gray-400 group-focus-within:text-black transition-colors">
                Full name
            </label>
            <input id="name" 
                   class="block w-full mt-2 py-3 border-b-2 border-gray-100 focus:border-black outline-none transition-all text-lg bg-transparent rounded-none placeholder:text-gray-200" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name" 
                   placeholder="Your name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-[12px] font-bold text-red-500" />
        </div>

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
                   autocomplete="username" 
                   placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[12px] font-bold text-red-500" />
        </div>

        <div class="group">
            <label for="password" class="text-[12px] font-bold tracking-tight text-gray-400 group-focus-within:text-black transition-colors">
                Password
            </label>
            <input id="password" 
                   class="block w-full mt-2 py-3 border-b-2 border-gray-100 focus:border-black outline-none transition-all text-lg bg-transparent rounded-none placeholder:text-gray-200"
                   type="password"
                   name="password"
                   required 
                   autocomplete="new-password"
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[12px] font-bold text-red-500" />
        </div>

        <div class="group">
            <label for="password_confirmation" class="text-[12px] font-bold tracking-tight text-gray-400 group-focus-within:text-black transition-colors">
                Confirm password
            </label>
            <input id="password_confirmation" 
                   class="block w-full mt-2 py-3 border-b-2 border-gray-100 focus:border-black outline-none transition-all text-lg bg-transparent rounded-none placeholder:text-gray-200"
                   type="password"
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-[12px] font-bold text-red-500" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-[#1a1a1a] text-white py-4 rounded-full font-bold hover:bg-black transition-all shadow-lg shadow-black/5 active:scale-[0.98]">
                Create account
            </button>
            
            <p class="mt-10 text-center lg:text-left text-gray-400 font-medium">
                Already have an account? <a href="{{ route('login') }}" class="text-black font-bold hover:underline">sign in</a>
            </p>
        </div>
    </form>
</x-guest-layout>