<section id="education" class="relative px-6 md:px-8 mt-4 pb-8 md:pb-12">
    <div class="max-w-4xl mx-auto text-center mb-2">
        <div class="flex items-center justify-center gap-2 mb-2">
            <span class="w-8 h-[1px] bg-primary"></span>
            <span class="text-primary text-xs font-medium tracking-widest uppercase">Riwayat Perjalanan</span>
            <span class="w-8 h-[1px] bg-primary"></span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
            Latar Belakang <span class="text-primary">Pendidikan.</span>
        </h2>
    </div>

    @php
        $totalItems = $educations?->count() ?? 0;
        $svgHeight = max(480, $totalItems * 220 + 200);
        $spacing = 220;
        $firstItemY = 100;
    @endphp

    <div class="md:hidden flex flex-col gap-8 mt-10 relative">
        <div class="absolute left-4 top-0 bottom-0 w-[2px] bg-primary/40"></div>

        @forelse($educations ?? [] as $education)
            <div class="relative pl-10">
                <div class="absolute left-[9px] top-2 w-4 h-4 bg-primary rounded-full"></div>

                <div class="glass-card p-6 rounded-xl border-l-4 border-primary">
                    <span class="text-primary font-mono text-sm">{{ $education->periode }}</span>
                    <h3 class="text-xl font-bold mt-2 leading-tight">{{ $education->gelar }}</h3>
                    <p class="text-textMuted mt-2 text-sm">{{ $education->instansi }}</p>
                    @if ($education->keterangan)
                        <p class="text-textMuted mt-3 text-sm">{{ $education->keterangan }}</p>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-center text-textMuted">No education data available</p>
        @endforelse
    </div>

    <div class="hidden md:block max-w-5xl mx-auto relative mt-2" style="min-height: {{ $svgHeight }}px">

        <svg class="edu-svg-container" viewBox="0 0 800 {{ $svgHeight }}" fill="none"
            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" style="height: {{ $svgHeight }}px">

            <path d="M400 0V{{ $svgHeight }}" stroke="#880808" stroke-width="2" stroke-dasharray="10 10" />

            @foreach ($educations ?? [] as $index => $education)
                @php
                    $itemY = $firstItemY + $index * $spacing;
                    $isLeft = $index % 2 === 0;

                    if ($isLeft) {
                        $pathD =
                            'M400 ' .
                            ($itemY + 50) .
                            'C400 ' .
                            ($itemY + 50) .
                            ' 400 ' .
                            ($itemY + 100) .
                            ' 300 ' .
                            ($itemY + 100) .
                            'H290';
                    } else {
                        $pathD =
                            'M400 ' .
                            ($itemY + 50) .
                            'C400 ' .
                            ($itemY + 50) .
                            ' 400 ' .
                            ($itemY + 100) .
                            ' 500 ' .
                            ($itemY + 100) .
                            'H650';
                    }
                @endphp

                <path d="{{ $pathD }}" stroke="#880808" stroke-width="2" stroke-opacity="0.5" />
            @endforeach
        </svg>

        @foreach ($educations ?? [] as $index => $education)
            @php
                $itemY = $firstItemY + $index * $spacing;
                $isLeft = $index % 2 === 0;

                $dotPosition = $isLeft ? 'md:-right-[15px]' : 'md:-left-[15px]';
                $borderClass = $isLeft ? 'border-l-4 border-l-primary' : 'border-r-4 border-r-primary';
                $textAlign = $isLeft ? '' : 'md:text-right';
            @endphp

            <div class="absolute w-[40%] z-10"
                style="top: {{ $itemY }}px; {{ $isLeft ? 'left: 0' : 'right: 0' }}">

                <div class="glass-card p-8 rounded-xl {{ $borderClass }} relative {{ $textAlign }}">

                    <!-- dot -->
                    <div
                        class="absolute {{ $dotPosition }} top-[87px] w-8 h-8 bg-base border-2 border-primary rounded-full flex items-center justify-center">
                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                    </div>

                    <span class="text-primary font-mono text-sm">{{ $education->periode }}</span>
                    <h3 class="text-2xl font-bold mt-2 leading-tight">{{ $education->gelar }}</h3>
                    <p class="text-textMuted mt-2 text-sm">{{ $education->instansi }}</p>

                    @if ($education->keterangan)
                        <p class="text-textMuted mt-4 text-sm">{{ $education->keterangan }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
