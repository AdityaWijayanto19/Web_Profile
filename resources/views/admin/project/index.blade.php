@extends('layouts.app')

@section('title', 'Manage Projects - FoxHR')
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
    </style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto px-4">

        <!-- Header Section -->
        <div class="flex justify-between items-end mb-8 border-b border-white/5 pb-6">
            <div>
                <h2 class="text-xl font-bold text-white tracking-tight uppercase">Portfolio Projects</h2>
                <p class="text-gray-500 text-[10px] mt-1 uppercase tracking-[0.2em]">Showcase your work and technical
                    expertise.</p>
            </div>
            <a href="{{ route('projects.create') }}"
                class="btn-primary text-white px-5 py-2.5 rounded-sm flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                Create New
            </a>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div
                class="mb-8 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-sm text-[10px] uppercase tracking-widest flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- GRID 3 KOLOM - Drag & Drop Sortable -->
        <div id="projectsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-14">

            @forelse ($proyeks as $proyek)
                <div class="group" data-project-id="{{ $proyek->id }}">
                    <!-- Thumbnail & Hover Actions -->
                    <div class="project-thumb relative mb-5 hover:cursor-grab">
                        @if ($proyek->path_gambar)
                            <img src="{{ $proyek->getThumbnailUrl() }}"
                                class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-all duration-700 group-hover:scale-105">
                        @else
                            <div
                                class="w-full h-full flex items-center justify-center bg-white/5 text-gray-700 italic text-[10px]">
                                No Preview</div>
                        @endif

                        <!-- Hover Overlay Buttons -->
                        <div
                            class="absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-4 z-10 backdrop-blur-[2px]">
                            <a href="{{ route('projects.edit', $proyek) }}"
                                class="p-3 bg-white/10 hover:bg-[#730c1e] rounded-sm text-white transition-colors border border-white/5">
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

                        <!-- Status Indicator (Bottom-Left) -->
                        <div class="absolute bottom-3 left-3 z-10">
                            <div class="flex items-center gap-2">
                                <div
                                    class="px-2 py-0.5 {{ $proyek->status === 'published' ? 'bg-green-600' : 'bg-yellow-600' }} rounded-sm">
                                    <p class="text-[8px] font-bold text-white uppercase tracking-widest">
                                        {{ $proyek->status }}</p>
                                </div>
                                <div
                                    class="w-6 h-6 bg-black/50 backdrop-blur-md flex items-center justify-center rounded-sm border border-white/10 text-white font-mono text-[9px] transition-all duration-300"
                                    data-sequence>
                                    {{ str_pad($proyek->urutan, 2, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Info -->
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

                        <!-- Tech Stack Icons (Bottom) -->
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
                <div class="col-span-full py-20 text-center border border-dashed border-white/5">
                    <p class="text-gray-600 text-[10px] uppercase tracking-[0.3em]">Project directory is empty</p>
                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        <div class="mt-16 py-8 border-t border-white/5">
            {{ $proyeks->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize Lucide Icons
        if (window.lucide) {
            window.lucide.createIcons();
        }

        // Initialize Sortable.js for drag-and-drop reordering
        document.addEventListener('DOMContentLoaded', function() {
            const projectsGrid = document.getElementById('projectsGrid');

            if (!projectsGrid) return;

            // Create debounce function to avoid multiple requests
            let reorderTimeout;
            const debounceReorder = (callback, delay = 300) => {
                clearTimeout(reorderTimeout);
                reorderTimeout = setTimeout(callback, delay);
            };

            // Initialize Sortable
            const sortable = Sortable.create(projectsGrid, {
                animation: 150,
                ghostClass: 'opacity-50',
                dragClass: 'dragging',
                touchStartThreshold: 5,
                fallbackOnBody: true,
                forceFallback: false,

                onEnd: function(evt) {
                    // Get all project elements in their new order
                    const projectElements = projectsGrid.querySelectorAll('[data-project-id]');
                    const orderedIds = Array.from(projectElements).map(el => ({
                        id: parseInt(el.dataset.projectId),
                        position: Array.from(projectElements).indexOf(el) + 1
                    }));

                    // Add visual feedback
                    projectsGrid.style.opacity = '0.6';
                    projectsGrid.style.pointerEvents = 'none';

                    // Debounce the API call
                    debounceReorder(() => {
                        // Send the new order to the backend
                        fetch('{{ route("projects.reorder") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                orders: orderedIds
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Update visual sequence numbers for each card
                                projectElements.forEach((element, index) => {
                                    const sequenceIndicator = element.querySelector('[data-sequence]');
                                    if (sequenceIndicator) {
                                        sequenceIndicator.textContent = String(index + 1).padStart(2, '0');
                                        // Add a subtle animation
                                        sequenceIndicator.style.animation = 'none';
                                        setTimeout(() => {
                                            sequenceIndicator.style.animation = 'pulse 0.5s ease-in-out';
                                        }, 10);
                                    }
                                });

                                // Show success feedback
                                showNotification('Projects reordered successfully!', 'success');
                            }
                        })
                        .catch(error => {
                            console.error('Error reordering projects:', error);
                            showNotification('Failed to reorder projects. Please try again.', 'error');
                            // Revert the DOM to previous state by reloading
                            setTimeout(() => location.reload(), 1000);
                        })
                        .finally(() => {
                            // Remove visual feedback
                            projectsGrid.style.opacity = '1';
                            projectsGrid.style.pointerEvents = 'auto';
                        });
                    });
                }
            });

            // Helper function to show notifications
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 px-6 py-3 rounded-sm text-white text-[10px] font-bold uppercase tracking-widest z-50 backdrop-blur-md transition-all duration-500
                    ${type === 'success' ? 'bg-green-500/20 border border-green-500/30 text-green-400' : 'bg-red-500/20 border border-red-500/30 text-red-400'}`;
                notification.textContent = message;
                document.body.appendChild(notification);

                // Animate in
                setTimeout(() => {
                    notification.style.opacity = '1';
                    notification.style.transform = 'translateY(0)';
                }, 10);

                // Remove after 3 seconds
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateY(-10px)';
                    setTimeout(() => notification.remove(), 500);
                }, 3000);
            }
        });
    </script>

    <style>
        /* Drag and drop animations */
        .dragging {
            opacity: 0.5;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        #projectsGrid {
            transition: opacity 0.2s ease, pointer-events 0.2s ease;
        }

        /* Sortable ghost element styling */
        .sortable-ghost {
            opacity: 0.3;
        }
    </style>
@endpush
