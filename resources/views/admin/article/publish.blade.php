@extends('layouts.admin')

@section('title', 'Publish Article')
@section('page_title', 'Finalize Article')

@push('styles')
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
@endpush

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Ready to Publish?</h1>
            <p class="text-gray-400">Add metadata and finalize your article before publishing.</p>
        </div>

        <form method="POST" action="{{ route('article.publish-finalize', $artikel->id) }}" class="space-y-6">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="judul" class="form-label">Article Title</label>
                <input
                    type="text"
                    id="judul"
                    name="judul"
                    class="form-input w-full @error('judul') border-red-500 @enderror"
                    value="{{ old('judul', $artikel->judul) }}"
                    required
                    maxlength="255"
                >
                <div class="char-count">
                    <span id="judul-count">{{ strlen(old('judul', $artikel->judul)) }}</span>/255 characters
                </div>
                @error('judul')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea
                    id="meta_description"
                    name="meta_description"
                    rows="3"
                    class="form-input w-full @error('meta_description') border-red-500 @enderror"
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
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Featured Image</label>
                <p class="form-description mb-3">Select an image from your article to use as featured image</p>

                <div id="images-container" class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    <p class="text-gray-400 text-sm col-span-full" id="loading-images">Loading images...</p>
                </div>

                <input type="hidden" id="path_gambar" name="path_gambar" value="{{ old('path_gambar', $artikel->path_gambar) }}">

                @error('path_gambar')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="menit_baca" class="form-label">Estimated Reading Time (minutes)</label>
                <input
                    type="number"
                    id="menit_baca"
                    name="menit_baca"
                    class="form-input w-full @error('menit_baca') border-red-500 @enderror"
                    value="{{ old('menit_baca', $artikel->menit_baca) }}"
                    min="1"
                    max="1000"
                    readonly
                >
                <p class="form-description">
                    Automatically calculated based on article content (200 words per minute)
                </p>
                @error('menit_baca')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug" class="form-label">Slug (URL Friendly)</label>
                <input
                    type="text"
                    id="slug"
                    name="slug"
                    class="form-input w-full @error('slug') border-red-500 @enderror"
                    value="{{ old('slug', $artikel->slug) }}"
                    maxlength="255"
                    placeholder="leave blank to auto-generate from title"
                >
                <p class="form-description">
                    The URL-friendly version of the article title. Leave blank to auto-generate.
                </p>
                @error('slug')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="preview-box">
                <h3 class="text-white font-semibold mb-4">Preview</h3>
                <div class="preview-title" id="preview-title">{{ $artikel->judul }}</div>
                <div class="preview-meta">
                    <p id="preview-description">{{ $artikel->meta_description ?: 'No description added yet' }}</p>
                    <p class="mt-2">
                        <span id="preview-reading-time">{{ $artikel->menit_baca ?? '--' }}</span> min read
                    </p>
                </div>
            </div>

            <div class="button-group">
                <a href="{{ route('article.edit', $artikel->id) }}" class="btn btn-secondary">
                    Back to Editor
                </a>
                <button type="submit" class="btn btn-primary">
                    Publish Article
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        window.artikelContent = {!! json_encode(json_decode($artikel->isi_konten, true) ?? ['blocks' => []]) !!};
    </script>
    @vite(['resources/js/admin/article/publish.js'])
@endpush
