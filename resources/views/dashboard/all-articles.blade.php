<x-app-layout>
    <main class="max-w-3xl mx-auto pt-12 md:pt-20 px-5 md:px-6 pb-32">
        <header class="mb-16 md:mb-20">
            <div class="flex items-center justify-between gap-4">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tighter text-[#1a1a1a]">Articles.</h1>
                
                <a href="{{ route('dashboard') }}" 
                   class="group flex items-center justify-center w-12 h-12 md:w-14 md:h-14 bg-[#1a1a1a] text-white rounded-2xl hover:bg-black hover:rotate-3 transition-all active:scale-95 shadow-xl shadow-black/5" 
                   title="Compose New Thought">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11l3 3" />
                    </svg>
                </a>
            </div>
        </header>

        <div class="space-y-10">
            <div class="flex items-center justify-between border-b-2 border-gray-100 pb-4">
                <h2 class="text-[11px] font-black tracking-[0.3em] text-gray-500">Entry History</h2>
                <span class="text-[10px] font-black text-gray-300 uppercase whitespace-nowrap">
                    Pg {{ $articles->currentPage() }} / {{ $articles->lastPage() }}
                </span>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse($articles as $item)
                    <div class="group py-8 transition-all">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                @if($item->status == 'published')
                                    <div class="flex items-center justify-between gap-3">
                                        <a href="{{ route('articles.show', $item->slug) }}" target="_blank" class="inline-block text-[21px] md:text-[23px] font-bold text-black underline decoration-gray-200 decoration-2 underline-offset-8 hover:decoration-black transition-all truncate max-w-full">
                                            {{ $item->title }}
                                        </a>
                                        
                                        <a href="{{ route('articles.edit', $item->slug) }}" class="flex-shrink-0 p-2 text-gray-400 hover:text-black transition-colors" title="Edit Thought">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="flex items-center flex-wrap gap-x-3 gap-y-2 mt-5">
                                        <span class="px-2 py-0.5 bg-green-50 text-green-700 text-[9px] font-black uppercase tracking-tighter rounded border border-green-100/50">Published</span>
                                        <span class="text-gray-200 font-bold hidden xs:inline">•</span>
                                        <span class="text-[11px] font-bold uppercase tracking-widest text-gray-400 italic">{{ $item->created_at->format('M d, Y') }}</span>
                                        <span class="text-gray-200 font-bold hidden xs:inline">•</span>
                                        <span class="text-[11px] font-bold uppercase tracking-widest text-gray-400">{{ $item->category }}</span>
                                    </div>
                                @else
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="block text-[21px] md:text-[23px] font-bold text-gray-300 cursor-default truncate italic underline decoration-gray-50 decoration-2 underline-offset-8 max-w-full">
                                            {{ $item->title ?? 'Untitled Thought' }}
                                        </span>
                                        
                                        <a href="{{ route('articles.edit', $item->slug) }}" class="flex-shrink-0 p-2 text-gray-400 hover:text-black transition-colors" title="Continue Writing">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="flex items-center flex-wrap gap-x-3 gap-y-2 mt-5">
                                        <span class="px-2 py-0.5 bg-gray-100 text-gray-400 text-[9px] font-black uppercase tracking-tighter rounded">Draft</span>
                                        <span class="text-gray-200 font-bold hidden xs:inline">•</span>
                                        <p class="text-[11px] font-bold uppercase tracking-widest text-gray-300">Touched {{ $item->updated_at->diffForHumans() }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-24 text-center">
                        <p class="text-[16px] text-gray-400 font-bold">The archive is currently empty.</p>
                        <a href="{{ route('dashboard') }}" class="mt-4 inline-block text-[12px] font-black uppercase tracking-widest text-black underline underline-offset-4 decoration-2">Create your first entry</a>
                    </div>
                @endforelse
            </div>

            @if ($articles->hasPages())
                <div class="mt-20 flex justify-center border-t-2 border-gray-100 pt-12">
                    <nav class="flex items-center gap-8 md:gap-12">
                        @if ($articles->onFirstPage())
                            <span class="text-[12px] font-black uppercase tracking-[0.3em] text-gray-200 cursor-not-allowed italic">Newer</span>
                        @else
                            <a href="{{ $articles->previousPageUrl() }}" class="text-[12px] font-black uppercase tracking-[0.3em] text-black hover:underline decoration-2 underline-offset-4 transition-all">Newer</a>
                        @endif

                        <span class="text-gray-200 font-bold text-lg">|</span>

                        @if ($articles->hasMorePages())
                            <a href="{{ $articles->nextPageUrl() }}" class="text-[12px] font-black uppercase tracking-[0.3em] text-black hover:underline decoration-2 underline-offset-4 transition-all">Older</a>
                        @else
                            <span class="text-[12px] font-black uppercase tracking-[0.3em] text-gray-200 cursor-not-allowed italic">Older</span>
                        @endif
                    </nav>
                </div>
            @endif
        </div>
    </main>
</x-app-layout>