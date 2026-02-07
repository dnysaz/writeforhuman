<x-home-layout>
    <main class="max-w-7xl mx-auto px-6 md:px-12 pb-32">    
        <header class="hidden py-20 mb-20 border-b border-gray-100 md:flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="max-w-3xl">
                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter mb-4 text-[#1a1a1a]">
                    Handcrafted thoughts
                </h1>
                <p class="text-xl md:text-2xl text-gray-500 font-light leading-relaxed tracking-tight">
                    Exploring the depth of human experience, <br class="hidden md:block"> one character at a time.
                </p>
            </div>
            <div class="text-left md:text-right">
                <span class="text-6xl md:text-7xl font-bold tracking-tighter text-gray-100 block leading-none">
                    {{ $articles->total() }}
                </span>
                <span class="text-sm font-bold text-gray-400 tracking-tight">Total entries</span>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-20">
            @forelse($articles as $article)
                <article class="group flex flex-col h-full">
                    <div class="flex items-center justify-between mb-6">
                        <time class="text-sm font-semibold text-gray-400">
                            {{ $article->created_at->format('M d, Y') }}
                        </time>
                        <span class="text-[11px] font-bold text-gray-500 px-2 py-0.5 border border-gray-100 rounded">
                            <a href="{{ route('articles.category', $article->category) }}">{{ $article->category }}</a>
                        </span>
                    </div>

                    <div class="flex-grow space-y-4">
                        <a href="{{ route('articles.show', $article->slug) }}" class="block">
                            <h2 class="text-2xl md:text-3xl font-bold leading-tight text-[#1a1a1a] group-hover:underline decoration-2 underline-offset-4 transition-all">
                                {{ $article->title }}
                            </h2>
                        </a>
                        
                        <p class="text-gray-500 text-[17px] leading-relaxed line-clamp-4 font-light">
                            {{ Str::limit(strip_tags($article->content), 180) }}
                        </p>
                    </div>

                    <div class="pt-8 mt-auto flex items-center gap-3 border-t border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-[#1a1a1a] flex items-center justify-center text-[10px] font-bold text-white overflow-hidden">
                            @if($article->user->avatar)
                                <img src="{{ $article->user->avatar }}" class="w-full h-full object-cover">
                            @else
                                <span>{{ strtoupper(substr($article->user->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <a href="{{ url('/@' . $article->user->username) }}" class="text-[14px] font-bold text-gray-500 hover:text-black hover:underline transition-all">
                            {{ $article->user->name }}
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-32 text-center bg-gray-50 rounded-[40px] border border-dashed border-gray-200">
                    <p class="text-2xl text-gray-300 font-light">The archive is currently quiet.</p>
                </div>
            @endforelse
        </div>
    
        <div class="mt-32 pt-12 border-t border-gray-100 flex justify-center font-bold">
            {{ $articles->links() }}
        </div>
    </main>    
</x-home-layout>