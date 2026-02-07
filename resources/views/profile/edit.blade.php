<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<x-app-layout>
    <main class="max-w-3xl mx-auto pt-12 md:pt-20 px-5 md:px-6 pb-32" x-data="{ openDeleteModal: false }">
        <header class="mb-16 md:mb-24 mt-8 md:mt-12 px-1">
            <div class="flex flex-row items-start gap-8 md:gap-14">
                <div class="w-20 h-20 md:w-32 md:h-32 rounded-full bg-[#1a1a1a] flex-shrink-0 overflow-hidden shadow-2xl shadow-black/10 rotate-[-2deg]">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" class="w-full h-full object-cover grayscale">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-3xl md:text-5xl font-black text-white">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                
                <div class="flex-1">
                    <div class="flex flex-row items-center justify-between gap-4">
                        <h1 class="text-4xl md:text-5xl font-bold tracking-tighter text-[#1a1a1a]">Settings.</h1>
                        
                        <a href="{{ route('dashboard') }}" 
                           class="group flex items-center justify-center w-12 h-12 md:w-14 md:h-14 bg-[#1a1a1a] text-white rounded-2xl hover:bg-black hover:rotate-3 transition-all active:scale-95 shadow-xl shadow-black/5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>
                    </div>
                    <p class="text-gray-400 text-[15px] md:text-[17px] mt-4 font-medium leading-relaxed italic max-w-xl">
                        "Refine your sanctuary. Every change here reflects your handcrafted identity."
                    </p>
                </div>
            </div>
        </header>

        <div class="space-y-24">
            <section>
                <div class="flex items-center justify-between mb-12 border-b-2 border-gray-100 pb-4">
                    <h2 class="text-[11px] font-black tracking-[0.3em] text-gray-500 uppercase">Security Settings</h2>
                </div>

                <form method="post" action="{{ route('password.update') }}" class="space-y-12">
                    @csrf
                    @method('put')

                    <div class="space-y-10">
                        <div class="space-y-4">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-300 block">Current Password</label>
                            <input name="current_password" type="password" 
                                class="w-full bg-transparent border-b-2 border-gray-100 focus:border-black focus:outline-none py-3 text-2xl transition-all placeholder:text-gray-200"
                                placeholder="••••••••">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2" />
                        </div>

                        <div class="space-y-4">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-300 block">New Password</label>
                            <input name="password" type="password" 
                                class="w-full bg-transparent border-b-2 border-gray-100 focus:border-black focus:outline-none py-3 text-2xl transition-all placeholder:text-gray-200"
                                placeholder="••••••••">
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2" />
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="bg-[#1a1a1a] text-white px-10 py-4 rounded-full text-[12px] font-black uppercase tracking-widest hover:bg-black hover:scale-105 active:scale-95 transition-all shadow-xl shadow-black/10">
                            Update Password
                        </button>
                    </div>
                </form>
            </section>

            <section class="pt-12 border-t-2 border-gray-100">
                <div class="bg-red-50/50 rounded-[2.5rem] p-10 md:p-14 border border-red-100/50 text-center">
                    <h2 class="text-2xl font-bold tracking-tighter text-red-600 mb-2">Danger zone</h2>
                    <p class="text-red-900/60 text-[15px] mb-10 leading-relaxed font-medium max-w-md mx-auto">
                        Once you depart, all your handcrafted thoughts will be lost in the void forever.
                    </p>
                    
                    <button type="button" 
                            @click="openDeleteModal = true; document.body.style.overflow = 'hidden'"
                            class="text-[12px] font-black text-red-600 hover:text-red-700 transition-all uppercase tracking-[0.2em] underline underline-offset-8 decoration-2 decoration-red-200">
                        Delete account permanently
                    </button>
                </div>
            </section>
        </div>

        <template x-teleport="body">
            <div x-show="openDeleteModal" x-cloak class="fixed inset-0 z-[110] flex items-center justify-center p-4">
                <div x-show="openDeleteModal" 
                     @click="openDeleteModal = false; document.body.style.overflow = 'auto'" 
                     class="absolute inset-0 bg-white/90 backdrop-blur-sm"></div>
                
                <div x-show="openDeleteModal"
                     class="relative bg-white w-full max-w-md overflow-hidden rounded-[2.5rem] border border-gray-100 p-10 md:p-12 text-center shadow-2xl shadow-black/5">
                    
                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')
                        
                        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                        </div>

                        <h2 class="text-3xl font-bold tracking-tighter text-black mb-4">Depart?</h2>
                        <p class="text-gray-400 font-medium mb-10 text-[15px] leading-relaxed">
                            Sign with your password as a final confirmation to leave the sanctuary.
                        </p>

                        <div class="mb-10">
                            <input name="password" type="password" 
                                   class="block w-full py-3 border-b-2 border-gray-100 focus:border-red-500 outline-none transition-all text-2xl bg-transparent text-center placeholder:text-gray-200 font-bold" 
                                   placeholder="••••••••" required>
                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-4 text-[10px] font-black text-red-500 uppercase tracking-widest" />
                        </div>
                        
                        <div class="flex flex-col gap-4">
                            <button type="submit" class="w-full bg-red-600 text-white py-4 rounded-full font-bold text-[14px] uppercase tracking-widest hover:bg-red-700 transition-all active:scale-95 shadow-xl shadow-red-500/10">
                                Confirm Departure
                            </button>
                            <button type="button" 
                                    @click="openDeleteModal = false; document.body.style.overflow = 'auto'" 
                                    class="text-[12px] font-black text-gray-400 hover:text-black transition-all uppercase tracking-widest">
                                Stay in the sanctuary
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </main>
</x-app-layout>