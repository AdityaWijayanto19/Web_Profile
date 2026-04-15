@extends('layouts.app')

@section('title', 'Edit Technology - Pie')
@section('page_title', 'Edit Technology')

@section('content')
    <div class="max-w-7xl px-4 mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <a href="{{ route('technologies.index') }}"
                class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-[#730c1e] transition-colors group">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                BACK TO TECHNOLOGIES
            </a>
        </div>

        <form action="{{ route('technologies.update', $technology) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <!-- FORM CARD -->
                <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden shadow-2xl">
                    <div class="p-5 border-b border-white/5 bg-black/20">
                        <h3 class="text-white text-sm font-semibold flex items-center gap-2">
                            <i data-lucide="edit-3" class="w-4 h-4 text-[#730c1e]"></i>
                            Update Technology
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Technology Name -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Technology
                                Name</label>
                            <input type="text" name="nama" placeholder="e.g. React, Laravel, PostgreSQL"
                                value="{{ old('nama', $technology->nama) }}"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm @error('nama') border-red-500 @enderror">
                            @error('nama')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon Selection -->
                        <div class="space-y-3">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Simple Icons Icon
                                Name</label>
                            <div class="space-y-2">
                                <input type="text" name="path_icon" id="icon-input"
                                    placeholder="e.g. react, laravel, ubuntu, python"
                                    value="{{ old('path_icon', $technology->path_icon) }}"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all text-sm @error('path_icon') border-red-500 @enderror">
                                @error('path_icon')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Live Preview -->
                            <div
                                class="bg-black/40 border border-white/5 rounded-sm p-4 flex items-center justify-center min-h-24">
                                <div class="text-center">
                                    <div id="icon-preview" class="mb-3">
                                        @if ($technology->path_icon)
                                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/{{ $technology->path_icon }}.svg"
                                                alt="{{ $technology->path_icon }}" class="w-12 h-12 mx-auto"
                                                style="filter: invert(1);">
                                        @else
                                            <i data-lucide="help-circle" class="w-12 h-12 text-gray-600 mx-auto"></i>
                                        @endif
                                    </div>
                                    <p id="icon-name" class="text-xs text-gray-500">
                                        {{ $technology->path_icon ?? 'Type icon name to preview' }}</p>
                                    <p id="icon-status" class="text-[9px] text-gray-600 mt-1">
                                        {{ $technology->path_icon ? '✓ Icon found' : '' }}</p>
                                </div>
                            </div>

                            <!-- Icon Reference Link -->
                            <p class="text-[9px] text-gray-500 italic space-y-1">
                            <div>Browse icons at <a href="https://simpleicons.org/" target="_blank"
                                    class="text-[#730c1e] hover:underline">simpleicons.org</a></div>
                            <div>Use the exact name (lowercase, e.g. "react", "laravel", "ubuntu")</div>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- INFO CARD -->
                <div class="bg-[#1a151d] border border-white/5 rounded-sm p-5 shadow-xl">
                    <div class="flex gap-3">
                        <i data-lucide="info" class="w-5 h-5 text-[#730c1e] flex-shrink-0 mt-0.5"></i>
                        <div>
                            <p class="text-xs font-semibold text-white mb-1">Technology Information</p>
                            <ul class="text-xs text-gray-400 space-y-1 list-disc list-inside">
                                <li>Created {{ $technology->created_at->format('d M Y H:i') }}</li>
                                <li>Last updated {{ $technology->updated_at->format('d M Y H:i') }}</li>
                                <li>Used in {{ $technology->proyeks->count() }} project(s)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('technologies.index') }}"
                        class="flex items-center justify-center bg-white/5 hover:bg-white/10 text-gray-400 py-3 rounded-sm text-[11px] font-bold transition-all border border-white/5 uppercase tracking-widest">
                        CANCEL
                    </a>
                    <button type="submit"
                        class="w-full bg-[#730c1e] hover:bg-[#911226] text-white py-3 rounded-sm text-[11px] font-bold tracking-[0.3em] transition-all active:scale-[0.98] shadow-lg shadow-[#730c1e]/20">
                        PUBLISH CREDENTIAL
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        lucide.createIcons();

        const iconInput = document.getElementById('icon-input');
        const iconPreview = document.getElementById('icon-preview');
        const iconName = document.getElementById('icon-name');
        const iconStatus = document.getElementById('icon-status');
        let previewTimeout;

        iconInput.addEventListener('input', function() {
            clearTimeout(previewTimeout);

            if (!this.value.trim()) {
                iconPreview.innerHTML = `<i data-lucide="help-circle" class="w-12 h-12 text-gray-600 mx-auto"></i>`;
                iconName.textContent = 'Type icon name to preview';
                iconStatus.textContent = '';
                return;
            }

            iconStatus.textContent = 'Loading...';
            iconStatus.style.color = '#888';

            previewTimeout = setTimeout(() => {
                const iconPath = this.value.toLowerCase().trim();
                const cdnUrl = `https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/${iconPath}.svg`;

                // Try to fetch the icon
                fetch(cdnUrl, {
                        method: 'HEAD'
                    })
                    .then(response => {
                        if (response.ok) {
                            iconPreview.innerHTML =
                                `<img src="${cdnUrl}" alt="${iconPath}" class="w-12 h-12 mx-auto" style="filter: invert(1);">`;
                            iconName.textContent = iconPath;
                            iconStatus.textContent = '✓ Icon found';
                            iconStatus.style.color = '#730c1e';
                        } else {
                            iconPreview.innerHTML =
                                `<i data-lucide="alert-circle" class="w-12 h-12 text-red-600 mx-auto"></i>`;
                            iconName.textContent = iconPath;
                            iconStatus.textContent = '✗ Icon not found';
                            iconStatus.style.color = '#ef4444';
                        }
                    })
                    .catch(() => {
                        iconPreview.innerHTML =
                            `<i data-lucide="alert-circle" class="w-12 h-12 text-red-600 mx-auto"></i>`;
                        iconName.textContent = iconPath;
                        iconStatus.textContent = '✗ Icon not found';
                        iconStatus.style.color = '#ef4444';
                    });
            }, 500);
        });

        // Trigger on page load if icon was pre-filled
        if (iconInput.value) {
            iconInput.dispatchEvent(new Event('input'));
        }
    </script>
@endpush
