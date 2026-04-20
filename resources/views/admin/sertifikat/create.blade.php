@extends('layouts.admin')

@section('title', 'Add New Certification')
@section('page_title', 'Create Credential')

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <div class="mb-6">
            <a href="{{ route('sertifikats.index') }}"
                class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-[#730c1e] transition-colors group">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                BACK TO CERTIFICATIONS
            </a>
        </div>

        <form action="{{ route('sertifikats.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <div class="lg:col-span-7 space-y-4">
                    <div class="bg-[#1a151e] border border-white/5 p-6 rounded-sm relative shadow-2xl">
                        <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-[#730c1e] to-transparent">
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label
                                    class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Certification
                                    Name</label>
                                <input type="text" name="nama_sertifikat" placeholder="e.g. GOOGLE CERTIFIED"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('nama_sertifikat') border-red-500 @enderror"
                                    value="{{ old('nama_sertifikat') }}">
                                @error('nama_sertifikat')
                                    <p class="text-[9px] text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Publisher/Organization</label>
                                <input type="text" name="penerbit" placeholder="e.g. Google, Meta, Microsoft"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('penerbit') border-red-500 @enderror"
                                    value="{{ old('penerbit') }}">
                                @error('penerbit')
                                    <p class="text-[9px] text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-6">

                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Start
                                        Year</label>
                                    <input type="text" name="start_year" placeholder="e.g. 2016"
                                        class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('start_year') border-red-500 @enderror">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">End Year /
                                        Status</label>
                                    <input type="text" name="end_year" placeholder="e.g. 2020 or Present"
                                        class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('end_year') border-red-500 @enderror">
                                </div>
                                @error('tahun')
                                    <p class="text-[9px] text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Credential
                                    ID (Optional)</label>
                                <input type="text" name="id_kredensial" placeholder="e.g. CERT-12345"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('id_kredensial') border-red-500 @enderror"
                                    value="{{ old('id_kredensial') }}">
                                @error('id_kredensial')
                                    <p class="text-[9px] text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Credential
                                    Link (Optional)</label>
                                <input type="url" name="link_kredensial"
                                    placeholder="https://credentials.example.com/cert/123"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('link_kredensial') border-red-500 @enderror"
                                    value="{{ old('link_kredensial') }}">
                                @error('link_kredensial')
                                    <p class="text-[9px] text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Description
                                    (Optional)</label>
                                <textarea name="deskripsi" placeholder="Add any additional details about this certification..."
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all @error('deskripsi') border-red-500 @enderror"
                                    rows="3">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <p class="text-[9px] text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Display
                                        Order</label>
                                    <input type="number" name="urutan" placeholder="e.g. 1" min="1" max="9999"
                                        value="{{ old('urutan', '') }}"
                                        class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm @error('urutan') border-red-500 @enderror">
                                    @error('urutan')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('sertifikats.index') }}"
                            class="flex items-center justify-center bg-white/5 hover:bg-white/10 text-gray-400 py-3 rounded-sm text-[11px] font-bold transition-all border border-white/5 uppercase tracking-widest">
                            CANCEL
                        </a>
                        <button type="submit"
                            class="w-full bg-[#730c1e] hover:bg-[#911226] text-white py-3 rounded-sm text-[11px] font-bold tracking-[0.3em] transition-all active:scale-[0.98] shadow-lg shadow-[#730c1e]/20">
                            PUBLISH CREDENTIAL
                        </button>
                    </div>
                </div>

                <div class="lg:col-span-5 space-y-4">
                    <div class="bg-[#1a151e] border border-white/5 p-4 rounded-sm shadow-xl">
                        <span class="text-[9px] text-gray-600 font-bold uppercase tracking-widest mb-3 block">Live Component
                            Preview</span>

                        <div class="relative aspect-video rounded-sm overflow-hidden border border-white/5 bg-black">
                            <div id="mock-bg" class="absolute inset-0 bg-cover bg-center opacity-40 grayscale-[50%]"
                                style="background-image: url('https://images.unsplash.com/photo-1635776062127-d379bfcba9f8?q=80&w=400')">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>

                            <div class="absolute bottom-3 left-3 flex items-center gap-2">
                                <div>
                                    <h4 id="mock-title" class="text-[10px] font-bold text-white uppercase tracking-tight">
                                        CERTIFICATION</h4>
                                    <p id="mock-subtitle" class="text-[8px] text-gray-400 uppercase">PUBLISHER</p>
                                </div>
                            </div>

                            <label
                                class="absolute inset-0 flex flex-col items-center justify-center bg-black/60 opacity-0 hover:opacity-100 transition-opacity cursor-pointer">
                                <i data-lucide="upload-cloud" class="w-6 h-6 text-white mb-1"></i>
                                <span class="text-[9px] font-bold text-white tracking-widest">UPLOAD BG</span>
                                <input type="file" name="path_gambar" id="image-input" class="hidden" accept="image/*">
                            </label>
                        </div>
                        <p class="text-[9px] text-gray-500 mt-3 text-center italic">*Recommended: 800x500px dark themed
                            image</p>
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
    @vite(['resources/js/admin/sertifikat/create.js'])
@endpush
