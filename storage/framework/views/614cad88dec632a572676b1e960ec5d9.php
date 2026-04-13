<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'FoxHR Dashboard'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
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

        /* Sidebar Transition Logic */
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

        /* Tooltip positioning: JavaScript-controlled */
        .sidebar-tooltip-fixed {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: all 0.2s ease;
        }

        /* UBAH DISINI: Hilangkan kata 'body' agar selector bisa kena dari tag <html> */
        .sidebar-collapsed aside {
            width: 64px;
        }

        .sidebar-collapsed .sidebar-text,
        .sidebar-collapsed .logo-name {
            opacity: 0;
            transform: scale(0.9);
            pointer-events: none;
        }

        /* Mobile Logic */
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

            /* Tooltip disabled on mobile */
            .sidebar-tooltip {
                opacity: 0 !important;
                visibility: hidden !important;
            }

            /* Jika di mobile, collapsed mode tidak boleh jalan */
            .sidebar-collapsed aside {
                width: 224px;
                left: -250px;
            }
        }
    </style>

    <!-- ANTI-FLICKER: Cek state paling awal -->
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
                <div class="flex gap-3 text-gray-400">
                    <button class="hover:text-[#730c1e] transition-colors"><i data-lucide="search"
                            class="w-4 h-4"></i></button>
                    <button class="hover:text-[#730c1e] transition-colors"><i data-lucide="settings"
                            class="w-4 h-4"></i></button>
                    <a href="<?php echo e(route('technologies.index')); ?>" class="hover:text-[#730c1e] transition-colors" title="Manage Technologies">
                        <i data-lucide="layers" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Logout Button (Temporary) -->
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="px-4 py-2 bg-red-600/20 hover:bg-red-600/30 text-red-400 hover:text-red-300 rounded-md transition-all text-xs font-medium flex items-center gap-2 border border-red-600/30">
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
        // Tooltip positioning for collapsed sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.nav-item');
            let tooltipEl = null;

            function createTooltip() {
                if (!tooltipEl) {
                    tooltipEl = document.createElement('div');
                    tooltipEl.className = 'sidebar-tooltip-fixed';
                    document.body.appendChild(tooltipEl);
                }
                return tooltipEl;
            }

            navItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    if (!document.documentElement.classList.contains('sidebar-collapsed')) {
                        return;
                    }

                    const tooltip = createTooltip();
                    const rect = this.getBoundingClientRect();
                    const icon = this.getAttribute('data-tooltip-icon');
                    const name = this.getAttribute('data-tooltip-name');
                    const desc = this.getAttribute('data-tooltip-desc');

                    tooltip.innerHTML = `
                        <div class="relative flex items-center h-8 bg-[#1a151c]/95 backdrop-blur-md border border-white/10 px-3 rounded-md shadow-[0_10px_40px_rgba(0,0,0,0.6)] whitespace-nowrap ml-2 transition-all duration-300">

                            <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-2 h-2 bg-[#1a151c] border-l border-b border-white/10 rotate-45"></div>

                            <span class="text-white font-semibold italic text-[10px] tracking-[0.15em] leading-none">
                                ${name}
                            </span>

                            <div class="absolute inset-x-0 top-0 h-[1px] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
                        </div>
                    `;

                    tooltip.style.position = 'fixed';
                    tooltip.style.left = (rect.right + 8) + 'px';
                    tooltip.style.top = (rect.top + rect.height / 2 - 20) + 'px';
                    tooltip.style.zIndex = '9999';
                    tooltip.style.opacity = '1';
                    tooltip.style.visibility = 'visible';
                    tooltip.style.pointerEvents = 'auto';
                    tooltip.style.transition = 'all 0.2s ease';

                    // Re-render lucide icons
                    if (window.lucide) {
                        window.lucide.createIcons();
                    }
                });

                item.addEventListener('mouseleave', function() {
                    if (tooltipEl) {
                        tooltipEl.style.opacity = '0';
                        tooltipEl.style.visibility = 'hidden';
                        tooltipEl.style.pointerEvents = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/layouts/app.blade.php ENDPATH**/ ?>