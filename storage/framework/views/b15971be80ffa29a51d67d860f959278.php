<?php $__env->startSection('title', 'Write Story'); ?>
<?php $__env->startSection('page_title', 'Medium Draft'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        :root {
            --m-green: #2c974b;
            --m-border: rgba(255, 255, 255, 0.1);
        }

        /* Selection Styling */
        ::selection {
            background-color: var(--m-green) !important;
            color: #000000 !important;
        }

        ::-moz-selection {
            background-color: var(--m-green) !important;
            color: #000000 !important;
        }

        /* 1. Layout & Typography */
        .ce-block__content,
        .ce-toolbar__content {
            max-width: 720px;
            margin-left: 60px;
        }

        .ce-paragraph {
            font-size: 1.2rem;
            font-family: serif;
            line-height: 1.8;
            color: #e5e5e5;
        }

        /* Heading Styles - Big and Bold */
        .ce-header {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.5;
            margin-bottom: 0.5rem;
        }

        .ce-header[data-level="1"] {
            font-size: 2.2rem;
            font-weight: 800;
        }

        .ce-header[data-level="2"] {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .ce-header[data-level="3"] {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .title-input {
            background: transparent;
            border: none;
            outline: none;
            font-size: 2.5rem;
            font-weight: 800;
            font-family: serif;
            width: 100%;
            color: white;
            letter-spacing: -0.04em;
            resize: none;
            overflow: hidden;
            min-height: auto;
            line-height: 1;
        }

        /* 2. IMAGE SELECTION LOGIC (ROBUST IMPLEMENTATION) */

        /* PRIMARY: Gambar saat blok parent FOKUS (.ce-block--focused) */
        .ce-block--focused .image-tool__image {
            border: 2px solid var(--m-green) !important;
            border-radius: 4px;
            box-shadow: 0 0 0 3px rgba(44, 151, 75, 0.2) !important;
        }

        /* Brightness saat focused */
        .ce-block--focused .image-tool__image-picture {
            filter: brightness(1.02);
        }

        /* DEFAULT State */
        .image-tool__image {
            border-radius: 2px;
            transition: all 0.2s ease;
            background: transparent !important;
            margin: 0 auto;
            position: relative;
        }

        .image-tool__image-picture {
            max-height: 550px;
            width: 100%;
            object-fit: contain;
            display: block;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .image-tool {
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .image-tool--filled {
            background: transparent !important;
        }

        /* Caption Style */
        .image-tool__caption {
            border: none !important;
            text-align: center !important;
            font-size: 0.9rem !important;
            color: rgba(255, 255, 255, 0.4) !important;
            background: transparent !important;
            font-style: italic;
        }

        /* 3. General UI */
        #editorjs.drag-over {
            background: rgba(44, 151, 75, 0.03);
            outline: 2px dashed var(--m-green);
        }

        .ce-toolbar__plus,
        .ce-toolbar__settings-btn {
            color: white !important;
            background: rgba(255, 255, 255, 0.05) !important;
        }

        .ce-popover,
        .ce-inline-toolbar {
            background: #1a151c !important;
            border: 1px solid var(--m-border) !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4 pb-40">
        <!-- Unsaved Indicator & Title Section -->

        
        <header class="flex sticky -top-4 z-50 bg-[#140f17] items-center justify-between py-2 border-b border-white/10 mb-4">
            <div class="flex items-center gap-4">
                <!-- Back Link -->
                <a href="<?php echo e(route('article.index')); ?>"
                    class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-white transition-colors group">
                    <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                    BACK TO PROJECTS
                </a>

                <!-- Status Indicator (Style mirip tab di gambar) -->
                <div class="flex items-center gap-2 px-1 relative">
                    <span id="saveStatusText" class="text-sm font-medium text-gray-400">
                        Draft
                    </span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4">
                <button id="publishBtn"
                    class="text-sm font-semibold bg-white text-black px-5 py-1.5 rounded-md hover:bg-gray-200 transition-all">
                    Publish
                </button>
            </div>
        </header>


        <div class="flex items-center gap-3 mb-2">
            <div class="flex-1">
                <textarea id="article-title" class="title-input" placeholder="Title" autocomplete="off"><?php echo e($artikel->judul ?? ''); ?></textarea>
            </div>
        </div>

        <div id="editorjs" class="min-h-10"></div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.30.6"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@2.8.7"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@1.10.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@2.9.3"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const titleInput = document.getElementById('article-title');
            const editorContainer = document.getElementById('editorjs');
            const saveStatusText = document.getElementById('saveStatusText');
            const saveStatus = document.getElementById('saveStatus'); // Bisa null, akan di-check di updateSaveStatus
            const artikelContent = <?php echo $artikelContent ? json_encode($artikelContent) : json_encode(['blocks' => []]); ?>;

            // =============== SAVE STATE MANAGEMENT ===============
            let hasUnsavedChanges = false;
            let isSaving = false;
            let lastSavedContent = JSON.stringify({
                judul: titleInput ? titleInput.value : '',
                isi_konten: JSON.stringify(artikelContent)
            });

            function updateSaveStatus(isSaved) {
                if (isSaved) {
                    hasUnsavedChanges = false;
                    if (saveStatusText) saveStatusText.textContent = 'Saved';
                    if (saveStatus) {
                        saveStatus.classList.remove('bg-yellow-500/10', 'border-yellow-500/30');
                        saveStatus.classList.add('bg-[#2c974b]/10', 'border-[#2c974b]/30');
                        saveStatusText.classList.remove('text-yellow-500');
                        saveStatusText.classList.add('text-[#2c974b]');
                    }
                } else {
                    hasUnsavedChanges = true;
                    if (saveStatusText) saveStatusText.textContent = 'Unsaved';
                    if (saveStatus) {
                        saveStatus.classList.remove('bg-[#2c974b]/10', 'border-[#2c974b]/30');
                        saveStatus.classList.add('bg-yellow-500/10', 'border-yellow-500/30');
                        saveStatusText.classList.remove('text-[#2c974b]');
                        saveStatusText.classList.add('text-yellow-500');
                    }
                }
            }

            async function saveArticleContent() {
                if (isSaving || !hasUnsavedChanges) return;

                isSaving = true;
                try {
                    const output = await editor.save();
                    const artikelId = <?php echo e($artikel->id); ?>;
                    const currentContent = {
                        judul: titleInput ? titleInput.value : '',
                        isi_konten: JSON.stringify(output)
                    };

                    const response = await fetch(`/admin/article/${artikelId}/save-content`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify(currentContent)
                    });

                    if (response.ok) {
                        lastSavedContent = JSON.stringify(currentContent);
                        updateSaveStatus(true);
                    }
                    isSaving = false;
                } catch (err) {
                    console.error('Save error:', err);
                    isSaving = false;
                }
            }

            // Check if content changed from last saved
            async function checkContentChanged() {
                const output = await editor.save();
                const currentContent = {
                    judul: titleInput ? titleInput.value : '',
                    isi_konten: JSON.stringify(output)
                };
                const currentContentStr = JSON.stringify(currentContent);

                if (currentContentStr !== lastSavedContent) {
                    updateSaveStatus(false);
                }
            }

            // Track changes
            if (titleInput) titleInput.addEventListener('input', checkContentChanged);
            if (editorContainer) {
                editorContainer.addEventListener('input', checkContentChanged);
                editorContainer.addEventListener('drop', () => setTimeout(checkContentChanged, 500));
                editorContainer.addEventListener('paste', () => setTimeout(checkContentChanged, 300));
            }

            const uploader = (file) => new Promise((res) => {
                const reader = new FileReader();
                reader.onload = (e) => res({
                    success: 1,
                    file: {
                        url: e.target.result
                    }
                });
                reader.readAsDataURL(file);
            });

            const editor = new EditorJS({
                holder: 'editorjs',
                placeholder: 'Tell your story...',
                data: artikelContent,
                tools: {
                    header: {
                        class: Header,
                        inlineToolbar: true
                    },
                    list: {
                        class: List,
                        inlineToolbar: true
                    },
                    image: {
                        class: ImageTool,
                        config: {
                            uploader: {
                                uploadByFile: uploader
                            }
                        },
                        inlineToolbar: true
                    }
                },
                onReady: () => {
                    bindEvents();
                    initCustomUndoRedo();
                }
            });

            // =============== CUSTOM UNDO/REDO MANAGER ===============
            let undoStack = [];
            let redoStack = [];
            const MAX_HISTORY = 50;
            let saveTimeout;
            let lastSavedState = null;

            async function saveEditorState() {
                try {
                    const data = await editor.save();
                    const dataStr = JSON.stringify(data);

                    // Only save if state changed
                    if (dataStr === lastSavedState) {
                        return;
                    }

                    lastSavedState = dataStr;
                    // Remove redo stack saat ada changes baru
                    redoStack = [];
                    // Add to undo stack
                    undoStack.push(data);
                    // Limit history size
                    if (undoStack.length > MAX_HISTORY) {
                        undoStack.shift();
                    }
                } catch (err) {
                    console.warn('Error saving state:', err);
                }
            }

            function debouncedSaveState() {
                clearTimeout(saveTimeout);
                saveTimeout = setTimeout(saveEditorState, 300);
            }

            async function undo() {
                if (undoStack.length < 2) {
                    return;
                }

                try {
                    // Get previous state
                    const previousData = undoStack[undoStack.length - 2];
                    // Current state push to redo
                    const currentData = undoStack.pop();
                    redoStack.push(currentData);

                    // Clear editor dan render previous state
                    await editor.render(previousData);
                    lastSavedState = JSON.stringify(previousData);

                } catch (err) {
                    console.warn('Undo error:', err);
                }
            }

            async function redo() {
                if (redoStack.length === 0) {
                    return;
                }

                try {
                    // Get next state from redo
                    const nextData = redoStack.pop();
                    // Current state back to undo
                    undoStack.push(nextData);

                    // Clear editor dan render next state
                    await editor.render(nextData);
                    lastSavedState = JSON.stringify(nextData);
                } catch (err) {
                    console.warn('Redo error:', err);
                }
            }

            async function initCustomUndoRedo() {
                // Save initial empty state
                await saveEditorState();

                // Monitor ALL text input dalam editor via input event bubbling
                editorContainer.addEventListener('input', debouncedSaveState, true);

                // Monitor image uploads via drop event
                editorContainer.addEventListener('drop', () => {
                    setTimeout(debouncedSaveState, 500);
                });

                // Monitor image tool changes via custom events
                editorContainer.addEventListener('paste', () => {
                    setTimeout(debouncedSaveState, 300);
                });

                // Handle Ctrl+Z and Ctrl+Y globally untuk undo/redo
                document.addEventListener('keydown', async (e) => {
                    if ((e.ctrlKey || e.metaKey) && e.key === 'z' && !e.shiftKey) {
                        e.preventDefault();
                        await undo();
                    } else if ((e.ctrlKey || e.metaKey) && (e.key === 'y' || (e.shiftKey && e
                            .key === 'z'))) {
                        e.preventDefault();
                        await redo();
                    }
                });
            }

            function bindEvents() {
                // =============== TITLE TO EDITOR NAVIGATION ===============
                titleInput.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowDown' || e.key === 'Enter') {
                        e.preventDefault();
                        editor.focus();
                        // Move to first block at start
                        editor.blocks.getBlockByIndex(0);
                    }
                });

                // =============== EDITOR TO TITLE NAVIGATION ===============
                editorContainer.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowUp') {
                        const index = editor.blocks.getCurrentBlockIndex();
                        const currentBlock = editor.blocks.getBlockByIndex(index);

                        // If at first block (index 0), move to title
                        if (index === 0 || index === -1) {
                            e.preventDefault();
                            e.stopImmediatePropagation();
                            titleInput.focus();
                            // Move cursor to end of title
                            titleInput.setSelectionRange(titleInput.value.length, titleInput.value.length);
                            return;
                        }
                    }
                });

                // =============== IMAGE SELECTION VIA CLICK ===============
                editorContainer.addEventListener('click', (e) => {
                    // Check if clicking on caption or contenteditable inside image tool
                    const captionElem = e.target.closest('.image-tool__caption');
                    const isEditableInImageTool = e.target.hasAttribute('contenteditable') &&
                        e.target.closest('.image-tool');

                    if (captionElem || isEditableInImageTool) {
                        return;
                    }

                    const imageToolElem = e.target.closest('.image-tool');
                    if (imageToolElem) {
                        console.log('✓ Image click detected!', imageToolElem);
                        const imgBlock = imageToolElem.closest('.ce-block');
                        if (imgBlock) {
                            // Remove focused class dari semua blocks
                            editorContainer.querySelectorAll('.ce-block').forEach(block => {
                                block.classList.remove('ce-block--focused');
                            });

                            // Add focused class ke clicked block
                            imgBlock.classList.add('ce-block--focused');
                            // Blur any text elements to remove cursor
                            editorContainer.querySelectorAll('[contenteditable="true"]').forEach(el => el
                                .blur());
                        }
                    } else {
                        // Jika klik di text/non-image area, remove focus dari semua image blocks
                        const focusedBlocks = editorContainer.querySelectorAll('.ce-block--focused');
                        focusedBlocks.forEach(block => {
                            // Hanya remove jika block itu image
                            if (block.querySelector('.image-tool')) {
                                block.classList.remove('ce-block--focused');
                            }
                        });
                    }
                });

                // =============== REMOVE IMAGE FOCUS WHEN TEXT GETS FOCUS ===============
                const removeImageFocus = () => {
                    editorContainer.querySelectorAll('.ce-block--focused').forEach(block => {
                        block.classList.remove('ce-block--focused');
                    });
                };

                // Monitor ALL contenteditable elements untuk remove image focus saat text focused
                editorContainer.addEventListener('focus', (e) => {
                    if (e.target.hasAttribute('contenteditable')) {
                        removeImageFocus();
                    }
                }, true);

                // =============== IMAGE DELETE ON BACKSPACE (tapi allow Ctrl+Z,Y) ===============
                document.addEventListener('keydown', async (e) => {
                    // Allow Ctrl+Z (Undo) dan Ctrl+Y (Redo) - handled by custom manager
                    if ((e.ctrlKey || e.metaKey) && (e.key === 'z' || e.key === 'y' || (e.shiftKey && e
                            .key === 'z'))) {
                        return; // Let custom undo/redo handle it
                    }

                    if (e.key === 'Backspace' || e.key === 'Delete') {
                        const focusedBlock = editorContainer.querySelector('.ce-block--focused');

                        if (focusedBlock && focusedBlock.querySelector('.image-tool')) {
                            e.preventDefault();

                            const allBlocks = Array.from(editorContainer.querySelectorAll('.ce-block'));
                            const blockIndex = allBlocks.indexOf(focusedBlock);

                            if (editor.blocks && editor.blocks.delete && blockIndex >= 0) {
                                try {
                                    editor.blocks.delete(blockIndex);
                                    // Delay slightly untuk memastikan DOM updated sebelum save
                                    setTimeout(async () => {
                                        await saveEditorState();
                                    }, 50);
                                } catch (err) {
                                    console.warn('Delete error:', err);
                                }
                            }
                        }
                    }
                });

                // =============== ARROW NAVIGATION - SELECT IMAGE ===============
                editorContainer.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
                        // Check if ArrowUp on first block - should go to title instead
                        if (e.key === 'ArrowUp') {
                            const index = editor.blocks.getCurrentBlockIndex();
                            if (index === 0 || index === -1) {
                                return;
                            }
                        }

                        setTimeout(() => {
                            // Skip if title is now focused (already moved by editor to title handler)
                            if (document.activeElement === titleInput) {
                                return;
                            }

                            const currentIndex = editor.blocks.getCurrentBlockIndex();
                            const allBlocks = Array.from(editorContainer.querySelectorAll(
                                '.ce-block'));

                            if (currentIndex >= 0 && allBlocks[currentIndex]) {
                                const currentBlock = allBlocks[currentIndex];

                                // Remove focused from all blocks
                                allBlocks.forEach(block => block.classList.remove(
                                    'ce-block--focused'));

                                // If current block is image, add focused class
                                if (currentBlock.querySelector('.image-tool')) {
                                    currentBlock.classList.add('ce-block--focused');
                                    // Blur any text elements to remove cursor
                                    editorContainer.querySelectorAll('[contenteditable="true"]')
                                        .forEach(el => el.blur());
                                } else {
                                    // If current block is text, re-focus it to show cursor
                                    const textBlock = currentBlock.querySelector(
                                        '[contenteditable="true"]');
                                    if (textBlock) {
                                        textBlock.focus();
                                    }
                                }
                            }
                        }, 10);
                    }
                });

                // =============== AUTO LIST FORMATTING (Ordered & Unordered) ===============
                editorContainer.addEventListener('input', async (e) => {
                    const block = e.target.closest('[contenteditable="true"]');
                    if (!block) return;

                    const text = block.textContent;
                    let isList = false;
                    let isOrdered = false;

                    // Check untuk ordered list: "1. " atau "1) "
                    if (/^1[\.\)]\s/.test(text)) {
                        isList = true;
                        isOrdered = true;
                    }
                    // Check untuk unordered list: "- " atau "* "
                    else if (/^[\-\*]\s/.test(text)) {
                        isList = true;
                        isOrdered = false;
                    }

                    if (isList) {
                        try {
                            const currentIndex = editor.blocks.getCurrentBlockIndex();
                            const currentData = editor.blocks.getBlockByIndex(currentIndex).data;

                            // Get content without the list marker
                            let content = text;
                            if (isOrdered) {
                                content = text.replace(/^1[\.\)]\s/, '').trim();
                            } else {
                                content = text.replace(/^[\-\*]\s/, '').trim();
                            }

                            // Delete current paragraph block
                            await editor.blocks.delete(currentIndex);

                            // Insert list block
                            await editor.blocks.insert(
                                'list', {
                                    style: isOrdered ? 'ordered' : 'unordered',
                                    items: [content || '']
                                }, {},
                                currentIndex
                            );

                            // Focus to newly created list
                            setTimeout(() => {
                                const newBlock = editor.blocks.getBlockByIndex(currentIndex);
                                if (newBlock && newBlock.holder) {
                                    const listItem = newBlock.holder.querySelector('li');
                                    if (listItem) {
                                        listItem.focus();
                                        // Move cursor ke end of content
                                        const range = document.createRange();
                                        const sel = window.getSelection();
                                        range.selectNodeContents(listItem);
                                        range.collapse(false);
                                        sel.removeAllRanges();
                                        sel.addRange(range);
                                    }
                                }
                            }, 50);

                            await saveEditorState();

                        } catch (err) {
                            console.warn('Auto list error:', err);
                        }
                    }
                });

                // =============== DELETE LIST ITEM ON BACKSPACE AT START ===============
                editorContainer.addEventListener('keydown', async (e) => {
                    if (e.key !== 'Backspace') return;

                    const sel = window.getSelection();
                    if (sel.rangeCount === 0) return;

                    const range = sel.getRangeAt(0);
                    const focusNode = range.commonAncestorContainer;

                    // Find the LI element
                    const liElement = focusNode.nodeType === 3 ?
                        focusNode.parentElement.closest('li') :
                        focusNode.closest('li');

                    if (!liElement) return; // Not in a list

                    // Find the list container (OL or UL)
                    const listContainer = liElement.closest('.cdx-list');
                    if (!listContainer) return;

                    // Check if item is EMPTY
                    const itemText = liElement.textContent.trim();
                    const isEmpty = itemText === '';

                    if (!isEmpty) return; // Only delete if item is empty

                    // Fully prevent all default behavior
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    e.stopPropagation();

                    try {
                        // Remove LI from DOM
                        liElement.remove();

                        // Check apakah masih ada LI lain
                        const remainingItems = listContainer.querySelectorAll('li');

                        if (remainingItems.length === 0) {
                            // List kosong, hapus block
                            const currentIndex = editor.blocks.getCurrentBlockIndex();
                            await editor.blocks.delete(currentIndex);
                            await editor.blocks.insert('paragraph', {
                                text: ''
                            }, {}, currentIndex);
                        } else {
                            // Focus ke item sebelumnya
                            const itemIndex = Math.max(0, remainingItems.length - 1);
                            remainingItems[itemIndex]?.focus();
                        }

                        // Save state untuk undo/redo
                        saveEditorState();

                    } catch (err) {
                        console.error('List delete error:', err);
                    }
                });

                // =============== DRAG & DROP STYLING ===============
                editorContainer.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    editorContainer.classList.add('drag-over');
                });
                ['dragleave', 'drop'].forEach(evt => {
                    editorContainer.addEventListener(evt, () => editorContainer.classList.remove(
                        'drag-over'));
                });

                // =============== MAKE FOCUSED STATE VISIBLE (FALLBACK) ===============
                // Monitor DOM untuk memastikan styling diterapkan
                // REMOVED: MutationObserver causing freeze - not needed


            }

            // Ctrl+S save handler
            document.addEventListener('keydown', async (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    await saveArticleContent();
                }
            });

            // Browser warning on unsaved changes
            window.addEventListener('beforeunload', (e) => {
                if (hasUnsavedChanges) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            document.getElementById('publishBtn').onclick = async () => {
                try {
                    // Save editor content
                    const output = await editor.save();
                    const artikelId = <?php echo e($artikel->id); ?>;

                    // Save to database
                    const response = await fetch(`/admin/article/${artikelId}/save-content`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                        },
                        body: JSON.stringify({
                            judul: titleInput ? titleInput.value : '',
                            isi_konten: JSON.stringify(output),
                        })
                    });

                    if (!response.ok) {
                        const error = await response.json();
                        alert('Gagal menyimpan konten: ' + (error.error || 'Unknown error'));
                        return;
                    }

                    // Redirect to publish form
                    updateSaveStatus(true);
                    window.location.href = `/admin/article/${artikelId}/publish`;
                } catch (err) {
                    console.error('Publish error:', err);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            };

            if (window.lucide) window.lucide.createIcons();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/article/create.blade.php ENDPATH**/ ?>