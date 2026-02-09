@section('title', 'dwrite.me/@' . Str::lower($user->username))
@section('meta_description', 'dwrite.me is a dedicated digital space engineered to filter out synthetic noise, ensuring a pure and focused human reading experience.')

<x-home-layout>
    <main class="max-w-3xl mx-auto px-5 sm:px-8 pb-20 sm:pb-32">

        <header class="mb-12 mt-8 px-4 md:px-0 flex flex-col items-center md:items-start text-center md:text-left">
    
            <div class="w-full flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">
                
                <div class="relative flex-shrink-0">
                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-full bg-[#1a1a1a] overflow-hidden shadow-2xl shadow-black/10 transition-transform duration-500 hover:scale-105">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover grayscale">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-4xl md:text-6xl font-black text-white/90">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="absolute -top-1 -right-1 md:hidden" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="p-2 bg-white rounded-full shadow-lg border border-gray-100 text-gray-400 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                        </button>
                        <div x-show="open" x-transition.opacity class="absolute right-0 md:left-0 md:right-auto mt-2 w-44 bg-white border border-gray-100 rounded-xl shadow-2xl z-50 overflow-hidden text-left">
                            <button onclick="navigator.share({ title: '{{ $user->name }}', url: window.location.href })" class="w-full flex items-center gap-3 px-4 py-3 text-[10px] font-black  text-gray-600 hover:bg-gray-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                <span>Share Profile</span>
                            </button>
                        
                            @auth @if(auth()->id() === $user->id)
                                <a href="{{ route('profile.setting') }}" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black  text-gray-600 hover:bg-gray-50 border-t border-gray-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Update Profile</span>
                                </a>
                            @endif @endauth
                        </div>
                    </div>
                </div>
        
                <div class="flex-1 flex flex-col items-center md:items-start w-full">
                    <div class="flex items-center gap-4 justify-center md:justify-start">
                        <h1 class="text-3xl md:text-5xl font-black tracking-tighter text-black leading-none">
                            {{ $user->name }}
                        </h1>
        
                        <div class="hidden md:block relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" class="p-1 text-gray-300 hover:text-black transition-colors focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                            </button>
                            <div x-show="open" x-transition.opacity class="absolute right-0 md:left-0 md:right-auto mt-2 w-44 bg-white border border-gray-100 rounded-xl shadow-2xl z-50 overflow-hidden text-left">
                                <button onclick="navigator.share({ title: '{{ $user->name }}', url: window.location.href })" class="w-full flex items-center gap-3 px-4 py-3 text-[10px] font-black  text-gray-600 hover:bg-gray-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                    <span>Share Profile</span>
                                </button>
                            
                                @auth @if(auth()->id() === $user->id)
                                    <a href="{{ route('profile.setting') }}" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black text-gray-600 hover:bg-gray-50 border-t border-gray-50 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span>Update Profile</span>
                                    </a>
                                @endif @endauth
                            </div>
                        </div>
                    </div>
        
                    @if(($user->show_bio || auth()->id() === $user->id) && $user->url)
                        <a href="{{ $user->url }}" target="_blank" class="text-[14px] underline font-bold text-gray-400 hover:text-black transition-colors mt-4">
                            {{ str_replace(['http://', 'https://'], '', $user->url) }}
                        </a>
                    @endif
        
                    @if($user->show_stats || auth()->id() === $user->id)
                        <div class="flex items-center justify-center md:justify-start gap-8 md:gap-12 mt-6">
                            <div class="flex flex-col">
                                <span class="text-xl md:text-2xl font-black text-black leading-none">{{ $user->articles()->where('status', 'published')->count() }}</span>
                                <span class="text-[9px] font-bold   text-gray-300 mt-2">Posts</span>
                            </div>
                            <div class="flex flex-col border-x border-gray-50 px-8 md:px-0 md:border-none">
                                <span class="text-xl md:text-2xl font-black text-black leading-none">{{ number_format($totalAppreciations) }}</span>
                                <span class="text-[9px] font-bold   text-gray-300 mt-2">Likes</span>
                            </div>
                            <a href="{{ route('articles.liked') }}" class="flex flex-col group">
                                <span class="text-xl md:text-2xl font-black text-black leading-none group-hover:underline decoration-2 underline-offset-4 transition-all">{{ $user->likedArticles()->count() }}</span>
                                <span class="text-[9px] font-bold   text-gray-300 group-hover:text-black mt-2">Saved</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        
            @if($user->show_bio || auth()->id() === $user->id)
                <div class="mt-10 max-w-2xl w-full">
                    <p class="text-[15px] md:text-[18px] text-gray-500 font-medium leading-relaxed italic md:not-italic">
                        {{ $user->bio ?? '"This space is yours. Tell the world who is behind these thoughts."' }}
                    </p>
                </div>
            @endif
        </header>

        <div class="space-y-12 sm:space-y-20">
            <h3 class="text-[14px] font-bold border-b border-gray-100 pb-4 sm:pb-6 tracking-tight text-gray-400">Recent publications</h3>
            
            <div class="grid gap-12 sm:gap-16">
                @forelse($articles as $article)
                    <article class="group relative">
                        <div class="flex flex-col space-y-3 sm:space-y-4">
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-gray-400">
                                <time>{{ $article->created_at->format('F j, Y') }}</time>
                                <span class="w-1 h-1 bg-gray-200 rounded-full"></span>
                                <span id="read-time-{{ $article->id }}">Calculating...</span>
                            </div>
                            
                            <a href="{{ route('articles.show', $article->slug) }}" class="block">
                                <h2 class="text-2xl sm:text-3xl font-semibold leading-snug text-[#1a1a1a] group-hover:underline decoration-2 underline-offset-4 transition-all">
                                    {{ $article->title }}
                                </h2>
                            </a>
                            
                            <p class="text-gray-600 text-base sm:text-lg leading-relaxed line-clamp-2 font-light">
                                {{ Str::limit(strip_tags($article->content), 180) }}
                            </p>

                            <div class="pt-1">
                                <a href="{{ route('articles.show', $article->slug) }}" class="text-xs sm:text-sm font-bold tracking-tight text-gray-900 hover:underline transition-all">
                                    Read entry
                                </a>
                            </div>
                        </div>
                        
                        <div id="content-{{ $article->id }}" class="hidden">{{ strip_tags($article->content) }}</div>
                    </article>
                @empty
                    <div class="py-16 sm:py-20 text-center bg-gray-50 rounded-2xl sm:rounded-3xl border border-dashed border-gray-200">
                        <p class="text-gray-400 font-medium text-base sm:text-lg ">No entries published yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mt-16 sm:mt-24 pt-8 sm:pt-12 border-t border-gray-100 flex justify-center">
            {{ $articles->links() }}
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const articles = document.querySelectorAll('[id^="content-"]');
            articles.forEach(article => {
                const id = article.id.replace('content-', '');
                const text = article.innerText;
                const wpm = 200;
                const words = text.trim().split(/\s+/).length;
                const time = Math.ceil(words / wpm);
                document.getElementById(`read-time-${id}`).innerText = `${time} min read`;
            });
        });
    </script>
</x-home-layout>