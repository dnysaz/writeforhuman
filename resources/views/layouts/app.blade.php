<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dwrite.me | dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Outfit', sans-serif; letter-spacing: -0.02em; }
        body { background-color: #ffffff; color: #111; overflow: auto; }
        
        /* Editor Styles */
        .editor-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            height: calc(100vh - 100px);
            padding: 4rem 1.5rem 0 1.5rem;
        }
        .editable-title {
            width: 100%;
            border: none;
            outline: none;
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 2rem;
            background: transparent;
        }
        .editable-content {
            width: 100%;
            height: 70%;
            border: none;
            outline: none;
            font-size: 1.5rem;
            line-height: 1.8;
            color: #333;
            resize: none;
            background: transparent;
        }

        /* Styling agar div kosong tetap menampilkan placeholder */
        [contenteditable=true]:empty:before {
            content: attr(placeholder);
            color: #9ca3af;
            cursor: text;
        }
        
        /* Styling link otomatis */
        #editor a {
            color: #2563eb;
            text-decoration: underline;
            cursor: pointer;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            left: -300px;
            top: 0;
            bottom: 0;
            width: 300px;
            background: #ffffff;
            border-right: 1px solid #eee;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            z-index: 100;
            padding: 1rem;
        }
        .sidebar:hover { left: 0; box-shadow: 10px 0 30px rgba(0,0,0,0.02); }
        .sidebar-handle {
            position: absolute;
            right: -15px;
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            cursor: pointer;
        }
        .handle-bar {
            width: 4px;
            height: 40px;
            background: #e5e7eb;
            border-radius: 10px;
        }
        .sidebar-handle::after {
            content: 'JOURNAL';
            position: absolute;
            right: 8px;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.2em;
            color: #d1d5db;
            transform: rotate(90deg);
        }

        /* Toast & Counter */
        .notification-toast {
            position: fixed;
            right: 24px;
            bottom: -100px;
            background: #000;
            color: #fff;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 1000;
        }
        .notification-toast.show { bottom: 24px; }
        .word-counter-box {
            position: fixed;
            right: 32px;
            bottom: 32px;
            font-size: 11px;
            font-weight: 800;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            z-index: 50;
            background: rgba(255,255,255,0.9);
            padding: 6px 12px;
            border-radius: 20px;
            border: 1px solid #f0f0f0;
        }

        /* Modal Improvements */
        .modal-overlay {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
        }
        .category-chip {
            border: 1.5px solid #f0f0f0;
            transition: all 0.2s ease;
        }
        input[type="radio"]:checked + .category-chip {
            border-color: #000;
            background: #000;
            color: #fff;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .editable-title { font-size: 2rem; }
            .sidebar { width: 250px; left: -240px; }
        }
        
        #editor-toolbar {
            transition: opacity 0.3s ease, transform 0.3s ease;
            /* Tambahkan display flex secara default jika belum ada */
            display: flex; 
        }

        /* Style tambahan untuk switch agar terlihat sangat clean */
        .peer-checked\:bg-black:checked ~ .peer {
            background-color: #000;
        }
    </style>
</head>
<body class="antialiased">
    <nav class="max-w-7xl mx-auto px-6 md:px-8 py-5 flex justify-between items-center bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-gray-50">
        <div class="text-2xl hover:underline font-bold ">
            <a href="{{ route('home') }}">dwrite.me</a>
        </div>
        
        <div class="flex items-center space-x-6">            
            <div class="relative inline-block text-left">
                <div onclick="toggleUserMenu()" class="flex items-center space-x-3 group cursor-pointer">
                    <span class="hidden md:block text-[15px] font-bold text-[#1a1a1a]">{{ Auth::user()->name }}</span>
                    <div class="w-10 h-10 rounded-full bg-[#1a1a1a] flex items-center justify-center text-[12px] font-bold text-white overflow-hidden border border-gray-100 transition-transform group-hover:scale-105">
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" class="w-full h-full object-cover">
                        @else
                            <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        @endif
                    </div>
                </div>

            
                <div id="userDropdown" class="hidden absolute right-0 mt-4 w-64 bg-white border border-gray-100 rounded-[2rem] shadow-2xl shadow-black/5 overflow-hidden z-[110]">
                    <div class="p-2 space-y-1">
                        <a href="{{ route('dashboard.articles') }}" class="flex items-center px-5 py-3 text-[15px] font-bold text-gray-500 hover:text-black hover:bg-gray-50 rounded-2xl transition">
                            My Articles
                        </a>
                        <a href="{{ route('profile.setting') }}" class="flex items-center px-5 py-3 text-[15px] font-bold text-gray-500 hover:text-black hover:bg-gray-50 rounded-2xl transition">
                            Profile
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-5 py-3 text-[15px] font-bold text-gray-500 hover:text-black hover:bg-gray-50 rounded-2xl transition">
                            Settings
                        </a>
                        <div class="border-t border-gray-50 my-2"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-5 py-3 text-[15px] font-bold text-red-400 hover:text-red-600 hover:bg-red-50 rounded-2xl transition">
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{ $slot }}

    <script>
        const dropdownMenu = document.getElementById('userDropdown');

        // 7. User Dropdown Toggle
        window.toggleUserMenu = function() {
            dropdownMenu.classList.toggle('hidden');
        };

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.group.cursor-pointer')) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>