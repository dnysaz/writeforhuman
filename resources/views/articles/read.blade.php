
@section('title', 'dwrite.me | '. $article->title)
@section('meta_description', str($article->content)->stripTags()->limit(100))
@section('og_image', asset('https://res.cloudinary.com/dmnble1qr/image/upload/q_auto,f_auto/' .$article->cover_image))

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
        <div class="flex flex-col gap-4 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 flex-wrap">
                    <div class="flex items-center gap-3">
                        <a href="{{ url('/@' . $article->user->username) }}" class="group flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-[#1a1a1a] flex items-center justify-center text-[12px] font-bold text-white overflow-hidden border border-gray-100 transition-transform group-hover:scale-105">
                                @if($article->user->avatar)
                                    <img src="{{ asset('storage/' . $article->user->avatar) }}" class="w-full h-full object-cover">
                                @else
                                    <span>{{ strtoupper(substr($article->user->name, 0, 1)) }}</span>
                                @endif
                            </div>
                        </a>
                    
                        <div class="flex flex-col justify-center">
                            <a href="{{ url('/@' . $article->user->username) }}" class="group">
                                <h3 class="text-[14px] font-bold text-black leading-tight group-hover:underline decoration-gray-200 underline-offset-4">
                                    {{ $article->user->name }}
                                </h3>
                                <p class="text-[11px] text-gray-400 font-medium tracking-tight">
                                    @<span>{{ $article->user->username }}</span>
                                </p>
                            </a>
                        </div>
                    </div>
                    <span class="text-gray-200 text-xs">|</span>
                    <a href="{{ route('articles.category', $article->category) }}" class="text-[10px] font-black uppercase tracking-wider text-gray-500 bg-gray-50 px-2 py-0.5 border border-gray-100 rounded">
                        {{ $article->category }}
                    </a>
                    <span class="text-gray-200 text-xs">|</span>
                    <div class="flex items-center gap-1 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span id="readDuration" class="text-[10px] font-bold uppercase tracking-tight">Calc...</span>
                    </div>
                </div>
        
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="p-1 hover:bg-gray-100 rounded-full transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>
        
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         class="absolute right-0 mt-2 w-32 bg-white border border-gray-100 rounded-xl shadow-xl z-50 overflow-hidden">
                        
                        @auth
                            @if(Auth::id() == $article->user_id)
                                <a href="{{ route('articles.edit', $article->slug) }}" class="flex items-center gap-2 px-4 py-2.5 text-[11px] font-bold uppercase tracking-widest text-gray-700 hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Edit
                                </a>
                            @endif
                        @endauth
        
                        <button onclick="navigator.share({ title: '{{ $article->title }}', url: window.location.href })" class="w-full flex items-center gap-2 px-4 py-2.5 text-[11px] font-bold uppercase tracking-widest text-gray-700 hover:bg-gray-50 border-t border-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            Share
                        </button>
                    </div>
                </div>
            </div>
        
            <div class="flex items-center gap-4 text-gray-400">
                <form action="{{ route('articles.like', $article->slug) }}" method="POST" class="inline-flex items-center">
                    @csrf
                    @php
                        $isLiked = auth()->check() && $article->likes()->where('user_id', auth()->id())->exists();
                    @endphp
                    <button type="submit" class="flex items-center gap-1 hover:text-black transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $isLiked ? 'fill-black stroke-black' : 'fill-none stroke-current' }}" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        <span class="text-[12px] font-bold">{{ number_format($article->likes()->count()) }} Likes</span>
                    </button>
                </form>
        
                <div class="flex items-center gap-1 text-[11px] font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    {{ number_format($article->word_count) }} Words
                </div>
        
                <time class="ml-auto text-[11px] font-medium uppercase tracking-tighter text-gray-500">
                    {{ $article->created_at->format('d M Y') }}
                </time>
            </div>
        </div>

        @if($article->cover_image)
            <div class="relative w-full h-[240px] md:h-[480px] overflow-hidden rounded-[1rem] mb-8 group">
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

        <h1 class="text-3xl md:text-5xl font-bold mb-14 tracking-[-0.04em] leading-[0.95] text-[#1a1a1a]">
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
            <p class="text-sm text-gray-500">
                Visuals by <a href="https://www.canva.com/p/huseyinbakikk/" target="_blank" class="underline hover:text-black transition">@huseyinbakikk</a> via Canva
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