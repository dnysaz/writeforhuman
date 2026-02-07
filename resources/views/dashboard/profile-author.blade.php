<x-app-layout>
    <main class="max-w-3xl mx-auto pt-12 md:pt-20 px-5 md:px-6 pb-32">
        <header class="mb-16 md:mb-20">
            <div class="flex items-center justify-between gap-4">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tighter text-[#1a1a1a]">Profile.</h1>
                
                <a href="{{ route('dashboard') }}" 
                   class="group flex items-center justify-center w-12 h-12 md:w-14 md:h-14 bg-[#1a1a1a] text-white rounded-2xl hover:bg-black hover:rotate-3 transition-all active:scale-95 shadow-xl shadow-black/5" 
                   title="Back to Dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
            </div>
        </header>

        <div class="space-y-12">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8 pb-12 border-b-2 border-gray-100">
                <div class="w-24 h-24 md:w-32 md:h-32 bg-[#1a1a1a] rounded-full flex items-center justify-center shadow-2xl shadow-black/10">
                    <span class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter">
                        {{ substr($user->name, 0, 1) }}
                    </span>
                </div>

                <div class="flex-1 text-center md:text-left">
                    <h2 class="text-3xl font-bold tracking-tighter text-black mb-2">{{ $user->name }}</h2>
                    <p class="text-gray-400 text-[16px] leading-relaxed font-medium mb-6 italic max-w-xl">
                        {{ $user->bio ?? 'No bio written yet. Share a bit about your journey.' }}
                    </p>
                </div>
            </div>

            <div class="pt-8">
                <form action="{{ route('profile.setting.update') }}" method="POST" class="space-y-16">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-8">
                        <h2 class="text-[11px] font-black tracking-[0.3em] text-gray-500 uppercase">Privacy & Visibility</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <label class="flex items-center justify-between p-6 rounded-3xl border-2 border-gray-50 hover:border-gray-100 transition-all cursor-pointer group">
                                <div class="flex flex-col gap-1">
                                    <span class="text-sm font-black uppercase tracking-widest text-[#1a1a1a]">Show Statistics</span>
                                    <span class="text-[11px] text-gray-400 font-medium">Articles count, likes, and saved entries.</span>
                                </div>
                                <div class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="show_stats" value="1" class="sr-only peer" {{ $user->show_stats ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-100 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-black"></div>
                                </div>
                            </label>

                            <label class="flex items-center justify-between p-6 rounded-3xl border-2 border-gray-50 hover:border-gray-100 transition-all cursor-pointer group">
                                <div class="flex flex-col gap-1">
                                    <span class="text-sm font-black uppercase tracking-widest text-[#1a1a1a]">Show Bio & URL</span>
                                    <span class="text-[11px] text-gray-400 font-medium">Display your story and portfolio link.</span>
                                </div>
                                <div class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="show_bio" value="1" class="sr-only peer" {{ $user->show_bio ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-100 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-black"></div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-10">
                        <h2 class="text-[11px] font-black tracking-[0.3em] text-gray-500 uppercase">Identity Details</h2>
                        
                        <div class="space-y-4">
                            <label class="text-[14px] font-black uppercase tracking-[0.2em] text-gray-300 block">Author Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                class="w-full bg-transparent border-b-2 border-gray-100 focus:border-black focus:outline-none py-3 text-xl font-semibold transition-all placeholder:text-gray-200"
                                placeholder="Your display name">
                            @error('name') <span class="text-red-500 text-[10px] font-bold uppercase tracking-widest">{{ $message }}</span> @enderror
                        </div>
                
                        <div class="space-y-4">
                            <label class="text-[14px] font-black uppercase tracking-[0.2em] text-gray-300 block">Short Bio</label>
                            <textarea name="bio" rows="3" 
                                class="w-full bg-transparent border-b-2 border-gray-100 focus:border-black focus:outline-none py-3 text-lg font-medium resize-none transition-all placeholder:text-gray-200"
                                placeholder="Share a piece of your mind...">{{ old('bio', $user->bio) }}</textarea>
                        </div>
                
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <div class="space-y-4">
                                <label class="text-[14px] font-black uppercase tracking-[0.2em] text-gray-300 block">Link Label</label>
                                <input type="text" name="url_name" value="{{ old('url_name', $user->url_name) }}" 
                                    class="w-full bg-transparent border-b-2 border-gray-100 focus:border-black focus:outline-none py-3 text-[15px] font-medium transition-all placeholder:text-gray-200"
                                    placeholder="e.g. My Portfolio">
                            </div>
                
                            <div class="space-y-4">
                                <label class="text-[14px] font-black uppercase tracking-[0.2em] text-gray-300 block">Destination URL</label>
                                <input type="text" name="url" value="{{ old('url', $user->url) }}" 
                                    class="w-full bg-transparent border-b-2 border-gray-100 focus:border-black focus:outline-none py-3 text-[15px] font-medium transition-all placeholder:text-gray-200"
                                    placeholder="https://...">
                            </div>
                        </div>
                    </div>

                    <div class="pt-10">
                        <button type="submit" class="bg-[#1a1a1a] text-white px-10 py-4 rounded-full text-[14px] font-black uppercase tracking-widest hover:bg-black hover:scale-105 active:scale-95 transition-all shadow-xl shadow-black/10">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>