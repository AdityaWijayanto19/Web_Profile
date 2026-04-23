<aside
    class="w-56 bg-[#210207] text-gray-400 flex flex-col z-50 h-screen relative border-r border-white/5 overflow-visible">

    <div class="p-4 flex items-center gap-2 mb-2 shrink-0 overflow-hidden">
        <div class="p-1.5 rounded-sm shrink-0">
            <img class="w-7 h-7" src="<?php echo e(asset('assets/images/cookie.svg')); ?>" alt="Cookie">
        </div>
        <span class="text-white text-xl font-bold tracking-tight logo-name transition-opacity duration-300">Pie.</span>
    </div>

    <nav class="flex-1 px-2 space-y-1 overflow-y-auto overflow-visible custom-scrollbar">
        <?php
            $navItems = [
                [
                    'route' => 'dashboard',
                    'icon' => 'layout-dashboard',
                    'name' => 'Dashboard',
                    'pattern' => 'admin/dashboard',
                    'desc' => 'Main overview',
                ],
                [
                    'route' => 'profile',
                    'icon' => 'user-pen',
                    'name' => 'Profile',
                    'pattern' => 'admin/profile',
                    'desc' => 'Manage account',
                ],
                [
                    'route' => 'pendidikans.index',
                    'icon' => 'album',
                    'name' => 'Edukasi',
                    'pattern' => 'admin/pendidikans*',
                    'desc' => 'Education history',
                ],
                [
                    'route' => 'pengalaman.index',
                    'icon' => 'user-star',
                    'name' => 'Experience',
                    'pattern' => 'admin/pengalaman',
                    'desc' => 'Work experience',
                ],
                [
                    'route' => 'sertifikats.index',
                    'icon' => 'file',
                    'name' => 'Certificates',
                    'pattern' => 'admin/sertifikats*',
                    'desc' => 'Achieved awards',
                ],
                [
                    'route' => 'projects.index',
                    'icon' => 'folder-open-dot',
                    'name' => 'Project',
                    'pattern' => 'admin/projects*',
                    'desc' => 'Portfolio work',
                ],
                [
                    'route' => 'article.index',
                    'icon' => 'newspaper',
                    'name' => 'Article',
                    'pattern' => 'admin/article*',
                    'desc' => 'Written blogs',
                ],
                [
                    'route' => 'admin.footer.index',
                    'icon' => 'footprints',
                    'name' => 'Footer',
                    'pattern' => 'admin/footer*',
                    'desc' => 'Footer settings',
                ],
            ];
        ?>

        <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(isset($item['route']) ? route($item['route']) : $item['url']); ?>"
                class="nav-item group relative flex items-center gap-3 px-3 py-2.5 rounded-sm transition-all hover:bg-white/5 hover:text-white <?php echo e(Request::is($item['pattern']) ? 'sidebar-active' : ''); ?>"
                data-tooltip-name="<?php echo e($item['name']); ?>"
                data-tooltip-desc="<?php echo e($item['desc']); ?>"
                data-tooltip-icon="<?php echo e($item['icon']); ?>">

                <i data-lucide="<?php echo e($item['icon']); ?>" class="w-4 h-4 shrink-0"></i>
                <span class="sidebar-text font-medium"><?php echo e($item['name']); ?></span>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>

    <div class="mt-auto relative w-full shrink-0 overflow-hidden pointer-events-none bg-transparent">
        <div class="w-full leading-[0] bg-transparent translate-y-2">
            <img src="<?php echo e(asset('assets/images/moon.svg')); ?>" class="w-full h-auto object-contain min-w-[224px] block"
                alt="Moon Illustration">
        </div>
    </div>
</aside>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>