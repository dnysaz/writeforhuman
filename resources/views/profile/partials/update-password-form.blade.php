<section>
    <header>
        <p class="mt-2 text-sm text-gray-500 font-light leading-relaxed">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-10 space-y-8">
        @csrf
        @method('put')

        <div class="group">
            <label for="update_password_current_password" class="text-[12px] font-bold tracking-tight text-gray-400 group-focus-within:text-black transition-colors">
                {{ __('Current password') }}
            </label>
            <input id="update_password_current_password" 
                   name="current_password" 
                   type="password" 
                   class="block w-full mt-2 py-3 border-b-2 border-gray-100 focus:border-black outline-none transition-all text-lg bg-transparent rounded-none placeholder:text-gray-200" 
                   autocomplete="current-password"
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-sm font-bold text-red-600" />
        </div>

        <div class="group">
            <label for="update_password_password" class="text-[12px] font-bold tracking-tight text-gray-400 group-focus-within:text-black transition-colors">
                {{ __('New password') }}
            </label>
            <input id="update_password_password" 
                   name="password" 
                   type="password" 
                   class="block w-full mt-2 py-3 border-b-2 border-gray-100 focus:border-black outline-none transition-all text-lg bg-transparent rounded-none placeholder:text-gray-200" 
                   autocomplete="new-password"
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-sm font-bold text-red-600" />
        </div>

        <div class="group">
            <label for="update_password_password_confirmation" class="text-[12px] font-bold tracking-tight text-gray-400 group-focus-within:text-black transition-colors">
                {{ __('Confirm new password') }}
            </label>
            <input id="update_password_password_confirmation" 
                   name="password_confirmation" 
                   type="password" 
                   class="block w-full mt-2 py-3 border-b-2 border-gray-100 focus:border-black outline-none transition-all text-lg bg-transparent rounded-none placeholder:text-gray-200" 
                   autocomplete="new-password"
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-sm font-bold text-red-600" />
        </div>

        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="px-10 py-3 bg-[#1a1a1a] text-white text-sm font-bold rounded-full hover:bg-black transition shadow-lg shadow-black/5 active:scale-[0.98]">
                {{ __('Update password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600 italic"
                >{{ __('Success, your sanctuary is secured.') }}</p>
            @endif
        </div>
    </form>
</section>