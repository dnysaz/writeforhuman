<x-app-layout>
    <style>
        /* Placeholder logic untuk contenteditable */
        .editable-content:empty:before {
            content: attr(placeholder);
            color: #9ca3af;
            cursor: text;
        }
        /* Smooth transition untuk modal */
        #publishModal.active {
            opacity: 1 !important;
            pointer-events: auto !important;
        }
        #publishModal.active > div:last-child {
            transform: scale(1) translateY(0);
        }
        .modal-content {
            transform: scale(0.95) translateY(10px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>

    @include('includes.sidebar')

    <main class="editor-container">
        <div class="flex items-center justify-between mb-12">
            <div class="flex items-center gap-6">
                <button onclick="openPublishModal()" class="bg-[#1a1a1a] text-white px-8 py-2.5 rounded-full text-[13px] font-bold hover:bg-black transition-all active:scale-95 shadow-lg shadow-black/5">
                    Publish
                </button>
                <button onclick="submitArticle('draft')" class="text-[13px] font-bold text-gray-400 hover:text-black transition-all group flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-200 group-hover:bg-gray-400 transition-colors"></span>
                    Save as draft
                </button>
            </div>
        </div>

        <input type="text" class="editable-title w-full text-4xl md:text-5xl font-bold border-none focus:ring-0 placeholder-gray-200 mb-8 bg-transparent" placeholder="Give it a title..." autofocus>
        
        <div id="editor" 
             class="editable-content focus:outline-none min-h-[60vh] text-[19px] md:text-[21px] font-light leading-relaxed text-[#1a1a1a]" 
             contenteditable="true" 
             placeholder="Share your handcrafted thoughts here..."></div>
    </main>

    <div id="toast" class="max-w-3xl mx-auto notification-toast flex items-center gap-3 bg-white border border-gray-100 px-6 py-4 rounded-2xl fixed bottom-8 left-1/2 -translate-x-1/2 opacity-0 pointer-events-none transition-all duration-300">
        <span id="toast-icon" class="w-2 h-2 rounded-full"></span>
        <span id="toast-message" class="text-sm font-bold text-gray-600"></span>
    </div>

    <div class="word-counter-box fixed bottom-8 right-8 border-none shadow-none bg-transparent opacity-40 hover:opacity-100 transition-opacity text-[13px] font-medium uppercase tracking-widest">
        <span id="word-count" class="text-[#1a1a1a] font-black">0</span> words
    </div>

    <div id="publishModal" class="fixed inset-0 z-[100] flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 p-4">
        <div onclick="closePublishModal()" class="absolute inset-0 bg-white/95 backdrop-blur-xl"></div>
        
        <div class="modal-content relative bg-white w-full max-w-2xl overflow-hidden rounded-[3rem] border border-gray-100 p-8 md:p-12 shadow-2xl shadow-black/5">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold mb-2 tracking-tighter text-[#1a1a1a]">Finalize.</h2>
                <p class="text-gray-400 text-[15px] leading-relaxed font-medium">Choose a visual vibe and category for your thought.</p>
            </div>
            
            <form onsubmit="handleFormSubmit(event)" class="space-y-10">
                <div>
                    <label class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-300 block mb-4 text-center">Visual Vibe</label>
                    <div class="flex justify-center gap-4">
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="cover_image" value="" class="sr-only" checked>
                            <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl border-2 border-dashed border-gray-100 flex flex-col items-center justify-center transition-all duration-300 group-hover:border-gray-400 group-[:has(:checked)]:border-black group-[:has(:checked)]:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                <span class="text-[8px] font-bold uppercase mt-1">None</span>
                            </div>
                        </label>
                
                        @for ($i = 1; $i <= 3; $i++)
                            @php $vibeId = str_pad($i, 3, '0', STR_PAD_LEFT); @endphp
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="cover_image" value="{{ $vibeId }}" class="sr-only">
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
                                <input type="radio" name="category" value="{{ $cat }}" class="sr-only" {{ $cat == 'general' ? 'checked' : '' }}>
                                <div class="category-chip transition-all text-center text-[13px] font-bold px-6 py-3 rounded-full border border-gray-100 group-hover:bg-gray-50 group-[:has(:checked)]:bg-black group-[:has(:checked)]:text-white group-[:has(:checked)]:border-black">
                                    {{ ucfirst($cat) }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
    
                <div class="flex flex-col space-y-4 pt-6 max-w-xs mx-auto text-center">
                    <button type="submit" class="w-full bg-[#1a1a1a] text-white py-4 rounded-full font-bold text-[15px] hover:bg-black transition-all active:scale-[0.98] shadow-xl shadow-black/5">
                        Continue publish
                    </button>
                    <button type="button" onclick="closePublishModal()" class="text-[13px] font-bold text-gray-400 hover:text-red-500 transition">
                        Wait, I'm not done
                    </button>
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
            const publishModal = document.getElementById('publishModal');
            
            let toastTimer;

            // 1. Word Counter
            const updateWordCount = () => {
                const text = editor.innerText.trim();
                wordCountDisplay.innerText = text ? text.split(/\s+/).length : 0;
            };

            // 2. Toast System
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

            // 3. Anti-Paste Protection
            const preventPaste = (e, msg) => {
                e.preventDefault();
                showToast(msg, "info");
            };

            titleInput.addEventListener('paste', (e) => preventPaste(e, "The title requires your finger's effort. No paste."));
            editor.addEventListener('paste', (e) => preventPaste(e, "Every word must be typed. No paste."));
            editor.addEventListener('drop', (e) => preventPaste(e, "Dropped content is blocked. Type your thoughts."));

            // 4. Editor Logic (Auto-link & Input)
            editor.addEventListener('input', updateWordCount);

            // 5. Modal Management
            window.openPublishModal = () => {
                if (!titleInput.value.trim()) {
                    showToast("Title is missing.", "error");
                    titleInput.focus();
                    return;
                }
                if (editor.innerText.trim().length < 5) {
                    showToast("Your thought is too short.", "error");
                    editor.focus();
                    return;
                }
                publishModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            };

            window.closePublishModal = () => {
                publishModal.classList.remove('active');
                document.body.style.overflow = 'auto';
            };

            // 6. Form Submission Logic
            window.submitArticle = async (status) => {
                if (status === 'draft' && !titleInput.value.trim()) {
                    showToast("At least give your draft a title.", "error");
                    return;
                }

                const selectedCategory = document.querySelector('input[name="category"]:checked');
                const selectedVibe = document.querySelector('input[name="cover_image"]:checked'); 

                const data = {
                    title: titleInput.value,
                    content: editor.innerHTML, // Menggunakan HTML untuk menyimpan format link otomatis
                    category: selectedCategory ? selectedCategory.value : 'general',
                    cover_image: (selectedVibe && selectedVibe.value !== "") ? selectedVibe.value : null,
                    status: status 
                };

                showToast(status === 'published' ? "Handcrafting your thought to the world..." : "Saving draft...");

                try {
                    const response = await fetch("{{ route('articles.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    if (response.ok) {
                        window.location.href = "{{ route('dashboard') }}?success=1";
                    } else {
                        const err = await response.json();
                        showToast(err.message || "Failed to save.", "error");
                    }
                } catch (e) {
                    showToast("Network error. Your words are still in the editor.", "error");
                }
            };

            window.handleFormSubmit = (e) => {
                e.preventDefault();
                submitArticle('published');
            };
        });
   </script>
</x-app-layout>