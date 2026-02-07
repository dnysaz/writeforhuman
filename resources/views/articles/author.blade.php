@section('title', 'dwrite.me/@' . Str::lower($user->username))
@section('meta_description', 'dwrite.me is a dedicated digital space engineered to filter out synthetic noise, ensuring a pure and focused human reading experience.')

<x-home-layout>
    <main class="max-w-3xl mx-auto px-5 sm:px-8 pb-20 sm:pb-32">

        <header class="mb-16 md:mb-24 mt-8 md:mt-12 px-1">
            <div class="flex flex-row {{ !$user->show_stats ? 'items-center' : 'items-start' }} gap-8 md:gap-14">
                
                <div class="w-20 h-20 md:w-32 md:h-32 rounded-full bg-[#1a1a1a] flex-shrink-0 overflow-hidden shadow-2xl shadow-black/10 rotate-[-2deg]">
                    @if($user->avatar)
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full object-cover grayscale">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-3xl md:text-5xl font-black text-white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="group relative">
                            <div class="flex items-center gap-3">
                                <h1 class="text-2xl md:text-4xl font-black tracking-tighter text-[#1a1a1a] leading-none {{ ($user->show_bio || auth()->id() === $user->id) ? 'mb-3' : '' }}">
                                    {{ $user->name }}
                                </h1>
        
                                @auth
                                    @if(auth()->id() === $user->id)
                                        <a href="{{ route('profile.setting') }}" class="opacity-0 group-hover:opacity-100 transition-opacity p-2 hover:bg-gray-50 rounded-full text-gray-400 hover:text-black" title="Edit Profile">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                        </a>
                                    @endif
                                @endauth
                            </div>
                            
                            @if(($user->show_bio || auth()->id() === $user->id) && $user->url)
                                <a href="{{ $user->url }}" target="_blank" class="inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest text-black underline underline-offset-4 decoration-gray-200 hover:decoration-black transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                    {{ $user->url_name ?? 'Portfolio' }}
                                </a>
                            @endif
                        </div>
                    </div>
        
                    @if($user->show_stats || auth()->id() === $user->id)
                        <div class="relative group/stats">
                            <div class="flex gap-10 md:gap-16 py-6 border-y border-gray-50 mt-6 animate-in fade-in slide-in-from-top-1 duration-500">
                                <div class="flex flex-col">
                                    <span class="text-xl md:text-2xl font-black text-black">
                                        {{ $user->articles()->where('status', 'published')->count() }}
                                    </span>
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-300">Articles</span>
                                </div>
                            
                                <div class="flex flex-col">
                                    <span class="text-xl md:text-2xl font-black text-black">
                                        {{ number_format($totalAppreciations) }}
                                    </span> 
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-300">Likes</span>
                                </div>
                            
                                <a href="{{ route('articles.liked') }}" class="group flex flex-col">
                                    <span class="text-xl md:text-2xl font-black text-black group-hover:underline decoration-2 underline-offset-4 transition-all">
                                        {{ $user->likedArticles()->count() }}
                                    </span>
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-300 group-hover:text-black transition-colors">Liked</span>
                                </a>
                            </div>
        
                            @if(!$user->show_stats && auth()->id() === $user->id)
                                <div class="absolute -bottom-5 left-0 flex items-center gap-1.5 opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                    <span class="text-[9px] font-bold uppercase tracking-widest text-gray-400">Hidden for public</span>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        
            @if($user->show_bio || auth()->id() === $user->id)
                <div class="mt-10 max-w-2xl relative">
                    <p class="text-[15px] md:text-[18px] text-gray-600 leading-relaxed ">
                        {{ $user->bio ?? '"Every word typed here is a conscious choice. No AI, no shortcuts, just friction."' }}
                    </p>
        
                    @if(!$user->show_bio && auth()->id() === $user->id)
                        <div class="mt-2 flex items-center gap-1.5 opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                            <span class="text-[9px] font-bold uppercase tracking-widest text-gray-400">Bio Hidden from public</span>
                        </div>
                    @endif
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