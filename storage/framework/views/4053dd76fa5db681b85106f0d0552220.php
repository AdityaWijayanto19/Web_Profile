<?php $__env->startSection('title', 'Visitors Analytics - FoxHR'); ?>
<?php $__env->startSection('page_title', 'Visitors Analytics'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .stat-card {
            background: rgba(115, 12, 30, 0.1);
            border: 1px solid rgba(115, 12, 30, 0.3);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            background: rgba(115, 12, 30, 0.2);
            border-color: rgba(115, 12, 30, 0.5);
            transform: translateY(-2px);
        }

        .stat-value {
            color: #730c1e;
            font-weight: 700;
        }

        .ip-address {
            font-family: 'Courier New', monospace;
            font-size: 12px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header Section -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-white">Visitor Statistics</h2>
            <p class="text-gray-400 text-xs mt-1">Real-time tracking of your profile visitors and engagement metrics.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Total Visitors -->
            <div class="stat-card rounded-sm p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-widest font-medium">Total Visitors</p>
                        <p class="stat-value text-2xl mt-2"><?php echo e($totalVisitors); ?></p>
                    </div>
                    <div class="text-[#730c1e] opacity-20">
                        <i data-lucide="users" class="w-8 h-8"></i>
                    </div>
                </div>
            </div>

            <!-- Unique Visitors -->
            <div class="stat-card rounded-sm p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-widest font-medium">Unique Visitors</p>
                        <p class="stat-value text-2xl mt-2"><?php echo e($uniqueVisitors); ?></p>
                    </div>
                    <div class="text-[#730c1e] opacity-20">
                        <i data-lucide="user" class="w-8 h-8"></i>
                    </div>
                </div>
            </div>

            <!-- Page Views -->
            <div class="stat-card rounded-sm p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-widest font-medium">Page Views</p>
                        <p class="stat-value text-2xl mt-2"><?php echo e($pageViews); ?></p>
                    </div>
                    <div class="text-[#730c1e] opacity-20">
                        <i data-lucide="eye" class="w-8 h-8"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visitors Table -->
        <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 bg-black/20">
                        <th class="px-4 py-3 font-medium text-gray-400 w-12 text-center">#</th>
                        <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">IP Address</th>
                        <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Page Path</th>
                        <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">User Agent</th>
                        <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Visited At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $visitors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $visitor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="group border-b border-white/5 transition-colors duration-200 hover:bg-white/[0.02]">
                            <td class="px-4 py-4 text-center text-gray-500"><?php echo e(($visitors->currentPage() - 1) * 5 + $loop->iteration); ?></td>
                            <td class="px-4 py-4">
                                <code class="ip-address text-[#730c1e] bg-black/50 px-2 py-1 rounded"><?php echo e($visitor->ip_address); ?></code>
                            </td>
                            <td class="px-4 py-4">
                                <span class="text-white font-medium text-xs"><?php echo e($visitor->page_path ?? '/'); ?></span>
                            </td>
                            <td class="px-4 py-4">
                                <p class="text-gray-400 text-xs line-clamp-1 max-w-xs"><?php echo e(Str::limit($visitor->user_agent ?? 'Unknown', 50)); ?></p>
                            </td>
                            <td class="px-4 py-4">
                                <span class="text-gray-500 text-xs">
                                    <?php echo e($visitor->visited_at ? $visitor->visited_at->format('M d, Y H:i') : '-'); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">No visitor data available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($visitors->links('partials.pagination')); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        // Initialize Lucide icons
        if (window.lucide) {
            window.lucide.createIcons();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/visitors/index.blade.php ENDPATH**/ ?>