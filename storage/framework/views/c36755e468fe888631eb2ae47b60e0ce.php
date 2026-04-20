<section id="projects" class="px-6 md:px-8 mt-12 md:mt-16">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
            <div class="relative">
                <span class="text-primary font-black uppercase tracking-[0.4em] text-[10px] mb-4 block italic">Verified Credentials</span>
                <h2 class="text-5xl md:text-7xl font-bold tracking-tighter italic leading-none">
                    Official <span class="text-white not-italic border-b-4 border-primary/40">Certifications</span>
                </h2>
            </div>
            <p class="text-textMuted max-w-sm text-sm font-light leading-relaxed border-l-2 border-primary/20 pl-6">
                Professional recognition verified by global tech institutions.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Project Cards -->
            <?php $__currentLoopData = ['Nexus AI Dashboard', 'Crypto Pulse App', 'E-Glow Commerce']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="group">
                <div class="project-img-container aspect-video mb-6 relative overflow-hidden rounded-xl">
                    <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <a href="#" class="bg-white text-black p-3 rounded-full"><i data-lucide="external-link"></i></a>
                    </div>
                </div>
                <h3 class="text-xl font-bold mb-2"><?php echo e($title); ?></h3>
                <p class="text-textMuted text-sm mb-4">A complete suite for modern digital products.</p>
                <div class="flex gap-3 text-textMuted text-xl">
                    <iconify-icon icon="simple-icons:nextdotjs"></iconify-icon>
                    <iconify-icon icon="simple-icons:react"></iconify-icon>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/sections/projects.blade.php ENDPATH**/ ?>