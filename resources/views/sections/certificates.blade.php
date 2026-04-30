<section id="certificates" class="pt-12 pb-8 px-6 md:px-8 relative overflow-hidden bg-base">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
            <div class="relative">
                <span class="text-primary font-black uppercase tracking-[0.4em] text-[10px] mb-3 block italic">Sertifikat Keahlian</span>
                <h2 class="text-4xl md:text-5xl font-bold tracking-tighter italic leading-none">
                    Galeri <span class="text-white not-italic border-b-4 border-primary/40"> Sertifikat</span>
                </h2>
            </div>
            <p class="text-textMuted max-w-md text-sm font-light leading-relaxed border-l-2 border-primary/20 pl-4">
                Kumpulan sertifikat dan pelatihan teknis yang memvalidasi kemampuan saya berdasarkan standar industri
                teknologi saat ini.
            </p>
        </div>

        @if ($sertifikats->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @foreach ($sertifikats->slice(0, 8) as $cert)
                    <div class="group h-[180px] [perspective:1000px] cursor-pointer">
                        <div class="relative h-full w-full rounded-xl transition-all duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)] shadow-lg"
                            style="transform-style: preserve-3d; -webkit-transform-style: preserve-3d; perspective: 1000px; -webkit-perspective: 1000px;">
                            <div class="absolute inset-0 h-full w-full [backface-visibility:hidden]">
                                <div
                                    class="h-full w-full rounded-lg overflow-hidden border border-white/10 relative shadow-lg">
                                    @if ($cert->path_gambar)
                                        <img src="{{ asset('storage/' . $cert->path_gambar) }}"
                                            alt="{{ $cert->nama_sertifikat }}" class="h-full w-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-white/5 text-gray-700 italic text-[9px]">
                                            No Preview</div>
                                    @endif
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-base/90 via-transparent to-transparent opacity-80">
                                    </div>
                                    <div class="absolute bottom-3 left-3 flex items-center gap-2 p-1">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-white font-black text-sm line-clamp-1">{{ $cert->nama_sertifikat }}</span>
                                            <span class="text-white/60 text-xs line-clamp-1">{{ $cert->tahun }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute inset-0 h-full w-full rounded-xl bg-[#0d0a0f] border-2 border-primary/40 p-4 [transform:rotateY(180deg)] [backface-visibility:hidden] shadow-[0_0_40px_rgba(244,63,94,0.2)]"
                                style="transform: rotateY(180deg); backface-visibility: hidden;">
                                <div class="flex flex-col h-full">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <iconify-icon icon="ri:shield-star-line"
                                                class="text-primary/40 text-base"></iconify-icon>
                                        </div>
                                        <h4
                                            class="text-sm font-bold text-white leading-tight tracking-tight mb-2 line-clamp-2">
                                            {{ $cert->nama_sertifikat }}</h4>
                                        <div class="h-[1px] w-8 bg-primary mb-3"></div>
                                        <p class="text-[10px] text-textMuted leading-relaxed font-light line-clamp-2">
                                            {{ $cert->deskripsi ?? 'Professional certification from industry leaders.' }}
                                        </p>
                                    </div>
                                    <div class="mt-auto pt-3 border-t border-white/5 flex items-center justify-between">
                                        <div class="flex flex-col gap-0.5">
                                            <span
                                                class="text-[7px] text-textMuted uppercase font-bold tracking-widest">Year</span>
                                            <span
                                                class="text-[9px] text-white font-mono uppercase">{{ $cert->tahun }}</span>
                                        </div>
                                        <a href="{{ $cert->link_kredensial ?? ($cert->link ?? '#') }}" target="_blank"
                                            class="group/btn flex items-center gap-1.5 bg-primary/10 hover:bg-primary px-2 py-1 rounded-lg transition-all duration-300">
                                            <span
                                                class="text-[8px] font-black uppercase tracking-widest text-white">View</span>
                                            <i data-lucide="external-link" class="w-3 h-3 text-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($sertifikats->slice(8)->count() > 0)
                <div id="cert-expanded-items" class="grid hidden grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    @foreach ($sertifikats->slice(8) as $cert)
                        <div class="group h-[180px] [perspective:1000px] cursor-pointer">
                            <div class="relative h-full w-full rounded-xl transition-all duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)] shadow-lg"
                                style="transform-style: preserve-3d; -webkit-transform-style: preserve-3d; perspective: 1000px; -webkit-perspective: 1000px;">
                                <div class="absolute inset-0 h-full w-full [backface-visibility:hidden]"
                                    style="backface-visibility: hidden; -webkit-backface-visibility: hidden;">
                                    <div
                                        class="h-full w-full rounded-lg overflow-hidden border border-white/10 relative shadow-lg">
                                        @if ($cert->path_gambar)
                                            <img src="{{ asset('storage/' . $cert->path_gambar) }}"
                                                alt="{{ $cert->nama_sertifikat }}" class="h-full w-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-white/5 text-gray-700 italic text-[9px]">
                                                No Preview</div>
                                        @endif
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-base/90 via-transparent to-transparent opacity-80">
                                        </div>
                                        <div class="absolute bottom-3 left-3 flex items-center gap-2 p-1">
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-white font-black text-sm line-clamp-1">{{ $cert->nama_sertifikat }}</span>
                                                <span
                                                    class="text-white/60 text-xs line-clamp-1">{{ $cert->tahun }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute inset-0 h-full w-full rounded-xl bg-[#0d0a0f] border-2 border-primary/40 p-4 [transform:rotateY(180deg)] [backface-visibility:hidden] shadow-[0_0_40px_rgba(244,63,94,0.2)]"
                                    style="transform: rotateY(180deg); -webkit-transform: rotateY(180deg); backface-visibility: hidden; -webkit-backface-visibility: hidden;">
                                    <div class="flex flex-col h-full">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-2">
                                                <iconify-icon icon="ri:shield-star-line"
                                                    class="text-primary/40 text-base"></iconify-icon>
                                            </div>
                                            <h4
                                                class="text-sm font-bold text-white leading-tight tracking-tight mb-2 line-clamp-2">
                                                {{ $cert->nama_sertifikat }}</h4>
                                            <div class="h-[1px] w-8 bg-primary mb-3"></div>
                                            <p
                                                class="text-[10px] text-textMuted leading-relaxed font-light line-clamp-2">
                                                {{ $cert->deskripsi ?? 'Professional certification from industry leaders.' }}
                                            </p>
                                        </div>
                                        <div
                                            class="mt-auto pt-3 border-t border-white/5 flex items-center justify-between">
                                            <div class="flex flex-col gap-0.5">
                                                <span
                                                    class="text-[7px] text-textMuted uppercase font-bold tracking-widest">Year</span>
                                                <span
                                                    class="text-[9px] text-white font-mono uppercase">{{ $cert->tahun }}</span>
                                            </div>
                                            <a href="{{ $cert->link_kredensial ?? ($cert->link ?? '#') }}"
                                                target="_blank"
                                                class="group/btn flex items-center gap-1.5 bg-primary/10 hover:bg-primary px-2 py-1 rounded-lg transition-all duration-300">
                                                <span
                                                    class="text-[8px] font-black uppercase tracking-widest text-white">View</span>
                                                <i data-lucide="external-link" class="w-3 h-3 text-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center mt-6">
                    <button type="button" id="cert-expand-btn"
                        class="px-6 py-2.5 bg-primary/10 border border-primary text-primary hover:bg-primary hover:text-white transition-all duration-300 rounded-sm text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                        <span id="cert-expand-text">Lihat Semua Sertifikat</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300"
                            id="cert-expand-icon"></i>
                    </button>
                </div>
            @endif
        @else
            <div class="lg:col-span-12 text-center py-12">
                <p class="text-textMuted text-sm">Tidak ada sertifikat yang tersedia saat ini.</p>
            </div>
        @endif
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const isTouchDevice = () => {
                return (('ontouchstart' in window) ||
                    (navigator.maxTouchPoints > 0) ||
                    (navigator.msMaxTouchPoints > 0));
            };

            const certCardGroups = document.querySelectorAll('#certificates .group[style*="perspective"]');

            certCardGroups.forEach(card => {
                const flipContainer = card.querySelector('.relative[style*="transform-style"]');

                if (!flipContainer) return;

                let isFlipped = false;

                const toggleFlip = (e) => {
                    if (e.target.closest('a')) return;

                    e.preventDefault();
                    isFlipped = !isFlipped;
                    flipContainer.style.transform = isFlipped ? 'rotateY(180deg)' : 'rotateY(0deg)';
                    flipContainer.style.WebkitTransform = isFlipped ? 'rotateY(180deg)' :
                        'rotateY(0deg)';
                    flipContainer.style.transformStyle = 'preserve-3d';
                    flipContainer.style.WebkitTransformStyle = 'preserve-3d';
                };

                if (isTouchDevice()) {
                    card.style.cursor = 'pointer';
                    card.addEventListener('touchstart', toggleFlip, {
                        passive: false
                    });
                } else {
                    card.addEventListener('click', toggleFlip);
                    card.addEventListener('mouseleave', () => {
                        isFlipped = false;
                        flipContainer.style.transform = 'rotateY(0deg)';
                        flipContainer.style.WebkitTransform = 'rotateY(0deg)';
                    });
                }
            });

            // Expand certificates button
            const expandBtn = document.getElementById('cert-expand-btn');
            const expandedContainer = document.getElementById('cert-expanded-items');
            const expandText = document.getElementById('cert-expand-text');
            const expandIcon = document.getElementById('cert-expand-icon');

            if (!expandBtn || !expandedContainer) {
                return;
            }

            let isExpanded = false;

            expandBtn.addEventListener('click', () => {
                isExpanded = !isExpanded;

                expandedContainer.classList.toggle('hidden', !isExpanded);

                if (expandText) {
                    expandText.textContent = isExpanded ? 'Tampilkan Lebih Sedikit Sertifikat' :
                        'Lihat Semua Sertifikat';
                }

                if (expandIcon) {
                    expandIcon.style.transform = isExpanded ? 'rotate(180deg)' : 'rotate(0deg)';
                }

                if (isExpanded) {
                    requestAnimationFrame(() => {
                        expandedContainer.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    });
                }
            });
        });
    </script>
@endpush
