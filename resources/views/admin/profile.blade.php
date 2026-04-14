@extends('layouts.app')

@section('title', 'Hero Manager - FoxHR')
@section('page_title', 'Hero Section Manager')

@push('styles')
<style>
    /* Custom Input Style agar senada dengan halaman lain */
    .form-input-custom {
        background-color: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        transition: all 0.2s;
    }
    .form-input-custom:focus {
        border-color: #730c1e;
        outline: none;
        background-color: rgba(255, 255, 255, 0.03);
    }
    .btn-push {
        background-color: #730c1e;
        box-shadow: 0 4px 15px rgba(115, 12, 30, 0.2);
    }
    .btn-push:hover {
        background-color: #921126;
        transform: translateY(-1px);
    }
</style>
@endpush

@section('content')
<!-- Flash Messages -->
@if ($message = Session::get('success'))
    <div class="max-w-6xl mx-auto mb-4 p-4 bg-green-900/20 border border-green-700/50 rounded-sm">
        <div class="text-sm text-green-400 flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            {{ $message }}
        </div>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="max-w-6xl mx-auto mb-4 p-4 bg-red-900/20 border border-red-700/50 rounded-sm">
        <div class="text-sm text-red-400 flex items-center gap-2">
            <i data-lucide="alert-circle" class="w-4 h-4"></i>
            {{ $message }}
        </div>
    </div>
@endif

