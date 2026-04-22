<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            <?php if($paginator->onFirstPage()): ?>
                <span class="px-4 py-2 text-[10px] font-bold text-gray-600 bg-white/5 border border-white/5 rounded-sm uppercase tracking-widest cursor-default">Previous</span>
            <?php else: ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="px-4 py-2 text-[10px] font-bold text-white bg-white/5 border border-white/10 rounded-sm uppercase tracking-widest hover:bg-[#730c1e] transition-all">Previous</a>
            <?php endif; ?>

            <?php if($paginator->hasMorePages()): ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="px-4 py-2 text-[10px] font-bold text-white bg-white/5 border border-white/10 rounded-sm uppercase tracking-widest hover:bg-[#730c1e] transition-all">Next</a>
            <?php else: ?>
                <span class="px-4 py-2 text-[10px] font-bold text-gray-600 bg-white/5 border border-white/5 rounded-sm uppercase tracking-widest cursor-default">Next</span>
            <?php endif; ?>
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-[11px] text-gray-500 tracking-tighter">
                    Showing <span class="font-bold text-white"><?php echo e($paginator->firstItem()); ?></span> - <span class="font-bold text-white"><?php echo e($paginator->lastItem()); ?></span> of <span class="font-bold text-white"><?php echo e($paginator->total()); ?></span>
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-sm">
                    <?php if($paginator->onFirstPage()): ?>
                        <span class="relative inline-flex items-center px-3 py-2 border border-white/10 bg-white/5 text-gray-600 rounded-l-sm cursor-default">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </span>
                    <?php else: ?>
                        <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="relative inline-flex items-center px-3 py-2 border border-white/10 bg-[#1a151c] text-gray-400 hover:text-white hover:bg-[#730c1e] rounded-l-sm transition-all">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </a>
                    <?php endif; ?>

                    <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(is_string($element)): ?>
                            <span class="relative inline-flex items-center px-4 py-2 border border-white/10 bg-white/5 text-gray-600 cursor-default text-[11px] font-bold"><?php echo e($element); ?></span>
                        <?php endif; ?>

                        <?php if(is_array($element)): ?>
                            <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($page == $paginator->currentPage()): ?>
                                    <span class="relative inline-flex items-center px-4 py-2 border border-[#730c1e] bg-[#730c1e] text-white text-[11px] font-bold z-10"><?php echo e($page); ?></span>
                                <?php else: ?>
                                    <a href="<?php echo e($url); ?>" class="relative inline-flex items-center px-4 py-2 border border-white/10 bg-[#1a151c] text-gray-400 hover:text-white hover:bg-white/5 transition-all text-[11px] font-bold">
                                        <?php echo e($page); ?>

                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($paginator->hasMorePages()): ?>
                        <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="relative inline-flex items-center px-3 py-2 border border-white/10 bg-[#1a151c] text-gray-400 hover:text-white hover:bg-[#730c1e] rounded-r-sm transition-all">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    <?php else: ?>
                        <span class="relative inline-flex items-center px-3 py-2 border border-white/10 bg-white/5 text-gray-600 rounded-r-sm cursor-default">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </span>
                    <?php endif; ?>
                </span>
            </div>
        </div>
    </nav>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/partials/pagination.blade.php ENDPATH**/ ?>