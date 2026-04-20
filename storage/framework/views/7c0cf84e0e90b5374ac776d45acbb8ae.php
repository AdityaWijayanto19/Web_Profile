<header class="relative w-full min-h-screen flex flex-col overflow-hidden">
    <div class="hero-pattern-bg"></div>
    <div class="hero-spotlight"></div>

    <main class="relative flex-1 flex flex-col md:flex-row items-center z-10 w-full max-w-7xl mx-auto px-6 md:px-16 py-12">
        <span class="absolute top-[55%] left-1/2 -translate-x-1/2 -translate-y-1/2 text-[20vw] md:text-[22vw] font-black text-white/[0.02] select-none uppercase tracking-tighter z-0 pointer-events-none whitespace-nowrap">
            CREATIVE
        </span>

        <div class="w-full md:w-3/5 space-y-12 z-10 text-left pt-20 md:pt-0">
            <div class="space-y-6 pt-14">
                <h1 class="text-6xl md:text-[100px] font-bold tracking-tighter leading-[0.85] flex flex-col italic">
                    <span class="text-white not-italic">ADITYA P.</span>
                    <span class="text-primary drop-shadow-[0_0_40px_rgba(244,63,94,0.25)]">WIJAYANTO</span>
                </h1>
                <div class="flex items-center gap-6 pl-2">
                    <div class="h-[1px] w-12 bg-primary"></div>
                    <p class="text-[10px] md:text-[13px] uppercase tracking-[0.4em] md:tracking-[0.6em] text-textMuted font-bold">
                        Undergraduate University of Brawijaya
                    </p>
                </div>
            </div>

            <div class="space-y-8 pl-2">
                <p class="text-textMuted max-w-lg text-base md:text-lg leading-relaxed opacity-80 font-light">
                    Crafting <span class="text-white border-b border-primary/40">high-performance</span> digital products with a focus on immersive aesthetics and scalable architecture since 2016.
                </p>
                <div class="flex gap-12 pt-4">
                    <div>
                        <p class="text-2xl font-bold text-white">0</p>
                        <p class="text-[10px] uppercase tracking-widest text-textMuted">Years Exp.</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-white">5+</p>
                        <p class="text-[10px] uppercase tracking-widest text-textMuted">Projects</p>
                    </div>
                </div>
            </div>

            <div class="pl-2">
                <button class="w-full md:w-auto px-12 py-5 bg-white text-black text-[11px] font-black uppercase tracking-[0.3em] hover:bg-primary hover:text-white transition-all duration-500 rounded-sm">
                    Get in Touch
                </button>
            </div>
        </div>

        <div class="absolute right-0 top-16 h-full w-full md:w-[45%] pointer-events-none z-20 flex items-end justify-end opacity-30 md:opacity-100">
            <img src="<?php echo e(asset('assets/images/me.png')); ?>" alt="Profile"
                style="mask-image: radial-gradient(circle at 50% 40%, black 30%, transparent 85%); -webkit-mask-image: radial-gradient(circle at 50% 40%, black 30%, transparent 85%);"
                class="relative z-30 w-auto h-full max-h-[85%] md:max-h-[100%] object-contain grayscale brightness-110 contrast-125 md:opacity-85 transition-all duration-700 hover:grayscale-0 hover:opacity-100">
        </div>
    </main>
</header>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/sections/hero.blade.php ENDPATH**/ ?>