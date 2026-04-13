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
        border-radius: 2px; /* rounded-sm sesuai request */
        overflow: hidden;
        background: #0f0d11;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
</style>
@endpush

@section('content')
<div class="max-w-6xl mx-auto">

    <!-- Header Section (Identik dengan Project) -->
    <div class="flex justify-between items-end mb-8 border-b border-white/5 pb-6">
        <div>
            <h2 class="text-xl font-bold text-white tracking-tight">Certifications</h2>
            <p class="text-gray-500 text-[11px] mt-1 uppercase tracking-tighter">Manage and reorder your professional credentials.</p>
        </div>
        <a href="{{ route('sertifikat.create') }}" class="btn-primary text-white px-4 py-2 rounded-sm flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
            Add New
        </a>
    </div>

    <!-- GRID 3 KOLOM (Mirip Project Index) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12" id="sortable-cards">

        <!-- Item 1 -->
        <div class="group cursor-grab active:cursor-grabbing">
            <div class="cert-thumb relative mb-4">
                <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=600" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-all duration-500">

                <!-- Hover Overlay Buttons -->
                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3 z-10">
                    <button onclick="openEditor()" class="p-2.5 bg-white/10 hover:bg-[#730c1e] rounded-sm text-white transition-colors">
                        <i data-lucide="edit-3" class="w-4.5 h-4.5"></i>
                    </button>
                    <button class="p-2.5 bg-white/10 hover:bg-red-600 rounded-sm text-white transition-colors">
                        <i data-lucide="trash-2" class="w-4.5 h-4.5"></i>
                    </button>
                </div>

                <!-- Small Badge Icon (Tetap dipertahankan di pojok) -->
                <div class="absolute bottom-2 left-2 z-10">
                    <div class="w-6 h-6 bg-[#730c1e] flex items-center justify-center rounded-sm">
                        <i data-lucide="check-circle" class="w-3.5 h-3.5 text-white"></i>
                    </div>
                </div>
            </div>

            <div class="px-0.5 space-y-1">
                <h4 class="text-sm font-bold text-white uppercase tracking-wider truncate">Google Certified</h4>
                <p class="text-[11px] text-gray-500 font-medium uppercase mt-0.5">UX Architecture Professional</p>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="group cursor-grab active:cursor-grabbing">
            <div class="cert-thumb relative mb-4">
                <img src="https://images.unsplash.com/photo-1587620962725-abab7fe55159?q=80&w=600" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-all duration-500">

                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3 z-10">
                    <button onclick="openEditor()" class="p-2.5 bg-white/10 hover:bg-[#730c1e] rounded-sm text-white transition-colors">
                        <i data-lucide="edit-3" class="w-4.5 h-4.5"></i>
                    </button>
                    <button class="p-2.5 bg-white/10 hover:bg-red-600 rounded-sm text-white transition-colors">
                        <i data-lucide="trash-2" class="w-4.5 h-4.5"></i>
                    </button>
                </div>

                <div class="absolute bottom-2 left-2 z-10">
                    <div class="w-6 h-6 bg-[#730c1e] flex items-center justify-center rounded-sm">
                        <i data-lucide="code" class="w-3.5 h-3.5 text-white"></i>
                    </div>
                </div>
            </div>

            <div class="px-0.5 space-y-1">
                <h4 class="text-sm font-bold text-white uppercase tracking-wider truncate">Meta Engineer</h4>
                <p class="text-[11px] text-gray-500 font-medium uppercase mt-0.5">React Professional Certification</p>
            </div>
        </div>

    </div>
</div>

<!-- SLIDE-OVER Editor (Panel Samping) -->
<div id="editor-panel" class="fixed inset-y-0 right-0 w-80 bg-[#0f0d11] border-l border-white/5 shadow-2xl transform translate-x-full transition-transform duration-500 z-50 p-8">
    <div class="flex justify-between items-center mb-10 border-b border-white/5 pb-4">
        <h3 class="text-xs font-bold text-white uppercase tracking-[0.2em]">Update Certificate</h3>
        <button onclick="closeEditor()" class="text-gray-500 hover:text-white"><i data-lucide="x" class="w-5 h-5"></i></button>
    </div>

    <div class="space-y-6">
        <div>
            <label class="text-[9px] text-gray-500 uppercase font-bold mb-2 block tracking-widest">Certificate Image</label>
            <div class="w-full aspect-video bg-black/20 border border-dashed border-white/10 rounded-sm flex flex-col items-center justify-center text-gray-500 hover:border-[#730c1e] transition-all cursor-pointer">
                <i data-lucide="image" class="w-5 h-5 mb-1"></i>
                <span class="text-[8px] uppercase">Upload New</span>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label class="text-[9px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Institution</label>
                <input type="text" class="w-full form-input-custom px-3 py-2 text-[11px] outline-none rounded-sm" placeholder="e.g. Google">
            </div>
            <div>
                <label class="text-[9px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Subject</label>
                <input type="text" class="w-full form-input-custom px-3 py-2 text-[11px] outline-none rounded-sm" placeholder="e.g. UX Architecture">
            </div>
        </div>

        <button class="w-full btn-primary text-white py-2.5 mt-4 rounded-sm text-[10px] font-bold tracking-widest uppercase shadow-lg shadow-[#730c1e]/20">
            Save Changes
        </button>
    </div>
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
