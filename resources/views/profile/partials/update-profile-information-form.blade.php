<section>
    <header class="flex flex-col md:flex-row md:items-center gap-6 mb-10">
        <div class="w-20 h-20 rounded-full bg-[#1a1a1a] flex items-center justify-center text-2xl font-bold text-white overflow-hidden border border-gray-100 flex-shrink-0">
            @if($user->avatar)
                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
            @else
                <span>{{ strtoupper(substr($user->name, 0, 1)) }}</span>
            @endif
        </div>

        <div>
            <h2 class="text-xl font-bold tracking-tight text-[#1a1a1a]">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500 font-light leading-relaxed">
                {{ __("Update your presence and how you are perceived in the sanctuary.") }}
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-10">
        @csrf
        @method('patch')

        <div class="group">
            <label for="username" class="text-[12px] font-bold tracking-tight text-gray-400">
                {{ __('Username') }}
            </label>
            <div class="flex items-center border-b-2 border-gray-50 transition-all">
                <span class="text-lg font-bold text-gray-300 pr-1 select-none">@</span>
                <input id="username" 
                       type="text" 
                       class="block w-full py-3 outline-none text-lg bg-transparent rounded-none opacity-40 cursor-not-allowed font-medium" 
                       value="{{ $user->username }}" 
                       readonly />
            </div>
            <p class="mt-2 text-[11px] text-gray-400 italic font-medium">
                {{ __('Your unique handle is permanent and cannot be changed.') }}
            </p>
        </div>

        <div class="group">
            <label for="name" class="text-[12px] font-bold tracking-tight text-gray-400 group-focus-within:text-black transition-colors">
                {{ __('Display name') }}
            </label>
            <input id="name" 
                   name="name" 
                   type="text" 
                   class="block w-full mt-2 py-3 border-b-2 border-gray-100 focus:border-black outline-none transition-all text-lg bg-transparent rounded-none" 
                   value="{{ old('name', $user->name) }}" 
                   required 
                   autofocus 
                   autocomplete="name" />
            <x-input-error class="mt-2 text-sm font-bold text-red-600" :messages="$errors->get('name')" />
        </div>

        <div class="group">
            <label for="email" class="text-[12px] font-bold tracking-tight text-gray-400 group-focus-within:text-black transition-colors">
                {{ __('Email address') }}
            </label>
            <input id="email" 
                   name="email" 
                   type="email" 
                   class="block w-full mt-2 py-3 border-b-2 border-gray-100 focus:border-black outline-none transition-all text-lg bg-transparent rounded-none opacity-50 cursor-not-allowed" 
                   value="{{ old('email', $user->email) }}" 
                   readonly 
                   autocomplete="username" />
            <x-input-error class="mt-2 text-sm font-bold text-red-600" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-gray-50 rounded-2xl">
                    <p class="text-sm text-gray-600 font-medium">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="text-black font-bold underline hover:no-underline transition ml-1">
                            {{ __('Resend verification link') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-xs text-green-600 italic">
                            {{ __('A new link has been delivered to your inbox.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-6">
            <button type="submit" class="px-10 py-3 bg-[#1a1a1a] text-white text-sm font-bold rounded-full hover:bg-black transition shadow-lg shadow-black/5 active:scale-[0.98]">
                {{ __('Save changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600 italic"
                >{{ __('Profile updated.') }}</p>
            @endif
        </div>
    </form>
</section>