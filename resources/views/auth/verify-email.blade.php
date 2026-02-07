<x-guest-layout>
    <header class="mb-10">
        <h1 class="text-4xl font-bold tracking-tighter text-[#1a1a1a] mb-3">
            almost there.
        </h1>
        <div class="h-1 w-12 bg-[#1a1a1a] mb-4"></div>
        <p class="text-gray-500 font-light italic text-[16px] leading-relaxed">
            {{ __('Thanks for joining. Please verify your email by clicking the link we just sent. It is the final key to your focus.') }}
        </p>
    </header>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-8 text-sm font-bold text-green-600 bg-green-50 p-4 rounded-xl border-l-4 border-green-500">
            {{ __('A new verification link has been delivered to your inbox.') }}
        </div>
    @endif

    <div class="space-y-6">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-[#1a1a1a] text-white py-4 rounded-full font-bold hover:bg-black transition-all shadow-lg shadow-black/5 active:scale-[0.98]">
                {{ __('Resend verification email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center lg:text-left">
            @csrf
            <button type="submit" class="text-[13px] font-bold text-gray-400 hover:text-red-500 hover:underline transition-all">
                {{ __('Log out') }}
            </button>
        </form>
    </div>
</x-guest-layout>