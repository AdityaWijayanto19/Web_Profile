@extends('layouts.admin')

@section('title', 'Edit Article Metadata')
@section('page_title', 'Edit Metadata')

@vite(['resources/css/metadata-form.css'])

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <a href="{{ route('article.index') }}" class="back-link">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to Articles
        </a>

        <div class="page-header mb-6">
            <h1 class="page-title">Edit Article Metadata</h1>
            <p class="page-subtitle">Update featured image and metadata for published article.</p>
        </div>

        <form method="POST" action="{{ route('article.update-metadata', $artikel->id) }}" class="form-container space-y-3">
            @csrf
            @method('PUT')

            @include('admin.article._metadata-form')

            <div class="button-group">
                <a href="{{ route('article.edit', $artikel->id) }}" class="btn btn-secondary">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    Edit Content
                </a>
                <button type="submit" class="btn btn-primary">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    Update Metadata
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/lucide@latest"></script>
    <script>
        window.artikelContent = {!! json_encode(json_decode($artikel->isi_konten, true) ?? ['blocks' => []]) !!};
        lucide.createIcons();
    </script>
    @vite(['resources/js/admin/article/publish.js'])
@endpush
