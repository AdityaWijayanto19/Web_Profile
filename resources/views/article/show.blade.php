@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-base pt-20 pb-20">
    <div class="max-w-4xl mx-auto px-6 md:px-8">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('landing') }}"
                class="inline-flex items-center gap-2 text-sm text-primary hover:text-white transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Home
            </a>
        </div>

        <!-- Article Header -->
        <div class="space-y-6 mb-12">
            <!-- Article Title -->
            <div class="space-y-4">
                <h1 class="text-5xl md:text-6xl font-bold leading-tight tracking-tighter bg-gradient-to-r from-white via-white to-white/80 bg-clip-text text-transparent">
                    {{ $artikel->judul }}
                </h1>

                <!-- Article Meta -->
                <div class="flex flex-wrap items-center gap-4 text-sm text-textMuted/80 font-medium">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>{{ $artikel->tanggal_rilis ? $artikel->tanggal_rilis->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="w-1 h-1 rounded-full bg-primary"></div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        <span>{{ $artikel->menit_baca ?? '5' }} min read</span>
                    </div>
                </div>

                <!-- Meta Description -->
                @if($artikel->meta_description)
                    <p class="text-lg text-white/80 leading-relaxed max-w-3xl">
                        {{ $artikel->meta_description }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Article Content (Editor.js blocks) -->
        <div class="prose prose-invert max-w-none space-y-6">
            @if($artikelContent && isset($artikelContent['blocks']) && count($artikelContent['blocks']) > 0)
                @foreach($artikelContent['blocks'] as $block)
                    {{-- Paragraph Block --}}
                    @if($block['type'] === 'paragraph' && isset($block['data']['text']))
                        <p class="text-white/80 leading-relaxed text-lg">
                            {!! nl2br(e($block['data']['text'])) !!}
                        </p>
                    @endif

                    {{-- Heading Block --}}
                    @if($block['type'] === 'heading' && isset($block['data']['text']))
                        @php
                            $level = $block['data']['level'] ?? 2;
                            $headingClass = match($level) {
                                1 => 'text-4xl font-bold',
                                2 => 'text-3xl font-bold',
                                3 => 'text-2xl font-bold',
                                4 => 'text-xl font-bold',
                                default => 'text-lg font-bold'
                            };
                        @endphp
                        <h{{ $level }} class="text-white {{ $headingClass }} mt-8 mb-4">
                            {!! nl2br(e($block['data']['text'])) !!}
                        </h{{ $level }}>
                    @endif

                    {{-- List Block --}}
                    @if($block['type'] === 'list' && isset($block['data']['items']))
                        @php
                            $style = $block['data']['style'] ?? 'unordered';
                        @endphp
                        @if($style === 'ordered')
                            <ol class="list-decimal list-inside text-white/80 space-y-2">
                                @foreach($block['data']['items'] as $item)
                                    <li class="ml-4">
                                        @if(is_array($item))
                                            {!! nl2br(e($item['content'] ?? '')) !!}
                                        @else
                                            {!! nl2br(e($item)) !!}
                                        @endif
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <ul class="list-disc list-inside text-white/80 space-y-2">
                                @foreach($block['data']['items'] as $item)
                                    <li class="ml-4">
                                        @if(is_array($item))
                                            {!! nl2br(e($item['content'] ?? '')) !!}
                                        @else
                                            {!! nl2br(e($item)) !!}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endif

                    {{-- Image Block --}}
                    @if($block['type'] === 'image' && isset($block['data']['file']['url']))
                        <figure class="my-8">
                            <img src="{{ $block['data']['file']['url'] }}"
                                class="w-full rounded-lg border border-white/10 shadow-lg"
                                alt="{{ $block['data']['caption'] ?? 'Article image' }}"
                                loading="lazy">
                            @if(isset($block['data']['caption']) && $block['data']['caption'])
                                <figcaption class="text-center text-sm text-textMuted/60 mt-3 italic">
                                    {{ $block['data']['caption'] }}
                                </figcaption>
                            @endif
                        </figure>
                    @endif

                    {{-- Quote Block --}}
                    @if($block['type'] === 'quote' && isset($block['data']['text']))
                        <blockquote class="border-l-4 border-primary pl-6 py-2 my-6 text-white/80 italic">
                            {!! nl2br(e($block['data']['text'])) !!}
                            @if(isset($block['data']['caption']))
                                <footer class="text-sm text-textMuted mt-2 not-italic">
                                    — {{ $block['data']['caption'] }}
                                </footer>
                            @endif
                        </blockquote>
                    @endif

                    {{-- Code Block --}}
                    @if($block['type'] === 'code' && isset($block['data']['code']))
                        <pre class="bg-black/50 border border-white/10 rounded-lg p-4 overflow-x-auto my-6">
                            <code class="text-green-400 text-sm font-mono">{!! nl2br(e($block['data']['code'])) !!}</code>
                        </pre>
                    @endif

                    {{-- Delimiter Block --}}
                    @if($block['type'] === 'delimiter')
                        <hr class="border-t border-white/10 my-8">
                    @endif
                @endforeach
            @else
                <p class="text-white/60 text-center py-12">Konten artikel tidak tersedia.</p>
            @endif
        </div>

        <!-- Article Footer -->
        <div class="mt-16 pt-8 border-t border-white/10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="space-y-2">
                    <p class="text-sm text-textMuted/60">Article published on</p>
                    <p class="text-white font-medium">{{ $artikel->tanggal_rilis ? $artikel->tanggal_rilis->format('F d, Y') : 'N/A' }}</p>
                </div>
                <a href="{{ route('landing') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary/10 border border-primary text-primary hover:bg-primary hover:text-white transition-all duration-300 rounded-lg font-semibold">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Back to All Articles
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        if (window.lucide) {
            window.lucide.createIcons();
        }
    </script>
@endpush
@endsection
