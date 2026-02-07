<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold tracking-tight text-red-600">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-2 text-sm text-red-900/60 leading-relaxed">
            {{ __('Once your account is deleted, all of your handcrafted thoughts and data will be permanently erased from the sanctuary. This action cannot be undone.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-2.5 bg-red-600 text-white text-sm font-bold rounded-full hover:bg-red-700 transition shadow-sm"
    >
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10 md:p-16 bg-white rounded-[3rem] text-center">
            @csrf
            @method('delete')
    
            <div class="mb-8 flex justify-center">
                <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
            </div>
    
            <h2 class="text-3xl font-bold tracking-tighter text-[#1a1a1a] mb-4">
                {{ __('Depart from the sanctuary?') }}
            </h2>
    
            <p class="text-[16px] text-gray-500 font-light leading-relaxed max-w-sm mx-auto mb-10">
                {{ __('Every word you have handcrafted will be lost in the void. If you are certain, please provide your password as a final signature.') }}
            </p>
    
            <div class="group max-w-sm mx-auto">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
    
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full py-4 border-b-2 border-gray-100 focus:border-red-600 outline-none transition-all text-xl bg-transparent rounded-none placeholder:text-gray-200 text-center"
                    placeholder="{{ __('Your password') }}"
                    required
                />
    
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-4 text-sm font-bold text-red-600" />
            </div>
    
            <div class="mt-12 flex flex-col items-center gap-6">
                <button 
                    type="submit"
                    class="w-full max-w-sm py-4 bg-red-600 text-white text-sm font-bold rounded-full hover:bg-red-700 transition shadow-xl shadow-red-600/20 active:scale-[0.98]"
                >
                    {{ __('Permanently delete my account') }}
                </button>
    
                <button 
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="text-[14px] font-bold text-gray-400 hover:text-black hover:underline transition"
                >
                    {{ __('I’ll stay a bit longer') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>