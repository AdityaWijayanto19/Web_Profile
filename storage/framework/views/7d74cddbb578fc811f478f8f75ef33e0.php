<section id="articles" class="py-12 md:py-16 px-6 md:px-8 relative overflow-hidden">
    <div class="webgl-globe-outer">
        <div class="webgl-globe-container">
            <canvas id="cobe-canvas"></canvas>
        </div>
    </div>

    <div class="max-w-6xl mx-auto relative z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
            <div class="relative">
                <span class="text-primary font-black uppercase tracking-[0.4em] text-[10px] mb-4 block italic">Verified Credentials</span>
                <h2 class="text-5xl md:text-7xl font-bold tracking-tighter italic leading-none">
                    Official <span class="text-white not-italic border-b-4 border-primary/40">Certifications</span>
                </h2>
            </div>
            <p class="text-textMuted max-w-sm text-sm font-light leading-relaxed border-l-2 border-primary/20 pl-6">Professional recognition verified by industry leaders.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:items-start">
            <div class="lg:col-span-7">
                <div class="group cursor-pointer flex flex-col gap-6">
                    <div class="relative aspect-[16/9] rounded-2xl overflow-hidden border border-borderMuted shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=2000" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute top-4 left-4">
                            <span class="bg-primary px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest text-white">Featured</span>
                        </div>
                    </div>
                    <div class="space-y-4 px-1">
                        <div class="flex items-center gap-3 text-xs text-textMuted/80 font-medium">
                            <span>March 24, 2024</span>
                            <span class="w-1 h-1 rounded-full bg-primary"></span>
                            <span>12 min read</span>
                        </div>
                        <h3 class="text-3xl md:text-4xl font-extrabold leading-tight tracking-tighter bg-gradient-to-r from-primary via-[#ef4444] to-[#7f1d1d] bg-clip-text text-transparent group-hover:from-white group-hover:to-primary transition-all duration-500">
                            The Shift to Multi-dimensional UI in 2025
                        </h3>
                        <p class="text-white/80 leading-relaxed text-base md:text-lg font-normal max-w-2xl">Exploring how spatial computing and AI are converging to create the next generation of web interfaces.</p>
                        <button class="text-primary font-black text-sm flex items-center gap-2 group-hover:gap-5 transition-all pt-2 uppercase tracking-[0.2em]">
                            Read Full Article <div class="w-8 h-[1px] bg-primary group-hover:w-12 transition-all"></div> <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col gap-3 lg:max-h-[560px] overflow-y-auto custom-scrollbar pr-2">
                <?php
                    $articles = [
                        ['title' => 'Scaling React for Enterprise', 'tag' => 'Architecture', 'img' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?q=80&w=400'],
                        ['title' => 'The Future of CSS Grid 2025', 'tag' => 'Design', 'img' => 'https://images.unsplash.com/photo-1614850523296-d8c1af93d400?q=80&w=400'],
                        ['title' => 'Zero Trust Frontend Security', 'tag' => 'Security', 'img' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=400'],
                        ['title' => 'Next.js Server Actions Dive', 'tag' => 'Backend', 'img' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=400'],
                    ];
                ?>
                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group cursor-pointer flex gap-4 items-center p-2 rounded-xl hover:bg-white/[0.03] transition-all duration-300">
                    <div class="flex-shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-xl overflow-hidden border border-borderMuted bg-surface">
                        <img src="<?php echo e($art['img']); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-500">
                    </div>
                    <div class="flex-1 min-w-0">
                        <span class="text-[9px] text-primary font-bold uppercase tracking-[0.2em] mb-1 block"><?php echo e($art['tag']); ?></span>
                        <h4 class="text-white text-base md:text-lg font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2 underline-offset-4 group-hover:underline"><?php echo e($art['title']); ?></h4>
                        <p class="text-textMuted text-xs mt-1 line-clamp-1 font-light opacity-90">Advanced guides and best practices.</p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/sections/articles.blade.php ENDPATH**/ ?>