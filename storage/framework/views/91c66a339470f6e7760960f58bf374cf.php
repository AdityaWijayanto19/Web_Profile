<section id="certificates" class="pt-20 pb-10 px-6 md:px-8 relative overflow-hidden bg-base">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
            <div class="relative">
                <span class="text-primary font-black uppercase tracking-[0.4em] text-[10px] mb-4 block italic">Verified Credentials</span>
                <h2 class="text-5xl md:text-7xl font-bold tracking-tighter italic leading-none">
                    Official <span class="text-white not-italic border-b-4 border-primary/40">Certifications</span>
                </h2>
            </div>
            <p class="text-textMuted max-w-sm text-sm font-light leading-relaxed border-l-2 border-primary/20 pl-6">
                Professional recognition and specialized training verified by global tech institutions and industry leaders.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php
                $certs = [
                    ['title' => 'Professional UX Design Specialization', 'id' => 'GO-229X', 'org' => 'Google Certified', 'role' => 'UX Architecture', 'date' => 'Dec 2023', 'img' => 'https://images.unsplash.com/photo-1620641788421-7a1c342ea42e?q=80&w=800', 'icon' => 'ri:verified-badge-fill'],
                    ['title' => 'Advanced React Patterns & Performance', 'id' => 'META-882', 'org' => 'Meta Engineer', 'role' => 'React Professional', 'date' => 'Oct 2022', 'img' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=800', 'icon' => 'ri:code-box-fill'],
                    ['title' => 'Three.js Creative Masterclass', 'id' => '3JS-991A', 'org' => 'WebGL Master', 'role' => 'Immersive 3D', 'date' => 'JAN 2024', 'img' => 'https://images.unsplash.com/photo-1620641788421-7a1c342ea42e?q=80&w=800', 'icon' => 'ri:shining-2-fill'],
                ];
            ?>

            <?php $__currentLoopData = $certs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="group h-[250px] [perspective:1000px]">
                <div class="relative h-full w-full rounded-2xl transition-all duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)] shadow-2xl">
                    <div class="absolute inset-0 h-full w-full [backface-visibility:hidden]">
                        <div class="h-full w-full rounded-lg overflow-hidden border border-white/10 relative shadow-2xl">
                            <img src="<?php echo e($cert['img']); ?>" class="h-full w-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-base/90 via-transparent to-transparent opacity-80"></div>
                            <div class="absolute bottom-5 left-5 flex items-center gap-3">
                                <div class="bg-primary p-2 rounded-lg shadow-[0_0_20px_rgba(244,63,94,0.6)]">
                                    <iconify-icon icon="<?php echo e($cert['icon']); ?>" class="text-white text-xl block"></iconify-icon>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-white font-black text-[10px] uppercase tracking-widest"><?php echo e($cert['org']); ?></span>
                                    <span class="text-white/60 text-[8px] uppercase tracking-tighter"><?php echo e($cert['role']); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-0 h-full w-full rounded-2xl bg-[#0d0a0f] border-2 border-primary/40 p-6 [transform:rotateY(180deg)] [backface-visibility:hidden] shadow-[0_0_40px_rgba(244,63,94,0.2)]">
                        <div class="flex flex-col h-full">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-[9px] text-primary font-black uppercase tracking-[0.2em]">Credential ID: <?php echo e($cert['id']); ?></span>
                                    <iconify-icon icon="ri:shield-star-line" class="text-primary/40 text-lg"></iconify-icon>
                                </div>
                                <h4 class="text-xl font-bold text-white leading-tight tracking-tight mb-3"><?php echo e($cert['title']); ?></h4>
                                <div class="h-[2px] w-12 bg-primary mb-4"></div>
                                <p class="text-[11px] text-textMuted leading-relaxed font-light line-clamp-4">Professional recognition verified by global tech institutions and industry leaders.</p>
                            </div>
                            <div class="mt-auto pt-4 border-t border-white/5 flex items-center justify-between">
                                <div class="flex flex-col gap-0.5">
                                    <span class="text-[8px] text-textMuted uppercase font-bold tracking-widest">Issue Date</span>
                                    <span class="text-[10px] text-white font-mono uppercase"><?php echo e($cert['date']); ?></span>
                                </div>
                                <a href="#" class="group/btn flex items-center gap-2 bg-primary/10 hover:bg-primary px-4 py-2 rounded-xl transition-all duration-300">
                                    <span class="text-[9px] font-black uppercase tracking-widest text-white">Verify ID</span>
                                    <i data-lucide="external-link" class="w-3 h-3 text-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/sections/certificates.blade.php ENDPATH**/ ?>