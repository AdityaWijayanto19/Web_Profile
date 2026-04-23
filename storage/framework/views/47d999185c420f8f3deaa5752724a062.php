<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #140f17;
            color: #e5e5e5;
        }

        .sidebar-active {
            background-color: rgba(115, 12, 30, 0.4);
            border-left: 3px solid #730c1e;
            color: white;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
        }

        aside {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: visible !important;
        }

        nav {
            overflow-y: auto;
            overflow-x: hidden !important;
            mask-image: linear-gradient(to right, black 0%, black calc(100% - 50px), transparent 100%);
            -webkit-mask-image: linear-gradient(to right, black 0%, black calc(100% - 50px), transparent 100%);
        }

        .sidebar-text,
        .logo-name {
            transition: opacity 0.2s, transform 0.2s;
            white-space: nowrap;
        }

        .sidebar-tooltip-fixed {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: all 0.2s ease;
        }

        .sidebar-collapsed aside {
            width: 64px;
        }

        .sidebar-collapsed .sidebar-text,
        .sidebar-collapsed .logo-name {
            opacity: 0;
            transform: scale(0.9);
            pointer-events: none;
        }

        [x-cloak] {
            display: none !important;
        }

        @media (max-width: 768px) {
            aside {
                position: fixed;
                left: -250px;
                height: 100vh;
            }

            .sidebar-open aside {
                left: 0;
                width: 224px;
            }

            .sidebar-open .sidebar-overlay {
                display: block;
            }

            .sidebar-tooltip {
                opacity: 0 !important;
                visibility: hidden !important;
            }

            .sidebar-collapsed aside {
                width: 224px;
                left: -250px;
            }
        }
    </style>

    <script>
        (function() {
            const sidebarState = localStorage.getItem('sidebar-collapsed');
            if (sidebarState === 'true' && window.innerWidth >= 768) {
                document.documentElement.classList.add('sidebar-collapsed');
            }
        })();
    </script>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="flex h-screen overflow-hidden text-sm">

    <?php if (isset($component)) { $__componentOriginal0b29f2cc4d94f88a812835e3e715f535 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0b29f2cc4d94f88a812835e3e715f535 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert-pop-up','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert-pop-up'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0b29f2cc4d94f88a812835e3e715f535)): ?>
<?php $attributes = $__attributesOriginal0b29f2cc4d94f88a812835e3e715f535; ?>
<?php unset($__attributesOriginal0b29f2cc4d94f88a812835e3e715f535); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0b29f2cc4d94f88a812835e3e715f535)): ?>
<?php $component = $__componentOriginal0b29f2cc4d94f88a812835e3e715f535; ?>
<?php unset($__componentOriginal0b29f2cc4d94f88a812835e3e715f535); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>

    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black/60 z-[40] hidden md:hidden"></div>

    <?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="flex-1 flex flex-col overflow-hidden w-full">
        <header
            class="px-6 py-3 flex justify-between items-center bg-black/50 backdrop-blur-md border-b border-white/5">
            <div class="flex items-center gap-4">
                <button id="sidebarToggle"
                    class="p-2 rounded-md hover:bg-white/5 text-gray-400 hover:text-white transition-all">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <h1 class="text-lg font-bold text-white uppercase tracking-wider"><?php echo $__env->yieldContent('page_title', 'Dashboard'); ?></h1>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex gap-4 text-gray-400">
                    <div class="flex gap-3 text-gray-400 hover:text-[#730c1e] transition-colors <?php echo e(Request::is('admin/article/create') ? 'text-[#730c1e]' : ''); ?>">
                        <a href="<?php echo e(route('article.create')); ?>"
                            class="w-4 h-4 flex items-center justify-center"
                            title="Write Articles">Write
                        </a>
                        <i data-lucide="square-pen" class="w-4 h-4 cursor-pointer"></i>
                    </div>
                    <a href="<?php echo e(route('visitors')); ?>"
                        class="hover:text-[#730c1e] transition-colors <?php echo e(Request::is('admin/visitors') ? 'text-[#730c1e]' : ''); ?>"
                        title="View Visitors">
                        <i data-lucide="activity" class="w-4 h-4"></i>
                    </a>
                    <a href="<?php echo e(route('technologies.index')); ?>"
                        class="hover:text-[#730c1e] transition-colors <?php echo e(Request::is('admin/technologies*') ? 'text-[#730c1e]' : ''); ?>"
                        title="Manage Technologies">
                        <i data-lucide="layers" class="w-4 h-4"></i>
                    </a>
                </div>

                <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600/20 hover:bg-red-600/30 text-red-400 hover:text-red-300 rounded-md transition-all text-xs font-medium flex items-center gap-2 border border-red-600/30">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </header>

        <div class="flex-1 p-4 overflow-y-auto custom-scrollbar bg-[#140f17]">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if(session('success')): ?>
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: {
                        message: "<?php echo e(addslashes(session('success'))); ?>",
                        type: 'success'
                    }
                }));
            <?php endif; ?>

            <?php if(session('error')): ?>
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: {
                        message: "<?php echo e(addslashes(session('error'))); ?>",
                        type: 'error'
                    }
                }));
            <?php endif; ?>
        });
    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/layouts/admin.blade.php ENDPATH**/ ?>