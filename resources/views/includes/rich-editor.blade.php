<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/tokyo-night-dark.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

<style>
    /* --- 2. EDITOR TYPOGRAPHY --- */
    #editor { 
        outline: none; 
        line-height: 1.8; 
        color: #1a1a1a; 
        min-height: 500px;
    }

    /* Bold Banget (900) */
    #editor b, #editor strong, #articleContent b, #articleContent strong { 
        font-weight: 900 !important; 
        color: #000; 
    }
    
    /* Heading Scale - Editorial Aesthetic */
    #editor h1, #articleContent h1 { font-size: 2.8em; font-weight: 900; margin: 1.5rem 0 0.5rem; letter-spacing: -0.04em; line-height: 1.1; }
    #editor h2, #articleContent h2 { font-size: 2.2em; font-weight: 800; margin: 1.2rem 0 0.4rem; letter-spacing: -0.03em; }
    #editor h3, #articleContent h3 { font-size: 1.75em; font-weight: 700; margin: 1rem 0 0.4rem; }
    #editor h4, #articleContent h4 { font-size: 1.4em; font-weight: 700; }
    #editor h5, #articleContent h5 { font-size: 1.1em; font-weight: 800; text-transform: uppercase; color: #4b5563; }
    #editor h6, #articleContent h6 { font-size: 0.95em; font-weight: 900; color: #9ca3af; text-transform: uppercase; }
    
    #editor p, #articleContent p { margin-bottom: 1.5rem; }

    /* The Handcrafted Quote Style */
    #editor blockquote, #articleContent blockquote { 
        border-left: 4px solid #1a1a1a; 
        padding: 1rem 0 1rem 2rem; 
        margin: 2.5rem 0; 
        font-style: italic; 
        font-size: 1.15em;
        color: #374151; 
        background: #f9f9f9;
        border-radius: 0 12px 12px 0;
        white-space: pre-wrap;
        min-height: 1.8em;
    }

    /* VS Code Style Code Block */
    #editor pre, #articleContent pre { 
        background: transparent; 
        border: none; 
        margin: 2rem 0; 
        padding: 0; 
    }

    /* Update pada bagian Code Block Styling */
    #editor pre code, #articleContent pre code {
        display: block;
        padding: 1.5rem;
        background: #1e1e1e;
        color: #d4d4d4;
        border-radius: 16px;
        font-family: 'JetBrains Mono', 'Consolas', monospace;
        font-size: 0.9em;
        line-height: 1.7;
        white-space: pre; 
        tab-size: 4; 
        -moz-tab-size: 4;
        overflow-x: auto;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.4);
    }

    /* Scrollbar Styling for Code */
    #editor pre code::-webkit-scrollbar, #articleContent pre code::-webkit-scrollbar { height: 8px; }
    #editor pre code::-webkit-scrollbar-thumb, #articleContent pre code::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
</style>

<div id="editor-toolbar" class="flex flex-wrap items-center gap-6 mb-10 pb-5 border-b border-gray-100">
    <div class="flex items-center gap-1 border-r border-gray-100 pr-6">
        <button type="button" onclick="execAction('bold')" class="p-2.5 hover:bg-gray-50 rounded-xl transition-all active:scale-90" title="Bold"><span style="font-weight: 900;">B</span></button>
        <button type="button" onclick="execAction('italic')" class="p-2.5 hover:bg-gray-50 rounded-xl transition-all active:scale-90" title="Italic"><span class="italic">I</span></button>
        <button type="button" onclick="execAction('underline')" class="p-2.5 hover:bg-gray-50 rounded-xl transition-all active:scale-90" title="Underline"><u>U</u></button>
    </div>

    <div class="flex items-center gap-1 border-r border-gray-100 pr-6">
        <button type="button" onclick="execAction('formatBlock', 'H1')" class="p-2.5 hover:bg-gray-100 rounded-lg transition-all active:scale-90" title="H1"><span class="text-[17px] font-black">H1</span></button>
        <button type="button" onclick="execAction('formatBlock', 'H2')" class="p-2.5 hover:bg-gray-100 rounded-lg transition-all active:scale-90" title="H2"><span class="text-[16px] font-extrabold">H2</span></button>
        <button type="button" onclick="execAction('formatBlock', 'H3')" class="p-2.5 hover:bg-gray-100 rounded-lg transition-all active:scale-90" title="H3"><span class="text-[15px] font-bold">H3</span></button>
        <button type="button" onclick="execAction('formatBlock', 'H4')" class="p-2.5 hover:bg-gray-100 rounded-lg transition-all active:scale-90" title="H4"><span class="text-[14px] font-bold">H4</span></button>
        <button type="button" onclick="execAction('formatBlock', 'H5')" class="p-2.5 hover:bg-gray-100 rounded-lg transition-all active:scale-90" title="H5"><span class="text-[13px] font-bold">H5</span></button>
        <button type="button" onclick="execAction('formatBlock', 'H6')" class="p-2.5 hover:bg-gray-100 rounded-lg transition-all active:scale-90" title="H6"><span class="text-[12px] font-bold">H6</span></button>
        <button type="button" onclick="execAction('formatBlock', 'P')" class="p-2.5 hover:bg-gray-100 rounded-lg transition-all active:scale-90" title="Text"><span class="text-[12px] font-light">P</span></button>
    </div>

    <div class="flex items-center gap-2">
        <button type="button" onclick="execAction('formatBlock', 'blockquote')" class="group p-2.5 hover:bg-gray-50 rounded-xl transition-all active:scale-90 flex items-center gap-2">
            <span class="font-serif text-xl leading-none text-gray-400 group-hover:text-black">“</span>
            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 group-hover:text-black hidden sm:inline">Quote</span>
        </button>
        <button type="button" onclick="execAction(null, 'OPEN_CODE_MODAL')" class="group p-2.5 hover:bg-gray-50 rounded-xl transition-all active:scale-90 flex items-center gap-2" title="Paste Code Snippet">
            <span class="font-mono text-sm font-bold text-blue-500 group-hover:text-blue-600">{ }</span>
            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 group-hover:text-black hidden sm:inline">Code</span>
        </button>
        <button type="button" onclick="execAction('removeFormat')" class="ml-2 p-2.5 text-red-400 hover:bg-red-50 rounded-xl transition-all active:scale-90" title="Clear Style">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
    </div>
