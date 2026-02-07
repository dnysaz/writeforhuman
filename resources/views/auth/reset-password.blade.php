<x-guest-layout>
    <header class="mb-10">
        <h1 class="text-4xl font-bold tracking-tighter text-[#1a1a1a] mb-3">
            new beginning.
        </h1>
        <div class="h-1 w-12 bg-[#1a1a1a] mb-4"></div>
        <p class="text-gray-500 font-light italic text-[16px] leading-relaxed">
            {{ __('Define your new credentials. Make them strong, make them yours.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-8">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="group">
            <label for="email" class="text-[12px] font-bold tracking-tight text-gray-400">
                {{ __('Email address') }}
            </label>
            <input id="email" 
                   class="block w-full mt-2 py-3 border-b-2 border-gray-100 focus:outline-none text-lg bg-transparent rounded-none opacity-40 cursor-not-allowed" 
                   type="email" 
                   name="email" 
                   value="{{ old('email', $request->email) }}" 
                   required 
                   readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[12px] font-bold text-red-500" />
        </div>

        <div class="group">
            <label for="password" class="text-[12px] font-bold tracking-tight text-gray-400 group-focus-within:text-black transition-colors">
                {{ __('New password') }}
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
                {{ __('Confirm new password') }}
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
                {{ __('Reset password now') }}
            </button>
        </div>
    </form>
</x-guest-layout>