<!-- Validation Errors -->
@if ($errors->any())
    <div class="max-w-6xl mx-auto mb-4 p-4 bg-red-900/20 border border-red-700/50 rounded-sm">
        <div class="text-sm text-red-400 mb-2 flex items-center gap-2">
            <i data-lucide="alert-triangle" class="w-4 h-4"></i>
            Terjadi kesalahan pada validasi:
        </div>
        <ul class="list-disc list-inside text-xs text-red-300 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('hero-section.update') }}" method="POST" enctype="multipart/form-data" class="max-w-6xl mx-auto">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-12 gap-4">

        <!-- ELEMENT 1: IDENTITY -->
        <div class="col-span-12 lg:col-span-7 bg-[#1a151d] rounded-sm p-5 border border-white/5 relative shadow-sm">
            <div class="absolute top-3 right-4 text-[8px] font-black text-[#730c1e] uppercase tracking-widest opacity-60">Identity</div>

            <div class="mb-6 min-h-[80px] flex flex-col justify-center border-l-2 border-[#730c1e] pl-4">
                <h1 id="preview-first-name" class="text-3xl md:text-4xl font-bold text-white tracking-tighter leading-none uppercase">ADITYA P.</h1>
                <h1 id="preview-last-name" class="text-3xl md:text-4xl font-bold text-[#730c1e] italic tracking-tighter leading-none uppercase">WIJAYANTO</h1>
            </div>

            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-white/5">
                <div class="space-y-1.5">
                    <label class="text-[9px] font-bold uppercase tracking-widest text-gray-500">First Name & Initial</label>
                    <input type="text" id="input-first-name" name="nama_depan" value="{{ $hero->nama_depan ?? 'ADITYA P.' }}"
                        oninput="updatePreview('preview-first-name', this.value)"
                        class="w-full form-input-custom rounded-sm px-3 py-2 text-xs">
                </div>
                <div class="space-y-1.5">
                    <label class="text-[9px] font-bold uppercase tracking-widest text-gray-500">Last Name</label>
                    <input type="text" id="input-last-name" name="nama_belakang" value="{{ $hero->nama_belakang ?? 'WIJAYANTO' }}"
                        oninput="updatePreview('preview-last-name', this.value)"
                        class="w-full form-input-custom rounded-sm px-3 py-2 text-xs">
                </div>
            </div>
        </div>  

        <!-- ELEMENT 3: COPYWRITING -->
        <div class="col-span-12 lg:col-span-8 bg-[#1a151d] rounded-sm p-5 border border-white/5 space-y-5 relative shadow-sm">
            <div class="absolute top-3 right-4 text-[8px] font-black text-[#730c1e] uppercase tracking-widest opacity-60">Copywriting</div>
            <div class="space-y-2 pb-4 border-b border-white/5">
                <p id="preview-headline" class="text-[10px] uppercase tracking-[0.3em] text-gray-400 font-bold">Undergraduate University of Brawijaya</p>
                <p id="preview-bio" class="text-xs text-gray-500 leading-relaxed max-w-xl italic">
                    Crafting <span class="text-white border-b border-[#730c1e]/40 font-medium">high-performance</span> digital products...
                </p>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div class="space-y-1.5">
                    <label class="text-[9px] font-bold uppercase tracking-widest text-gray-500">Headline</label>

                    <input type="text" id="input-headline" name="text_singkat" value="{{ $hero->text_singkat ?? 'Undergraduate University of Brawijaya' }}"
                    oninput="updatePreview('preview-headline', this.value)"
                    class="w-full form-input-custom rounded-sm px-3 py-2 text-xs">
                </div>
                <div class="space-y-1.5">
                    <label class="text-[9px] font-bold uppercase tracking-widest text-gray-500">Biography</label>
                    <textarea id="input-bio" name="deskripsi" rows="2"
                        oninput="updatePreview('preview-bio', this.value)"
                        class="w-full form-input-custom rounded-sm px-3 py-2 text-xs leading-relaxed">{{ $hero->deskripsi ?? 'Crafting digital products with immersive aesthetics since 2016.' }}</textarea>
                </div>
            </div>
        </div>

        <!-- ELEMENT 4: SYSTEM METRICS -->
        <div class="col-span-12 lg:col-span-4 bg-[#1a151d] rounded-sm p-5 border border-white/5 flex flex-col justify-between relative shadow-sm">
            <div class="absolute top-3 right-4 text-[8px] font-black text-[#730c1e] uppercase tracking-widest opacity-60">Metrics</div>
            <div class="flex items-center gap-6 py-2">
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-white tracking-tighter italic">0</h3>
                    <p class="text-[8px] uppercase tracking-widest text-gray-500 font-black">Years</p>
                </div>
                <div class="h-8 w-[1px] bg-white/5"></div>
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-white tracking-tighter italic">5+</h3>
                    <p class="text-[8px] uppercase tracking-widest text-gray-500 font-black">Projects</p>
                </div>
            </div>
            <div class="bg-black/20 p-3 rounded-sm border border-white/5 mt-4">
                <p class="text-[9px] text-gray-500 leading-relaxed italic">Values are synced from database.</p>
            </div>
        </div>

        <!-- ELEMENT 5: VISUAL & ACTION -->
        <div class="col-span-12 bg-[#1a151d] rounded-sm border border-white/5 overflow-hidden grid grid-cols-12 relative shadow-sm">
            <div class="col-span-12 md:col-span-8 p-6 flex flex-col justify-center space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-bold uppercase tracking-widest text-gray-500">Destination URL</label>
                        <input type="text" name="link_cv" value="{{ $hero->link_cv ?? '#contact' }}" class="w-full form-input-custom rounded-sm px-3 py-2 text-xs">
                    </div>
                </div>
                <div id="preview-cta-label" class="px-8 py-3 bg-white text-black text-[10px] font-black uppercase tracking-widest inline-block rounded-sm w-max">
                    Get in Touch
                </div>
            </div>

            <div class="col-span-12 md:col-span-4 bg-black/40 p-6 flex flex-col items-center justify-center border-l border-white/5">
                <div class="relative group w-32 h-40 border border-dashed border-white/10 rounded-sm flex items-center justify-center overflow-hidden">
                    <img id="preview-portrait" src="{{ $hero && $hero->path_foto ? Storage::disk('public')->url($hero->path_foto) : asset('assets/images/me.png') }}" class="w-full h-full object-cover grayscale opacity-40 group-hover:opacity-100 transition-all">
                    <label for="portrait" class="absolute inset-0 flex flex-col items-center justify-center bg-black/80 opacity-0 group-hover:opacity-100 cursor-pointer transition-all">
                        <i data-lucide="upload-cloud" class="w-6 h-6 text-white mb-1"></i>
                        <span class="text-[8px] font-bold text-white uppercase tracking-tighter">Replace</span>
                    </label>
                    <input type="file" id="portrait" name="path_foto" class="hidden" onchange="previewImage(event)">
                </div>
            </div>
        </div>

    </div>

    <!-- ACTION BAR -->
    <div class="mt-6 flex justify-between items-center bg-[#1a151d] p-3 rounded-sm border border-white/5">
        <span class="text-[9px] text-gray-600 uppercase font-bold tracking-widest pl-2 italic">Ready for production</span>
        <button type="submit" class="btn-push text-white px-8 py-2.5 rounded-sm font-bold text-[10px] uppercase tracking-[0.2em] flex items-center gap-2 transition-all">
            <i data-lucide="zap" class="w-3.5 h-3.5"></i>
            Push to Production
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
    lucide.createIcons();

    function updatePreview(id, val) {
        document.getElementById(id).innerText = val;
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('preview-portrait').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Initialize preview values from form inputs on page load
    document.addEventListener('DOMContentLoaded', function() {
        const firstName = document.getElementById('input-first-name');
        const lastName = document.getElementById('input-last-name');
        const echoText = document.getElementById('input-echo');
        const bio = document.getElementById('input-bio');

        if (firstName && firstName.value) {
            updatePreview('preview-first-name', firstName.value);
        }
        if (lastName && lastName.value) {
            updatePreview('preview-last-name', lastName.value);
        }
        if (echoText && echoText.value) {
            updatePreview('preview-echo', echoText.value);
        }
        if (bio && bio.value) {
            updatePreview('preview-bio', bio.value);
        }
    });
</script>
@endpush
