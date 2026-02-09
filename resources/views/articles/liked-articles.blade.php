@section('title', 'Liked articles | dwrite.me')
@section('meta_description', 'dwrite.me is a dedicated digital space engineered to filter out synthetic noise, ensuring a pure and focused human reading experience.')

<x-home-layout>
    <main class="max-w-7xl mx-auto px-6 md:px-12 pb-32">    
        <header class="hidden py-20 mb-20 border-b border-gray-100 md:flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="max-w-3xl">
                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter mb-4 text-[#1a1a1a]">
                    Liked Articles
                </h1>
                <p class="text-xl md:text-2xl text-gray-500 font-light leading-relaxed tracking-tight ">
                    Thoughts that echoed within your nervous system, <br class="hidden md:block"> preserved for deeper reflection.
                </p>
            </div>
            <div class="text-left md:text-right">
                <span class="text-6xl md:text-7xl font-bold tracking-tighter text-gray-100 block leading-none">
                    {{ $articles->total() }}
                </span>
                <span class="text-sm font-bold text-gray-400 tracking-tight">Appreciations</span>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-20">
            @forelse($articles as $article)
                <article class="group flex flex-col h-full">
                    <div class="flex items-center justify-between mb-6">
                        <time class="text-sm font-semibold text-gray-400">
                            {{ $article->created_at->format('M d, Y') }}
                        </time>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-700 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[11px] font-bold text-gray-500 px-2 py-0.5 border border-gray-100 rounded uppercase tracking-widest">
                                <a href="{{ route('articles.category', $article->category) }}">{{ $article->category }}</a>
                            </span>
                        </div>
                    </div>

                    <div class="flex-grow space-y-4">
                        <a href="{{ route('articles.show', $article->slug) }}" class="block">
                            <h2 class="text-2xl md:text-3xl font-bold leading-tight text-[#1a1a1a] group-hover:underline decoration-2 underline-offset-4 transition-all">
                                {{ $article->title }}
                            </h2>
                        </a>
                        
                        <p class="text-gray-500 text-[17px] leading-relaxed line-clamp-4 font-light ">
                            {{ Str::limit(strip_tags(html_entity_decode($article->content)), 180) }}
                        </p>
                    </div>

                    <div class="pt-8 mt-auto flex items-center justify-between border-t border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#1a1a1a] flex items-center justify-center text-[10px] font-bold text-white overflow-hidden shadow-sm">
                                @if($article->user->avatar)
                                    <img src="{{ $article->user->avatar }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all">
                                @else
                                    <span>{{ strtoupper(substr($article->user->name, 0, 1)) }}</span>
                                @endif
                            </div>
                            <a href="{{ url('/@' . $article->user->username) }}" class="text-[14px] font-bold text-gray-500 hover:text-black hover:underline transition-all">
                                {{ $article->user->name }}
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-40 text-center bg-gray-50 rounded-[40px] border border-dashed border-gray-100 flex flex-col items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-200 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <p class="text-xl text-gray-400 font-light ">You haven't preserved any resonances yet.</p>
                    <a href="{{ route('home') }}" class="mt-6 text-[12px] font-black uppercase tracking-widest text-black underline underline-offset-8">Explore thoughts</a>
                </div>
            @endforelse
        </div>
    
        <div class="mt-32 pt-12 border-t border-gray-100 flex justify-center font-bold">
            {{ $articles->links() }}
        </div>
    </main>    
</x-home-layout>