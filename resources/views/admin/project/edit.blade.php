@extends('layouts.app')

@section('title', 'Edit Project - Pie')
@section('page_title', 'Edit Project')

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <a href="{{ route('projects.index') }}"
                class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-[#730c1e] transition-colors group">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                BACK TO PROJECTS
            </a>
        </div>

        <form action="{{ route('projects.update', ['project' => $proyek->id ?? 1]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                <!-- LEFT COLUMN: FORM UTAMA (8/12) -->
                <div class="lg:col-span-8 space-y-6">
                    <!-- Project Details Card -->
                    <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden shadow-2xl">
                        <div class="p-5 border-b border-white/5 bg-black/20">
                            <h3 class="text-white text-sm font-semibold flex items-center gap-2">
                                <i data-lucide="folder-open" class="w-4 h-4 text-[#730c1e]"></i>
                                Project Information
                            </h3>
                        </div>

                        <div class="p-6 space-y-6">
                            <!-- Project Title -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Project
                                    Title</label>
                                <input type="text" name="judul" placeholder="e.g. E-Commerce Platform"
                                    value="{{ old('judul', $proyek->judul) }}"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm @error('judul') border-red-500 @enderror">
                                @error('judul')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Project Description -->
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Description</label>
                                <textarea name="deskripsi" rows="6" placeholder="Describe your project, features, and outcomes..."
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-3 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 resize-none text-sm leading-relaxed @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $proyek->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Links Row -->
                            <div class="grid grid-cols-2 gap-6">
                                <!-- Demo Link -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Demo
                                        Link</label>
                                    <input type="url" name="link_demo" placeholder="https://example.com"
                                        value="{{ old('link_demo', $proyek->link_demo) }}"
                                        class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm @error('link_demo') border-red-500 @enderror">
                                    @error('link_demo')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Repository Link -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Repository
                                        Link</label>
                                    <input type="url" name="link_repo" placeholder="https://github.com/..."
                                        value="{{ old('link_repo', $proyek->link_repo) }}"
                                        class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm @error('link_repo') border-red-500 @enderror">
                                    @error('link_repo')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Order Number -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Display
                                    Order</label>
                                <input type="number" name="urutan" placeholder="0" min="0" max="9999"
                                    value="{{ old('urutan', $proyek->urutan) }}"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm @error('urutan') border-red-500 @enderror">
                                @error('urutan')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- FORM ACTIONS -->
                    <div
                        class="flex items-center justify-between p-6 bg-[#1a151d] border border-white/5 rounded-sm shadow-xl">
                        <a href="{{ route('projects.index') }}"
                            class="text-xs font-bold text-gray-500 hover:text-white transition-colors uppercase tracking-widest">
                            Cancel
                        </a>
                        <div class="flex gap-4">
                            <button type="submit"
                                class="bg-[#730c1e] hover:bg-[#8e1227] text-white px-8 py-3 rounded-sm text-xs font-bold transition-all shadow-lg shadow-[#730c1e]/10 flex items-center gap-2">
                                <i data-lucide="save" class="w-4 h-4"></i>
                                UPDATE PROJECT
                            </button>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: SIDEBAR (4/12) -->
                <div class="lg:col-span-4 space-y-6">

                    <!-- IMAGE UPLOAD CARD -->
                    <div class="bg-[#1a151d] border border-white/5 rounded-sm p-6 shadow-xl">
                        <h4
                            class="text-white text-[11px] font-bold uppercase tracking-widest mb-4 pb-3 border-b border-white/5 flex items-center gap-2">
                            <i data-lucide="image" class="w-3.5 h-3.5 text-gray-500"></i> Project Image
                        </h4>

                        <div class="relative aspect-video rounded-sm overflow-hidden border border-white/5 bg-black mb-4">
                            <div
                                class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/80 flex items-center justify-center">
                                @if ($proyek->path_gambar)
                                    <img id="preview-image" src="{{ asset('storage/' . $proyek->path_gambar) }}"
                                        alt="Preview" class="w-full h-full object-cover">
                                @else
                                    <div id="placeholder" class="text-center">
                                        <i data-lucide="image-plus" class="w-8 h-8 text-gray-600 mx-auto mb-2"></i>
                                        <p class="text-xs text-gray-500">No image selected</p>
                                    </div>
                                    <img id="preview-image" src="" alt="Preview"
                                        class="w-full h-full object-cover hidden">
                                @endif
                            </div>

                            <!-- Upload Overlay -->
                            <label
                                class="absolute inset-0 flex flex-col items-center justify-center bg-black/50 opacity-0 hover:opacity-100 transition-opacity cursor-pointer">
                                <i data-lucide="upload-cloud" class="w-6 h-6 text-white mb-1"></i>
                                <span class="text-[9px] font-bold text-white tracking-widest">CHANGE IMAGE</span>
                                <input type="file" name="gambar" id="image-input" class="hidden" accept="image/*"
                                    @error('gambar') is-invalid @enderror>
                            </label>
                        </div>

                        <p class="text-[9px] text-gray-500 text-center italic mb-4">JPG, PNG • Max 2MB • Min 100x100px</p>

                        @error('gambar')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PUBLISH & CONFIG CARD -->
                    <div class="bg-[#1a151d] border border-white/5 rounded-sm p-6 shadow-xl">
                        <h4
                            class="text-white text-[11px] font-bold uppercase tracking-widest mb-6 pb-2 border-b border-white/5 flex items-center gap-2">
                            <i data-lucide="settings-2" class="w-3.5 h-3.5 text-gray-500"></i> Status
                        </h4>

                        <div class="space-y-4">
                            <!-- Status Selection -->
                            <div class="space-y-3">
                                <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Publish
                                    Status</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <label class="cursor-pointer group">
                                        <input type="radio" name="status" value="draft" class="peer sr-only"
                                            {{ old('status', $proyek->status) === 'draft' ? 'checked' : '' }} />
                                        <div
                                            class="text-center py-2.5 text-[10px] border border-white/5 bg-black/40 text-gray-500 peer-checked:border-[#730c1e] peer-checked:text-white peer-checked:bg-[#730c1e]/10 transition-all rounded-sm uppercase font-black">
                                            DRAFT</div>
                                    </label>
                                    <label class="cursor-pointer group">
                                        <input type="radio" name="status" value="published" class="peer sr-only"
                                            {{ old('status', $proyek->status) === 'published' ? 'checked' : '' }} />
                                        <div
                                            class="text-center py-2.5 text-[10px] border border-white/5 bg-black/40 text-gray-500 peer-checked:border-[#730c1e] peer-checked:text-white peer-checked:bg-[#730c1e]/10 transition-all rounded-sm uppercase font-black">
                                            PUBLISHED</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TECHNOLOGIES CARD -->
                    <div class="bg-[#1a151d] border border-white/5 rounded-sm p-6 shadow-xl">
                        <h4
                            class="text-white text-[11px] font-bold uppercase tracking-widest mb-4 pb-3 border-b border-white/5 flex items-center gap-2">
                            <i data-lucide="cpu" class="w-3.5 h-3.5 text-gray-500"></i> Technologies
                        </h4>

                        <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                            @forelse($teknologis ?? [] as $tech)
                                <label
                                    class="flex items-center gap-3 p-2.5 rounded-sm bg-black/20 hover:bg-black/40 transition-colors cursor-pointer">
                                    <input type="checkbox" name="teknologis[]" value="{{ $tech->id }}"
                                        class="w-4 h-4 rounded border-white/10 bg-black/40 checked:bg-[#730c1e] cursor-pointer"
                                        {{ in_array($tech->id, $selectedTeknologis ?? []) ? 'checked' : '' }}>
                                    <span class="text-xs text-white">{{ $tech->nama }}</span>
                                </label>
                            @empty
                                <p class="text-[10px] text-gray-500 italic">No technologies available</p>
                            @endforelse
                        </div>

                        @error('teknologis')
                            <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CONTENT GUIDELINES CARD -->
                    <div class="bg-[#1a151d] border border-white/5 rounded-sm p-6">
                        <h4
                            class="text-white text-[11px] font-bold uppercase tracking-widest mb-4 flex items-center gap-2">
                            <i data-lucide="info" class="w-3.5 h-3.5 text-[#730c1e]"></i> Edit Tips
                        </h4>

                        <ul class="space-y-4">
                            <li class="flex gap-3">
                                <div
                                    class="w-5 h-5 rounded bg-[#730c1e]/10 border border-[#730c1e]/20 flex items-center justify-center flex-shrink-0">
                                    <span class="text-[10px] text-[#730c1e] font-bold">1</span>
                                </div>
                                <p class="text-[11px] text-gray-400 leading-relaxed">Ubah gambar untuk mengganti yang lama.
                                    Gambar lama akan dihapus otomatis.</p>
                            </li>
                            <li class="flex gap-3">
                                <div
                                    class="w-5 h-5 rounded bg-[#730c1e]/10 border border-[#730c1e]/20 flex items-center justify-center flex-shrink-0">
                                    <span class="text-[10px] text-[#730c1e] font-bold">2</span>
                                </div>
                                <p class="text-[11px] text-gray-400 leading-relaxed">Setidaknya satu teknologi harus
                                    dipilih untuk project.</p>
                            </li>
                            <li class="flex gap-3">
                                <div
                                    class="w-5 h-5 rounded bg-[#730c1e]/10 border border-[#730c1e]/20 flex items-center justify-center flex-shrink-0">
                                    <span class="text-[10px] text-[#730c1e] font-bold">3</span>
                                </div>
                                <p class="text-[11px] text-gray-400 leading-relaxed">Simpan perubahan untuk memperbarui
                                    project di portfolio.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        lucide.createIcons();
        const imageInput = document.getElementById('image-input');
        const previewImage = document.getElementById('preview-image');
        const placeholder = document.getElementById('placeholder');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImage.src = event.target.result;
                    previewImage.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
