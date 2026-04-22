@extends('layouts.admin')

@section('title', 'Articles Management')
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

        .article-thumb {
            width: 60px;
            aspect-ratio: 16 / 9;
            border-radius: 2px;
            overflow: hidden;
            background: #0f0d11;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .status-badge {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
        }

        .status-draft {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .status-published {
            background: rgba(44, 151, 75, 0.1);
            color: #2c974b;
        }

        .tab-button {
            padding: 0.5rem 2rem;
            border: none;
            background: transparent;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 600;
            border-bottom: 1px solid transparent;
        }

        .tab-button.active {
            color: #ffffff;
            border-bottom-color: #ffffff;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header Section -->
        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-xl font-semibold text-white">Articles</h2>
                <p class="text-gray-400 text-xs mt-1">Manage your draft and published articles.</p>
            </div>
            <a href="{{ route('article.create') }}"
                class="btn-primary text-white px-4 py-2 rounded-sm flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                Add New
            </a>
        </div>

        <!-- Tabs -->
        <div class="flex gap-4 mb-6 border-b border-white/5">
            <button class="tab-button active" data-tab="drafts">
                Drafts <span class="text-gray-500">{{ $draftArticles->total() }}</span>
            </button>
            <button class="tab-button" data-tab="published">
                Published <span class="text-gray-500">{{ $publishedArticles->total() }}</span>
            </button>
        </div>

        <!-- Draft Articles -->
        <div id="drafts-tab" class="tab-content">
            @if ($draftArticles->count() > 0)
                <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/5 bg-black/20">
                                <th class="px-4 py-3 font-medium text-gray-400 w-12 text-center text-xs">#</th>
                                <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Article
                                </th>
                                <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Created
                                </th>
                                <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider text-right">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($draftArticles as $key => $artikel)
                                <tr
                                    class="group border-b border-white/5 transition-colors duration-200 hover:bg-white/[0.02]">
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-gray-500 text-xs font-medium">{{ $key + 1 }}</span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div>
                                            <div class="text-white font-medium text-sm leading-tight truncate">
                                                {{ strlen($artikel->judul) > 35 ? substr($artikel->judul, 0, 35) . '...' : $artikel->judul }}
                                            </div>
                                            <div class="text-gray-500 text-[10px] mt-1 line-clamp-1">
                                                {{ $artikel->meta_description ?: 'No description' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="status-badge status-draft">Draft</span>
                                    </td>
                                    <td class="px-4 py-4 font-mono text-xs text-gray-500">
                                        {{ $artikel->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-4 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('article.edit', $artikel->id) }}"
                                                class="p-1.5 hover:bg-white/10 rounded text-gray-400 hover:text-white transition-colors"
                                                title="Edit">
                                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                                            </a>
                                            <a href="{{ route('article.publish-form', $artikel->id) }}"
                                                class="p-1.5 hover:bg-green-900/20 rounded text-gray-400 hover:text-green-500 transition-colors"
                                                title="Publish">
                                                <i data-lucide="send" class="w-4 h-4"></i>
                                            </a>
                                            <form action="{{ route('article.destroy', $artikel->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="button"
                                                    data-delete-btn
                                                    data-article-title="{{ addslashes($artikel->judul) }}"
                                                    data-delete-url="{{ route('article.destroy', $artikel->id) }}"
                                                    class="p-1.5 hover:bg-red-900/20 rounded text-gray-400 hover:text-red-500 transition-colors"
                                                    title="Delete">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 text-[10px] text-gray-600 uppercase font-bold tracking-widest">
                    <p>Total: {{ $draftArticles->total() }} draft articles</p>
                </div>
            @else
                <div class="col-span-full py-16 text-center">
                    <i data-lucide="inbox" class="w-16 h-16 text-gray-600 mx-auto mb-4"></i>
                    <p class="text-gray-500 text-[11px] uppercase tracking-widest">No draft articles yet.</p>
                </div>
            @endif
        </div>

        <!-- Published Articles -->
        <div id="published-tab" class="tab-content hidden">
            @if ($publishedArticles->count() > 0)
                <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/5 bg-black/20">
                                <th class="px-4 py-3 font-medium text-gray-400 w-12 text-center text-xs">#</th>
                                <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Article
                                </th>
                                <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Published
                                </th>
                                <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider text-right">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($publishedArticles as $key => $artikel)
                                <tr
                                    class="group border-b border-white/5 transition-colors duration-200 hover:bg-white/[0.02]">
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-gray-500 text-xs font-medium">{{ $key + 1 }}</span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div>
                                            <div class="text-white font-medium text-sm leading-tight truncate">
                                                {{ strlen($artikel->judul) > 35 ? substr($artikel->judul, 0, 35) . '...' : $artikel->judul }}
                                            </div>
                                            <div class="text-gray-500 text-[10px] mt-1 line-clamp-1">
                                                {{ $artikel->meta_description ?: 'No description' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="status-badge status-published">Published</span>
                                    </td>
                                    <td class="px-4 py-4 font-mono text-xs text-gray-500">
                                        {{ $artikel->tanggal_rilis?->format('M d, Y') ?: 'N/A' }}
                                    </td>
                                    <td class="px-4 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="#"
                                                class="p-1.5 hover:bg-white/10 rounded text-gray-400 hover:text-white transition-colors"
                                                title="View">
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                            </a>
                                            <a href="{{ route('article.edit', $artikel->id) }}"
                                                class="p-1.5 hover:bg-purple-900/20 rounded text-gray-400 hover:text-purple-500 transition-colors"
                                                title="Edit Content">
                                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                            </a>
                                            <a href="{{ route('article.edit-metadata', $artikel->id) }}"
                                                class="p-1.5 hover:bg-blue-900/20 rounded text-gray-400 hover:text-blue-500 transition-colors"
                                                title="Edit Metadata">
                                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                                            </a>
                                            <form action="{{ route('article.destroy', $artikel->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="button"
                                                    data-delete-btn
                                                    data-article-title="{{ addslashes($artikel->judul) }}"
                                                    data-delete-url="{{ route('article.destroy', $artikel->id) }}"
                                                    class="p-1.5 hover:bg-red-900/20 rounded text-gray-400 hover:text-red-500 transition-colors"
                                                    title="Delete">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 text-[10px] text-gray-600 uppercase font-bold tracking-widest">
                    <p>Total: {{ $publishedArticles->total() }} published articles</p>
                </div>
            @else
                <div class="col-span-full py-16 text-center">
                    <i data-lucide="inbox" class="w-16 h-16 text-gray-600 mx-auto mb-4"></i>
                    <p class="text-gray-500 text-[11px] uppercase tracking-widest">No published articles yet.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/article/index.js'])
@endpush
