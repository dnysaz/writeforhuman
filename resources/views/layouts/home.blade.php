<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>writeforhuman | {{ $title ?? '' }}</title>
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
    
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100/50">
        <nav class="max-w-7xl mx-auto px-4 md:px-8 py-4 sm:py-5 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-bold tracking-tighter hover:underline transition-all">
                wfh<span class="text-gray-300">.</span>
            </a>
            
            <div class="flex items-center gap-4 sm:gap-8">
                @auth
                    <div class="flex items-center gap-5 sm:gap-7">
                        <a href="{{ route('articles.index') }}" class="xs:inline-block text-[13px] sm:text-[15px] font-bold text-gray-700 hover:text-black hover:underline decoration-2 underline-offset-4 transition-all">
                            Feed
                        </a>
                        
                        <a href="{{ route('articles.liked') }}" class="xs:inline-block text-[13px] sm:text-[15px] font-bold text-gray-700 hover:text-black hover:underline decoration-2 underline-offset-4 transition-all">
                            Liked
                        </a>
                    </div>
                    
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center bg-[#1a1a1a] text-white px-4 py-2 sm:px-6 sm:py-2.5 rounded-full text-[11px] sm:text-sm font-black tracking-widest hover:bg-black transition-all shadow-lg shadow-black/5">
                        <span class="sm:inline">Write</span><span class="hidden sm:inline">&nbsp;New</span>
                    </a>
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