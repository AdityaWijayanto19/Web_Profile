<footer class="bg-[#050307]/90 backdrop-blur-md border-t border-borderMuted py-10 md:py-6 px-6 md:px-8 relative z-20">
    <div class="max-w-7xl mx-auto">
        @php
            $footerData = $footer ?? null;
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10 text-left">
            <!-- Logo & Description -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 font-bold text-2xl">
                    @if ($footerData?->logo_path)
                        <img src="{{ asset('storage/' . $footerData->logo_path) }}" alt="{{ $footerData->nama_web }}"
                            class="w-8 h-8 object-cover rounded-xs">
                    @endif
                    {{ $footerData?->nama_web ?? 'Pie.' }}
                </div>
                <p class="text-textMuted text-sm">{{ $footerData?->deskripsi ?? 'Independent Senior Developer building high-end digital products.' }}</p>
            </div>

            <!-- Navigation Links -->
            <div>
                <h4 class="font-bold mb-4 md:mb-8 uppercase text-xs tracking-widest">Navigation</h4>
                <ul class="space-y-4 text-textMuted text-sm">
                    <li><a href="#about" class="hover:text-primary transition-colors">Profile</a></li>
                    <li><a href="#education" class="hover:text-primary transition-colors">Education</a></li>
                    <li><a href="#projects" class="hover:text-primary transition-colors">Projects</a></li>
                </ul>
            </div>

            <!-- Services Links -->
            <div>
                <h4 class="font-bold mb-4 md:mb-8 uppercase text-xs tracking-widest">Services</h4>
                <ul class="space-y-4 text-textMuted text-sm">
                    <li>Enterprise Web Apps</li>
                    <li>3D/WebGL Design</li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div>
                <h4 class="font-bold mb-4 md:mb-8 uppercase text-xs tracking-widest">Contact</h4>
                <ul class="space-y-4 text-textMuted text-sm">
                    @if ($footerData?->email)
                        <li>
                            <a href="mailto:{{ $footerData->email }}" class="text-primary font-bold hover:text-secondary transition-colors">
                                {{ $footerData->email }}
                            </a>
                        </li>
                    @endif
                    @if ($footerData?->no_hp)
                        <li>{{ $footerData->no_hp }}</li>
                    @endif
                </ul>

                <!-- Social Media Icons -->
                @if ($footerData?->mediaSozials->count() > 0)
                    <div class="flex items-center gap-3 mt-4">
                        @foreach ($footerData->mediaSozials as $media)
                            <a href="{{ $media->url }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center justify-center w-8 h-8 bg-white/10 hover:bg-primary rounded-xs text-textMuted hover:text-white transition-all"
                                title="{{ $media->technology->nama ?? 'Social Media' }}">
                                @if ($media->technology?->icon)
                                    <i data-lucide="{{ $media->technology->icon }}" class="w-4 h-4"></i>
                                @else
                                    <i data-lucide="link" class="w-4 h-4"></i>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="text-center pt-8 border-t border-borderMuted/10">
            <p class="text-textMuted text-xs tracking-widest">&copy; 2026 {{ $footerData?->nama_web ?? 'Pie' }}. All rights reserved.</p>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/lucide@latest"></script>
        <script>
            lucide.createIcons();
        </script>
    @endpush
</footer>
