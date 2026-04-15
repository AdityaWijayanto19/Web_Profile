@extends('layouts.app')

@section('title', 'Certifications - FoxHR')
@section('page_title', 'Certifications Manager')

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

        /* Efek Sortable */
        .sortable-ghost {
            opacity: 0.2;
            border: 2px dashed #730c1e;
        }

        .sortable-drag {
            cursor: grabbing !important;
            transform: scale(1.02);
        }

        /* Thumbnail Style - Mirip Project */
        .cert-thumb {
            aspect-ratio: 16 / 9;
            border-radius: 2px;
            /* rounded-sm sesuai request */
            overflow: hidden;
            background: #0f0d11;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto px-4">

        <!-- Header Section (Identik dengan Project) -->
        <div class="flex justify-between items-end mb-8 border-b border-white/5 pb-6">
            <div>
                <h2 class="text-xl font-bold text-white tracking-tight">Certifications</h2>
                <p class="text-gray-500 text-[11px] mt-1 uppercase tracking-tighter">Manage and reorder your professional
                    credentials.</p>
            </div>
            <a href="{{ route('sertifikats.create') }}"
                class="btn-primary text-white px-4 py-2 rounded-sm flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                Add New
            </a>
        </div>

        <!-- GRID 3 KOLOM (Mirip Project Index) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12" id="sortable-cards">

            @forelse($sertifikats as $sertifikat)
                <!-- Sertifikat Card -->
                <div class="group cursor-grab active:cursor-grabbing" data-id="{{ $sertifikat->id }}">
                    <div class="cert-thumb relative mb-4">
                        @if ($sertifikat->path_gambar)
                            <img src="{{ asset('storage/' . $sertifikat->path_gambar) }}"
                                alt="{{ $sertifikat->nama_sertifikat }}"
                                class="w-full h-full object-cover group-hover:opacity-100 transition-all duration-500">
                        @else
                            <div
                                class="w-full h-full flex items-center justify-center bg-white/5 text-gray-700 italic text-[10px]">
                                No Preview</div>
                        @endif

                        <!-- Hover Overlay Buttons -->
                        <div
                            class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3 z-10">
                            <a href="{{ route('sertifikats.edit', $sertifikat) }}"
                                class="p-2.5 bg-white/10 hover:bg-blue-600 rounded-sm text-white transition-colors">
                                <i data-lucide="edit-3" class="w-4.5 h-4.5"></i>
                            </a>
                            <form action="{{ route('sertifikats.destroy', $sertifikat) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-2.5 bg-white/10 hover:bg-red-600 rounded-sm text-white transition-colors">
                                    <i data-lucide="trash-2" class="w-4.5 h-4.5"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Year Badge -->
                        <div class="absolute top-2 right-2 z-10">
                            <div class="px-2 py-1 bg-[#730c1e] rounded-sm">
                                <span class="text-[9px] font-bold text-white">{{ $sertifikat->tahun }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="px-0.5 space-y-1">
                        <a href="{{ route('sertifikats.show', $sertifikat) }}"
                            class="text-sm font-bold text-white uppercase tracking-wider truncate hover:text-[#730c1e] transition-colors line-clamp-1">
                            {{ $sertifikat->nama_sertifikat }}
                        </a>
                        <p class="text-[11px] text-gray-500 font-medium uppercase mt-0.5 line-clamp-1">
                            {{ $sertifikat->penerbit }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center">
                    <i data-lucide="inbox" class="w-16 h-16 text-gray-600 mx-auto mb-4"></i>
                    <p class="text-gray-500 text-[11px] uppercase tracking-widest">No certifications yet.</p>
                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        @if ($sertifikats->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $sertifikats->links('partials.pagination') }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        lucide.createIcons();

        function openEditor() {
            document.getElementById('editor-panel').classList.remove('translate-x-full');
        }

        function closeEditor() {
            document.getElementById('editor-panel').classList.add('translate-x-full');
        }

        const el = document.getElementById('sortable-cards');
        Sortable.create(el, {
            animation: 350,
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag'
        });
    </script>
@endpush
