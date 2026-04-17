@extends('layouts.app')

@section('title', 'Manage Projects')
@section('page_title', 'Projects Manager')

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

        /* Card Project Style */
        .project-thumb {
            aspect-ratio: 16 / 9;
            border-radius: 2px;
            overflow: hidden;
            background: #0f0d11;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Custom Scrollbar untuk horizontal tech stack */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .dragging {
            opacity: 0.5;
        }

        #projectsGrid {
            transition: opacity 0.2s ease, pointer-events 0.2s ease;
        }

        /* Sortable ghost element styling */
        .sortable-ghost {
            opacity: 0.3;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }
    </style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto px-4">

        {{-- HEADER --}}
        <div class="flex justify-between items-end mb-8 border-b border-white/5 pb-6">
            <div>
                <h2 class="text-xl font-bold text-white tracking-tight">Portfolio Projects</h2>
                <p class="text-gray-500 text-[11px] mt-1 uppercase tracking-tighter">Showcase your work and technical
                    expertise.</p>
            </div>
            <a href="{{ route('projects.create') }}"
                class="btn-primary text-white px-4 py-2 rounded-sm flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                Add New
            </a>
        </div>

        <div id="projectsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-14"
            data-redirect-url="{{ route('projects.index') }}">

            @forelse ($proyeks as $proyek)
                <div class="group" data-project-id="{{ $proyek->id }}"
                    data-reorder-url="{{ route('projects.reorder') }}">
                    <div class="project-thumb relative mb-5 hover:cursor-grab">
                        @if ($proyek->path_gambar)
                            <img src="{{ $proyek->getThumbnailUrl() }}"
                                class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-all duration-700 group-hover:scale-105">
                        @else
                            <div
                                class="w-full h-full flex items-center justify-center bg-white/5 text-gray-700 italic text-[10px]">
                                No Preview</div>
                        @endif

                        <div
                            class="absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-4 z-10 backdrop-blur-[2px]">
                            <a href="{{ route('projects.edit', $proyek) }}"
                                class="p-3 bg-white/10 hover:bg-blue-600 rounded-sm text-white transition-colors border border-white/5">
                                <i data-lucide="edit-3" class="w-5 h-5"></i>
                            </a>

                            <form action="{{ route('projects.destroy', $proyek) }}" method="POST" class="inline"
                                onsubmit="return confirm('Delete this project?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-3 bg-white/10 hover:bg-red-600 rounded-sm text-white transition-colors border border-white/5">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </div>

                        <div class="absolute bottom-3 left-3 z-10">
                            <div class="flex items-center gap-2">
                                <div
                                    class="px-2 py-0.5 {{ $proyek->status === 'published' ? 'bg-green-600' : 'bg-yellow-600' }} rounded-sm">
                                    <p class="text-[8px] font-bold text-white uppercase tracking-widest">
                                        {{ $proyek->status }}</p>
                                </div>
                                <div class="w-6 h-6 bg-black/50 backdrop-blur-md flex items-center justify-center rounded-sm border border-white/10 text-white font-mono text-[9px] transition-all duration-300"
                                    data-sequence>
                                    {{ str_pad($proyek->urutan, 2, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-0.5 space-y-1.5">
                        <div class="flex justify-between items-start">
                            <h4
                                class="text-sm font-bold text-white uppercase tracking-wider truncate transition-colors group-hover:text-[#730c1e]">
                                {{ $proyek->judul }}
                            </h4>
                            <a href="{{ route('projects.show', $proyek) }}"
                                class="text-gray-600 hover:text-white transition-colors">
                                <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                            </a>
                        </div>

                        <p
                            class="text-[11px] text-gray-500 font-medium uppercase tracking-tight line-clamp-1 leading-relaxed">
                            {{ $proyek->deskripsi }}
                        </p>

                        <div class="flex items-center gap-2.5 pt-3 border-t border-white/5 mt-3">
                            @foreach ($proyek->teknologis as $tech)
                                <div class="group/tech relative">
                                    @if ($tech->path_icon)
                                        <img src="https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/{{ $tech->path_icon }}.svg"
                                            alt="{{ $tech->nama }}" class="w-5 h-5" style="filter: invert(0.2);"
                                            loading="lazy">
                                    @else
                                        <div
                                            class="w-4 h-4 flex items-center justify-center bg-white/5 rounded-[1px] text-[7px] text-gray-500 font-bold border border-white/10">
                                            {{ substr($tech->nama, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center">
                    <i data-lucide="inbox" class="w-16 h-16 text-gray-600 mx-auto mb-4"></i>
                    <p class="text-gray-500 text-[11px] uppercase tracking-widest">No Projects yet.</p>
                </div>
            @endforelse

        </div>

        <div class="mt-16 py-8 border-t border-white/5">
            {{ $proyeks->links('partials.pagination') }}
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/project/index.js'])
@endpush
