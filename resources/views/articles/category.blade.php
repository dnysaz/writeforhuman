@section('title', 'category | dwrite.me')
@section('meta_description', 'dwrite.me is a dedicated digital space engineered to filter out synthetic noise, ensuring a pure and focused human reading experience.')
<x-home-layout>
    <main class="max-w-7xl mx-auto px-6 md:px-12 pb-32">    
        <header class="hidden py-20 mb-20 border-b border-gray-100 md:flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="max-w-3xl">
                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter mb-4 text-[#1a1a1a]">
                    Category.
                </h1>
                <p class="text-xl md:text-2xl text-gray-500 font-light leading-relaxed tracking-tight italic">
                    Exploring thoughts preserved under the <span class="text-black font-bold">{{ $category }}</span> archive.
                </p>
            </div>
            <div class="text-left md:text-right">
                <span class="text-6xl md:text-7xl font-bold tracking-tighter text-gray-100 block leading-none">
                    {{ $articles->total() }}
                </span>
                <span class="text-sm font-bold text-gray-400 tracking-tight">Entries found</span>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-20">
            @forelse($articles as $article)
                <article class="group flex flex-col h-full">
                    <div class="flex items-center justify-between mb-6">
                        <time class="text-sm font-semibold text-gray-400">
                            {{ $article->created_at->format('M d, Y') }}
                        </time>
                        <span class="text-[11px] font-bold text-gray-400 px-2 py-0.5 border border-gray-100 rounded uppercase tracking-widest">
                            <a href="{{ route('articles.category', $article->category) }}">{{ $article->category }}</a>
                        </span>
                    </div>

                    <div class="flex-grow space-y-4">
                        <a href="{{ route('articles.show', $article->slug) }}" class="block">
                            <h2 class="text-2xl md:text-3xl font-bold leading-tight text-[#1a1a1a] group-hover:underline decoration-2 underline-offset-4 transition-all">
                                {{ $article->title }}
                            </h2>
                        </a>
                        
                        <p class="text-gray-500 text-[17px] leading-relaxed line-clamp-4 font-light italic">
                            {{ Str::limit(strip_tags($article->content), 180) }}
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
                        
                        <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">
                            {{ $article->reading_time }} min read
                        </span>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-40 text-center bg-gray-50 rounded-[40px] border border-dashed border-gray-100 flex flex-col items-center justify-center">
                    <p class="text-xl text-gray-400 font-light italic">No thoughts have been shared in this category yet.</p>
                    <a href="{{ route('home') }}" class="mt-6 text-[12px] font-black uppercase tracking-widest text-black underline underline-offset-8">Back to home</a>
                </div>
            @endforelse
        </div>
    
        <div class="mt-32 pt-12 border-t border-gray-100 flex justify-center font-bold">
            {{ $articles->links() }}
        </div>
    </main>    
</x-home-layout>