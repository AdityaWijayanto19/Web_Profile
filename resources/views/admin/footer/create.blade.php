@extends('layouts.admin')

@section('title', 'Create Footer')
@section('page_title', 'Create Footer')

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <div class="mb-6">
            <a href="{{ route('admin.footer.index') }}"
                class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-[#730c1e] transition-colors group">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                BACK TO FOOTER
            </a>
        </div>

        <div class="bg-[#1a151d] border border-white/5 rounded-sm p-6">
            <h2 class="text-lg font-semibold text-white mb-4">Add New Footer</h2>

            <form action="{{ route('admin.footer.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Nama Website -->
                <div>
                    <label for="nama_web" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Website Name
                    </label>
                    <input type="text" id="nama_web" name="nama_web" value="{{ old('nama_web') }}"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-sm placeholder-gray-600 focus:outline-none focus:border-[#730c1e] transition-colors"
                        placeholder="e.g., Pie Studio" required>
                    @error('nama_web')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Description
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-sm placeholder-gray-600 focus:outline-none focus:border-[#730c1e] transition-colors"
                        placeholder="Website description..." required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-sm placeholder-gray-600 focus:outline-none focus:border-[#730c1e] transition-colors"
                        placeholder="contact@example.com">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No HP -->
                <div>
                    <label for="no_hp" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Phone Number
                    </label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-sm placeholder-gray-600 focus:outline-none focus:border-[#730c1e] transition-colors"
                        placeholder="+62 81234567890">
                    @error('no_hp')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Logo -->
                <div>
                    <label for="logo_path" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Logo
                    </label>
                    <input type="file" id="logo_path" name="logo_path" accept="image/*"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-gray-400 text-sm focus:outline-none focus:border-[#730c1e] transition-colors">
                    <p class="text-gray-500 text-xs mt-1">Max 2MB. Format: JPEG, PNG, JPG, GIF, WebP</p>
                    @error('logo_path')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Media Sosial -->
                <div class="border-t border-white/5 pt-4">
                    <div class="flex justify-between items-center mb-3">
                        <label class="block text-xs font-semibold text-gray-300 uppercase tracking-wider">
                            Social Media
                        </label>
                        <button type="button" id="add-media-btn"
                            class="text-xs text-[#730c1e] hover:text-[#921126] font-semibold transition-colors">
                            + Add Social
                        </button>
                    </div>

                    <div id="media-container" class="space-y-2">
                        <!-- Media items will be added here -->
                    </div>

                    @error('media_sozials')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Urutan -->
                <div>
                    <label for="urutan" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Order
                    </label>
                    <input type="number" id="urutan" name="urutan" value="{{ old('urutan', 0) }}" min="0"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-sm placeholder-gray-600 focus:outline-none focus:border-[#730c1e] transition-colors">
                    @error('urutan')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="flex gap-2 pt-2">
                    <button type="submit"
                        class="flex-1 bg-[#730c1e] hover:bg-[#921126] text-white px-3 py-2 rounded-xs text-xs font-bold uppercase tracking-widest transition-colors">
                        Create Footer
                    </button>
                    <a href="{{ route('admin.footer.index') }}"
                        class="px-3 py-2 bg-white/5 hover:bg-white/10 text-gray-300 rounded-xs text-xs font-bold uppercase tracking-widest transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/lucide@latest"></script>
        <script>
            const technologies = @json($technologies);
            const mediaContainer = document.getElementById('media-container');
            const addMediaBtn = document.getElementById('add-media-btn');

            function renderMediaItem(index) {
                const tech = technologies[0] || {};
                const item = document.createElement('div');
                item.className = 'media-item flex gap-2 items-start';
                item.innerHTML = `
                    <select name="media_sozials[${index}][technology_id]"
                        class="flex-1 px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-xs focus:outline-none focus:border-[#730c1e]" required>
                        <option value="">Select Social Media</option>
                        ${technologies.map(t => `<option value="${t.id}">${t.nama}</option>`).join('')}
                    </select>
                    <input type="url" name="media_sozials[${index}][url]" placeholder="https://..."
                        class="flex-1 px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-xs placeholder-gray-600 focus:outline-none focus:border-[#730c1e]" required>
                    <button type="button" class="remove-media px-2 py-2 hover:bg-red-600/20 text-gray-400 hover:text-red-400 rounded-xs transition-colors" title="Remove">
                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                    </button>
                `;

                item.querySelector('.remove-media').addEventListener('click', () => {
                    item.remove();
                    reorderMediaInputs();
                    lucide.createIcons();
                });

                return item;
            }

            function reorderMediaInputs() {
                const items = mediaContainer.querySelectorAll('.media-item');
                items.forEach((item, index) => {
                    item.querySelectorAll('input, select').forEach(input => {
                        const name = input.getAttribute('name');
                        if (name) {
                            input.setAttribute('name', name.replace(/\[\d+\]/, `[${index}]`));
                        }
                    });
                });
            }

            addMediaBtn.addEventListener('click', () => {
                const items = mediaContainer.querySelectorAll('.media-item');
                const newItem = renderMediaItem(items.length);
                mediaContainer.appendChild(newItem);
                lucide.createIcons();
            });

            // Initialize
            lucide.createIcons();
        </script>
    @endpush
@endsection
