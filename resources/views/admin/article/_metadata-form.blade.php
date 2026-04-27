{{-- Shared metadata form fields for article publish/edit pages --}}

<div class="form-group">
    <label for="judul" class="form-label">Article Title</label>
    <input
        type="text"
        id="judul"
        name="judul"
        class="form-input @error('judul') border-red-500 @enderror"
        value="{{ old('judul', $artikel->judul) }}"
        required
        maxlength="255"
    >
    <div class="char-count">
        <span id="judul-count">{{ strlen(old('judul', $artikel->judul)) }}</span>/255 characters
    </div>
    @error('judul')
        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="meta_description" class="form-label">Meta Description</label>
    <textarea
        id="meta_description"
        name="meta_description"
        rows="2"
        class="form-input @error('meta_description') border-red-500 @enderror"
        placeholder="Write a compelling description (160 characters max)"
        maxlength="160"
    >{{ old('meta_description', $artikel->meta_description) }}</textarea>
    <div class="char-count">
        <span id="meta-count">{{ strlen(old('meta_description', $artikel->meta_description ?? '')) }}</span>/160 characters
    </div>
    <p class="form-description">
        This description will appear in search results and social media previews.
    </p>
    @error('meta_description')
        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label class="form-label">Featured Image</label>
    <p class="form-description mb-2">Select an image from your article to use as featured image</p>

    <div id="images-container" class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
        <p class="text-gray-400 text-xs col-span-full" id="loading-images">Loading images...</p>
    </div>

    <input type="hidden" id="path_gambar" name="path_gambar" value="{{ old('path_gambar', $artikel->path_gambar) }}">

    @error('path_gambar')
        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="menit_baca" class="form-label">Estimated Reading Time (minutes)</label>
    <input
        type="number"
        id="menit_baca"
        name="menit_baca"
        class="form-input @error('menit_baca') border-red-500 @enderror"
        value="{{ old('menit_baca', $artikel->menit_baca) }}"
        min="1"
        max="1000"
        readonly
    >
    <p class="form-description">
        Automatically calculated based on article content (200 words per minute)
    </p>
    @error('menit_baca')
        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="slug" class="form-label">Slug (URL Friendly)</label>
    <input
        type="text"
        id="slug"
        name="slug"
        class="form-input @error('slug') border-red-500 @enderror"
        value="{{ old('slug', $artikel->slug) }}"
        maxlength="255"
        placeholder="leave blank to auto-generate from title"
    >
    <p class="form-description">
        The URL-friendly version of the article title. Leave blank to auto-generate.
    </p>
    @error('slug')
        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
    @enderror
</div>

<div class="preview-box">
    <h3 class="text-white font-semibold text-sm mb-3">Preview</h3>
    <div class="preview-title" id="preview-title">{{ $artikel->judul }}</div>
    <div class="preview-meta">
        <p id="preview-description">{{ $artikel->meta_description ?: 'No description added yet' }}</p>
        <p class="mt-1">
            <span id="preview-reading-time">{{ $artikel->menit_baca ?? '--' }}</span> min read
        </p>
    </div>
</div>
