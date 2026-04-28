<footer class="bg-[#050307]/90 backdrop-blur-md border-t border-borderMuted py-10 md:py-6 px-6 md:px-8 relative z-20">
    <div class="max-w-7xl mx-auto">
        <?php
            $footerData = $footer ?? null;
        ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10 text-left">
            <div class="space-y-4">
                <div class="flex items-center gap-2 font-bold text-2xl">
                    <?php if($footerData && $footerData->logo_path): ?>
                        <img src="<?php echo e(asset('storage/' . $footerData->logo_path)); ?>" alt="<?php echo e($footerData->nama_web); ?>"
                            class="w-8 h-8 object-cover rounded-xs">
                    <?php endif; ?>
                    <?php echo e($footerData && $footerData->nama_web ? $footerData->nama_web : 'Pie.'); ?>

                </div>
                <p class="text-textMuted text-sm">
                    <?php echo e($footerData && $footerData->deskripsi ? $footerData->deskripsi : 'Independent Senior Developer building high-end digital products.'); ?>

                </p>
            </div>

            <div>
                <h4 class="font-bold mb-4 md:mb-8 uppercase text-xs tracking-widest">Navigation</h4>
                <div class="grid grid-cols-2 gap-4">
                    <ul class="space-y-4 text-textMuted text-sm">
                        <li><a href="<?php echo e(route('landing')); ?>#about" class="hover:text-primary transition-colors">Profile</a></li>
                        <li><a href="<?php echo e(route('landing')); ?>#education" class="hover:text-primary transition-colors">Education</a></li>
                        <li><a href="<?php echo e(route('landing')); ?>#certificates" class="hover:text-primary transition-colors">Certificates</a></li>
                    </ul>
                    <ul class="space-y-4 text-textMuted text-sm">
                        <li><a href="<?php echo e(route('landing')); ?>#experience" class="hover:text-primary transition-colors">Experience</a></li>
                        <li><a href="<?php echo e(route('landing')); ?>#projects" class="hover:text-primary transition-colors">Projects</a></li>
                        <li><a href="<?php echo e(route('landing')); ?>#articles" class="hover:text-primary transition-colors">Articles</a></li>
                    </ul>
                </div>
            </div>

            <div>
                <h4 class="font-bold mb-4 md:mb-8 uppercase text-xs tracking-widest">Media Social</h4>
                <?php if($footerData && $footerData->mediaSozials && $footerData->mediaSozials->count() > 0): ?>
                    <div class="flex items-center gap-3 mt-2">
                        <?php $__currentLoopData = $footerData->mediaSozials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($media->url); ?>" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center text-textMuted hover:text-white transition-all"
                                title="<?php echo e($media->technology->nama ?? 'Social Media'); ?>">
                                <?php if($media->technology?->path_icon): ?>
                                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/<?php echo e($media->technology->path_icon); ?>.svg"
                                        alt="<?php echo e($media->technology->nama); ?>" class="w-6 h-6" style="filter: invert(0.3) brightness(1.1);">
                                <?php else: ?>
                                    <i data-lucide="link" class="w-4 h-4"></i>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <h4 class="font-bold mb-4 md:mb-8 uppercase text-xs tracking-widest">Contact</h4>
                <ul class="space-y-4 text-textMuted text-sm">
                    <?php if($footerData && $footerData->email): ?>
                        <li>
                            <a href="mailto:<?php echo e($footerData->email); ?>"
                                class="flex items-center gap-2 text-primary font-bold hover:text-secondary transition-colors">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                                <?php echo e($footerData->email); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if($footerData && $footerData->no_hp): ?>
                        <li class="flex items-center gap-2">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                            <?php echo e($footerData->no_hp); ?>

                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="text-center pt-8 border-t border-borderMuted/10">
            <p class="text-textMuted text-xs tracking-widest">&copy; <?php echo e(now()->year); ?> <?php echo e($footerData && $footerData->nama_web ? $footerData->nama_web : 'Pie'); ?> All
                rights reserved.</p>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdn.jsdelivr.net/npm/lucide@latest"></script>
        <script>
            lucide.createIcons();
        </script>
    <?php $__env->stopPush(); ?>
</footer>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/partials/footer.blade.php ENDPATH**/ ?>