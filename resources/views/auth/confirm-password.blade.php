<x-guest-layout>
    <header class="mb-10">
        <h1 class="text-3xl font-bold font-sans tracking-tighter text-black mb-3 lowercase">
            confirm security
        </h1>
        <div class="h-1 w-12 bg-black mb-4"></div>
        <p class="text-gray-500 font-serif italic text-sm leading-relaxed">
            {{ __('This is a secure area. Please verify your identity before we proceed further.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-8">
        @csrf

        <div class="group">
            <label for="password" class="text-[10px] font-bold tracking-[0.2em] text-gray-300 group-focus-within:text-black transition-colors uppercase">
                {{ __('Password') }}
            </label>
            
            <input id="password" 
                   class="block w-full mt-2 py-3 border border-slate-400 focus:border-black outline-none transition-all font-serif text-lg bg-transparent rounded-none"
                   type="password"
                   name="password"
                   required 
                   autocomplete="current-password"
                   placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[11px] font-sans font-bold tracking-tighter text-red-500" />
        </div>

        <div class="pt-4 flex flex-col items-center">
            <button type="submit" class="w-full bg-black text-white py-4 font-sans font-bold hover:bg-zinc-800 transition-all shadow-xl active:scale-95">
                {{ __('Confirm Identity') }}
            </button>
            
            <a href="javascript:history.back()" class="mt-8 text-[11px] font-bold tracking-widest text-gray-400 hover:text-black transition-colors uppercase">
                Go back
            </a>
        </div>
    </form>
</x-guest-layout>