<?php $__env->startSection('title', 'Technologies Management - Pie'); ?>
<?php $__env->startSection('page_title', 'Technologies Library'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4">
        <!-- HEADER -->
        <div class="flex justify-between items-end mb-8 border-b border-white/5 pb-6">
            <div>
                <h2 class="text-xl font-bold text-white tracking-tight">Technology Stack</h2>
                <p class="text-gray-500 text-[11px] mt-1 uppercase tracking-tighter">Manage available technologies</p>
            </div>
            <a href="<?php echo e(route('technologies.create')); ?>"
                class="btn-primary text-white px-4 py-2 bg-[#730c1e] rounded-sm flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                Add New
            </a>
        </div>

        <!-- SEARCH & FILTER -->
        <div class="mb-6 flex gap-4">
            <div class="flex-1 relative">
                <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-600"></i>
                <input type="text" id="search-tech" placeholder="Search technologies..."
                    class="w-full bg-[#1a151d] border border-white/5 rounded-sm pl-10 pr-4 py-2.5 text-white text-sm focus:border-[#730c1e] outline-none transition-all">
            </div>
        </div>

        <!-- TABLE -->
        <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden shadow-2xl">
            <!-- TABLE HEADER -->
            <div class="grid grid-cols-12 gap-4 p-4 bg-black/20 border-b border-white/5">
                <div class="col-span-1 text-[10px] font-bold text-gray-500 uppercase tracking-widest">#</div>
                <div class="col-span-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Technology</div>
                <div class="col-span-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Icon</div>
                <div class="col-span-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Actions</div>
            </div>

            <!-- TABLE BODY -->
            <div class="divide-y divide-white/5">
                <?php $__empty_1 = true; $__currentLoopData = $technologies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="grid grid-cols-12 gap-4 p-4 hover:bg-black/20 transition-colors">
                        <!-- Index -->
                        <div class="col-span-1">
                            <span class="text-sm text-gray-400"><?php echo e($loop->iteration); ?></span>
                        </div>

                        <!-- Name + Icon Preview -->
                        <div class="col-span-4 flex items-center gap-3">
                            <div class="w-8 h-8 bg-[#730c1e]/20 rounded-sm flex items-center justify-center flex-shrink-0">
                                <img src="https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/<?php echo e($tech->path_icon); ?>.svg"
                                    alt="<?php echo e($tech->path_icon); ?>" class="w-4 h-4" style="filter: invert(1);">
                            </div>
                            <span class="text-sm text-white font-medium"><?php echo e($tech->nama); ?></span>
                        </div>

                        <!-- Icon Name -->
                        <div class="col-span-3 flex items-center">
                            <span
                                class="text-xs text-gray-500 bg-black/40 px-2.5 py-1.5 rounded-sm"><?php echo e($tech->path_icon); ?></span>
                        </div>

                        <!-- Actions -->
                        <div class="col-span-4 flex items-center gap-2">
                            <a href="<?php echo e(route('technologies.edit', $tech)); ?>"
                                class="text-[10px] font-bold text-gray-500 hover:text-[#730c1e] transition-colors px-3 py-1.5 rounded-sm hover:bg-black/40 inline-flex items-center gap-1 uppercase tracking-widest">
                                <i data-lucide="edit-2" class="w-3 h-3"></i>
                                Edit
                            </a>
                            <form action="<?php echo e(route('technologies.destroy', $tech)); ?>" method="POST" class="inline"
                                onsubmit="return confirm('Delete <?php echo e($tech->nama); ?>?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                    class="text-[10px] font-bold text-gray-500 hover:text-red-500 transition-colors px-3 py-1.5 rounded-sm hover:bg-red-500/10 inline-flex items-center gap-1 uppercase tracking-widest">
                                    <i data-lucide="trash-2" class="w-3 h-3"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="p-8 text-center">
                        <i data-lucide="inbox" class="w-12 h-12 text-gray-600 mx-auto mb-3 opacity-50"></i>
                        <p class="text-sm text-gray-500">No technologies found</p>
                        <a href="<?php echo e(route('technologies.create')); ?>"
                            class="text-[#730c1e] hover:underline text-sm font-medium mt-2 inline-block">
                            Create one now
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-16 py-8 border-t border-white/5">
            <?php echo e($technologies->links('partials.pagination')); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        lucide.createIcons();

        // Simple search filter
        document.getElementById('search-tech').addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.grid.grid-cols-12 > .col-span-1').forEach(row => {
                const parent = row.closest('.divide-y');
                if (!parent) return;

                const text = parent.textContent.toLowerCase();
                parent.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/technology/index.blade.php ENDPATH**/ ?>