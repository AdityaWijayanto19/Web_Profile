<?php $__env->startSection('title', 'Footer Management'); ?>
<?php $__env->startSection('page_title', 'Footer Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-lg font-semibold text-white">Footer Settings</h2>
                <p class="text-gray-400 text-xs mt-1">Manage website footer information and social media links.</p>
            </div>
            <a href="<?php echo e(route('admin.footer.create')); ?>"
                class="bg-[#730c1e] hover:bg-[#921126] text-white px-3 py-1.5 rounded-sm flex items-center gap-1 text-xs font-bold uppercase tracking-widest transition-colors">
                <i data-lucide="plus" class="w-3 h-3"></i>
                Add
            </a>
        </div>

        <?php if($footers->isEmpty()): ?>
            <div class="bg-[#1a151d] border border-white/5 rounded-sm p-8 text-center">
                <p class="text-gray-400 text-sm">No footer data yet. <a href="<?php echo e(route('admin.footer.create')); ?>"
                        class="text-[#730c1e] hover:text-[#921126] font-semibold">Create one</a></p>
            </div>
        <?php else: ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $footers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $footer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-[#1a151d] border border-white/5 rounded-sm p-3 hover:bg-white/[0.01] transition-colors group">
                        <div class="flex items-start justify-between gap-3">
                            <!-- Logo & Info -->
                            <div class="flex items-start gap-3 flex-1 min-w-0">
                                <?php if($footer->logo_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $footer->logo_path)); ?>" alt="<?php echo e($footer->nama_web); ?>"
                                        class="w-10 h-10 rounded-sm object-cover flex-shrink-0">
                                <?php else: ?>
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-[#730c1e] to-[#4a0715] rounded-sm flex items-center justify-center flex-shrink-0">
                                        <span class="text-xs font-bold text-white"><?php echo e(substr($footer->nama_web, 0, 1)); ?></span>
                                    </div>
                                <?php endif; ?>

                                <div class="flex-1 min-w-0">
                                    <div class="font-medium text-white text-sm truncate"><?php echo e($footer->nama_web); ?></div>
                                    <p class="text-gray-400 text-xs line-clamp-1"><?php echo e($footer->deskripsi); ?></p>
                                    <div class="flex items-center gap-2 mt-1 text-xs text-gray-500">
                                        <?php if($footer->email): ?>
                                            <span class="inline-flex items-center gap-1 truncate">
                                                <i data-lucide="mail" class="w-3 h-3"></i>
                                                <?php echo e($footer->email); ?>

                                            </span>
                                        <?php endif; ?>
                                        <?php if($footer->no_hp): ?>
                                            <span class="inline-flex items-center gap-1">
                                                <i data-lucide="phone" class="w-3 h-3"></i>
                                                <?php echo e($footer->no_hp); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if($footer->mediaSozials->count() > 0): ?>
                                        <div class="flex items-center gap-1.5 mt-1.5">
                                            <?php $__currentLoopData = $footer->mediaSozials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e($media->url); ?>" target="_blank" rel="noopener noreferrer"
                                                    class="inline-flex items-center justify-center w-5 h-5 bg-white/5 hover:bg-white/10 rounded-xs text-gray-400 hover:text-white transition-all text-xs"
                                                    title="<?php echo e($media->technology->nama ?? 'Social Media'); ?>">
                                                    <?php if($media->technology?->icon): ?>
                                                        <i data-lucide="<?php echo e($media->technology->icon); ?>" class="w-3 h-3"></i>
                                                    <?php else: ?>
                                                        <i data-lucide="link" class="w-3 h-3"></i>
                                                    <?php endif; ?>
                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-1.5 flex-shrink-0">
                                <a href="<?php echo e(route('admin.footer.edit', $footer->id)); ?>"
                                    class="p-1 hover:bg-blue-600/20 text-gray-400 hover:text-blue-400 rounded-xs transition-colors text-xs"
                                    title="Edit">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </a>
                                <form action="<?php echo e(route('admin.footer.destroy', $footer->id)); ?>" method="POST"
                                    class="inline" onsubmit="return confirm('Delete this footer?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                        class="p-1 hover:bg-red-600/20 text-gray-400 hover:text-red-400 rounded-xs transition-colors text-xs"
                                        title="Delete">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <div class="mt-4 p-3 bg-[#1a151d] border border-white/5 rounded-sm text-xs text-gray-400">
            <p><span class="font-semibold">Total Footers:</span> <?php echo e($footers->count()); ?></p>
            <p><span class="font-semibold">Total Social Media:</span> <?php echo e($totalMedia); ?></p>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdn.jsdelivr.net/npm/lucide@latest"></script>
        <script>
            lucide.createIcons();
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/footer/index.blade.php ENDPATH**/ ?>