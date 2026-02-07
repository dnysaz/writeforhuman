<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<x-app-layout>
    <style>
        .editable-content:empty:before { content: attr(placeholder); color: #9ca3af; cursor: text; }
        #publishModal.active { opacity: 1 !important; pointer-events: auto !important; }
        #publishModal.active > div:last-child { transform: scale(1) translateY(0); }
        .modal-content { transform: scale(0.95) translateY(10px); transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
        [x-cloak] { display: none !important; }
    </style>

    <input type="hidden" id="article-slug" value="{{ $article->slug }}">

    @include('includes.sidebar')

    <main class="editor-container" x-data="{ showDeleteModal: false }">
        <div class="flex items-center justify-between mb-12">
            <div class="flex items-center gap-8">
                <div class="flex items-center gap-6">
                    <button onclick="openPublishModal()" class="bg-[#1a1a1a] text-white px-8 py-2.5 rounded-full text-[13px] font-bold hover:bg-black transition-all active:scale-95 shadow-lg shadow-black/5">
                        Publish Update
                    </button>
                    <button onclick="submitArticle('draft')" class="text-[13px] font-bold text-gray-400 hover:text-black transition-all group flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-200 group-hover:bg-gray-400 transition-colors"></span>
                        Keep as draft
                    </button>
                </div>
    
                <div class="h-4 w-px bg-gray-100"></div>
    
                <div>
                    <button @click="showDeleteModal = true; document.body.style.overflow = 'hidden'" 
                            type="button" 
                            class="group flex items-center gap-2 text-[13px] font-bold text-gray-300 hover:text-red-500 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        <span>Erase entry</span>
                    </button>
                </div>
            </div>
            <span class="text-[11px] font-bold text-gray-300 uppercase tracking-widest italic">Editing Mode</span>
        </div>

        <input type="text" class="editable-title w-full text-4xl md:text-5xl font-bold border-none focus:ring-0 placeholder-gray-200 mb-8 bg-transparent" placeholder="Give it a title..." value="{{ $article->title }}" autofocus>
        
        <div id="editor" 
             class="editable-content focus:outline-none min-h-[60vh] text-[19px] md:text-[21px] font-light leading-relaxed text-[#1a1a1a]" 
             contenteditable="true" 
             placeholder="Share your handcrafted thoughts here...">{!! $article->content !!}</div>

        <template x-teleport="body">
            <div x-show="showDeleteModal" 
                 x-cloak
                 class="fixed inset-0 z-[110] flex items-center justify-center p-4">
                <div x-show="showDeleteModal" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="showDeleteModal = false; document.body.style.overflow = 'auto'" 
                     class="absolute inset-0 bg-white/90 backdrop-blur-sm"></div>
                
                <div x-show="showDeleteModal"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                     class="relative bg-white w-full max-w-md overflow-hidden rounded-[2.5rem] border border-gray-100 p-10 text-center shadow-2xl shadow-black/5">
                    
                    <div class="w-16 h-16 bg-gray-200 text-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18m-2 0v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                    </div>

                    <h2 class="text-2xl font-bold mb-2 tracking-tighter">Erase this thought?</h2>
                    <p class="text-gray-400 text-sm mb-10 leading-relaxed font-medium px-4">This action cannot be undone. Your handcrafted entry will be permanently removed from the archive.</p>
                    
                    <div class="flex flex-col gap-3">
                        <button onclick="deleteArticle()" class="w-full bg-gray-800 text-white py-4 rounded-full font-bold text-[15px] hover:bg-gray-900 transition-all active:scale-[0.98]">
                            Yes, erase permanently
                        </button>
                        <button @click="showDeleteModal = false; document.body.style.overflow = 'auto'" class="text-[13px] font-bold text-gray-400 hover:text-black py-2 transition">
                            No, keep it
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </main>

    <div id="toast" class="notification-toast flex items-center gap-3 bg-white border border-gray-100 shadow-2xl px-6 py-4 rounded-2xl fixed bottom-8 left-1/2 -translate-x-1/2 opacity-0 pointer-events-none transition-all duration-300">
        <span id="toast-icon" class="w-2 h-2 rounded-full"></span>
        <span id="toast-message" class="text-sm font-bold text-gray-600"></span>
    </div>

    <div class="word-counter-box fixed bottom-8 right-8 border-none shadow-none bg-transparent opacity-40 hover:opacity-100 transition-opacity text-[13px] font-medium uppercase tracking-widest">
        <span id="word-count" class="text-[#1a1a1a] font-black">{{ $article->word_count }}</span> words
    </div>

    <div id="publishModal" class="fixed inset-0 z-[100] flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 p-4">
        <div onclick="closePublishModal()" class="absolute inset-0 bg-white/95 backdrop-blur-xl"></div>
        
        <div class="modal-content relative bg-white w-full max-w-2xl overflow-hidden rounded-[3rem] border border-gray-100 p-8 md:p-12 shadow-2xl shadow-black/5">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold mb-2 tracking-tighter text-[#1a1a1a]">Update Thought.</h2>
                <p class="text-gray-400 text-[15px] leading-relaxed font-medium">Refine your visual vibe and category.</p>
            </div>
            
            <form onsubmit="handleFormSubmit(event)" class="space-y-10">
                <div>
                    <label class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-300 block mb-4 text-center">Visual Vibe</label>
                    <div class="flex justify-center gap-4">
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="cover_image" value="" class="sr-only" {{ is_null($article->cover_image) ? 'checked' : '' }}>
                            <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center transition-all duration-300 group-hover:border-gray-400 group-[:has(:checked)]:border-black group-[:has(:checked)]:bg-gray-50 text-gray-300 group-[:has(:checked)]:text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                <span class="text-[8px] font-bold uppercase mt-1">None</span>
                            </div>
                        </label>
                
                        @for ($i = 1; $i <= 3; $i++)
                            @php $vibeId = str_pad($i, 3, '0', STR_PAD_LEFT); @endphp
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="cover_image" value="{{ $vibeId }}" class="sr-only" {{ $article->cover_image == $vibeId ? 'checked' : '' }}>
                                <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl overflow-hidden border-2 border-transparent transition-all duration-300 group-hover:scale-95 group-[:has(:checked)]:border-black group-[:has(:checked)]:scale-105 group-[:has(:checked)]:shadow-xl">
                                    <img src="https://res.cloudinary.com/dmnble1qr/image/upload/w_400,c_thumb,q_auto,f_auto/{{ $vibeId }}.jpg" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-[:has(:checked)]:grayscale-0 transition-all duration-500">
                                </div>
                            </label>
                        @endfor
                    </div>
                </div>
    
                <div>
                    <label class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-300 block mb-4 text-center">Category</label>
                    <div class="flex flex-wrap justify-center gap-2">
                        @foreach(['general', 'health', 'education', 'technology', 'food'] as $cat)
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="category" value="{{ $cat }}" class="sr-only" {{ $article->category == $cat ? 'checked' : '' }}>
                                <div class="category-chip transition-all text-center text-[13px] font-bold px-6 py-3 rounded-full border border-gray-100 group-hover:bg-gray-50 group-[:has(:checked)]:bg-black group-[:has(:checked)]:text-white group-[:has(:checked)]:border-black">
                                    {{ ucfirst($cat) }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
    
                <div class="flex flex-col space-y-4 pt-6 max-w-xs mx-auto text-center">
                    <button type="submit" class="w-full bg-[#1a1a1a] text-white py-4 rounded-full font-bold text-[15px] hover:bg-black transition-all active:scale-[0.98]">
                        Confirm Update
                    </button>
                    <button type="button" onclick="closePublishModal()" class="text-[13px] font-bold text-gray-400 hover:text-red-500 transition">Cancel</button>
                </div>
            </form>
        </div>
    </div>

   <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editor = document.getElementById('editor');
            const titleInput = document.querySelector('.editable-title');
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            const toastIcon = document.getElementById('toast-icon');
            const wordCountDisplay = document.getElementById('word-count');
            const slugHeader = document.getElementById('article-slug').value;
            const publishModal = document.getElementById('publishModal');
            let toastTimer;

            const showToast = (message, type = 'info') => {
                clearTimeout(toastTimer);
                toastMessage.innerText = message;
                toastIcon.className = (type === 'error') ? 'w-2 h-2 rounded-full bg-red-500' : 'w-2 h-2 rounded-full bg-blue-500';
                toast.classList.add('opacity-100', 'translate-y-[-10px]');
                toast.classList.remove('opacity-0', 'pointer-events-none');
                toastTimer = setTimeout(() => {
                    toast.classList.remove('opacity-100', 'translate-y-[-10px]');
                    toast.classList.add('opacity-0', 'pointer-events-none');
                }, 3000);
            };

            // Logika Hapus (Delete Article)
            window.deleteArticle = async () => {
                showToast("Erasing your thought forever...", "info");
                try {
                    const response = await fetch(`/articles/${slugHeader}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        window.location.href = "{{ route('dashboard') }}?erased=1";
                    } else {
                        showToast("Failed to erase. Try again.", "error");
                    }
                } catch (e) {
                    showToast("Network error. Action aborted.", "error");
                }
            };

            // Anti-Paste
            const preventPaste = (e, msg) => { e.preventDefault(); showToast(msg, "info"); };
            titleInput.addEventListener('paste', (e) => preventPaste(e, "Title requires effort. No paste."));
            editor.addEventListener('paste', (e) => preventPaste(e, "Every word must be typed manually."));

            // Word Count
            const updateWordCount = () => {
                const text = editor.innerText.trim();
                wordCountDisplay.innerText = text ? text.split(/\s+/).length : 0;
            };
            editor.addEventListener('input', updateWordCount);

            // Update Logic
            window.submitArticle = async (status) => {
                const selectedCategory = document.querySelector('input[name="category"]:checked');
                const selectedVibe = document.querySelector('input[name="cover_image"]:checked'); 

                const data = {
                    title: titleInput.value,
                    content: editor.innerHTML,
                    category: selectedCategory ? selectedCategory.value : 'general',
                    cover_image: (selectedVibe && selectedVibe.value !== "") ? selectedVibe.value : null,
                    status: status 
                };

                try {
                    const response = await fetch(`/articles/${slugHeader}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    if (response.ok) {
                        window.location.href = "{{ route('dashboard') }}?updated=1";
                    } else {
                        const err = await response.json();
                        showToast(err.message || "Failed to update.", "error");
                    }
                } catch (e) {
                    showToast("Connection lost. Words are safe.", "error");
                }
            };

            window.openPublishModal = () => {
                publishModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            };

            window.closePublishModal = () => {
                publishModal.classList.remove('active');
                document.body.style.overflow = 'auto';
            };

            window.handleFormSubmit = (e) => {
                e.preventDefault();
                submitArticle('published');
            };
        });
   </script>
</x-app-layout>