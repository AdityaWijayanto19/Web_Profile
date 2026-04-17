<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
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
    @stack('styles')
</head>

<body class="flex h-screen overflow-hidden text-sm">

    <x-alert />

    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black/60 z-[40] hidden md:hidden"></div>

    @include('partials.sidebar')

    <main class="flex-1 flex flex-col overflow-hidden w-full">
        <header
            class="px-6 py-3 flex justify-between items-center bg-black/50 backdrop-blur-md border-b border-white/5">
            <div class="flex items-center gap-4">
                <button id="sidebarToggle"
                    class="p-2 rounded-md hover:bg-white/5 text-gray-400 hover:text-white transition-all">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <h1 class="text-lg font-bold text-white uppercase tracking-wider">@yield('page_title', 'Dashboard')</h1>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex gap-3 text-gray-400">
                    <a href="{{ route('visitors') }}"
                        class="hover:text-[#730c1e] transition-colors {{ Request::is('admin/visitors') ? 'text-[#730c1e]' : '' }}"
                        title="View Visitors">
                        <i data-lucide="activity" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ route('technologies.index') }}"
                        class="hover:text-[#730c1e] transition-colors {{ Request::is('admin/technologies*') ? 'text-[#730c1e]' : '' }}"
                        title="Manage Technologies">
                        <i data-lucide="layers" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Logout Button (Temporary) -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-600/20 hover:bg-red-600/30 text-red-400 hover:text-red-300 rounded-md transition-all text-xs font-medium flex items-center gap-2 border border-red-600/30">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </header>

        <div class="flex-1 p-4 overflow-y-auto custom-scrollbar bg-[#140f17]">
            @yield('content')
        </div>
    </main>

    @vite(['resources/js/app.js'])
    @stack('scripts')
    <script>
        // Tooltip positioning for collapsed sidebar
        document.addEventListener('DOMContentLoaded', function() {
           @if (session('success'))
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: {
                        message: "{{ addslashes(session('success')) }}",
                        type: 'success'
                    }
                }));
            @endif

            @if (session('error'))
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: {
                        message: "{{ addslashes(session('error')) }}",
                        type: 'error'
                    }
                }));
            @endif
        });
    </script>
</body>

</html>
