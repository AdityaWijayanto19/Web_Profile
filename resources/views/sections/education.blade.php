<section id="education" class="relative px-6 md:px-8 mt-4 md:mt-4 pb-8 md:pb-12">
    <div class="max-w-4xl mx-auto text-center mb-2">
        <div class="flex items-center justify-center gap-2 mb-2">
            <span class="w-8 h-[1px] bg-primary"></span>
            <span class="text-primary text-xs font-medium tracking-widest uppercase">My Journey</span>
            <span class="w-8 h-[1px] bg-primary"></span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
            Education <span class="text-primary">section.</span>
        </h2>
    </div>

    <div class="max-w-5xl mx-auto relative flex flex-col md:block gap-10 mt-16 md:mt-2" style="min-height: {{ $educations?->count() > 0 ? $educations->count() * 220 + 200 : 480 }}px">
        @php
            $totalItems = $educations?->count() ?? 0;
            $svgHeight = max(480, $totalItems * 220 + 200);
            $spacing = 220; // Jarak antar item
            $firstItemY = 100; // Posisi item pertama
        @endphp

        <svg class="edu-svg-container hidden md:block" viewBox="0 0 800 {{ $svgHeight }}" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" style="height: {{ $svgHeight }}px">
            <!-- Garis vertikal utama (timeline tengah) -->
            <path d="M400 0V{{ $svgHeight }}" stroke="#880808" stroke-width="2" stroke-dasharray="10 10" />

            <!-- Garis connector untuk setiap item -->
            @forelse($educations ?? [] as $index => $education)
                @php
                    $itemY = $firstItemY + ($index * $spacing);
                    $isLeft = $index % 2 === 0;

                    if ($isLeft) {
                        // Ke kiri: curve dari tengah (400) ke kiri (300) -> 290
                        $pathD = "M400 " . ($itemY + 50) . "C400 " . ($itemY + 50) . " 400 " . ($itemY + 100) . " 300 " . ($itemY + 100) . "H290";
                    } else {
                        // Ke kanan: curve dari tengah (400) ke kanan (500) -> 650
                        $pathD = "M400 " . ($itemY + 50) . "C400 " . ($itemY + 50) . " 400 " . ($itemY + 100) . " 500 " . ($itemY + 100) . "H650";
                    }
                @endphp
                <path d="{{ $pathD }}" stroke="#880808" stroke-width="2" stroke-opacity="0.5" />
            @empty
            @endforelse
        </svg>

        <!-- Item Cards Loop -->
        @forelse($educations ?? [] as $index => $education)
            @php
                $itemY = $firstItemY + ($index * $spacing);
                $isLeft = $index % 2 === 0;
                $dotPosition = $isLeft ? 'md:-right-[15px]' : 'md:-left-[15px]';
                $borderClass = $isLeft ? 'border-l-4 border-l-primary' : 'border-r-4 border-r-primary';
                $textAlign = $isLeft ? '' : 'md:text-right';
            @endphp
            <div class="relative md:absolute md:w-[40%] w-full z-10" style="top: {{ $itemY }}px; {{ $isLeft ? 'left: 0' : 'right: 0' }}">
                <div class="glass-card p-8 rounded-xl {{ $borderClass }} relative">
                    <div class="absolute {{ $dotPosition }} top-[87px] w-8 h-8 bg-base border-2 border-primary rounded-full hidden md:flex items-center justify-center">
                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                    </div>
                    <span class="text-primary font-mono text-sm">{{ $education->periode }}</span>
                    <h3 class="text-2xl font-bold mt-2 leading-tight">{{ $education->gelar }}</h3>
                    <p class="text-textMuted mt-2 text-sm leading-relaxed font-light">{{ $education->instansi }}</p>
                    @if($education->keterangan)
                        <p class="text-textMuted mt-4 text-sm leading-relaxed font-light">{{ $education->keterangan }}</p>
                    @endif
                </div>
            </div>
        @empty
            <!-- Fallback jika tidak ada data -->
            <div class="text-center text-textMuted py-12">
                <p>No education data available</p>
            </div>
        @endforelse
    </div>
</section>
