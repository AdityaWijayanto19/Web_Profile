<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoxHR Dashboard - Compact Version</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- HANYA BAGIAN STYLE YANG DIUBAH / DITAMBAH -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #140f17;
            color: #e5e5e5;
        }

        .sidebar-active {
            background-color: rgba(115, 12, 30, 0.2);
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

        tr:hover td {
            background-color: rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden text-sm">

    <!-- SIDEBAR - More Compact -->
    <aside class="w-56 bg-[#210207] text-gray-400 flex flex-col z-50 h-screen">
        <!-- LOGO -->
        <div class="p-4 flex items-center gap-2">
            <div class="p-1.5 rounded-sm">
                <img class="w-7 h-7" src="{{ asset('assets/images/cookie.svg') }}" alt="Cookie">
            </div>
            <span class="text-white text-xl font-bold tracking-tight">Pie.</span>
        </div>

        <!-- MENU -->
        <nav class="flex-1 mt-2 px-2 space-y-1">
            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-sm sidebar-active transition-all">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
            </a>
            <a href="#"
                class="flex items-center gap-3 px-3 py-2 rounded-sm hover:bg-white/5 hover:text-white transition-all">
                <i data-lucide="user-pen" class="w-4 h-4"></i>Profile
            </a>
            <a href="#"
                class="flex items-center gap-3 px-3 py-2 rounded-sm hover:bg-white/5 hover:text-white transition-all">
                <i data-lucide="user-star" class="w-4 h-4"></i>Experience
            </a>
            <a href="#"
                class="flex items-center gap-3 px-3 py-2 rounded-sm hover:bg-white/5 hover:text-white transition-all">
                <i data-lucide="folder-open-dot" class="w-4 h-4"></i>Project
            </a>
            <a href="#"
                class="flex items-center gap-3 px-3 py-2 rounded-sm hover:bg-white/5 hover:text-white transition-all">
                <i data-lucide="file" class="w-4 h-4"></i>Certificates
            </a>
            <a href="#"
                class="flex items-center gap-3 px-3 py-2 rounded-sm hover:bg-white/5 hover:text-white transition-all">
                <i data-lucide="newspaper" class="w-4 h-4"></i>Article
            </a>
        </nav>

        <!-- FOOTER SIDEBAR (Premium CTA & Illustration) -->
        <div class="mt-auto top-2 relative w-full">
            <!-- SVG CELEBRATING (Lepas tanpa background kotak) -->
            <div class="w-full leading-[0]">
                <img src="{{ asset('assets/images/moon.svg') }}" class="w-full h-auto object-contain"
                    alt="Celebrating Illustration">
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col overflow-hidden">

        <!-- HEADER - Tighter -->
        <header class="px-6 py-3 flex justify-between items-center bg-black/50 backdrop-blur-md ">
            <h1 class="text-lg font-bold text-white">Dashboard</h1>
            <div class="flex items-center gap-4">
                <div class="flex gap-3 text-gray-400">
                    <button class="hover:text-[#730c1e] transition-colors"><i data-lucide="search"
                            class="w-4 h-4"></i></button>
                    <button class="hover:text-[#730c1e] transition-colors"><i data-lucide="settings"
                            class="w-4 h-4"></i></button>
                </div>
            </div>
        </header>

        <div class="flex-1 p-4 overflow-y-auto custom-scrollbar">
            <div class="grid grid-cols-12 gap-4">

                <!-- LEFT COLUMN -->
                <div class="col-span-12 lg:col-span-8 space-y-4">

                    <!-- BANNER WITH YOUR SVG -->
                    <div
                        class="bg-gradient-to-r from-black via-[#1a0f14] to-[#140f17] rounded-md p-6 relative flex items-center overflow-hidden min-h-[160px] shadow-sm">
                        <div class="z-10 w-2/3">
                            <h2 class="text-white text-2xl font-bold mb-1">Hello Yunnappie!</h2>
                            <p class="text-gray-300 text-xs leading-relaxed">Consistency is the key to <span
                                    class="font-bold border-b border-gray-500">mastery</span>. Keep updating, keep
                                growing, and keep inspiring.
                            </p>
                            <button
                                class="mt-4 text-[10px] font-bold text-white border border-white/30 px-3 py-1.5 rounded-sm hover:bg-[#730c1e] hover:border-[#730c1e] hover:text-white transition-all uppercase tracking-tighter">
                                Manage Now
                            </button>
                        </div>

                        <!-- PENGGUNAAN SVG ANDA DI SINI -->
                        <div class="absolute -right-28 opacity-60 bottom-0 w-52 pointer-events-none">
                            <img src="{{ asset('assets/images/Illustration-1.svg') }}"
                                class="object-contain w-full h-full" alt="Programmer Illustration">
                        </div>
                    </div>

                    <!-- STATS OVERVIEW - Compact & Sharp -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <!-- Total Projects -->
                        <div
                            class="bg-[#1a0f14] p-4 rounded-md shadow-sm border border-white/5 hover:border-[#730c1e]/50 transition-all group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="p-2 bg-[#730c1e]/10 rounded text-[#730c1e] group-hover:bg-[#730c1e] group-hover:text-white transition-all">
                                    <i data-lucide="folder-kanban" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p
                                        class="text-[9px] font-black text-gray-500 uppercase tracking-widest leading-none mb-1">
                                        Projects</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-xl font-bold text-white tracking-tighter">24</span>
                                        <span class="text-[9px] text-gray-600 font-medium">Items</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Articles -->
                        <div
                            class="bg-[#1a0f14] p-4 rounded-md shadow-sm border border-white/5 hover:border-[#730c1e]/50 transition-all group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="p-2 bg-[#730c1e]/10 rounded text-[#730c1e] group-hover:bg-[#730c1e] group-hover:text-white transition-all">
                                    <i data-lucide="book-open" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p
                                        class="text-[9px] font-black text-gray-500 uppercase tracking-widest leading-none mb-1">
                                        Articles</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-xl font-bold text-white tracking-tighter">12</span>
                                        <span class="text-[9px] text-gray-600 font-medium">Posts</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Certifications -->
                        <div
                            class="bg-[#1a0f14] p-4 rounded-md shadow-sm border border-white/5 hover:border-[#730c1e]/50 transition-all group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="p-2 bg-[#730c1e]/10 rounded text-[#730c1e] group-hover:bg-[#730c1e] group-hover:text-white transition-all">
                                    <i data-lucide="award" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p
                                        class="text-[9px] font-black text-gray-500 uppercase tracking-widest leading-none mb-1">
                                        Certifications</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-xl font-bold text-white tracking-tighter">08</span>
                                        <span class="text-[9px] text-gray-600 font-medium">Verified</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Experience -->
                        <div
                            class="bg-[#1a0f14] p-4 rounded-md shadow-sm border border-white/5 hover:border-[#730c1e]/50 transition-all group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="p-2 bg-[#730c1e]/10 rounded text-[#730c1e] group-hover:bg-[#730c1e] group-hover:text-white transition-all">
                                    <i data-lucide="briefcase" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <p
                                        class="text-[9px] font-black text-gray-500 uppercase tracking-widest leading-none mb-1">
                                        Experience</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-xl font-bold text-white tracking-tighter">03</span>
                                        <span
                                            class="text-[9px] text-gray-600 font-bold uppercase tracking-tighter">Active</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ENGAGEMENT STATS (Visitor Insights) - Compact with Mini Charts -->
                    <div class="mt-6">
                        <div class="flex items-center justify-between mb-3 px-1">
                            <h3 class="text-[11px] font-black text-gray-500 uppercase tracking-[0.2em]">Engagement Stat
                                <span class="text-[#730c1e]/50 ml-1">(Visitor Insights)</span>
                            </h3>
                            <span class="text-[10px] text-gray-600 font-medium">Last 30 Days</span>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <!-- Total Visitors -->
                            <div
                                class="bg-[#1a0f14] p-4 rounded-md border border-white/5 flex flex-col justify-between h-32 relative overflow-hidden group">
                                <div class="z-10">
                                    <div class="flex justify-between items-start">
                                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider">Total
                                            Visitors</p>
                                        <span class="text-[9px] text-green-500 font-bold">+12%</span>
                                    </div>
                                    <h4 class="text-2xl font-bold text-white mt-1">1,284</h4>
                                </div>
                                <!-- Mini Chart (SVG) -->
                                <div
                                    class="absolute bottom-0 left-0 w-full h-12 opacity-40 group-hover:opacity-80 transition-opacity">
                                    <svg viewBox="0 0 100 30" class="w-full h-full">
                                        <path d="M0,25 Q15,25 25,15 T45,20 T65,10 T85,15 T100,5" fill="none"
                                            stroke="#730c1e" stroke-width="2" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Project Clicks -->
                            <div
                                class="bg-[#1a0f14] p-4 rounded-md border border-white/5 flex flex-col justify-between h-32 relative overflow-hidden group">
                                <div class="z-10">
                                    <div class="flex justify-between items-start">
                                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider">Project
                                            Clicks</p>
                                        <span class="text-[9px] text-[#730c1e] font-bold">+5%</span>
                                    </div>
                                    <h4 class="text-2xl font-bold text-white mt-1">432</h4>
                                </div>
                                <!-- Mini Chart (SVG) -->
                                <div
                                    class="absolute bottom-0 left-0 w-full h-12 opacity-40 group-hover:opacity-80 transition-opacity">
                                    <svg viewBox="0 0 100 30" class="w-full h-full">
                                        <path
                                            d="M0,20 L10,15 L20,22 L30,10 L40,18 L50,5 L60,15 L70,10 L80,20 L90,5 L100,12"
                                            fill="none" stroke="#730c1e" stroke-width="2" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Article Views -->
                            <div
                                class="bg-[#1a0f14] p-4 rounded-md border border-white/5 flex flex-col justify-between h-32 relative overflow-hidden group">
                                <div class="z-10">
                                    <div class="flex justify-between items-start">
                                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider">Article
                                            Views</p>
                                        <span class="text-[9px] text-green-500 font-bold">+18%</span>
                                    </div>
                                    <h4 class="text-2xl font-bold text-white mt-1">892</h4>
                                </div>
                                <!-- Mini Chart (SVG) -->
                                <div
                                    class="absolute bottom-0 left-0 w-full h-12 opacity-40 group-hover:opacity-80 transition-opacity">
                                    <svg viewBox="0 0 100 30" class="w-full h-full">
                                        <path d="M0,28 L20,25 L40,15 L60,18 L80,5 L100,8" fill="none"
                                            stroke="#730c1e" stroke-width="2" />
                                    </svg>
                                </div>
                            </div>

                            <!-- CV Downloads -->
                            <div
                                class="bg-[#1a0f14] p-4 rounded-md border border-white/5 flex flex-col justify-between h-32 relative overflow-hidden group">
                                <div class="z-10">
                                    <div class="flex justify-between items-start">
                                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider">CV
                                            Downloads</p>
                                        <span class="text-[9px] text-blue-400 font-bold">STABLE</span>
                                    </div>
                                    <h4 class="text-2xl font-bold text-white mt-1">56</h4>
                                </div>
                                <!-- Mini Chart (SVG) -->
                                <div
                                    class="absolute bottom-0 left-0 w-full h-12 opacity-40 group-hover:opacity-80 transition-opacity">
                                    <svg viewBox="0 0 100 30" class="w-full h-full">
                                        <path d="M0,15 L20,15 L40,12 L60,15 L80,14 L100,15" fill="none"
                                            stroke="#730c1e" stroke-width="2" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN -->
                <div class="col-span-12 lg:col-span-4 space-y-4">

                    <!-- CALENDAR - FULLY FUNCTIONAL & DARK THEME -->
                    <div class="bg-[#1a0f14] rounded-lg p-4 shadow-xl text-white">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-sm tracking-tight">Calendar</h3>
                            <div class="flex items-center gap-3">
                                <span id="calendar-month-year"
                                    class="text-[10px] font-black uppercase text-[#730c1e] tracking-widest"></span>
                                <div class="flex gap-1">
                                    <button onclick="changeMonth(-1)"
                                        class="p-1 hover:bg-white/10 rounded transition-colors">
                                        <i data-lucide="chevron-left" class="w-3 h-3"></i>
                                    </button>
                                    <button onclick="changeMonth(1)"
                                        class="p-1 hover:bg-white/10 rounded transition-colors">
                                        <i data-lucide="chevron-right" class="w-3 h-3"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-7 gap-1 text-center text-[10px] font-bold text-gray-500 mb-2">
                            <div>MO</div>
                            <div>TU</div>
                            <div>WE</div>
                            <div>TH</div>
                            <div>FR</div>
                            <div>SA</div>
                            <div>SU</div>
                        </div>

                        <!-- Container untuk tanggal yang di-generate JS -->
                        <div id="calendar-days" class="grid grid-cols-7 gap-1 text-center text-[11px]">
                            <!-- JS akan mengisi ini -->
                        </div>
                    </div>

                    <!-- PROFILE & CLOCK CARD - MIDNIGHT THEME -->
                    <div class="bg-[#1a0f14] rounded-lg shadow-xl overflow-hidden text-white">
                        <!-- Profile Section -->
                        <div class="p-4 border-b ">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <i data-lucide="user" class="w-11 h-11 rounded-lg object-cover shadow-lg"
                                            alt="user"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-white text-sm leading-tight">Yunnappie</h4>
                                        <p
                                            class="text-[9px] text-[#730c1e] font-black uppercase mt-0.5 tracking-widest">Undergraduate Student</p>
                                    </div>
                                </div>
                                <button class="text-gray-600 hover:text-[#730c1e] transition-colors">
                                    <i data-lucide="more-horizontal" class="w-4 h-4"></i>
                                </button>
                            </div>

                            <!-- Action Buttons - Dark Mode Style -->
                            <div class="grid grid-cols-3 gap-2">
                                <button
                                    class="flex justify-center py-2 rounded-md bg-white/5 hover:bg-[#730c1e]/20 hover:text-[#730c1e] transition-all text-gray-400">
                                    <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                                </button>
                                <button
                                    class="flex justify-center py-2 rounded-md bg-white/5 hover:bg-[#730c1e]/20 hover:text-[#730c1e transition-all text-gray-400">
                                    <i data-lucide="mail" class="w-3.5 h-3.5"></i>
                                </button>
                                <button
                                    class="flex justify-center py-2 rounded-md bg-white/5 hover:bg-[#730c1e]/20 hover:text-[#730c1e transition-all text-gray-400">
                                    <i data-lucide="message-square" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Clock Section -->
                        <div class="p-4 bg-white/[0.02]">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Digital
                                    Clock</span>
                                <span class="text-[9px] font-bold text-[#730c1e]">REALTIME</span>
                            </div>

                            <div class="flex items-baseline gap-1">
                                <h2 id="clock-main" class="text-4xl font-light tracking-tighter text-gray-200">00:00
                                </h2>
                                <span id="clock-seconds"
                                    class="text-xl font-medium text-[#730c1e] tabular-nums">00</span>
                            </div>

                            <!-- Project Progress - Premium Look -->
                            <div class="mt-4 pt-3 border-t ">
                                <div class="flex justify-between items-center text-[10px] mb-1.5">
                                    <span class="text-gray-400">Active Projects</span>
                                    <span class="text-[#730c1e] font-black tracking-tighter">34 ACTIVE</span>
                                </div>
                                <div class="w-full h-1 bg-white/8 rounded-full overflow-hidden">
                                    <div
                                        class="w-[75%] h-full bg-gradient-to-r from-[#730c1e] to-[#480415] rounded-full">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script>
        // --- STATE MANAGEMENT ---
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();

        // --- FUNGSI KALENDER ---
        function renderCalendar() {
            const monthYearLabel = document.getElementById('calendar-month-year');
            const daysContainer = document.getElementById('calendar-days');

            if (!monthYearLabel || !daysContainer) return;

            const months = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const today = new Date();

            monthYearLabel.innerHTML = `${months[currentMonth]} ${currentYear}`;
            daysContainer.innerHTML = '';

            // Hitung slot kosong (Menyesuaikan Senin sebagai hari pertama)
            // Minggu (0) jadi index 6, Senin (1) jadi index 0
            let emptySlots = firstDay === 0 ? 6 : firstDay - 1;

            for (let i = 0; i < emptySlots; i++) {
                daysContainer.innerHTML += `<div class="py-1.5 text-transparent">0</div>`;
            }

            // Render Tanggal
            for (let day = 1; day <= daysInMonth; day++) {
                const isToday =
                    day === today.getDate() &&
                    currentMonth === today.getMonth() &&
                    currentYear === today.getFullYear();

                const dayClass = isToday ?
                    'bg-[#730c1e] text-white font-black shadow-lg shadow-[#730c1e]/20' :
                    'text-gray-300 hover:bg-white/10 hover:text-white';

                daysContainer.innerHTML += `
                <div class="py-1.5 rounded transition-all cursor-pointer ${dayClass}">
                    ${day}
                </div>`;
            }
        }

        // Fungsi ganti bulan (dipanggil dari tombol onclick di HTML)
        function changeMonth(step) {
            currentMonth += step;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            } else if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        }

        // --- FUNGSI JAM REALTIME ---
        function updateClock() {
            const clockMain = document.getElementById('clock-main');
            const clockSeconds = document.getElementById('clock-seconds');

            if (!clockMain || !clockSeconds) return;

            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            clockMain.textContent = `${hours}:${minutes}`;
            clockSeconds.textContent = seconds;
        }

        // --- INISIALISASI UTAMA ---
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Jalankan Kalender
            renderCalendar();

            // 2. Jalankan Jam & Interval
            updateClock();
            setInterval(updateClock, 1000);

            // 3. Inisialisasi Ikon Lucide
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            // 4. Navigasi Sidebar Interaktif
            const navLinks = document.querySelectorAll('nav a');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Hapus state aktif dari semua link
                    navLinks.forEach(l => {
                        l.classList.remove('sidebar-active');
                        l.classList.add('text-gray-400'); // Kembalikan ke warna default
                    });

                    // Tambahkan state aktif ke yang diklik
                    this.classList.add('sidebar-active');
                    this.classList.remove('text-gray-400');
                });
            });
        });
    </script>
</body>

</html>
