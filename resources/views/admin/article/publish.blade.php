@extends('layouts.admin')

@section('title', 'Publish Article')
@section('page_title', 'Finalize Article')

@vite(['resources/css/metadata-form.css'])

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <a href="{{ route('article.edit', $artikel->id) }}" class="back-link">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to Editor
        </a>

        <div class="page-header mb-6">
            <h1 class="page-title">Ready to Publish?</h1>
            <p class="page-subtitle">Add metadata and finalize your article before publishing.</p>
        </div>

        <form method="POST" action="{{ route('article.publish-finalize', $artikel->id) }}" class="form-container space-y-3">
            @csrf
            @method('POST')

            @include('admin.article._metadata-form')

            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    Publish Article
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
