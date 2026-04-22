

<?php $__env->startSection('content'); ?>
<section class="relative px-6 md:px-8 py-16 md:py-24">
    <div class="max-w-4xl mx-auto text-center mb-12">
        <div class="flex items-center justify-center gap-2 mb-4">
            <span class="w-8 h-[1px] bg-primary"></span>
            <span class="text-primary text-xs font-medium tracking-widest uppercase">My Journey</span>
            <span class="w-8 h-[1px] bg-primary"></span>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
            All <span class="text-primary">Educations</span>
        </h1>
        <p class="text-textMuted mt-4 text-base md:text-lg max-w-2xl mx-auto">
            Explore my complete educational journey and achievements
        </p>
    </div>

    <?php if($educations->count() > 0): ?>
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="glass-card p-8 rounded-xl border-l-4 border-l-primary relative hover:border-l-primary hover:shadow-lg transition-all duration-300">
                        <span class="text-primary font-mono text-sm"><?php echo e($education->periode); ?></span>
                        <h3 class="text-2xl font-bold mt-3 leading-tight text-white"><?php echo e($education->gelar); ?></h3>
                        <p class="text-textMuted mt-2 text-sm font-semibold"><?php echo e($education->instansi); ?></p>
                        <p class="text-textMuted mt-4 text-sm leading-relaxed font-light"><?php echo e($education->keterangan); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php echo e($educations->links('partials.pagination')); ?>

        </div>
    <?php else: ?>
        <div class="max-w-2xl mx-auto">
            <div class="p-12 bg-[#1a151d]/50 border border-white/10 rounded-sm text-center">
                <i data-lucide="book-open" class="w-12 h-12 text-gray-600 mx-auto mb-4"></i>
                <p class="text-sm text-gray-400 mb-2">Belum ada data pendidikan</p>
                <p class="text-xs text-gray-500">Data pendidikan akan ditampilkan di sini</p>
                <a href="<?php echo e(route('landing')); ?>" class="text-primary hover:text-primary/80 text-sm font-medium mt-6 inline-block">
                    Kembali ke halaman utama
                </a>
            </div>
        </div>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/pages/educations.blade.php ENDPATH**/ ?>