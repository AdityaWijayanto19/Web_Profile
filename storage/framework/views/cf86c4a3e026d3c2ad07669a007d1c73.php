<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-base pt-20 pb-20">
    <div class="max-w-4xl mx-auto px-6 md:px-8">
        <div class="mb-8">
            <a href="<?php echo e(route('landing')); ?>"
                class="inline-flex items-center gap-2 text-sm text-primary hover:text-white transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Home
            </a>
        </div>

        <div class="space-y-6 mb-12">
            <div class="space-y-4">
                <h1 class="text-5xl md:text-6xl font-bold leading-tight tracking-tighter bg-gradient-to-r from-white via-white to-white/80 bg-clip-text text-transparent">
                    <?php echo e($artikel->judul); ?>

                </h1>

                <div class="flex flex-wrap items-center gap-4 text-sm text-textMuted/80 font-medium">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span><?php echo e($artikel->tanggal_rilis ? $artikel->tanggal_rilis->format('M d, Y') : 'N/A'); ?></span>
                    </div>
                    <div class="w-1 h-1 rounded-full bg-primary"></div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        <span><?php echo e($artikel->menit_baca ?? '5'); ?> min read</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="prose prose-invert max-w-none space-y-6">
            <?php if($artikelContent && isset($artikelContent['blocks']) && count($artikelContent['blocks']) > 0): ?>
                <?php $__currentLoopData = $artikelContent['blocks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo \App\Helpers\EditorJsParser::parse($block); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p class="text-white/60 text-center py-12">Konten artikel tidak tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        if (window.lucide) {
            window.lucide.createIcons();
        }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/article/show.blade.php ENDPATH**/ ?>