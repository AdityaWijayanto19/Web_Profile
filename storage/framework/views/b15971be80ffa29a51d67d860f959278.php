<?php $__env->startSection('title', 'Write Story'); ?>
<?php $__env->startSection('page_title', 'Article Editor'); ?>

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

        /* Inline Code Styling */
        code {
            background: rgba(255, 255, 255, 0.1);
            padding: 2px 6px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            color: #2c974b;
        }

        .ce-paragraph code,
        .ce-header code {
            background: rgba(44, 151, 75, 0.15);
            color: #2c974b;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4 pb-40">

        <header class="flex sticky -top-4 z-50 bg-[#140f17] items-center justify-between py-2 border-b border-white/10 mb-4">
            <div class="flex items-center gap-4">

                <a href="<?php echo e(route('article.index')); ?>"
                    class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-white transition-colors group">
                    <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                    BACK TO PROJECTS
                </a>

                <div class="flex items-center gap-2 px-1 relative">
                    <span id="saveStatusText" class="text-sm font-medium text-gray-400">
                        <?php if($artikel->status === 'publish'): ?>
                            Published
                        <?php else: ?>
                            Draft
                        <?php endif; ?>
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <?php if($artikel->status === 'draft'): ?>
                    <button id="publishBtn"
                        class="text-sm font-semibold bg-white text-black px-5 py-1.5 rounded-md hover:bg-gray-200 transition-all">
                        Publish
                    </button>
                <?php else: ?>
                    <a href="<?php echo e(route('article.edit-metadata', $artikel->id)); ?>"
                        class="text-sm font-semibold bg-blue-600 text-white px-4 py-1.5 rounded-md hover:bg-blue-700 transition-all inline-flex items-center gap-2">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                        Metadata
                    </a>
                    <button id="updateBtn"
                        class="text-sm font-semibold bg-green-600 text-white px-5 py-1.5 rounded-md hover:bg-green-700 transition-all">
                        Update Content
                    </button>
                <?php endif; ?>
            </div>
        </header>


        <div class="flex items-center gap-3 mb-2">
            <div class="flex-1">
                <textarea id="article-title" class="title-input" placeholder="Title" autocomplete="off"><?php echo e($artikel->judul ?? ''); ?></textarea>
            </div>
        </div>

        <div id="editorjs" class="min-h-10"
             data-artikel-id="<?php echo e($artikel->id); ?>"
             data-upload-url="<?php echo e(route('article.upload-image', $artikel->id)); ?>"></div>
    </div>

    <script>
        window.artikelContent = <?php echo json_encode($artikelContent ?? ['blocks' => []]); ?>;
        
        // Debug: Log struktur data
        console.log('=== ARTIKEL CONTENT STRUCTURE ===');
        console.log(JSON.stringify(window.artikelContent, null, 2));
        console.log('================================');
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.30.6"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@2.8.7"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@1.10.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@2.9.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@1.4.0"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/admin/article/create.js']); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/article/create.blade.php ENDPATH**/ ?>