<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'writeforhuman') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <style>
            body { 
                font-family: 'Outfit', sans-serif; 
                letter-spacing: -0.015em;
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-[#1a1a1a] antialiased bg-white selection:bg-gray-100">
        
        <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
            
            <div class="hidden lg:flex flex-col justify-center items-center px-16 xl:px-24 bg-gray-50 border-r border-gray-100 relative">
                <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 24px 24px;"></div>
                
                <div class="max-w-md relative z-10 mx-auto">
                    <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tighter mb-16 inline-block hover:underline">
                        writeforhuman.
                    </a>
                    <h2 class="text-4xl xl:text-5xl font-bold leading-[1.1] tracking-tighter mb-8">
                        The internet is drowning in noise. We are the <span class="italic font-light text-gray-400">filter.</span>
                    </h2>
                    <p class="text-lg text-gray-500 font-light leading-relaxed border-l-2 border-[#1a1a1a] pl-6">
                        Every sentence published here represents a human being sitting down, focusing, and pressing one key at a time. No shortcuts. No synthetic thoughts.
                    </p>
                    <div class="mt-12 flex items-center space-x-4">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-gray-50"></div>
                            <div class="w-8 h-8 rounded-full bg-gray-300 border-2 border-gray-50"></div>
                            <div class="w-8 h-8 rounded-full bg-gray-400 border-2 border-gray-50"></div>
                        </div>
                        <span class="text-[11px] font-bold tracking-tight text-gray-400">Join 2,000+ verified humans</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col min-h-screen bg-white">
                
                <div class="lg:hidden p-8">
                    <a href="{{ route('home') }}" class="text-xl font-bold tracking-tighter">writeforhuman.</a>
                </div>

                <div class="flex-1 flex flex-col justify-center px-6 md:px-16 xl:px-24 py-12">
                    <div class="w-full max-w-sm mx-auto">
                        
                        {{ $slot }}
                        
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>