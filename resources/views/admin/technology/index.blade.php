@extends('layouts.admin')

@section('title', 'Technologies Management - Pie')
@section('page_title', 'Technologies Library')

@section('content')
    <div class="max-w-7xl mx-auto px-4">

        <div class="flex justify-between items-end mb-8 border-b border-white/5 pb-6">
            <div>
                <h2 class="text-xl font-bold text-white tracking-tight">Technology Stack</h2>
                <p class="text-gray-500 text-[11px] mt-1 uppercase tracking-tighter">Manage available technologies</p>
            </div>
            <a href="{{ route('technologies.create') }}"
                class="btn-primary text-white px-4 py-2 bg-[#730c1e] rounded-sm flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                Add New
            </a>
        </div>

        <div class="mb-6 flex gap-4">
            <div class="flex-1 relative">
                <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-600"></i>
                <input type="text" id="search-tech" placeholder="Search technologies..."
                    class="w-full bg-[#1a151d] border border-white/5 rounded-sm pl-10 pr-4 py-2.5 text-white text-sm focus:border-[#730c1e] outline-none transition-all">
            </div>
        </div>

        <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden shadow-2xl">

            <div class="grid grid-cols-12 gap-4 p-4 bg-black/20 border-b border-white/5">
                <div class="col-span-1 text-[10px] font-bold text-gray-500 uppercase tracking-widest">#</div>
                <div class="col-span-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Technology</div>
                <div class="col-span-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Icon</div>
                <div class="col-span-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Actions</div>
            </div>

            <div class="divide-y divide-white/5">
                @forelse($technologies as $index => $tech)
                    <div class="grid grid-cols-12 gap-4 p-4 hover:bg-black/20 transition-colors">

                        <div class="col-span-1">
                            <span class="text-sm text-gray-400">{{ $loop->iteration }}</span>
                        </div>

                        <div class="col-span-4 flex items-center gap-3">
                            <div class="w-8 h-8 bg-[#730c1e]/20 rounded-sm flex items-center justify-center flex-shrink-0">
                                <img src="https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/{{ $tech->path_icon }}.svg"
                                    alt="{{ $tech->path_icon }}" class="w-4 h-4" style="filter: invert(1);">
                            </div>
                            <span class="text-sm text-white font-medium">{{ $tech->nama }}</span>
                        </div>

                        <div class="col-span-3 flex items-center">
                            <span
                                class="text-xs text-gray-500 bg-black/40 px-2.5 py-1.5 rounded-sm">{{ $tech->path_icon }}</span>
                        </div>

                        <div class="col-span-4 flex items-center gap-2">
                            <a href="{{ route('technologies.edit', $tech) }}"
                                class="text-[10px] font-bold text-gray-500 hover:text-[#730c1e] transition-colors px-3 py-1.5 rounded-sm hover:bg-black/40 inline-flex items-center gap-1 uppercase tracking-widest">
                                <i data-lucide="edit-2" class="w-3 h-3"></i>
                                Edit
                            </a>
                            <form action="{{ route('technologies.destroy', $tech) }}" method="POST" class="inline"
                                onsubmit="return confirm('Delete {{ $tech->nama }}?')">
                                @csrf
                                <button type="button"
                                data-delete-btn
                                    data-technology-name="{{ addslashes($tech->nama) }}"
                                    data-delete-url="{{ route('technologies.destroy', $tech) }}"
                                    class="text-[10px] font-bold text-gray-500 hover:text-red-500 transition-colors px-3 py-1.5 rounded-sm hover:bg-red-500/10 inline-flex items-center gap-1 uppercase tracking-widest">
                                    <i data-lucide="trash-2" class="w-3 h-3"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <i data-lucide="inbox" class="w-12 h-12 text-gray-600 mx-auto mb-3 opacity-50"></i>
                        <p class="text-sm text-gray-500">No technologies found</p>
                        <a href="{{ route('technologies.create') }}"
                            class="text-[#730c1e] hover:underline text-sm font-medium mt-2 inline-block">
                            Create one now
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mt-16 py-8 border-t border-white/5">
            {{ $technologies->links('partials.pagination') }}
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/technology/index.js'])
@endpush
