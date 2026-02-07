<aside class="sidebar w-80 hidden md:flex"> 
    <div class="sidebar-handle"><div class="handle-bar"></div></div>

    <div class="px-2 h-full flex flex-col"> 
        <h2 class="text-[14px] font-black tracking-[0.2em] text-gray-400 mb-8">
            Journal archive
        </h2>
        
        <div class="space-y-12 overflow-y-auto pb-20 flex-1">
            
            <div>
                <h3 class="text-[14px] font-black tracking-widest text-gray-300 uppercase mb-4 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-800"></span>
                    Published
                </h3>
                <div class="space-y-1">
                    @forelse($articles->where('status', 'published') as $item)
                        <div class="group flex items-center justify-between py-2 px-3 rounded-xl {{ isset($article) && $article->id == $item->id ? 'bg-gray-50 border-gray-100' : 'border-transparent' }} hover:bg-gray-50 transition-all border hover:border-gray-100">
                            <a href="{{ route('articles.show', $item->slug) }}" 
                                target="_blank"
                                class="block text-[15px] font-semibold {{ isset($article) && $article->id == $item->id ? 'text-black' : 'text-gray-900' }} group-hover:text-black transition truncate flex-1 mr-4">
                                {{ Str::limit($item->title, 30, '...') }}
                            </a>
            
                            <div class="flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('articles.edit', $item->slug) }}" class="text-gray-300 hover:text-black transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-[12px] font-medium text-gray-300 px-3 italic">No public thoughts.</p>
                    @endforelse
                </div>
            </div>

            <div>
                <h3 class="text-[14px] font-black tracking-widest text-gray-300 uppercase mb-4 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-800"></span>
                    Drafts
                </h3>
                <div class="space-y-1">
                    @forelse($articles->where('status', 'draft') as $item)
                        <div class="group flex items-center justify-between py-2 px-3 rounded-xl {{ isset($article) && $article->id == $item->id ? 'bg-gray-50 border-gray-100' : 'border-transparent' }} hover:bg-gray-50 transition-all border hover:border-gray-100">
                            <span class="block text-[15px] font-semibold {{ isset($article) && $article->id == $item->id ? 'text-black' : 'text-gray-900' }} transition truncate flex-1 mr-4 cursor-default">
                                {{ Str::limit($item->title, 30, '...') }}
                            </span>
            
                            <div class="flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('articles.edit', $item->slug) }}" class="text-gray-300 hover:text-black transition-colors" title="Edit draft">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-[12px] font-medium text-gray-300 px-3 italic">Empty drafts.</p>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="py-6 border-t border-gray-50 bg-white">
            <a href="{{ route('dashboard') }}" class="text-[14px] font-black tracking-widest text-black hover:opacity-60 transition flex items-center gap-2">
                <span>+</span> New Article
            </a>
        </div>
    </div>
</aside>