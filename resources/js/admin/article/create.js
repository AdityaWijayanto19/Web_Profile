

        document.addEventListener('DOMContentLoaded', () => {
            const titleInput = document.getElementById('article-title');
            const editorContainer = document.getElementById('editorjs');
            const saveStatusText = document.getElementById('saveStatusText');
            const saveStatus = document.getElementById('saveStatus');

            const artikelId = editorContainer?.dataset.artikelId;
            const uploadUrl = editorContainer?.dataset.uploadUrl;
            const artikelContent = window.artikelContent || { blocks: [] };

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

            if (titleInput) titleInput.addEventListener('input', checkContentChanged);
            if (editorContainer) {
                editorContainer.addEventListener('input', checkContentChanged);
                editorContainer.addEventListener('drop', () => setTimeout(checkContentChanged, 500));
                editorContainer.addEventListener('paste', () => setTimeout(checkContentChanged, 300));

                // Detect inline formatting changes (bold, italic, code, links)
                editorContainer.addEventListener('mouseup', () => setTimeout(checkContentChanged, 100));
                editorContainer.addEventListener('keyup', () => setTimeout(checkContentChanged, 100));
            }

            // Custom Inline Code Tool
            class InlineCode {
                constructor() {
                    this.tag = 'code';
                    this.class = 'inline-code';
                    this.button = null;
                }

                static get isInline() {
                    return true;
                }

                render() {
                    this.button = document.createElement('button');
                    this.button.type = 'button';
                    this.button.innerHTML = '&lt;code&gt;';
                    this.button.classList.add('ce-inline-tool');
                    this.button.title = 'Inline Code (Cmd+Shift+M)';
                    return this.button;
                }

                surround(range) {
                    const selectedText = range.extractContents();
                    const code = document.createElement(this.tag);
                    code.appendChild(selectedText);
                    range.insertNode(code);
                }

                checkState() {
                    return document.queryCommandState('formatBlock', false, 'code');
                }

                static get sanitize() {
                    return {
                        code: {}
                    };
                }

                static get shortcut() {
                    return 'CMD+SHIFT+M';
                }
            }
            const uploader = (file) => new Promise((res) => {
                const formData = new FormData();
                formData.append('image', file);

                fetch(uploadUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        res({
                            success: 1,
                            file: data.file
                        });
                    } else {
                        res({
                            success: 0,
                            message: data.error || 'Image upload failed'
                        });
                    }
                })
                .catch(error => {
                    console.error('Upload error:', error);
                    res({
                        success: 0,
                        message: 'Network error during upload'
                    });
                });
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
                    },
                    inlineCode: {
                        class: InlineCode,
                        shortcut: 'CMD+SHIFT+M'
                    }
                },
                onReady: () => {
                    bindEvents();
                    initCustomUndoRedo();
                }
            });

            let undoStack = [];
            let redoStack = [];
            const MAX_HISTORY = 50;
            let saveTimeout;
            let lastSavedState = null;

            async function saveEditorState() {
                try {
                    const data = await editor.save();
                    const dataStr = JSON.stringify(data);

                    if (dataStr === lastSavedState) {
                        return;
                    }

                    lastSavedState = dataStr;
                    redoStack = [];
                    undoStack.push(data);

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
                    const previousData = undoStack[undoStack.length - 2];
                    const currentData = undoStack.pop();
                    redoStack.push(currentData);

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
                    const nextData = redoStack.pop();
                    undoStack.push(nextData);

                    await editor.render(nextData);
                    lastSavedState = JSON.stringify(nextData);
                } catch (err) {
                    console.warn('Redo error:', err);
                }
            }

            async function initCustomUndoRedo() {

                await saveEditorState();


                editorContainer.addEventListener('input', debouncedSaveState, true);


                editorContainer.addEventListener('drop', () => {
                    setTimeout(debouncedSaveState, 500);
                });


                editorContainer.addEventListener('paste', () => {
                    setTimeout(debouncedSaveState, 300);
                });


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
                titleInput.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowDown' || e.key === 'Enter') {
                        e.preventDefault();
                        editor.focus();

                        editor.blocks.getBlockByIndex(0);
                    }
                });

                editorContainer.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowUp') {
                        const index = editor.blocks.getCurrentBlockIndex();
                        const currentBlock = editor.blocks.getBlockByIndex(index);

                        if (index === 0 || index === -1) {
                            e.preventDefault();
                            e.stopImmediatePropagation();
                            titleInput.focus();
                            titleInput.setSelectionRange(titleInput.value.length, titleInput.value.length);
                            return;
                        }
                    }
                });

                editorContainer.addEventListener('click', (e) => {
                    const captionElem = e.target.closest('.image-tool__caption');
                    const isEditableInImageTool = e.target.hasAttribute('contenteditable') &&
                        e.target.closest('.image-tool');

                    if (captionElem || isEditableInImageTool) {
                        return;
                    }

                    const imageToolElem = e.target.closest('.image-tool');
                    if (imageToolElem) {

                        const imgBlock = imageToolElem.closest('.ce-block');
                        if (imgBlock) {

                            editorContainer.querySelectorAll('.ce-block').forEach(block => {
                                block.classList.remove('ce-block--focused');
                            });

                            imgBlock.classList.add('ce-block--focused');

                            editorContainer.querySelectorAll('[contenteditable="true"]').forEach(el => el
                                .blur());
                        }
                    } else {
                        const focusedBlocks = editorContainer.querySelectorAll('.ce-block--focused');
                        focusedBlocks.forEach(block => {
                            if (block.querySelector('.image-tool')) {
                                block.classList.remove('ce-block--focused');
                            }
                        });
                    }
                });

                const removeImageFocus = () => {
                    editorContainer.querySelectorAll('.ce-block--focused').forEach(block => {
                        block.classList.remove('ce-block--focused');
                    });
                };

                editorContainer.addEventListener('focus', (e) => {
                    if (e.target.hasAttribute('contenteditable')) {
                        removeImageFocus();
                    }
                }, true);

                document.addEventListener('keydown', async (e) => {
                    if ((e.ctrlKey || e.metaKey) && (e.key === 'z' || e.key === 'y' || (e.shiftKey && e
                            .key === 'z'))) {
                        return;
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

                editorContainer.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
                        if (e.key === 'ArrowUp') {
                            const index = editor.blocks.getCurrentBlockIndex();
                            if (index === 0 || index === -1) {
                                return;
                            }
                        }

                        setTimeout(() => {
                            if (document.activeElement === titleInput) {
                                return;
                            }

                            const currentIndex = editor.blocks.getCurrentBlockIndex();
                            const allBlocks = Array.from(editorContainer.querySelectorAll(
                                '.ce-block'));

                            if (currentIndex >= 0 && allBlocks[currentIndex]) {
                                const currentBlock = allBlocks[currentIndex];

                                allBlocks.forEach(block => block.classList.remove(
                                    'ce-block--focused'));

                                if (currentBlock.querySelector('.image-tool')) {
                                    currentBlock.classList.add('ce-block--focused');
                                    editorContainer.querySelectorAll('[contenteditable="true"]')
                                        .forEach(el => el.blur());
                                } else {
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

                editorContainer.addEventListener('input', async (e) => {
                    const block = e.target.closest('[contenteditable="true"]');
                    if (!block) return;

                    const text = block.textContent;
                    let isList = false;
                    let isOrdered = false;

                    if (/^1[\.\)]\s/.test(text)) {
                        isList = true;
                        isOrdered = true;
                    }

                    else if (/^[\-\*]\s/.test(text)) {
                        isList = true;
                        isOrdered = false;
                    }

                    if (isList) {
                        try {
                            const currentIndex = editor.blocks.getCurrentBlockIndex();
                            const currentData = editor.blocks.getBlockByIndex(currentIndex).data;

                            let content = text;
                            if (isOrdered) {
                                content = text.replace(/^1[\.\)]\s/, '').trim();
                            } else {
                                content = text.replace(/^[\-\*]\s/, '').trim();
                            }

                            await editor.blocks.delete(currentIndex);

                            await editor.blocks.insert(
                                'list', {
                                    style: isOrdered ? 'ordered' : 'unordered',
                                    items: [content || '']
                                }, {},
                                currentIndex
                            );

                            setTimeout(() => {
                                const newBlock = editor.blocks.getBlockByIndex(currentIndex);
                                if (newBlock && newBlock.holder) {
                                    const listItem = newBlock.holder.querySelector('li');
                                    if (listItem) {
                                        listItem.focus();
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

                editorContainer.addEventListener('keydown', async (e) => {
                    if (e.key !== 'Backspace') return;

                    const sel = window.getSelection();
                    if (sel.rangeCount === 0) return;

                    const range = sel.getRangeAt(0);
                    const focusNode = range.commonAncestorContainer;

                    const liElement = focusNode.nodeType === 3 ?
                        focusNode.parentElement.closest('li') :
                        focusNode.closest('li');

                    if (!liElement) return;

                    const listContainer = liElement.closest('.cdx-list');
                    if (!listContainer) return;

                    const itemText = liElement.textContent.trim();
                    const isEmpty = itemText === '';

                    if (!isEmpty) return;

                    e.preventDefault();
                    e.stopImmediatePropagation();
                    e.stopPropagation();

                    try {

                        liElement.remove();

                        const remainingItems = listContainer.querySelectorAll('li');

                        if (remainingItems.length === 0) {

                            const currentIndex = editor.blocks.getCurrentBlockIndex();
                            await editor.blocks.delete(currentIndex);
                            await editor.blocks.insert('paragraph', {
                                text: ''
                            }, {}, currentIndex);
                        } else {

                            const itemIndex = Math.max(0, remainingItems.length - 1);
                            remainingItems[itemIndex]?.focus();
                        }


                        saveEditorState();

                    } catch (err) {
                        console.error('List delete error:', err);
                    }
                });

                editorContainer.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    editorContainer.classList.add('drag-over');
                });
                ['dragleave', 'drop'].forEach(evt => {
                    editorContainer.addEventListener(evt, () => editorContainer.classList.remove(
                        'drag-over'));
                });

            }

            document.addEventListener('keydown', async (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    await saveArticleContent();
                }
            });

            window.addEventListener('beforeunload', (e) => {
                if (hasUnsavedChanges) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            document.getElementById('publishBtn').onclick = async () => {
                try {
                    const output = await editor.save();

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

                    updateSaveStatus(true);
                    window.location.href = `/admin/article/${artikelId}/publish`;
                } catch (err) {
                    console.error('Publish error:', err);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            };

            // Handle update button for published articles
            const updateBtn = document.getElementById('updateBtn');
            if (updateBtn) {
                updateBtn.onclick = async () => {
                    try {
                        const output = await editor.save();

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
                            alert('Gagal memperbarui konten: ' + (error.error || 'Unknown error'));
                            return;
                        }

                        updateSaveStatus(true);
                        alert('Konten artikel berhasil diperbarui!');
                        window.location.href = '/admin/article/index';
                    } catch (err) {
                        console.error('Update error:', err);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                };
            }

            if (window.lucide) window.lucide.createIcons();
        });
