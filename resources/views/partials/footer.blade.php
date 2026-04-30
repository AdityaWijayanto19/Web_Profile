<footer class="bg-[#050307]/90 backdrop-blur-md border-t border-borderMuted py-10 md:py-6 px-6 md:px-8 relative z-20">
    <div class="max-w-7xl mx-auto">
        @php
            $footerData = $footer ?? null;
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10 text-left">
            <div class="space-y-4">
                <div class="flex items-center gap-2 font-bold text-2xl">
                    @if ($footerData && $footerData->logo_path)
                        <img src="{{ asset('storage/' . $footerData->logo_path) }}" alt="{{ $footerData->nama_web }}"
                            class="w-8 h-8 object-cover rounded-xs">
                    @endif
                    {{ $footerData && $footerData->nama_web ? $footerData->nama_web : 'Pie.' }}
                </div>
                <p class="text-textMuted text-sm">
                    {{ $footerData && $footerData->deskripsi ? $footerData->deskripsi : 'Independent Senior Developer building high-end digital products.' }}
                </p>
            </div>

            <div>
                <h4 class="font-bold mb-4 md:mb-8 uppercase text-xs tracking-widest">Navigasi</h4>
                <div class="grid grid-cols-2 gap-4">
                    <ul class="space-y-4 text-textMuted text-sm">
                        <li><a href="{{ route('landing') }}#about"
                                class="hover:text-primary transition-colors">Profil</a></li>
                        <li><a href="{{ route('landing') }}#education"
                                class="hover:text-primary transition-colors">Pendidikan</a></li>
                        <li><a href="{{ route('landing') }}#certificates"
                                class="hover:text-primary transition-colors">Sertifikat</a></li>
                    </ul>
                    <ul class="space-y-4 text-textMuted text-sm">
                        <li><a href="{{ route('landing') }}#experience"
                                class="hover:text-primary transition-colors">Pengalaman</a></li>
                        <li><a href="{{ route('landing') }}#projects"
                                class="hover:text-primary transition-colors">Proyek</a></li>
                        <li><a href="{{ route('landing') }}#articles"
                                class="hover:text-primary transition-colors">Artikel</a></li>
                    </ul>
                </div>
            </div>

            <div>
                <h4 class="font-bold mb-4 md:mb-8 uppercase text-xs tracking-widest">Sosial Media</h4>
                @if ($footerData && $footerData->mediaSozials && $footerData->mediaSozials->count() > 0)
                    <div class="flex items-center gap-3 mt-2">
                        @foreach ($footerData->mediaSozials as $media)
                            <a href="{{ $media->url }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center text-textMuted hover:text-white transition-all"
                                title="{{ $media->technology->nama ?? 'Social Media' }}">
                                @if ($media->technology?->path_icon)
                                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/{{ $media->technology->path_icon }}.svg"
                                        alt="{{ $media->technology->nama }}" class="w-6 h-6"
                                        style="filter: invert(0.3) brightness(1.1);">
                                @else
                                    <i data-lucide="link" class="w-4 h-4"></i>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <h4 class="font-bold mb-4 md:mb-8 uppercase text-xs tracking-widest">Kontak</h4>
                <ul class="space-y-4 text-textMuted text-sm">
                    @if ($footerData && $footerData->email)
                        <li>
                            <a href="mailto:{{ $footerData->email }}"
                                class="flex items-center gap-2 text-primary font-bold hover:text-secondary transition-colors">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                                {{ $footerData->email }}
                            </a>
                        </li>
                    @endif
                    @if ($footerData && $footerData->no_hp)
                        <li class="flex items-center gap-2">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                            {{ $footerData->no_hp }}
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="text-center pt-8 border-t border-borderMuted/10">
            <p class="text-textMuted text-xs tracking-widest">&copy; {{ now()->year }}
                {{ $footerData && $footerData->nama_web ? $footerData->nama_web : 'Pie' }} Hak
                cipta dilindungi undang-undang.</p>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/lucide@latest"></script>
        <script>
            lucide.createIcons();
        </script>
    @endpush
</footer>
