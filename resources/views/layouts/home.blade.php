<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('meta_description')">
    <meta property="og:image" content="@yield('og_image', asset('assets/logo/dw.png'))">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            letter-spacing: -0.015em; /* Sedikit lebih rapat agar lebih estetik */
            word-spacing: 0.02em;
        }
        html { scroll-behavior: smooth; }
        
        /* Menghapus gaya serif agar konsisten ke sans-serif */
        .serif { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-white text-[#1a1a1a] antialiased">
    
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100/50" x-data="{ openNotify: false }">
        <nav class="max-w-7xl mx-auto px-4 md:px-8 py-4 sm:py-5 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-bold tracking-tighter hover:underline transition-all">
                dwrite.me
            </a>
            
            <div class="flex items-center gap-4 sm:gap-8">
                @auth
                    <div class="relative">
                        <button @click="openNotify = !openNotify" class="relative group p-2 rounded-full hover:bg-gray-50 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-700 group-hover:text-black">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31a8.967 8.967 0 0 1-2.312-6.022c0-3.472-1.684-6.611-4.478-8.152a2.25 2.25 0 0 0-4.593 0c-2.794 1.541-4.478 4.68-4.478 8.152a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                            
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="absolute top-1 right-1 flex h-4 w-4">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-black opacity-20"></span>
                                    <span class="relative inline-flex rounded-full h-4 w-4 bg-black text-[9px] font-black text-white items-center justify-center">
                                        {{ Auth::user()->unreadNotifications->count() }}
                                    </span>
                                </span>
                            @endif
                        </button>
    
                        <div 
                            x-show="openNotify" 
                            @click.away="openNotify = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            {{-- Update class: fixed & inset untuk mobile, absolute untuk desktop --}}
                            class="fixed md:absolute left-4 right-4 md:left-auto md:right-0 mt-4 md:w-[450px] bg-white border border-gray-600 rounded-[1rem] z-50"
                            style="display: none;"
                        >
                            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                                <h4 class="text-sm font-black text-black">Notifications</h4>
                                @if(Auth::user()->unreadNotifications->count() > 0)
                                    <span class="text-[10px] text-black font-black bg-gray-200 px-2 py-1 rounded-full">{{ Auth::user()->unreadNotifications->count() }} New</span>
                                @endif
                            </div>

                            <div class="max-h-[60vh] md:max-h-[400px] overflow-y-auto">
                                @forelse(Auth::user()->unreadNotifications as $notification)
                                    <a href="{{ route('articles.show', $notification->data['article_slug']) }}" class="block p-6 hover:bg-gray-50 transition-all border-b border-gray-100 last:border-0 group">
                                        <div class="flex items-start gap-4">
                                            <div class="w-2 h-2 mt-2 bg-black rounded-full flex-shrink-0"></div>
                                            <div class="flex-1">
                                                <p class="text-[14px] leading-tight mb-1">
                                                    <span class="font-bold text-black">{{ $notification->data['user_name'] ?? 'Someone' }}</span> 
                                                    <span class="text-gray-500 font-light">responded to</span> 
                                                    <span class="font-bold text-black underline decoration-gray-400">"{{ $notification->data['article_title'] }}"</span>
                                                </p>
                                                <p class="text-[13px] text-gray-600 font-light line-clamp-2 italic mb-2">
                                                    "{{ $notification->data['comment_body'] ?? '' }}"
                                                </p>
                                                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 group-hover:text-black transition-colors">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="p-10 text-center">
                                        <p class="text-gray-400 text-sm font-medium italic">All caught up! No new responses.</p>
                                    </div>
                                @endforelse
                            </div>

                            @if(Auth::user()->unreadNotifications->count() > 0)
                            <form action="{{ route('notifications.markAllRead') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-4 text-gray-800 text-center text-[14px] font-black  hover:underline">
                                    Mark all as read
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
    
                    <div class="flex items-center gap-5 sm:gap-7 border-l border-gray-100 pl-4 sm:pl-8">
                        <a href="{{ route('articles.index') }}" class=" text-[13px] sm:text-[15px] font-bold text-gray-700 hover:text-black hover:underline decoration-2 underline-offset-4 transition-all">
                            Feed
                        </a>
                        
                        <a href="{{ route('articles.liked') }}" class=" text-[13px] sm:text-[15px] font-bold text-gray-700 hover:text-black hover:underline decoration-2 underline-offset-4 transition-all">
                            Liked
                        </a>
    
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center bg-[#1a1a1a] text-white px-4 py-2 sm:px-6 sm:py-2.5 rounded-full text-[11px] sm:text-sm font-black tracking-widest hover:bg-black transition-all shadow-lg shadow-black/5">
                            Write<span class="hidden sm:inline">&nbsp;New</span>
                        </a>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-[13px] sm:text-[15px] font-bold text-gray-400 hover:text-black hover:underline decoration-2 underline-offset-4 transition-all">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-[#1a1a1a] text-white px-5 py-2 sm:px-7 sm:py-2.5 rounded-full text-[11px] sm:text-sm font-black uppercase tracking-widest hover:bg-black transition-all shadow-lg shadow-black/5">
                        Start
                    </a>
                @endauth
            </div>
        </nav>
    </header>
    
    <div class="md:h-[20px]"></div> 

    <main class="pt-24 min-h-screen">
        {{ $slot }}
    </main>

    <footer class="max-w-7xl mx-auto px-8 py-16 border-t border-gray-100 flex flex-col lg:flex-row justify-between items-center gap-8 text-gray-500 text-[13px] font-bold tracking-widest">
        <div class="flex items-center flex-wrap justify-center gap-x-6 gap-y-4">
            <a href="{{ route('home') }}" class="hover:text-black transition-colors">Home</a>
            <span class="text-gray-200 font-light">|</span>
            
            <a href="{{ route('about') }}" class="hover:text-black transition-colors">About</a>
            <span class="text-gray-200 font-light">|</span>
            
            <a href="{{ route('help') }}" class="hover:text-black transition-colors">Help</a>
            <span class="text-gray-200 font-light">|</span>
            
            <a href="{{ route('terms') }}" class="hover:text-black transition-colors">Terms and Conditions</a>
            <span class="text-gray-200 font-light">|</span>
            
            <a href="{{ route('support') }}" class="hover:text-black transition-colors">Support</a>
            
            <div class="ml-2 flex items-center gap-3 lowercase italic tracking-normal">
                <span class="text-gray-400 font-medium">love this?</span>
                <a href="{{ route('donate') }}" class="flex items-center gap-2 text-black hover:text-red-500 transition-all group bg-gray-50 px-4 py-1.5 rounded-full border border-gray-100 hover:border-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 fill-red-500 animate-pulse" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-black uppercase tracking-widest text-[10px]">Donate</span>
                </a>
            </div>
        </div>
        
        <span class="text-gray-300 font-medium tracking-tighter normal-case">Handcrafted by fingers &copy; 2026</span>
    </footer>

</body>
</html>