<section id="articles" class="py-8 md:py-10 px-6 md:px-8 relative overflow-hidden">
    <div class="webgl-globe-outer">
        <div class="webgl-globe-container">
            <canvas id="cobe-canvas"></canvas>
        </div>
    </div>

    <div class="max-w-6xl mx-auto relative z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
            <div class="relative">
                <span class="text-primary font-black uppercase tracking-[0.4em] text-[10px] mb-3 block italic">Publikasi
                    Artikel</span>
                <h2 class="text-4xl md:text-5xl font-bold tracking-tighter italic leading-none">
                    Galeri <span class="text-white not-italic border-b-4 border-primary/40">Artikel</span>
                </h2>
            </div>
            <p class="text-textMuted max-w-md text-sm font-light leading-relaxed border-l-2 border-primary/20 pl-4">
                Ruang berbagi edukasi dan pengalaman melalui tulisan, memberikan sudut pandang baru seputar tren
                industri dan teknologi.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:items-start">
            @if ($articles->count() > 0)
                {{-- Featured Article (Left) --}}
                @php $featuredArticle = $articles->first(); @endphp
                <div class="lg:col-span-7">
                    <div class="group cursor-pointer flex flex-col gap-4 no-underline">
                        <div
                            class="relative aspect-[16/9] rounded-2xl overflow-hidden border border-borderMuted shadow-2xl">
                            @php
                                $imageSrc = null;
                                if ($featuredArticle->path_gambar) {
                                    // Check if path already has /storage/ prefix
                                    if (strpos($featuredArticle->path_gambar, '/storage/') === 0) {
                                        $imageSrc = $featuredArticle->path_gambar;
                                    } else {
                                        $imageSrc = asset('storage/' . $featuredArticle->path_gambar);
                                    }
                                }
                            @endphp
                            @if ($imageSrc)
                                <img src="{{ $imageSrc }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-base text-gray-700 italic text-sm">
                                    No Preview</div>
                            @endif
                        </div>
                        <div class="space-y-3 px-1">
                            <div class="flex items-center gap-3 text-xs text-textMuted/80 font-medium">
                                <span>{{ $featuredArticle->tanggal_rilis ? $featuredArticle->tanggal_rilis->format('M d, Y') : 'N/A' }}</span>
                                <span class="w-1 h-1 rounded-full bg-primary"></span>
                                <span>{{ $featuredArticle->menit_baca ?? '5' }} min read</span>
                            </div>
                            <h3
                                class="text-3xl md:text-4xl font-extrabold leading-tight tracking-tighter bg-gradient-to-r from-primary via-[#ef4444] to-[#7f1d1d] bg-clip-text text-transparent group-hover:from-white group-hover:to-primary transition-all duration-500">
                                {{ $featuredArticle->judul }}
                            </h3>
                            <p class="text-white/80 leading-relaxed text-base md:text-lg font-normal max-w-2xl">
                                {{ $featuredArticle->meta_description ?? 'Professional insights and technical deep dives.' }}
                            </p>
                            <a href="{{ route('article.show', $featuredArticle->slug) }}"
                                class="text-primary font-black text-sm flex items-center gap-2 group-hover:gap-5 transition-all pt-2 uppercase">
                                Read Full Article <div class="w-8 h-[1px] bg-primary group-hover:w-12 transition-all">
                                </div> <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Other Articles (Right) --}}
                <div class="lg:col-span-5 flex flex-col gap-2 lg:max-h-[560px] overflow-y-auto custom-scrollbar pr-2">
                    @foreach ($articles->slice(1) as $article)
                        <a href="{{ route('article.show', $article->slug) }}"
                            class="group cursor-pointer flex gap-3 items-start p-2 rounded-xl hover:bg-white/[0.03] transition-all duration-300 no-underline">
                            <div
                                class="flex-shrink-0 w-32 md:w-40 aspect-video rounded-lg overflow-hidden border border-borderMuted bg-surface">
                                @if ($article->path_gambar)
                                    @php
                                        $imageSrc = null;

                                        if (strpos($article->path_gambar, '/storage/') === 0) {
                                            $imageSrc = $article->path_gambar;
                                        } else {
                                            $imageSrc = asset('storage/' . $article->path_gambar);
                                        }
                                    @endphp
                                    <img src="{{ $imageSrc }}"
                                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-base text-gray-700 italic text-[9px]">
                                        No Preview</div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <span
                                    class="text-[9px] text-primary font-bold uppercase tracking-[0.2em] mb-1 block">{{ $article->tanggal_rilis ? $article->tanggal_rilis->format('M d, Y') : 'N/A' }}</span>
                                <h4
                                    class="text-white text-sm md:text-md font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2 underline-offset-4 group-hover:underline">
                                    {{ $article->judul }}</h4>
                                <p class="text-textMuted text-xs mt-1 line-clamp-1 font-light opacity-90">
                                    {{ $article->meta_description ?? 'Professional insights.' }}</p>
                                <p class="text-textMuted/70 text-xs mt-1 font-light">{{ $article->menit_baca ?? '5' }}
                                    min read</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="lg:col-span-12 text-center py-12">
                    <p class="text-textMuted text-sm">No articles available at the moment.</p>
                </div>
            @endif
        </div>
    </div>
</section>
