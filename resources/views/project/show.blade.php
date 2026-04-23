@extends('layouts.app')

@section('content')
    <style>
        .macbook-wrapper {
            position: relative;
            width: 100%;
            z-index: 20;
        }

        .screen-container {
            position: absolute;
            top: 7%;
            left: 12.1%;
            right: 12.1%;
            bottom: 14.2%;
            overflow: hidden;
            z-index: 25;
            padding: 7.2%;
        }

        .screen-container-bg {
            position: absolute;
            top: 14.7%;
            left: 20%;
            width: 60%;
            height: 70%;
            background-color: #000000;
            border-radius: 2px;
            z-index: 10;
        }

        .screen-content {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: top center;
        }

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <main class="relative z-10 pt-20">
        <section class="px-6 pb-20 max-w-6xl mx-auto">
            <div class="mt-12 grid lg:grid-cols-12 gap-10 lg:gap-16 items-start">

                <div class="lg:col-span-5 space-y-12 order-2 lg:order-1">
                    <div class="reveal">
                        <div class="flex items-center gap-4 mb-6">
                            <div>
                                <h1 class="text-4xl lg:text-5xl font-black italic tracking-tighter leading-none">
                                    Craigslist <span class="text-white not-italic">Redesign</span>
                                </h1>
                            </div>
                        </div>
                        <p class="text-textMuted text-base font-light leading-relaxed">
                                Craigslist redesign ini fokus pada kenyamanan navigasi tanpa membuang fungsionalitas utama
                                situs aslinya. Desain ini bertujuan memberikan pengalaman yang bersih dan *straightforward*.
                            </p>
                    </div>

                    <!-- About & Goals (Integrated) -->
                    <div class="reveal space-y-10" style="transition-delay: 150ms;">
                        <div class="grid grid-cols-2 gap-8 pt-6 border-t border-white/5">
                            <div class="space-y-4">
                                <h2 class="text-sm font-black italic tracking-[0.3em] uppercase text-primary">Tech Stack
                                </h2>
                                <div class="flex gap-4 items-center">
                                    <iconify-icon icon="logos:laravel"
                                        class="text-3xl grayscale hover:grayscale-0 transition-all"></iconify-icon>
                                    <iconify-icon icon="logos:tailwindcss-icon"
                                        class="text-3xl grayscale hover:grayscale-0 transition-all"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Actions -->
                    <div class="reveal pt-4" style="transition-delay: 300ms;">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#"
                                class="px-8 py-3 bg-primary text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-sm shadow-lg hover:shadow-primary/40 hover:-translate-y-0.5 transition-all text-center">
                                Live Preview
                            </a>
                            <a href="#"
                                class="px-8 py-3 glass-card text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-sm hover:bg-white/5 transition-all text-center">
                                Source Code
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Visual Side (Laptop) -->
                <div class="lg:col-span-7 reveal order-1 lg:order-2 lg:sticky lg:top-24">
                    <div class="macbook-wrapper lg:scale-110 origin-top lg:origin-center">
                        <div class="screen-container-bg"></div>
                        <img src="{{ asset('assets/images/MacBoook.png') }}"
                            class="relative z-30 w-full drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)]" alt="Mockup">
                        <div class="screen-container z-20">
                            <img src="{{ asset('assets/images/image.png') }}" class="screen-content"
                                alt="Screenshot Project">
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        // Logic khusus untuk reveal animation pada halaman ini
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
@endpush
