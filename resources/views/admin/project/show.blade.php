@extends('layouts.app')

@section('title', $proyek->judul)
@section('page_title', 'Project Details')

@push('styles')
    <style>
        .btn-outline {
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .btn-danger-soft {
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
            transition: all 0.3s ease;
        }

        .btn-danger-soft:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        .meta-label {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #4b5563;
            /* gray-600 */
            margin-bottom: 0.5rem;
            display: block;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto px-4">

        <!-- HEADER: DISAMAKAN DENGAN DESIGN SEBELUMNYA -->
        <div class="flex justify-between items-end mb-12 border-b border-white/5 pb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h2 class="text-3xl font-black text-white tracking-tighter uppercase italic">{{ $proyek->judul }}</h2>
                    <div
                        class="px-2 py-0.5 {{ $proyek->status === 'published' ? 'bg-green-600' : 'bg-yellow-600' }} border border-white/10 rounded-sm text-[9px] text-white font-bold uppercase tracking-widest">
                        {{ $proyek->status }}
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('projects.index') }}"
                    class="btn-outline text-white px-5 py-2.5 rounded-sm flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    Back
                </a>
                <a href="{{ route('projects.edit', $proyek) }}"
                    class="bg-[#730c1e] text-white px-5 py-2.5 rounded-sm flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest hover:bg-[#921126] transition-all">
                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                    Modify
                </a>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-12">

            <!-- LEFT COLUMN: MEDIA & LINKS -->
            <div class="col-span-12 lg:col-span-5 space-y-10">

                <!-- LARGE IMAGE -->
                <div class="relative group">
                    <div class="aspect-video bg-[#0f0d11] border border-white/5 overflow-hidden rounded-sm">
                        @if ($proyek->path_gambar)
                            <img src="{{ asset('storage/' . $proyek->path_gambar) }}" alt="{{ $proyek->judul }}"
                                class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-all duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i data-lucide="image" class="w-12 h-12 text-white/5"></i>
                            </div>
                        @endif
                    </div>
                    <!-- Decorative Elements -->
                    <div class="absolute -bottom-2 -right-2 w-20 h-20 bg-[#730c1e]/10 -z-10"></div>
                </div>

                <!-- LINKS & REFERENCES -->
                <div class="space-y-6">
                    <div>
                        <span class="meta-label">Links & Resources</span>
                        <div class="grid grid-cols-1 gap-3 mt-4">
                            @if ($proyek->link_demo)
                                <a href="{{ $proyek->link_demo }}" target="_blank"
                                    class="flex items-center justify-between p-4 bg-white/[0.02] border border-white/5 rounded-sm hover:border-[#730c1e]/50 hover:bg-white/[0.04] transition-all group">
                                    <div class="flex items-center gap-4">
                                        <i data-lucide="external-link"
                                            class="w-5 h-5 text-gray-500 group-hover:text-[#730c1e]"></i>
                                        <span class="text-xs font-bold text-gray-300 uppercase tracking-widest">Live
                                            Preview</span>
                                    </div>
                                    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-700"></i>
                                </a>
                            @endif

                            @if ($proyek->link_repo)
                                <a href="{{ $proyek->link_repo }}" target="_blank"
                                    class="flex items-center justify-between p-4 bg-white/[0.02] border border-white/5 rounded-sm hover:border-white/20 hover:bg-white/[0.04] transition-all group">
                                    <div class="flex items-center gap-4">
                                        <i data-lucide="folder" class="w-5 h-5 text-gray-500 group-hover:text-white"></i>
                                        <span class="text-xs font-bold text-gray-300 uppercase tracking-widest">Repository
                                            Code</span>
                                    </div>
                                    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-700"></i>
                                </a>
                            @endif

                            @if (!$proyek->link_demo && !$proyek->link_repo)
                                <p class="text-[10px] text-gray-600 italic uppercase tracking-widest">No external links
                                    provided.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: CONTENT & SPECS -->
            <div class="col-span-12 lg:col-span-7 space-y-12">

                <!-- OVERVIEW / DESCRIPTION -->
                <div class="space-y-4">
                    <span class="meta-label">Project Overview</span>
                    <p class="text-gray-400 text-sm leading-relaxed font-medium">
                        {{ $proyek->deskripsi ?? 'No description provided for this project.' }}
                    </p>
                </div>

                <!-- TECHNICAL STACK -->
                <div class="space-y-6">
                    <span class="meta-label">Technical Stack</span>
                    <div class="flex items-center gap-2.5 ">
                        @foreach ($proyek->teknologis as $tech)
                            <div class="group/tech relative">
                                @if ($tech->path_icon)
                                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/{{ $tech->path_icon }}.svg"
                                        alt="{{ $tech->nama }}" class="w-5 h-5" style="filter: invert(0.2);"
                                        loading="lazy">
                                @else
                                    <div
                                        class="w-4 h-4 flex items-center justify-center bg-white/5 rounded-[1px] text-[7px] text-gray-500 font-bold border border-white/10">
                                        {{ substr($tech->nama, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- METADATA GRID -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 pt-10 border-t border-white/5">
                    <div>
                        <span class="meta-label">Order Index</span>
                        <p class="text-xl font-mono text-white italic">
                            #{{ str_pad($proyek->urutan, 2, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <span class="meta-label">Deployment Date</span>
                        <p class="text-sm font-bold text-gray-300 uppercase">{{ $proyek->created_at->format('M d, Y') }}
                        </p>
                    </div>
                    <div>
                        <span class="meta-label">Last Revision</span>
                        <p class="text-sm font-bold text-gray-300 uppercase">{{ $proyek->updated_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        if (window.lucide) {
            window.lucide.createIcons();
        }
    </script>
@endpush
