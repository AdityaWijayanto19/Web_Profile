@extends('layouts.app')

@section('title', 'Articles Management - FoxHR')
@section('page_title', 'Articles Management')

@push('styles')
<style>
    .btn-primary {
        background-color: #730c1e;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #921126;
        transform: translateY(-1px);
    }

    /* Thumbnail Style dari UI Insights */
    .article-thumb {
        width: 60px;
        aspect-ratio: 16 / 9;
        border-radius: 2px;
        overflow: hidden;
        background: #0f0d11;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* Category Badge Style */
    .category-label {
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 0.05em;
        color: #730c1e;
        text-transform: uppercase;
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <!-- Header Section -->
    <div class="flex justify-between items-end mb-6">
        <div>
            <h2 class="text-xl font-semibold text-white">Latest Insights</h2>
            <p class="text-gray-400 text-xs mt-1">Manage your articles, technical guides, and thoughts.</p>
        </div>
        <a href="#" class="btn-primary text-white px-4 py-2 rounded-sm flex items-center gap-2 text-xs font-medium">
            <i data-lucide="plus" class="w-4 h-4"></i>
            ADD NEW ARTICLE
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-white/5 bg-black/20">
                    <th class="px-4 py-3 font-medium text-gray-400 w-12 text-center text-xs">#</th>
                    <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Article</th>
                    <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Category</th>
                    <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Date Published</th>
                    <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
                <tr class="group border-b border-white/5 transition-colors duration-200 hover:bg-white/[0.02]">
                    <td class="px-4 py-4 text-center">
                        <span class="text-gray-500 text-xs font-medium">1</span>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-4">
                            <div class="article-thumb shrink-0">
                                <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=200" class="w-full h-full object-cover" alt="Article Thumbnail">
                            </div>
                            <div>
                                <div class="text-white font-medium text-sm leading-tight">The Shift to Multi-dimensional UI in 2025</div>
                                <div class="text-gray-500 text-[10px] mt-1 line-clamp-1">Exploring spatial computing and AI interfaces...</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <span class="category-label">Architecture</span>
                    </td>
                    <td class="px-4 py-4 font-mono text-xs text-gray-500">March 24, 2024</td>
                    <td class="px-4 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="#" class="p-1.5 hover:bg-white/10 rounded text-gray-400 hover:text-white transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <button class="p-1.5 hover:bg-red-900/20 rounded text-gray-400 hover:text-red-500 transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Row 2 -->
                <tr class="group border-b border-white/5 transition-colors duration-200 hover:bg-white/[0.02]">
                    <td class="px-4 py-4 text-center">
                        <span class="text-gray-500 text-xs font-medium">2</span>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-4">
                            <div class="article-thumb shrink-0 grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all">
                                <img src="https://images.unsplash.com/photo-1633356122544-f134324a6cee?q=80&w=200" class="w-full h-full object-cover" alt="Article Thumbnail">
                            </div>
                            <div>
                                <div class="text-white font-medium text-sm leading-tight">Scaling React for Enterprise</div>
                                <div class="text-gray-500 text-[10px] mt-1 line-clamp-1">Advanced state management and best practices.</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <span class="category-label">Development</span>
                    </td>
                    <td class="px-4 py-4 font-mono text-xs text-gray-500">Feb 12, 2024</td>
                    <td class="px-4 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <button class="p-1.5 hover:bg-white/10 rounded text-gray-400 hover:text-white transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </button>
                            <button class="p-1.5 hover:bg-red-900/20 rounded text-gray-400 hover:text-red-500 transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-4 flex justify-between items-center text-[10px] text-gray-600 uppercase font-bold tracking-widest">
        <p>Total: 2 articles</p>
        <p>Sorted by: Date Published</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
