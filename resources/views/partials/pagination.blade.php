@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        {{-- Mobile View --}}
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-[10px] font-bold text-gray-600 bg-white/5 border border-white/5 rounded-sm uppercase tracking-widest cursor-default">Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-[10px] font-bold text-white bg-white/5 border border-white/10 rounded-sm uppercase tracking-widest hover:bg-[#730c1e] transition-all">Previous</a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-[10px] font-bold text-white bg-white/5 border border-white/10 rounded-sm uppercase tracking-widest hover:bg-[#730c1e] transition-all">Next</a>
            @else
                <span class="px-4 py-2 text-[10px] font-bold text-gray-600 bg-white/5 border border-white/5 rounded-sm uppercase tracking-widest cursor-default">Next</span>
            @endif
        </div>

        {{-- Desktop View --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-[11px] text-gray-500 uppercase tracking-tighter">
                    Showing <span class="font-bold text-white">{{ $paginator->firstItem() }}</span> to <span class="font-bold text-white">{{ $paginator->lastItem() }}</span> of <span class="font-bold text-white">{{ $paginator->total() }}</span> results
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-sm">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center px-3 py-2 border border-white/10 bg-white/5 text-gray-600 rounded-l-sm cursor-default">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-3 py-2 border border-white/10 bg-[#1a151c] text-gray-400 hover:text-white hover:bg-[#730c1e] rounded-l-sm transition-all">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements (Numbers) --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span class="relative inline-flex items-center px-4 py-2 border border-white/10 bg-white/5 text-gray-600 cursor-default text-[11px] font-bold">{{ $element }}</span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="relative inline-flex items-center px-4 py-2 border border-[#730c1e] bg-[#730c1e] text-white text-[11px] font-bold z-10">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-white/10 bg-[#1a151c] text-gray-400 hover:text-white hover:bg-white/5 transition-all text-[11px] font-bold">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-3 py-2 border border-white/10 bg-[#1a151c] text-gray-400 hover:text-white hover:bg-[#730c1e] rounded-r-sm transition-all">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    @else
                        <span class="relative inline-flex items-center px-3 py-2 border border-white/10 bg-white/5 text-gray-600 rounded-r-sm cursor-default">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
