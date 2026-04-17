@extends('layouts.app')

@section('title', 'Edit Technology - Pie')
@section('page_title', 'Edit Technology')

@section('content')
    <div class="max-w-7xl px-4 mx-auto">
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
                <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden shadow-2xl">
                    <div class="p-5 border-b border-white/5 bg-black/20">
                        <h3 class="text-white text-sm font-semibold flex items-center gap-2">
                            <i data-lucide="edit-3" class="w-4 h-4 text-[#730c1e]"></i>
                            Update Technology
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
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

                            <p class="text-[9px] text-gray-500 italic space-y-1">
                            <div>Browse icons at <a href="https://simpleicons.org/" target="_blank"
                                    class="text-[#730c1e] hover:underline">simpleicons.org</a></div>
                            </p>
                            <p class="text-xs text-gray-400 space-y-1 list-disc list-inside mt-2">Used in
                                {{ $technology->proyeks->count() }} projects</p>
                        </div>
                    </div>
                </div>

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
    @vite(['resources/js/admin/technology/edit.js'])
@endpush