</div>

<div id="codeModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center z-[9999] p-4">
    <div class="bg-white rounded-xl w-full max-w-2xl overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
            <h3 class="font-black uppercase text-[10px] text-gray-500">Paste Code Allowed</h3>
            <button onclick="closeCodeModal()" class="text-gray-400 hover:text-black transition-colors">✕</button>
        </div>
        <div class="p-6">
            <textarea id="codeContent" class="w-full h-72 p-2 bg-[#1e1e1e] text-[#d4d4d4] border-none rounded-xl text-xs focus:ring-0 outline-none resize-none" placeholder="// Paste your code here..."></textarea>
        </div>
        <div class="p-6 flex justify-end gap-4">
            <button onclick="closeCodeModal()" class="px-6 py-2 text-[10px] font-black uppercase text-gray-400">Cancel</button>
            <button onclick="insertCodeBlock()" class="px-8 py-3 text-[10px] font-black uppercase tracking-widest bg-black text-white rounded-full transition-all hover:scale-105">Insert into editor</button>
        </div>
    </div>
</div>

<script>
    // Variabel global untuk mencatat posisi kursor terakhir
    let savedRange = null;

    // Fungsi untuk mencatat posisi kursor
    function saveSelection() {
        const selection = window.getSelection();
        if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            const editor = document.getElementById('editor');
            // Pastikan kursor memang berada di dalam editor
            if (editor.contains(range.commonAncestorContainer)) {
                savedRange = range;
            }
        }
    }

    // Fungsi untuk mengembalikan fokus ke posisi kursor semula
    function restoreSelection() {
        if (savedRange) {
            const selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(savedRange);
        }
    }

    window.execAction = (command, value = null) => {
        const editor = document.getElementById('editor');
        if (!editor) return;

        // 1. Prioritas Utama: Buka Modal Code
        if (command === 'OPEN_CODE_MODAL' || value === 'OPEN_CODE_MODAL') {
            saveSelection(); // Simpan posisi kursor SEBELUM modal terbuka
            const modal = document.getElementById('codeModal');
            if (modal) {
                modal.classList.remove('hidden');
                document.getElementById('codeContent').focus();
            }
            return;
        }

        editor.focus();

        if (command === 'removeFormat') {
            document.execCommand('removeFormat', false, null);
            document.execCommand('formatBlock', false, 'P');
        } else if (command === 'formatBlock') {
            const selection = window.getSelection();
            if (selection.rangeCount > 0) {
                const range = selection.getRangeAt(0);
                let node = range.commonAncestorContainer;
                if (node.nodeType === 3) node = node.parentNode;
                
                const isAlreadyInBlock = node.closest(value);
                
                if (isAlreadyInBlock) {
                    document.execCommand('formatBlock', false, 'P');
                } else {
                    document.execCommand('formatBlock', false, value);
                    if (selection.isCollapsed) {
                        const newBlock = selection.anchorNode.parentElement.closest(value);
                        if (newBlock && newBlock.innerHTML.trim() === "") {
                            newBlock.innerHTML = '<br>';
                        }
                    }
                }
            }
        } else if (command) {
            document.execCommand(command, false, value);
        }

        editor.dispatchEvent(new Event('input', { bubbles: true }));
    };

    function closeCodeModal() {
        document.getElementById('codeModal').classList.add('hidden');
        document.getElementById('codeContent').value = '';
        savedRange = null; // Reset kursor yang tersimpan
    }

    function insertCodeBlock() {
        const textArea = document.getElementById('codeContent');
        let code = textArea.value;
        
        if (!code.trim()) { closeCodeModal(); return; }

        const editor = document.getElementById('editor');
        
        // Kembalikan kursor ke baris yang benar sebelum memasukkan kode
        restoreSelection();
        editor.focus();

        const pre = document.createElement('pre');
        const codeTag = document.createElement('code');
        
        // Membersihkan baris kosong di awal/akhir tapi menjaga indentasi di tengah
        codeTag.textContent = code.replace(/^\s*[\r\n]/, '').trimEnd();
        
        pre.appendChild(codeTag);
        
        const selection = window.getSelection();
        if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            range.deleteContents();
            range.insertNode(pre);
            
            if (typeof hljs !== 'undefined') {
                hljs.highlightElement(codeTag);
            }

            // Tambahkan paragraf baru di bawah kotak kode agar tidak terjebak
            const p = document.createElement('p');
            p.innerHTML = '<br>';
            pre.after(p);
            
            // Pindahkan kursor ke baris baru tersebut secara otomatis
            const newRange = document.createRange();
            newRange.setStart(p, 0);
            newRange.collapse(true);
            selection.removeAllRanges();
            selection.addRange(newRange);
        }
        
        closeCodeModal();
        editor.dispatchEvent(new Event('input', { bubbles: true }));
    }

    document.addEventListener('DOMContentLoaded', () => {
        // 1. Inisialisasi Preferensi Toolbar (LocalStorage)
        const toolbar = document.getElementById('editor-toolbar');
        const checkbox = document.getElementById('toolbar-toggle');
        const isVisible = localStorage.getItem('dwrite_toolbar_visible');

        if (isVisible === 'false') {
            if (checkbox) checkbox.checked = false;
            if (toolbar) {
                toolbar.style.display = 'none';
                toolbar.style.opacity = '0';
                toolbar.style.transform = 'translateY(-10px)';
            }
        } else {
            if (checkbox) checkbox.checked = true;
            if (toolbar) {
                toolbar.style.display = 'flex';
                toolbar.style.opacity = '1';
                toolbar.style.transform = 'translateY(0)';
            }
        }

        // 2. Konfigurasi Editor Utama
        document.execCommand('defaultParagraphSeparator', false, 'p');
        const editor = document.getElementById('editor');
        if (!editor) return;

        // Monitor posisi kursor tiap kali pengguna mengetik atau klik di editor
        editor.addEventListener('mouseup', saveSelection);
        editor.addEventListener('keyup', saveSelection);
        editor.addEventListener('focus', saveSelection);

        // Block Paste di Utama
        editor.addEventListener('paste', (e) => {
            e.preventDefault();
            if (typeof showToast === 'function') {
                showToast("Handcrafted mode: Use 'Code' button for pasting.", "info");
            }
        });

        // Smart Enter di Quote/Code
        editor.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                const selection = window.getSelection();
                const node = selection.anchorNode;
                const container = (node.nodeType === 3 ? node.parentElement : node).closest('blockquote, pre');
                if (container) {
                    e.preventDefault();
                    document.execCommand('insertLineBreak');
                }
            }
        });

        // Initial Highlight untuk konten yang sudah ada
        if (typeof hljs !== 'undefined') {
            hljs.configure({ ignoreUnescapedHTML: true });
            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
            });
        }
    });

    function toggleToolbar(checkbox) {
        const toolbar = document.getElementById('editor-toolbar');
        if (!toolbar) return;

        if (checkbox.checked) {
            // Tampilkan Toolbar
            toolbar.style.display = 'flex';
            setTimeout(() => {
                toolbar.style.opacity = '1';
                toolbar.style.transform = 'translateY(0)';
            }, 10);
            // Simpan status ke localStorage
            localStorage.setItem('dwrite_toolbar_visible', 'true');
        } else {
            // Sembunyikan Toolbar
            toolbar.style.opacity = '0';
            toolbar.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                toolbar.style.display = 'none';
            }, 300);
            // Simpan status ke localStorage
            localStorage.setItem('dwrite_toolbar_visible', 'false');
        }
    }
</script>