<?php $__env->startSection('title', 'Publish Article'); ?>
<?php $__env->startSection('page_title', 'Finalize Article'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .form-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e5e5e5;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.08);
            border-color: #2c974b;
            box-shadow: 0 0 0 3px rgba(44, 151, 75, 0.1);
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #ffffff;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-description {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 0.25rem;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #2c974b;
            color: white;
        }

        .btn-primary:hover {
            background: #237a3d;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #e5e5e5;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .preview-box {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-top: 2rem;
        }

        .preview-title {
            font-size: 2rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 1rem;
        }

        .preview-meta {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.875rem;
            line-height: 1.6;
        }

        .char-count {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 0.25rem;
        }

        .image-selector {
            position: relative;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 0.5rem;
            overflow: hidden;
            transition: all 0.2s ease;
            aspect-ratio: 16/9;
        }

        .image-selector:hover {
            border-color: rgba(44, 151, 75, 0.5);
            transform: scale(1.02);
        }

        .image-selector.selected {
            border-color: #2c974b;
            box-shadow: 0 0 0 3px rgba(44, 151, 75, 0.2);
        }

        .image-selector img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-selector-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .image-selector:hover .image-selector-overlay {
            opacity: 1;
        }

        .image-selector.selected .image-selector-overlay {
            opacity: 1;
            background: rgba(44, 151, 75, 0.7);
        }

        .checkmark {
            color: white;
            font-size: 1.5rem;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Ready to Publish?</h1>
            <p class="text-gray-400">Add metadata and finalize your article before publishing.</p>
        </div>

        <form method="POST" action="<?php echo e(route('article.publish-finalize', $artikel->id)); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('POST'); ?>

            <!-- Title -->
            <div class="form-group">
                <label for="judul" class="form-label">Article Title</label>
                <input
                    type="text"
                    id="judul"
                    name="judul"
                    class="form-input w-full <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('judul', $artikel->judul)); ?>"
                    required
                    maxlength="255"
                >
                <div class="char-count">
                    <span id="judul-count"><?php echo e(strlen(old('judul', $artikel->judul))); ?></span>/255 characters
                </div>
                <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-400 text-sm"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Meta Description -->
            <div class="form-group">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea
                    id="meta_description"
                    name="meta_description"
                    rows="3"
                    class="form-input w-full <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Write a compelling description (160 characters max)"
                    maxlength="160"
                ><?php echo e(old('meta_description', $artikel->meta_description)); ?></textarea>
                <div class="char-count">
                    <span id="meta-count"><?php echo e(strlen(old('meta_description', $artikel->meta_description ?? ''))); ?></span>/160 characters
                </div>
                <p class="form-description">
                    This description will appear in search results and social media previews.
                </p>
                <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-400 text-sm"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Featured Image Selection -->
            <div class="form-group">
                <label class="form-label">Featured Image</label>
                <p class="form-description mb-3">Select an image from your article to use as featured image</p>

                <div id="images-container" class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    <p class="text-gray-400 text-sm col-span-full" id="loading-images">Loading images...</p>
                </div>

                <input type="hidden" id="path_gambar" name="path_gambar" value="<?php echo e(old('path_gambar', $artikel->path_gambar)); ?>">

                <?php $__errorArgs = ['path_gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-400 text-sm"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Reading Time -->
            <div class="form-group">
                <label for="menit_baca" class="form-label">Estimated Reading Time (minutes)</label>
                <input
                    type="number"
                    id="menit_baca"
                    name="minet_baca"
                    class="form-input w-full <?php $__errorArgs = ['menit_baca'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('menit_baca', $artikel->menit_baca)); ?>"
                    min="1"
                    max="1000"
                    readonly
                >
                <p class="form-description">
                    Automatically calculated based on article content (200 words per minute)
                </p>
                <?php $__errorArgs = ['menit_baca'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-400 text-sm"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Slug (Optional) -->
            <div class="form-group">
                <label for="slug" class="form-label">Slug (URL Friendly)</label>
                <input
                    type="text"
                    id="slug"
                    name="slug"
                    class="form-input w-full <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('slug', $artikel->slug)); ?>"
                    maxlength="255"
                    placeholder="leave blank to auto-generate from title"
                >
                <p class="form-description">
                    The URL-friendly version of the article title. Leave blank to auto-generate.
                </p>
                <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-400 text-sm"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Preview -->
            <div class="preview-box">
                <h3 class="text-white font-semibold mb-4">Preview</h3>
                <div class="preview-title" id="preview-title"><?php echo e($artikel->judul); ?></div>
                <div class="preview-meta">
                    <p id="preview-description"><?php echo e($artikel->meta_description ?: 'No description added yet'); ?></p>
                    <p class="mt-2">
                        <span id="preview-reading-time"><?php echo e($artikel->menit_baca ?? '--'); ?></span> min read
                    </p>
                </div>
            </div>

            <!-- Button Group -->
            <div class="button-group">
                <a href="<?php echo e(route('article.edit', $artikel->id)); ?>" class="btn btn-secondary">
                    Back to Editor
                </a>
                <button type="submit" class="btn btn-primary">
                    Publish Article
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        const judulInput = document.getElementById('judul');
        const judulCount = document.getElementById('judul-count');
        const metaInput = document.getElementById('meta_description');
        const metaCount = document.getElementById('meta-count');
        const miniBacaInput = document.getElementById('menit_baca');
        const slugInput = document.getElementById('slug');
        const pathGambarInput = document.getElementById('path_gambar');
        const imagesContainer = document.getElementById('images-container');

        // Article content from server
        const artikelContent = <?php echo $artikel->isi_konten ? json_encode(json_decode($artikel->isi_konten, true)) : json_encode(['blocks' => []]); ?>;

        // Extract images from EditorJS content
        function extractImages() {
            const images = [];
            if (artikelContent.blocks && Array.isArray(artikelContent.blocks)) {
                artikelContent.blocks.forEach(block => {
                    if (block.type === 'image' && block.data && block.data.file) {
                        images.push(block.data.file.url);
                    }
                });
            }
            return images;
        }

        // Display image options
        function displayImages() {
            const images = extractImages();
            imagesContainer.innerHTML = '';

            if (images.length === 0) {
                imagesContainer.innerHTML = '<p class="text-gray-400 text-sm col-span-full">No images found in your article. Add images to select as featured image.</p>';
                return;
            }

            images.forEach((imageUrl, index) => {
                const imageDiv = document.createElement('div');
                imageDiv.className = 'image-selector';
                imageDiv.innerHTML = `
                    <img src="${imageUrl}" alt="Image ${index + 1}">
                    <div class="image-selector-overlay">
                        <span class="checkmark">✓</span>
                    </div>
                `;

                if (pathGambarInput.value === imageUrl) {
                    imageDiv.classList.add('selected');
                }

                imageDiv.addEventListener('click', () => {
                    // Remove selected from all
                    document.querySelectorAll('.image-selector').forEach(el => {
                        el.classList.remove('selected');
                    });
                    // Add selected to clicked
                    imageDiv.classList.add('selected');
                    pathGambarInput.value = imageUrl;
                });

                imagesContainer.appendChild(imageDiv);
            });
        }

        // Calculate reading time from word count
        function calculateReadingTime() {
            let totalText = '';

            if (artikelContent.blocks && Array.isArray(artikelContent.blocks)) {
                artikelContent.blocks.forEach(block => {
                    if (block.type === 'paragraph' && block.data && block.data.text) {
                        totalText += block.data.text + ' ';
                    } else if (block.type === 'header' && block.data && block.data.text) {
                        totalText += block.data.text + ' ';
                    } else if (block.type === 'list' && block.data && block.data.items) {
                        block.data.items.forEach(item => {
                            if (typeof item === 'string') {
                                totalText += item + ' ';
                            } else if (item.content) {
                                totalText += item.content + ' ';
                            }
                        });
                    }
                });
            }

            // Count words
            const wordCount = totalText.trim().split(/\s+/).length;
            const readingTime = Math.ceil(wordCount / 200); // 200 words per minute

            miniBacaInput.value = Math.max(1, readingTime); // Min 1 minute
            updatePreview();
        }

        // Update character counts
        judulInput.addEventListener('input', () => {
            judulCount.textContent = judulInput.value.length;
            updatePreview();
        });

        metaInput.addEventListener('input', () => {
            metaCount.textContent = metaInput.value.length;
            updatePreview();
        });

        // Update preview
        function updatePreview() {
            document.getElementById('preview-title').textContent = judulInput.value || 'Article Title';
            document.getElementById('preview-description').textContent = metaInput.value || 'No description added yet';
            document.getElementById('preview-reading-time').textContent = miniBacaInput.value || '--';
        }

        // Auto-generate slug from title
        judulInput.addEventListener('blur', () => {
            if (!slugInput.value) {
                const slug = judulInput.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugInput.value = slug;
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', () => {
            displayImages();
            calculateReadingTime();
            if (window.lucide) window.lucide.createIcons();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/article/publish.blade.php ENDPATH**/ ?>