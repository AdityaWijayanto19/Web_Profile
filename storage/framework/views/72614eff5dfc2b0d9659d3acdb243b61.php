

<div class="form-group">
    <label for="judul" class="form-label">Article Title</label>
    <input
        type="text"
        id="judul"
        name="judul"
        class="form-input <?php $__errorArgs = ['judul'];
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
        <span class="text-red-400 text-xs mt-1 block"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <label for="meta_description" class="form-label">Meta Description</label>
    <textarea
        id="meta_description"
        name="meta_description"
        rows="2"
        class="form-input <?php $__errorArgs = ['meta_description'];
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
        <span class="text-red-400 text-xs mt-1 block"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <label class="form-label">Featured Image</label>
    <p class="form-description mb-2">Select an image from your article to use as featured image</p>

    <div id="images-container" class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
        <p class="text-gray-400 text-xs col-span-full" id="loading-images">Loading images...</p>
    </div>

    <input type="hidden" id="path_gambar" name="path_gambar" value="<?php echo e(old('path_gambar', $artikel->path_gambar)); ?>">

    <?php $__errorArgs = ['path_gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-red-400 text-xs mt-1 block"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <label for="menit_baca" class="form-label">Estimated Reading Time (minutes)</label>
    <input
        type="number"
        id="menit_baca"
        name="menit_baca"
        class="form-input <?php $__errorArgs = ['menit_baca'];
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
        <span class="text-red-400 text-xs mt-1 block"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <label for="slug" class="form-label">Slug (URL Friendly)</label>
    <input
        type="text"
        id="slug"
        name="slug"
        class="form-input <?php $__errorArgs = ['slug'];
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
        <span class="text-red-400 text-xs mt-1 block"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="preview-box">
    <h3 class="text-white font-semibold text-sm mb-3">Preview</h3>
    <div class="preview-title" id="preview-title"><?php echo e($artikel->judul); ?></div>
    <div class="preview-meta">
        <p id="preview-description"><?php echo e($artikel->meta_description ?: 'No description added yet'); ?></p>
        <p class="mt-1">
            <span id="preview-reading-time"><?php echo e($artikel->menit_baca ?? '--'); ?></span> min read
        </p>
    </div>
</div>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/article/_metadata-form.blade.php ENDPATH**/ ?>