<x-app-layout>
    <div class="min-h-screen bg-white font-sans antialiased text-[#1a1a1a]">
        
        <main class="max-w-[1200px] mx-auto px-8 py-20">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 mb-24 border-b border-gray-100 pb-16">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-300 block mb-4">Total Souls</span>
                    <div class="text-6xl font-bold tracking-tighter">{{ $stats['total_users'] }}</div>
                </div>
                
                <div>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-300 block mb-4">Total Thoughts</span>
                    <div class="text-6xl font-bold tracking-tighter">{{ $stats['total_articles'] }}</div>
                </div>

                <div>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-300 block mb-4">Verified Now</span>
                    <div class="text-6xl font-bold tracking-tighter text-green-500">{{ $stats['verified_users'] }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
                
                <div class="lg:col-span-4">
                    <h3 class=" font-black uppercase tracking-[0.3em] text-gray-300 mb-10">Latest Users</h3>
                    <div class="space-y-8">
                        @foreach($stats['recent_users'] as $user)
                        <div class="group flex items-center justify-between">
                            <div>
                                <div class="text-[15px] font-bold text-black group-hover:underline decoration-2 underline-offset-4">{{ $user->name }}</div>
                                <div class=" text-gray-400 font-medium mt-0.5">@<span>{{ $user->username ?? 'null' }}</span></div>
                            </div>
                            <div class="text-right">
                                <div class="text-[10px] font-bold text-gray-300 uppercase tabular-nums tracking-tighter">
                                    {{ $user->created_at->format('M d') }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <h3 class=" font-black uppercase tracking-[0.3em] text-gray-300 mb-10">Handcrafted Thoughts Log</h3>
                    
                    <div class="overflow-hidden">
                        <table class="w-full text-left">
                            <tbody class="divide-y divide-gray-100">
                                @foreach($stats['recent_articles'] as $article)
                                <tr class="group">
                                    <td class="py-6 pr-8">
                                        <div class="text-[17px] font-bold text-black mb-1 group-hover:text-gray-500 transition-colors cursor-default">
                                            {{ $article->title }}
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest italic">
                                                By {{ $article->user->name ?? 'Unknown' }}
                                            </span>
                                            <span class="w-1 h-1 rounded-full bg-gray-200"></span>
                                            <span class="text-[10px] font-bold {{ $article->status === 'published' ? 'text-black' : 'text-gray-300' }} uppercase">
                                                {{ $article->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-6 text-right align-top">
                                        <div class=" font-bold text-gray-300 tabular-nums uppercase tracking-tighter pt-1">
                                            {{ $article->created_at->format('d/m/y') }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>