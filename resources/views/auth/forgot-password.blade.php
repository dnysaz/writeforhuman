<x-guest-layout>
    <header class="mb-10">
        <h1 class="text-4xl font-bold tracking-tighter text-[#1a1a1a] mb-3">
            recovery.
        </h1>
        <div class="h-1 w-12 bg-[#1a1a1a] mb-4"></div>
        <p class="text-gray-500 font-light italic text-[16px] leading-relaxed">
            {{ __('Losing your way is part of the journey. Share your email, and we will help you find the way back to your sanctuary.') }}
        </p>
    </header>

    <x-auth-session-status class="mb-8 text-sm font-bold text-green-600 bg-green-50 p-4 rounded-xl border-l-4 border-green-500" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-8">
        @csrf

        <div class="group">
            <label for="email" class="text-[12px] font-bold tracking-tight text-gray-400 group-focus-within:text-black transition-colors">
                {{ __('Email address') }}
            </label>
            <input id="email" 
                   class="block w-full mt-2 py-3 border-b-2 border-gray-100 focus:border-black outline-none transition-all text-lg bg-transparent rounded-none placeholder:text-gray-200" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[12px] font-bold text-red-500" />
        </div>

        <div class="pt-4 flex flex-col items-center">
            <button type="submit" class="w-full bg-[#1a1a1a] text-white py-4 rounded-full font-bold hover:bg-black transition-all shadow-lg shadow-black/5 active:scale-[0.98]">
                {{ __('Send reset link') }}
            </button>
            
            <a href="{{ route('login') }}" class="mt-8 text-[13px] font-bold text-gray-400 hover:text-black hover:underline transition-all">
                {{ __('Back to sign in') }}
            </a>
        </div>
    </form>
</x-guest-layout>