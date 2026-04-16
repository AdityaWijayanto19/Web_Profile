<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G-Docs Editor Fix</title>

    <!-- Tailwind CSS (Abaikan warning production di console) -->
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>

    <style>
        .ce-block__content, .ce-toolbar__content { max-width: 800px; }
        .editor-paper {
            background: white;
            min-height: 1000px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border: 1px solid #e5e7eb;
        }
        /* Style agar list editorjs terlihat seperti GDocs */
        .cdx-list { margin: 0; padding-left: 20px; }
        .ce-paragraph { line-height: 1.6; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    <nav class="bg-white border-b border-gray-200 px-6 py-2 sticky top-0 z-50 flex justify-between items-center shadow-sm">
        <div class="flex items-center gap-4">
            <div class="bg-blue-600 text-white p-1 rounded italic font-bold px-2 text-sm">DOC</div>
            <input type="text" value="Untitled Document" class="focus:outline-none focus:border-blue-500 border-b border-transparent px-1">
        </div>
        <button id="save-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-1.5 rounded-full text-sm font-medium transition">
            Simpan
        </button>
    </nav>

    <div class="mt-8 mb-20 px-4">
        <div class="max-w-4xl mx-auto editor-paper p-10 md:p-16">
            <div id="editorjs" class="prose prose-slate max-w-none"></div>
        </div>
    </div>

    <!-- LOAD SCRIPTS DENGAN LINK BUNDLE (UMD) AGAR VARIABEL GLOBAL TERSEDIA -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.29.1/dist/editor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@2.11.3/dist/bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@1.10.0/dist/bundle.js"></script>

    <script>
        // Gunakan pengecekan yang lebih kuat
        const startEditor = () => {
            // Cek apakah class tersedia di global window
            // Catatan: Nama class di CDN terkadang 'List' terkadang 'NestedList'
            // Namun untuk plugin List standar biasanya 'List'
            if (typeof EditorJS === 'undefined' || typeof List === 'undefined' || typeof Paragraph === 'undefined') {
                console.log('Menyiapkan library...');
                setTimeout(startEditor, 100);
                return;
            }

            const editor = new EditorJS({
                holder: 'editorjs',
                tools: {
                    paragraph: {
                        class: Paragraph,
                        inlineToolbar: true,
                    },
                    list: {
                        class: List,
                        inlineToolbar: true,
                        config: {
                            defaultStyle: 'unordered'
                        }
                    }
                },
                placeholder: "Ketik '-' atau '1.' lalu spasi...",
                onReady: () => {
                    console.log('Editor Ready');
                    setupInteractions(editor);
                }
            });

            // Handler tombol simpan
            document.getElementById('save-btn').onclick = async () => {
                const data = await editor.save();
                console.log("Konten JSON:", data);
                alert("Berhasil simpan! Cek console log (F12)");
            }
        };

        function setupInteractions(editor) {
            const el = document.getElementById('editorjs');

            // 1. Fitur Auto List (- atau 1. + Space)
            el.addEventListener('keyup', async (e) => {
                if (e.key === ' ') {
                    const idx = await editor.blocks.getCurrentBlockIndex();
                    const block = await editor.blocks.getBlockByIndex(idx);

                    if (block.name === 'paragraph') {
                        const text = block.holder.innerText.trim();
                        if (text === '-' || text === '*') {
                            changeBlockToList(editor, idx, 'unordered');
                        } else if (text === '1.') {
                            changeBlockToList(editor, idx, 'ordered');
                        }
                    }
                }
            });

            // 2. Fitur Backspace (GDocs Behavior)
            el.addEventListener('keydown', async (e) => {
                if (e.key === 'Backspace') {
                    const idx = await editor.blocks.getCurrentBlockIndex();
                    const block = await editor.blocks.getBlockByIndex(idx);

                    if (block.name === 'list') {
                        const items = block.holder.querySelectorAll('.cdx-list__item');
                        const selection = window.getSelection();

                        // Jika item list kosong dan kursor di depan, balikkan ke paragraf
                        if (items.length === 1 && items[0].innerText.trim() === "" && selection.anchorOffset === 0) {
                            e.preventDefault();
                            await editor.blocks.delete(idx);
                            await editor.blocks.insert('paragraph', { text: '' }, {}, idx, true);
                            editor.caret.setToBlock(idx);
                        }
                    }
                }
            });
        }

        async function changeBlockToList(editor, index, style) {
            await editor.blocks.delete(index);
            await editor.blocks.insert('list', {
                style: style,
                items: ['']
            }, {}, index, true);
            editor.caret.setToBlock(index);
        }

        // Jalankan fungsi
        startEditor();
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/editor.blade.php ENDPATH**/ ?>