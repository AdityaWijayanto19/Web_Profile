@extends('layouts.app')

@section('title', 'Add New Certification')
@section('page_title', 'Create Credential')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- HEADER NAV -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('sertifikats.index') }}" class="flex items-center gap-2 text-[10px] font-bold tracking-widest text-gray-500 hover:text-[#730c1e] transition-colors">
            <i data-lucide="chevron-left" class="w-3 h-3"></i> BACK TO REPOSITORY
        </a>
        <span class="text-[9px] text-[#730c1e] font-bold border border-[#730c1e]/30 px-2 py-0.5 rounded-sm uppercase tracking-tighter">New Entry</span>
    </div>

    <form action="{{ route('sertifikats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- LEFT: INPUT FIELDS -->
            <div class="lg:col-span-7 space-y-4">
                <div class="bg-[#1a151e] border border-white/5 p-6 rounded-sm relative shadow-2xl">
                    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-[#730c1e] to-transparent"></div>

                    <div class="space-y-5">
                        <div>
                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Certification Name</label>
                            <input type="text" name="nama_sertifikat" placeholder="e.g. GOOGLE CERTIFIED"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('nama_sertifikat') border-red-500 @enderror"
                                value="{{ old('nama_sertifikat') }}">
                            @error('nama_sertifikat')
                                <p class="text-[9px] text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Publisher/Organization</label>
                            <input type="text" name="penerbit" placeholder="e.g. Google, Meta, Microsoft"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('penerbit') border-red-500 @enderror"
                                value="{{ old('penerbit') }}">
                            @error('penerbit')
                                <p class="text-[9px] text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Year Obtained</label>
                            <input type="number" name="tahun" placeholder="e.g. 2024" min="1900" max="{{ date('Y') }}"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('tahun') border-red-500 @enderror"
                                value="{{ old('tahun') }}">
                            @error('tahun')
                                <p class="text-[9px] text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Credential ID (Optional)</label>
                            <input type="text" name="id_kredensial" placeholder="e.g. CERT-12345"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('id_kredensial') border-red-500 @enderror"
                                value="{{ old('id_kredensial') }}">
                            @error('id_kredensial')
                                <p class="text-[9px] text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Credential Link (Optional)</label>
                            <input type="url" name="link_kredensial" placeholder="https://credentials.example.com/cert/123"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('link_kredensial') border-red-500 @enderror"
                                value="{{ old('link_kredensial') }}">
                            @error('link_kredensial')
                                <p class="text-[9px] text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Description (Optional)</label>
                            <textarea name="deskripsi" placeholder="Add any additional details about this certification..."
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('deskripsi') border-red-500 @enderror"
                                rows="3">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="text-[9px] text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#730c1e] hover:bg-[#911226] text-white py-3 rounded-sm text-[11px] font-bold tracking-[0.3em] transition-all active:scale-[0.98] shadow-lg shadow-[#730c1e]/20">
                    PUBLISH CREDENTIAL
                </button>
            </div>

            <!-- RIGHT: PREVIEW & UPLOAD -->
            <div class="lg:col-span-5 space-y-4">
                <div class="bg-[#1a151e] border border-white/5 p-4 rounded-sm shadow-xl">
                    <span class="text-[9px] text-gray-600 font-bold uppercase tracking-widest mb-3 block">Live Component Preview</span>

                    <div class="relative aspect-video rounded-sm overflow-hidden border border-white/5 bg-black">
                        <div id="mock-bg" class="absolute inset-0 bg-cover bg-center opacity-40 grayscale-[50%]" style="background-image: url('https://images.unsplash.com/photo-1635776062127-d379bfcba9f8?q=80&w=400')"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>

                        <div class="absolute bottom-3 left-3 flex items-center gap-2">
                            <div class="w-6 h-6 bg-[#730c1e] flex items-center justify-center rounded-sm">
                                <i data-lucide="certificate" class="w-3 h-3 text-white"></i>
                            </div>
                            <div>
                                <h4 id="mock-title" class="text-[10px] font-bold text-white uppercase tracking-tight">CERTIFICATION</h4>
                                <p id="mock-subtitle" class="text-[8px] text-gray-400 uppercase">PUBLISHER</p>
                            </div>
                        </div>

                        <!-- Upload Overlay -->
                        <label class="absolute inset-0 flex flex-col items-center justify-center bg-black/60 opacity-0 hover:opacity-100 transition-opacity cursor-pointer">
                            <i data-lucide="upload-cloud" class="w-6 h-6 text-white mb-1"></i>
                            <span class="text-[9px] font-bold text-white tracking-widest">UPLOAD BG</span>
                            <input type="file" name="path_gambar" id="image-input" class="hidden" accept="image/*">
                        </label>
                    </div>
                    <p class="text-[9px] text-gray-500 mt-3 text-center italic">*Recommended: 800x500px dark themed image</p>
                    @error('path_gambar')
                        <p class="text-[9px] text-red-400 mt-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
    const mockTitle = document.getElementById('mock-title');
    const mockSubtitle = document.getElementById('mock-subtitle');
    const mockBg = document.getElementById('mock-bg');

    document.querySelector('input[name="nama_sertifikat"]').oninput = (e) => mockTitle.innerText = e.target.value || 'CERTIFICATION';
    document.querySelector('input[name="penerbit"]').oninput = (e) => mockSubtitle.innerText = e.target.value || 'PUBLISHER';

    document.getElementById('image-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                mockBg.style.backgroundImage = `url('${event.target.result}')`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
