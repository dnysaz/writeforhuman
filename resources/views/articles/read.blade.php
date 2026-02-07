<x-home-layout>
    <style>
        /* Styling Link di Dalam Artikel */
        #articleContent a {
            color: #2563eb !important; /* Blue-600 */
            text-decoration: underline !important;
            font-weight: 400;
        }

        /* Styling Preview Card */
        .link-preview-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border: 1px solid #f1f5f9;
            border-radius: 1rem;
            margin-top: 1.5rem;
            text-decoration: none !important;
            transition: all 0.2s ease;
        }
        .link-preview-card:hover {
            background: #ffffff;
            border-color: #e2e8f0;
        }
        .preview-image {
            width: 80px;
            height: 80px;
            object-cover: cover;
            border-radius: 0.5rem;
            background: #f1f5f9;
        }
    </style>

    <main class="max-w-3xl mx-auto px-4 md:px-0 pb-24">
        <div class="flex flex-col gap-6 mb-12">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-3">
                    <div class="px-4 py-1.5 bg-gray-50 border border-gray-100 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 rounded-full">
                        <a href="{{ route('articles.category', $article->category) }}">{{ $article->category }}</a>
                    </div>
                    <span class="text-gray-200 text-xs font-light">|</span>
                    <span id="readDuration" class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Calculating...</span>
                </div>
                
                @auth
                    @if(Auth::id() == $article->user_id)
                        <a href="{{ route('articles.edit', $article->slug) }}" 
                            class="group flex items-center justify-center gap-2 w-20 h-7 bg-[#1a1a1a] text-white rounded-2xl hover:bg-black hover:rotate-3 transition-all active:scale-95 shadow-xl shadow-black/5" 
                            title="Edit this thought">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11l3 3" />
                            </svg> 
                            <span class="text-[10px] font-black uppercase tracking-widest">Edit</span>
                        </a>
                    @endif
                @endauth
            </div>
        
            <div class="text-[14px] font-medium text-gray-400 flex items-center flex-wrap gap-x-4 gap-y-2">
                <span>By 
                    <a href="{{ url('/@' . $article->user->username) }}" class="text-black font-bold hover:underline transition-all decoration-gray-200 underline-offset-4">
                        {{ $article->user->name }}
                    </a>
                </span>            
                
                <span class="text-gray-200">•</span>
                
                <span>{{ number_format($article->word_count) }} words</span>
                
                <span class="text-gray-200">•</span>
                
                <time>{{ $article->created_at->format('F j, Y') }}</time>
                
                <span class="text-gray-200">•</span>
        
                <div class="inline-flex items-center">
                    <form action="{{ route('articles.like', $article->slug) }}" method="POST" class="flex items-center">
                        @csrf
                        @php
                            $isLiked = auth()->check() && $article->likes()->where('user_id', auth()->id())->exists();
                            $likeCount = $article->likes()->count();
                        @endphp
                        
                        <button type="submit" 
                            class="group flex items-center gap-1.5 transition-all active:scale-90 focus:outline-none"
                            title="{{ $isLiked ? 'Unlike' : 'Like' }}">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="h-4 w-4 transition-all {{ $isLiked ? 'fill-black stroke-black' : 'fill-none stroke-gray-300 group-hover:stroke-black' }}" 
                                 viewBox="0 0 24 24" 
                                 stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                
                            <span class="text-[13px] font-bold {{ $isLiked ? 'text-black' : 'text-gray-400 group-hover:text-black' }}">
                                {{ number_format($likeCount) }}
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if($article->cover_image)
            <div class="relative w-full h-[150px] md:h-[240px] overflow-hidden rounded-[1rem] mb-8 group">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-black/5 z-10 pointer-events-none"></div>
                <img src="https://res.cloudinary.com/dmnble1qr/image/upload/q_auto,f_auto/{{ $article->cover_image }}.jpg" 
                    alt="Visual Vibe"
                    class="w-full h-full object-cover grayscale transition-all duration-[1.5s] ease-out group-hover:grayscale-0 group-hover:scale-105">
                
                <div class="absolute bottom-6 right-8 z-20 flex gap-1.5 px-3 py-2 bg-black/10 backdrop-blur-md rounded-full border border-white/10">
                    @for($i=1; $i<=3; $i++)
                        <div class="w-1 h-1 rounded-full {{ ($article->cover_image == str_pad($i, 3, '0', STR_PAD_LEFT)) ? 'bg-white' : 'bg-white/30' }}"></div>
                    @endfor
                </div>
            </div>
        @endif

        <h1 class="text-4xl md:text-6xl font-bold mb-14 tracking-[-0.04em] leading-[0.95] text-[#1a1a1a]">
            {{ $article->title }}
        </h1>

        <div id="articleContent" class="text-[20px] md:text-[22px] text-[#1a1a1a] leading-[1.6] font-light tracking-tight article-content italic-quotes">
            {!! $article->content !!}
        </div>

        <div id="linkPreviewContainer" class="mt-12 space-y-4"></div>

        <div class="mt-24 pt-12 border-t border-gray-100">
            <p class="mt-6 text-gray-500 text-sm font-light italic leading-relaxed">
                This thought was processed through a human nervous system and typed manually. No generative AI, no paste shortcuts.
            </p>
        </div>
    </main>

    <section class="max-w-3xl px-4 md:px-0 mx-auto pb-36">
        <div class="flex items-center justify-between mb-16">
            <h3 class="text-3xl font-bold tracking-tighter text-black">Responses <span class="text-gray-300 font-light ml-2">{{ $article->comments->count() }}</span></h3>
        </div>

        @auth
            <div class="mb-20 bg-white rounded-[2.5rem] p-8 md:p-12 border border-gray-100">
                <form action="{{ route('comments.store', $article->id) }}" method="POST" id="commentForm">
                    @csrf
                    <textarea 
                        id="commentInput" 
                        name="body" 
                        rows="4" 
                        class="w-full bg-transparent text-[19px] font-light border-b border-gray-100 focus:border-black focus:outline-none py-6 resize-none transition-all placeholder:text-gray-300" 
                        placeholder="What are your handcrafted thoughts?"></textarea>
                    
                    <div class="flex items-center justify-between mt-8">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-300">Handcrafted response</span>
                        <button type="submit" class="bg-black text-white px-10 py-3.5 rounded-full text-sm font-black uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-xl shadow-black/10">
                            Respond
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="mb-20 bg-gray-50 rounded-[2.5rem] p-10 md:p-16 border border-dashed border-gray-200 text-center">
                <div class="max-w-sm mx-auto">
                    <p class="text-gray-500 text-[14px] font-medium leading-relaxed">
                        Every thought deserves a handcrafted response. Please <a href="{{ route('login') }}" class="underline">Sign In</a> to share yours.
                    </p>
                </div>
            </div>
        @endauth

        <div class="space-y-16" id="commentsList">
            @forelse($article->comments as $comment)
                <div class="group relative">
                    <div class="flex items-center gap-5 mb-6">
                        <div class="w-12 h-12 rounded-full bg-black flex items-center justify-center border border-gray-100 overflow-hidden shadow-sm text-white">
                            @if($comment->user->avatar)
                                <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->name }}" class="w-full h-full object-cover grayscale transition-all duration-500">
                            @else
                                <span>{{ strtoupper(substr($comment->user->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div>
                            <a href="{{ url('/@' . $comment->user->username) }}" class="text-[16px] font-bold text-black hover:underline transition">
                                {{ $comment->user->name }}
                            </a>
                            <span class="block text-[11px] text-gray-400 font-black uppercase tracking-widest mt-1">
                                {{ $comment->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    <div class="md:pl-16 font-light text-[18px] text-[#444] leading-relaxed italic-quotes">
                        {{ $comment->body }}
                    </div>
                </div>
            @empty
                <p class="text-center py-20 text-gray-300 font-medium tracking-tight">This space is waiting for your handcrafted thoughts.</p>
            @endforelse
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const contentArea = document.getElementById('articleContent');
            const previewContainer = document.getElementById('linkPreviewContainer');
            const urlRegex = /(https?:\/\/[^\s<]+)/g;

            // 1. Auto-linker & Styling (Blue-600)
            let rawHtml = contentArea.innerHTML;
            contentArea.innerHTML = rawHtml.replace(urlRegex, (url) => {
                const cleanUrl = url.replace(/[.,]$/, "");
                return `<a href="${cleanUrl}" target="_blank" rel="noopener">${cleanUrl}</a>`;
            });

            // 2. Link Preview dengan Gambar (Microlink API)
            const foundLinks = contentArea.innerText.match(urlRegex);
            if (foundLinks) {
                const uniqueLinks = [...new Set(foundLinks)];
                uniqueLinks.forEach(async (url) => {
                    const cleanUrl = url.replace(/[.,]$/, "");
                    try {
                        const response = await fetch(`https://api.microlink.io?url=${encodeURIComponent(cleanUrl)}`);
                        const data = await response.json();
                        
                        if (data.status === 'success') {
                            const metadata = data.data;
                            const card = `
                                <a href="${cleanUrl}" target="_blank" class="link-preview-card">
                                    ${metadata.image ? `<img src="${metadata.image.url}" class="preview-image" alt="preview">` : `<div class="preview-image flex items-center justify-center bg-gray-100"><svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg></div>`}
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-black truncate">${metadata.title || cleanUrl}</h4>
                                        <p class="text-xs text-gray-400 truncate mt-1">${metadata.description || 'No description available'}</p>
                                        <p class="text-[9px] font-black uppercase tracking-widest text-blue-600 mt-2">${new URL(cleanUrl).hostname}</p>
                                    </div>
                                </a>
                            `;
                            previewContainer.insertAdjacentHTML('beforeend', card);
                        }
                    } catch (e) { console.error("Preview failed for", cleanUrl); }
                });
            }

            // 3. Hitung Durasi Baca
            const words = contentArea.innerText.trim().split(/\s+/).length;
            const duration = Math.ceil(words / 225);
            document.getElementById('readDuration').innerText = `${duration} min read`;
        });
    </script>
</x-home-layout>