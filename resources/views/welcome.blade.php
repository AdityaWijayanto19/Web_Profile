<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        base: '#08050a',
                        primary: '#880808',
                        borderMuted: 'rgba(255, 255, 255, 0.06)',
                        surface: 'rgba(255, 255, 255, 0.02)',
                        surfaceHover: 'rgba(255, 255, 255, 0.04)',
                        textMuted: '#8a8a93'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            background-color: #08050a;
            color: #ffffff;
            -webkit-font-smoothing: antialiased;
        }

        .hero-pattern-bg {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='48' height='48' viewBox='0 0 48 48' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Crect x='0' y='0' width='20' height='20' rx='4'/%3E%3Crect x='24' y='24' width='20' height='20' rx='4'/%3E%3C/g%3E%3Cg stroke='%23ffffff' stroke-opacity='0.03' stroke-width='1'%3E%3Crect x='24' y='0' width='20' height='20' rx='4'/%3E%3Crect x='0' y='24' width='20' height='20' rx='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            background-size: 48px 48px;
            mask-image: radial-gradient(ellipse 100% 100% at 50% 0%, black 30%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse 100% 100% at 50% 0%, black 30%, transparent 80%);
            z-index: 0;
        }

        .hero-spotlight {
            position: absolute;
            top: -150px;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 600px;
            background: radial-gradient(circle, rgba(244, 63, 94, 0.15) 0%, rgba(8, 5, 10, 0) 70%);
            mix-blend-mode: screen;
            z-index: 0;
            pointer-events: none;
        }

        #navbar {
            transition: transform 0.45s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s;
        }

        .nav-hide {
            transform: translateY(-120%);
            opacity: 0;
        }

        /* GLOBE POSITIONED AS BACKGROUND */
        .webgl-globe-outer {
            position: absolute;
            bottom: -200px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            height: 800px;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
            opacity: 0.6;
            mask-image: radial-gradient(circle at center, black 30%, transparent 70%);
            -webkit-mask-image: radial-gradient(circle at center, black 30%, transparent 70%);
        }

        .webgl-globe-container {
            width: 1000px;
            height: 1000px;
            margin: 0 auto;
            background: radial-gradient(circle at center, rgba(244, 63, 94, 0.15) 0%, transparent 65%);
        }

        canvas {
            width: 100%;
            height: 100%;
            outline: none;
        }

        .edu-svg-container {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.01);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #880808;
            border-radius: 10px;
        }
    </style>
</head>

<body class="relative overflow-x-hidden">

    <header class="relative w-full min-h-screen flex flex-col overflow-hidden">
        <div class="hero-pattern-bg"></div>
        <div class="hero-spotlight"></div>

        <nav id="navbar"
            class="fixed top-0 left-1/2 -translate-x-1/2 w-[calc(100%-2rem)] flex items-center justify-between px-6 md:px-12 py-4 border-b border-borderMuted/50 bg-[#08050a]/40 backdrop-blur-xl rounded-2xl z-[100]">
            <div class="flex items-center gap-12">
                <a href="#" class="flex items-center gap-2 font-bold text-lg">Pie.</a>
            </div>
            <div class="hidden md:flex gap-7 text-[13px] font-medium text-textMuted">
                <a href="#about" class="text-white">Profile</a>
                <a href="#education" class="hover:text-white transition-colors">Education</a>
                <a href="#projects" class="hover:text-white transition-colors">Projects</a>
                <a href="#articles" class="hover:text-white transition-colors">Articles</a>
            </div>
        </nav>

        <main
            class="relative flex-1 flex flex-col md:flex-row items-center z-10 w-full max-w-7xl mx-auto px-6 md:px-16 py-12">

            <!-- Background Echo Text (REVERSED TO ORIGINAL SCALE & POSITION) -->
            <span
                class="absolute top-[55%] left-1/2 -translate-x-1/2 -translate-y-1/2 text-[20vw] md:text-[22vw] font-black text-white/[0.02] select-none uppercase tracking-tighter z-0 pointer-events-none whitespace-nowrap">
                CREATIVE
            </span>

            <!-- 2. LEFT SIDE: PERSONAL IDENTITY -->
            <div class="w-full md:w-3/5 space-y-12 z-10 text-left pt-20 md:pt-0">
                <div class="space-y-6 pt-14">
                    <h1 class="text-6xl md:text-[100px] font-bold tracking-tighter leading-[0.85] flex flex-col italic">
                        <span class="text-white not-italic">ADITYA P.</span>
                        <span class="text-primary drop-shadow-[0_0_40px_rgba(244,63,94,0.25)]">WIJAYANTO</span>
                    </h1>
                    <div class="flex items-center gap-6 pl-2">
                        <div class="h-[1px] w-12 bg-primary"></div>
                        <p
                            class="text-[10px] md:text-[13px] uppercase tracking-[0.4em] md:tracking-[0.6em] text-textMuted font-bold">
                            Undergraduate University of Brawijaya
                        </p>
                    </div>
                </div>

                <div class="space-y-8 pl-2">
                    <p class="text-textMuted max-w-lg text-base md:text-lg leading-relaxed opacity-80 font-light">
                        Crafting <span class="text-white border-b border-primary/40">high-performance</span> digital
                        products with a focus on immersive aesthetics and scalable architecture since 2016.
                    </p>
                    <div class="flex gap-12 pt-4">
                        <div>
                            <p class="text-2xl font-bold text-white">0</p>
                            <p class="text-[10px] uppercase tracking-widest text-textMuted">Years Exp.</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white">5+</p>
                            <p class="text-[10px] uppercase tracking-widest text-textMuted">Projects</p>
                        </div>
                    </div>
                </div>

                <div class="pl-2">
                    <button
                        class="w-full md:w-auto px-12 py-5 bg-white text-black text-[11px] font-black uppercase tracking-[0.3em] hover:bg-primary hover:text-white transition-all duration-500 rounded-sm">
                        Get in Touch
                    </button>
                </div>
            </div>

            <!-- 3. RIGHT SIDE: THE PORTRAIT (REVERSED TO ORIGINAL POSITION & OPACITY) -->
            <div
                class="absolute right-0 top-16 h-full w-full md:w-[45%] pointer-events-none z-20 flex items-end justify-end opacity-30 md:opacity-100">
                <img src="assets/images/me.png" alt="Profile"
                    style="mask-image: radial-gradient(circle at 50% 40%, black 30%, transparent 85%); -webkit-mask-image: radial-gradient(circle at 50% 40%, black 30%, transparent 85%);"
                    class="relative z-30 w-auto h-full max-h-[85%] md:max-h-[100%] object-contain grayscale brightness-110 contrast-125 md:opacity-85 transition-all duration-700 hover:grayscale-0 hover:opacity-100">
            </div>

        </main>
    </header>

    {{-- EDUCATION SECTION --}}
    <section id="education" class="relative px-6 md:px-8 mt-4 md:mt-4 pb-8 md:pb-12">
        <div class="max-w-4xl mx-auto text-center mb-2">
            <div class="flex items-center justify-center gap-2 mb-2">
                <span class="w-8 h-[1px] bg-primary"></span>
                <span class="text-primary text-xs font-medium tracking-widest uppercase">My Journey</span>
                <span class="w-8 h-[1px] bg-primary"></span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
                Process <span class="text-primary">section.</span>
            </h2>
        </div>

        <!-- Container Utama -->
        <div class="max-w-5xl mx-auto relative flex flex-col md:block gap-10 mt-16 md:mt-2 md:h-[480px]">

            <!-- SVG Connectors -->
            <svg class="edu-svg-container hidden md:block" viewBox="0 0 800 480" fill="none"
                xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M400 0V480" stroke="#880808" stroke-width="2" stroke-dasharray="10 10" />
                <path d="M400 150C400 150 400 200 300 200H290" stroke="#880808" stroke-width="2" stroke-opacity="0.5" />
                <path d="M400 350C400 350 400 420 500 420H650" stroke="#880808" stroke-width="2" stroke-opacity="0.5" />

                <defs>
                    <linearGradient id="paint0_linear" x1="400" y1="0" x2="400" y2="480"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="#f43f5e" stop-opacity="0" />
                        <stop offset="0.2" stop-color="#f43f5e" />
                        <stop offset="0.8" stop-color="#f43f5e" />
                        <stop offset="1" stop-color="#f43f5e" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>

            <!-- Card 1 -->
            <div class="relative md:absolute md:left-0 md:top-[100px] w-full md:w-[40%] z-10">
                <div class="glass-card p-8 rounded-3xl border-l-4 border-l-primary relative">
                    <div
                        class="absolute -right-[15px] top-[87px] w-8 h-8 bg-base border-2 border-primary rounded-full hidden md:flex items-center justify-center">
                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                    </div>

                    <span class="text-primary font-mono text-sm">2016 - 2020</span>
                    <h3 class="text-2xl font-bold mt-2 leading-tight">Bachelor of Software Engineering</h3>
                    <p class="text-textMuted mt-4 text-sm leading-relaxed font-light">
                        Graduated with Honors. Focused on Distributed Systems and Graphics Programming.
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="relative md:absolute md:right-0 md:top-[320px] w-full md:w-[40%] z-10">
                <div class="glass-card p-8 rounded-3xl border-r-4 border-r-primary md:text-right relative">
                    <div
                        class="absolute -left-[15px] top-[87px] w-8 h-8 bg-base border-2 border-primary rounded-full hidden md:flex items-center justify-center">
                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                    </div>

                    <span class="text-primary font-mono text-sm">2021 - 2022</span>
                    <h3 class="text-2xl font-bold mt-2 leading-tight">Master of AI & Interaction</h3>
                    <p class="text-textMuted mt-4 text-sm leading-relaxed font-light">
                        Specialized in Generative UI and Machine Learning integration for modern web apps.
                    </p>
                </div>
            </div>

        </div>
    </section>

    {{-- CERTIFICATES SECTION --}}
    <section id="certificates" class="pt-20 pb-10 px-6 md:px-8 relative overflow-hidden bg-base">
        <div class="max-w-7xl mx-auto">

            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
                <div class="relative">
                    <span
                        class="text-primary font-black uppercase tracking-[0.4em] text-[10px] mb-4 block italic">Verified
                        Credentials</span>
                    <h2 class="text-5xl md:text-7xl font-bold tracking-tighter italic leading-none">
                        Official <span class="text-white not-italic border-b-4 border-primary/40">Certifications</span>
                    </h2>
                </div>
                <p
                    class="text-textMuted max-w-sm text-sm font-light leading-relaxed border-l-2 border-primary/20 pl-6">
                    Professional recognition and specialized training verified by global tech institutions and industry
                    leaders.
                </p>
            </div>

            <!-- Flip Cards Grid (Landscape 16:10 Aspect) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

                <!-- Certificate Card 1 -->
                <div class="group h-[250px] [perspective:1000px]">
                    <div
                        class="relative h-full w-full rounded-2xl transition-all duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)] shadow-2xl">

                        <!-- FRONT SIDE (Full Color Landscape Image) -->
                        <div class="absolute inset-0 h-full w-full [backface-visibility:hidden]">
                            <div
                                class="h-full w-full rounded-2xl overflow-hidden border border-white/10 relative shadow-2xl">
                                <!-- Image: Full Color, Sharp, No Grayscale -->
                                <img src="https://images.unsplash.com/photo-1620641788421-7a1c342ea42e?q=80&w=800"
                                    class="h-full w-full object-cover">
                                <!-- Bottom Aesthetic Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-base/90 via-transparent to-transparent opacity-80">
                                </div>
                                <div class="absolute bottom-5 left-5 flex items-center gap-3">
                                    <div class="bg-primary p-2 rounded-lg shadow-[0_0_20px_rgba(244,63,94,0.6)]">
                                        <iconify-icon icon="ri:verified-badge-fill"
                                            class="text-white text-xl block"></iconify-icon>
                                    </div>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-white font-black text-[10px] uppercase tracking-widest">Google
                                            Certified</span>
                                        <span class="text-white/60 text-[8px] uppercase tracking-tighter">UX
                                            Architecture</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BACK SIDE (Compact Information Detail) -->
                        <div
                            class="absolute inset-0 h-full w-full rounded-2xl bg-[#0d0a0f] border-2 border-primary/40 p-6 [transform:rotateY(180deg)] [backface-visibility:hidden] shadow-[0_0_40px_rgba(244,63,94,0.2)]">
                            <div class="flex flex-col h-full">
                                <!-- Card Content -->
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-3">
                                        <span
                                            class="text-[9px] text-primary font-black uppercase tracking-[0.2em]">Credential
                                            ID: GO-229X</span>
                                        <iconify-icon icon="ri:shield-star-line"
                                            class="text-primary/40 text-lg"></iconify-icon>
                                    </div>

                                    <h4 class="text-xl font-bold text-white leading-tight tracking-tight mb-3">
                                        Professional UX Design Specialization
                                    </h4>

                                    <div class="h-[2px] w-12 bg-primary mb-4"></div>

                                    <p class="text-[11px] text-textMuted leading-relaxed font-light line-clamp-4">
                                        Comprehensive mastery in user-centric design architectures, high-fidelity
                                        prototyping, and systemic design thinking for enterprise-level digital products.
                                    </p>
                                </div>

                                <!-- Card Footer -->
                                <div class="mt-auto pt-4 border-t border-white/5 flex items-center justify-between">
                                    <div class="flex flex-col gap-0.5">
                                        <span
                                            class="text-[8px] text-textMuted uppercase font-bold tracking-widest">Issue
                                            Date</span>
                                        <span class="text-[10px] text-white font-mono uppercase">Dec 2023</span>
                                    </div>
                                    <a href="#"
                                        class="group/btn flex items-center gap-2 bg-primary/10 hover:bg-primary px-4 py-2 rounded-xl transition-all duration-300">
                                        <span class="text-[9px] font-black uppercase tracking-widest text-white">Verify
                                            ID</span>
                                        <i data-lucide="external-link"
                                            class="w-3 h-3 text-white transition-transform group-hover/btn:-translate-y-0.5 group-hover/btn:translate-x-0.5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Certificate Card 2 (Copy for another certificate) -->
                <div class="group h-[250px] [perspective:1000px]">
                    <div
                        class="relative h-full w-full rounded-2xl transition-all duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)] shadow-2xl">
                        <div class="absolute inset-0 h-full w-full [backface-visibility:hidden]">
                            <div
                                class="h-full w-full rounded-2xl overflow-hidden border border-white/10 relative shadow-2xl">
                                <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=800"
                                    class="h-full w-full object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-base/90 via-transparent to-transparent opacity-80">
                                </div>
                                <div class="absolute bottom-5 left-5 flex items-center gap-3">
                                    <div class="bg-primary p-2 rounded-lg shadow-[0_0_20px_rgba(244,63,94,0.6)]">
                                        <iconify-icon icon="ri:code-box-fill"
                                            class="text-white text-xl block"></iconify-icon>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-white font-black text-[10px] uppercase tracking-widest">Meta
                                            Engineer</span>
                                        <span class="text-white/60 text-[8px] uppercase tracking-tighter">React
                                            Professional</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="absolute inset-0 h-full w-full rounded-2xl bg-[#0d0a0f] border-2 border-primary/40 p-6 [transform:rotateY(180deg)] [backface-visibility:hidden] shadow-[0_0_40px_rgba(244,63,94,0.2)]">
                            <div class="flex flex-col h-full">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-3">
                                        <span
                                            class="text-[9px] text-primary font-black uppercase tracking-[0.2em]">Credential
                                            ID: META-882</span>
                                        <iconify-icon icon="ri:reactjs-line"
                                            class="text-primary/40 text-lg"></iconify-icon>
                                    </div>
                                    <h4 class="text-xl font-bold text-white leading-tight tracking-tight mb-3">Advanced
                                        React Patterns & Performance</h4>
                                    <div class="h-[2px] w-12 bg-primary mb-4"></div>
                                    <p class="text-[11px] text-textMuted leading-relaxed font-light line-clamp-4">
                                        Official professional certification for building high-performance, scalable web
                                        architectures using Meta's frontend standards.</p>
                                </div>
                                <div class="mt-auto pt-4 border-t border-white/5 flex items-center justify-between">
                                    <div class="flex flex-col gap-0.5">
                                        <span
                                            class="text-[8px] text-textMuted uppercase font-bold tracking-widest">Issue
                                            Date</span>
                                        <span class="text-[10px] text-white font-mono uppercase">Oct 2022</span>
                                    </div>
                                    <a href="#"
                                        class="group/btn flex items-center gap-2 bg-primary/10 hover:bg-primary px-4 py-2 rounded-xl transition-all duration-300">
                                        <span class="text-[9px] font-black uppercase tracking-widest text-white">Verify
                                            ID</span>
                                        <i data-lucide="external-link"
                                            class="w-3 h-3 text-white transition-transform group-hover/btn:-translate-y-0.5 group-hover/btn:translate-x-0.5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Certificate Card 3 -->
                <div class="group h-[250px] [perspective:1000px]">
                    <div
                        class="relative h-full w-full rounded-2xl transition-all duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)] shadow-2xl">
                        <div class="absolute inset-0 h-full w-full [backface-visibility:hidden]">
                            <div
                                class="h-full w-full rounded-2xl overflow-hidden border border-white/10 relative shadow-2xl">
                                <img src="https://images.unsplash.com/photo-1620641788421-7a1c342ea42e?q=80&w=800"
                                    class="h-full w-full object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-base/90 via-transparent to-transparent opacity-80">
                                </div>
                                <div class="absolute bottom-5 left-5 flex items-center gap-3">
                                    <div class="bg-primary p-2 rounded-lg shadow-[0_0_20px_rgba(244,63,94,0.6)]">
                                        <iconify-icon icon="ri:shining-2-fill"
                                            class="text-white text-xl block"></iconify-icon>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-white font-black text-[10px] uppercase tracking-widest">WebGL
                                            Master</span>
                                        <span class="text-white/60 text-[8px] uppercase tracking-tighter">Immersive
                                            3D</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="absolute inset-0 h-full w-full rounded-2xl bg-[#0d0a0f] border-2 border-primary/40 p-6 [transform:rotateY(180deg)] [backface-visibility:hidden] shadow-[0_0_40px_rgba(244,63,94,0.2)]">
                            <div class="flex flex-col h-full">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-3">
                                        <span
                                            class="text-[9px] text-primary font-black uppercase tracking-[0.2em]">Credential
                                            ID: 3JS-991A</span>
                                        <iconify-icon icon="ri:box-3-line"
                                            class="text-primary/40 text-lg"></iconify-icon>
                                    </div>
                                    <h4 class="text-xl font-bold text-white leading-tight tracking-tight mb-3">Three.js
                                        Creative Masterclass</h4>
                                    <div class="h-[2px] w-12 bg-primary mb-4"></div>
                                    <p class="text-[11px] text-textMuted leading-relaxed font-light line-clamp-4">
                                        Advanced mastery in WebGL, shaders, and creating immersive 3D web environments
                                        using Three.js and GLSL.</p>
                                </div>
                                <div class="mt-auto pt-4 border-t border-white/5 flex items-center justify-between">
                                    <div class="flex flex-col gap-0.5">
                                        <span
                                            class="text-[8px] text-textMuted uppercase font-bold tracking-widest">Issue
                                            Date</span>
                                        <span class="text-[10px] text-white font-mono uppercase">JAN 2024</span>
                                    </div>
                                    <a href="#"
                                        class="group/btn flex items-center gap-2 bg-primary/10 hover:bg-primary px-4 py-2 rounded-xl transition-all duration-300">
                                        <span class="text-[9px] font-black uppercase tracking-widest text-white">Verify
                                            ID</span>
                                        <i data-lucide="external-link"
                                            class="w-3 h-3 text-white transition-transform group-hover/btn:-translate-y-0.5 group-hover/btn:translate-x-0.5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- EXPERIENCE / PROCESS SECTION --}}
    <section id="experience" class="relative pt-10 pb-0 px-6 overflow-hidden font-sans">

        <!-- Header: Simple & Centered -->
        <div class="max-w-4xl mx-auto text-center mb-2">
            <div class="flex items-center justify-center gap-2 mb-2">
                <span class="w-8 h-[1px] bg-primary"></span>
                <span class="text-primary text-xs font-medium tracking-widest uppercase">My Journey</span>
                <span class="w-8 h-[1px] bg-primary"></span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
                Process <span class="text-primary">section.</span>
            </h2>
        </div>

        <!-- Journey Map Container -->
        <div class="max-w-6xl mx-auto relative">

            <!-- Desktop Wave Line (SVG Path Akurat) -->
            <div class="absolute inset-0 hidden md:block pointer-events-none translate-y-12">
                <svg width="100%" height="100%" viewBox="0 0 1000 400" fill="none"
                    preserveAspectRatio="none">
                    <path
                        d="M 50 250 C 150 250, 250 300, 350 200 C 450 100, 550 100, 650 200 C 750 300, 850 250, 950 250"
                        stroke="url(#gradient-line)" stroke-width="3" stroke-linecap="round" />
                    <defs>
                        <linearGradient id="gradient-line" x1="0%" y1="0%" x2="100%"
                            y2="0%">
                            <stop offset="0%" stop-color="#ef4444" stop-opacity="0.2" />
                            <stop offset="50%" stop-color="#880808" />
                            <stop offset="100%" stop-color="#ef4444" stop-opacity="0.2" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>

            <!-- Timeline Steps -->
            <div class="relative grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-4 min-h-[450px]">

                <!-- Step 1: Frontend Intern (Low - Left) -->
                <div class="relative flex flex-col items-center md:items-start md:mt-16 group">
                    <!-- Background Number -->

                    <div
                        class="relative z-10 top-0 md:top-24 flex flex-col items-center md:items-start text-center md:text-left">
                        <!-- Text Above for Point 1 -->

                        <!-- Parent: Tambahkan items-center atau items-start, dan gap -->
                        <div
                            class="flex flex-col md:flex-row items-center md:items-start gap-4 md:gap-2 relative mb-10">

                            <!-- Angka 1: Hapus absolute, biarkan mengalir di dalam flex -->
                            <span class="text-8xl font-bold text-slate-200/50 select-none leading-none">
                                1
                            </span>

                            <!-- Kontainer Teks -->
                            <div class="text-center md:text-left">
                                <h4 class="text-xl font-bold text-primary mb-2">Frontend Intern</h4>
                                <p class="text-sm text-gray-500 leading-relaxed max-w-[200px]">
                                    Tech Studio Inc • 2021. Focus on mastering modern UI architecture.
                                </p>
                            </div>
                        </div>

                        <!-- Hexagon Icon (The Pivot Point) -->
                        <div
                            class="hidden md:flex w-12 h-12 relative flex items-center justify-center drop-shadow-xl md:ml-10">
                            <div
                                class="absolute inset-0 bg-white shadow-lg rotate-[30deg] rounded-lg border border-slate-100">
                            </div>
                            <iconify-icon icon="ri:flag-fill"
                                class="text-primary text-xl relative z-10"></iconify-icon>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Junior Developer (Peak - Center) -->
                <div class="relative flex flex-col items-center md:mt-0 group">

                    <div class="relative z-10 top-0 md:top-40 flex flex-col items-center text-center">
                        <!-- Hexagon Icon (The Pivot Point - High) -->
                        <div
                            class="hidden md:flex w-12 h-12 relative flex items-center justify-center drop-shadow-xl mb-10">
                            <div
                                class="absolute inset-0 bg-white shadow-lg rotate-[30deg] rounded-lg border border-slate-100">
                            </div>
                            <iconify-icon icon="ri:bar-chart-fill"
                                class="text-primary text-xl relative z-10"></iconify-icon>
                        </div>

                        <div class="flex flex-col md:flex-row items-center gap-4 md:gap-2 relative mb-10">
                            <span class="text-8xl font-bold text-slate-200/50 select-none leading-none">2</span>

                            <!-- Text Below for Point 2 -->
                            <div class="text-center md:text-left">
                                <h4 class="text-xl font-bold text-primary mb-2">Junior Developer</h4>
                                <p class="text-sm text-gray-500 leading-relaxed max-w-[240px]">Cyber Nexus • 2022.
                                    Developing scalable React applications and state management.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Frontend Intern (Low - Left) -->
                <div class="relative flex flex-col items-center md:items-start md:mt-16 group">
                    <!-- Background Number -->

                    <div
                        class="relative z-10 top-0 md:top-24 flex flex-col items-center md:items-end text-center md:text-right">
                        <!-- Text Above for Point 1 -->

                        <!-- Parent: Tambahkan items-center atau items-start, dan gap -->
                        <div class="flex flex-col-reverse md:flex-row items-center gap-4 md:gap-2 relative mb-10">
                            <!-- Kontainer Teks -->
                            <div class="text-center md:text-left">
                                <h4 class="text-xl font-bold text-primary mb-2">UI Engineer</h4>
                                <p class="text-sm text-gray-500 leading-relaxed max-w-[240px]">Freelance • 2023 - Now.
                                    Crafting immersive 3D experiences with Three.js.</p>
                            </div>

                            <span class="text-8xl font-bold text-slate-200/50 select-none leading-none">
                                3
                            </span>
                        </div>

                        <!-- Hexagon Icon (The Pivot Point) -->
                        <div
                            class="hidden md:flex w-12 h-12 relative flex items-center justify-center drop-shadow-xl md:ml-10">
                            <div
                                class="absolute inset-0 bg-white shadow-lg rotate-[30deg] rounded-lg border border-slate-100">
                            </div>
                            <iconify-icon icon="ri:flag-fill"
                                class="text-primary text-xl relative z-10"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROJECTS SECTION -->
    <section id="projects" class="px-6 md:px-8 mt-12 md:mt-16">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
                <div class="relative">
                    <span
                        class="text-primary font-black uppercase tracking-[0.4em] text-[10px] mb-4 block italic">Verified
                        Credentials</span>
                    <h2 class="text-5xl md:text-7xl font-bold tracking-tighter italic leading-none">
                        Official <span class="text-white not-italic border-b-4 border-primary/40">Certifications</span>
                    </h2>
                </div>
                <p
                    class="text-textMuted max-w-sm text-sm font-light leading-relaxed border-l-2 border-primary/20 pl-6">
                    Professional recognition and specialized training verified by global tech institutions and industry
                    leaders.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Project Cards Tetap Sama -->
                <div class="group">
                    <div class="project-img-container aspect-video mb-6 relative overflow-hidden rounded-xl">
                        <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=800"
                            alt="Project" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <a href="#" class="bg-white text-black p-3 rounded-full"><i
                                    data-lucide="external-link"></i></a>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Nexus AI Dashboard</h3>
                    <p class="text-textMuted text-sm mb-4">A complete analytics suite for AI-driven businesses.</p>
                    <div class="flex gap-3 text-textMuted text-xl">
                        <iconify-icon icon="simple-icons:nextdotjs"></iconify-icon>
                        <iconify-icon icon="simple-icons:react"></iconify-icon>
                    </div>
                </div>

                <div class="group">
                    <div class="project-img-container aspect-video mb-6 relative overflow-hidden rounded-xl">
                        <img src="https://images.unsplash.com/photo-1614850523296-d8c1af93d400?auto=format&fit=crop&q=80&w=800"
                            alt="Project" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <a href="#" class="bg-white text-black p-3 rounded-full"><i
                                    data-lucide="external-link"></i></a>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Crypto Pulse App</h3>
                    <p class="text-textMuted text-sm mb-4">Real-time cryptocurrency tracking and news...</p>
                    <div class="flex gap-3 text-textMuted text-xl">
                        <iconify-icon icon="simple-icons:html5"></iconify-icon>
                        <iconify-icon icon="simple-icons:css3"></iconify-icon>
                    </div>
                </div>

                <div class="group">
                    <div class="project-img-container aspect-video mb-6 relative overflow-hidden rounded-xl">
                        <img src="https://images.unsplash.com/photo-1633356122544-f134324a6cee?auto=format&fit=crop&q=80&w=800"
                            alt="Project" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <a href="#" class="bg-white text-black p-3 rounded-full"><i
                                    data-lucide="external-link"></i></a>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">E-Glow Commerce</h3>
                    <p class="text-textMuted text-sm mb-4">Luxury brand e-commerce with immersive animations.</p>
                    <div class="flex gap-3 text-textMuted text-xl">
                        <iconify-icon icon="simple-icons:laravel"></iconify-icon>
                        <iconify-icon icon="simple-icons:tailwindcss"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ARTICLES SECTION (COMPACT & SCROLLABLE ASIDE) -->
    <section id="articles" class="py-12 md:py-16 px-6 md:px-8 relative overflow-hidden">
        <div class="webgl-globe-outer">
            <div class="webgl-globe-container">
                <canvas id="cobe-canvas"></canvas>
            </div>
        </div>

        <div class="max-w-6xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
                <div class="relative">
                    <span
                        class="text-primary font-black uppercase tracking-[0.4em] text-[10px] mb-4 block italic">Verified
                        Credentials</span>
                    <h2 class="text-5xl md:text-7xl font-bold tracking-tighter italic leading-none">
                        Official <span class="text-white not-italic border-b-4 border-primary/40">Certifications</span>
                    </h2>
                </div>
                <p
                    class="text-textMuted max-w-sm text-sm font-light leading-relaxed border-l-2 border-primary/20 pl-6">
                    Professional recognition and specialized training verified by global tech institutions and industry
                    leaders.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:items-start">

                <!-- 1. Main Featured Article (Kiri) - UPDATED GRADIENT & CONTRAST -->
                <div class="lg:col-span-7">
                    <div class="group cursor-pointer flex flex-col gap-6">
                        <div
                            class="relative aspect-[16/9] rounded-2xl overflow-hidden border border-borderMuted shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=2000"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-primary px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest text-white shadow-[0_0_15px_rgba(244,63,94,0.4)]">Featured</span>
                            </div>
                        </div>

                        <div class="space-y-4 px-1">
                            <!-- Meta Info -->
                            <div class="flex items-center gap-3 text-xs text-textMuted/80 font-medium">
                                <span>March 24, 2024</span>
                                <span class="w-1 h-1 rounded-full bg-primary"></span>
                                <span>12 min read</span>
                            </div>

                            <!-- Heading with Red Gradient (Terang ke Gelap) -->
                            <h3
                                class="text-3xl md:text-4xl font-extrabold leading-tight tracking-tighter bg-gradient-to-r from-primary via-[#ef4444] to-[#7f1d1d] bg-clip-text text-transparent group-hover:from-white group-hover:to-primary transition-all duration-500">
                                The Shift to Multi-dimensional UI in 2025
                            </h3>

                            <!-- Paragraph with Better Visibility -->
                            <!-- Gue ganti text-textMuted jadi text-white/80 dan font-normal biar lebih 'pop' -->
                            <p class="text-white/80 leading-relaxed text-base md:text-lg font-normal max-w-2xl">
                                Exploring how spatial computing and AI are converging to create the next generation of
                                web interfaces, moving beyond flat grids into immersive 3D space.
                            </p>

                            <!-- CTA Button -->
                            <button
                                class="text-primary font-black text-sm flex items-center gap-2 group-hover:gap-5 transition-all pt-2 uppercase tracking-[0.2em]">
                                Read Full Article
                                <div class="w-8 h-[1px] bg-primary group-hover:w-12 transition-all"></div>
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 2. Secondary Articles List (Aside - Scrollable & Compact) -->
                <div class="lg:col-span-5 flex flex-col gap-3 lg:max-h-[560px] overflow-y-auto custom-scrollbar pr-2">

                    <!-- Item 1 -->
                    <div
                        class="group cursor-pointer flex gap-4 items-center p-2 rounded-xl hover:bg-white/[0.03] transition-all duration-300">
                        <!-- Image Container: Kunci ukuran biar selaras mau gambar apapun -->
                        <div
                            class="flex-shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-xl overflow-hidden border border-borderMuted bg-surface">
                            <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?q=80&w=400"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-500">
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <span
                                class="text-[9px] text-primary font-bold uppercase tracking-[0.2em] mb-1 block">Architecture</span>
                            <h4
                                class="text-white text-base md:text-lg font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2 underline-offset-4 group-hover:underline">
                                Scaling React for Enterprise
                            </h4>
                            <!-- P dibuat kelihatan tanpa hover -->
                            <p class="text-textMuted text-xs mt-1 line-clamp-1 font-light opacity-90">
                                Advanced state management guides and best practices.
                            </p>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div
                        class="group cursor-pointer flex gap-4 items-center p-2 rounded-xl hover:bg-white/[0.03] transition-all duration-300">
                        <div
                            class="flex-shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-xl overflow-hidden border border-borderMuted bg-surface">
                            <img src="https://images.unsplash.com/photo-1614850523296-d8c1af93d400?q=80&w=400"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-500">
                        </div>
                        <div class="flex-1 min-w-0">
                            <span
                                class="text-[9px] text-primary font-bold uppercase tracking-[0.2em] mb-1 block">Design</span>
                            <h4
                                class="text-white text-base md:text-lg font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2 underline-offset-4 group-hover:underline">
                                The Future of CSS Grid 2025
                            </h4>
                            <p class="text-textMuted text-xs mt-1 line-clamp-1 font-light opacity-90">
                                New layout possibilities without a single line of JS.
                            </p>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div
                        class="group cursor-pointer flex gap-4 items-center p-2 rounded-xl hover:bg-white/[0.03] transition-all duration-300">
                        <div
                            class="flex-shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-xl overflow-hidden border border-borderMuted bg-surface">
                            <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=400"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-500">
                        </div>
                        <div class="flex-1 min-w-0">
                            <span
                                class="text-[9px] text-primary font-bold uppercase tracking-[0.2em] mb-1 block">Security</span>
                            <h4
                                class="text-white text-base md:text-lg font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2 underline-offset-4 group-hover:underline">
                                Zero Trust Frontend Security
                            </h4>
                            <p class="text-textMuted text-xs mt-1 line-clamp-1 font-light opacity-90">
                                Protecting user data from sophisticated client attacks.
                            </p>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div
                        class="group cursor-pointer flex gap-4 items-center p-2 rounded-xl hover:bg-white/[0.03] transition-all duration-300">
                        <div
                            class="flex-shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-xl overflow-hidden border border-borderMuted bg-surface">
                            <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=400"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-500">
                        </div>
                        <div class="flex-1 min-w-0">
                            <span
                                class="text-[9px] text-primary font-bold uppercase tracking-[0.2em] mb-1 block">Backend</span>
                            <h4
                                class="text-white text-base md:text-lg font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2 underline-offset-4 group-hover:underline">
                                Next.js Server Actions Dive
                            </h4>
                            <p class="text-textMuted text-xs mt-1 line-clamp-1 font-light opacity-90">
                                Simplify your data mutations with type-safety.
                            </p>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div
                        class="group cursor-pointer flex gap-4 items-center p-2 rounded-xl hover:bg-white/[0.03] transition-all duration-300">
                        <div
                            class="flex-shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-xl overflow-hidden border border-borderMuted bg-surface">
                            <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=400"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-500">
                        </div>
                        <div class="flex-1 min-w-0">
                            <span
                                class="text-[9px] text-primary font-bold uppercase tracking-[0.2em] mb-1 block">DevOps</span>
                            <h4
                                class="text-white text-base md:text-lg font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2 underline-offset-4 group-hover:underline">
                                Modern CI/CD Pipelines
                            </h4>
                            <p class="text-textMuted text-xs mt-1 line-clamp-1 font-light opacity-90">
                                Deploying high-performance apps with confidence.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer
        class="bg-[#050307]/90 backdrop-blur-md border-t border-borderMuted py-10 md:py-6 px-6 md:px-8 relative z-20">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10 text-left">
                <div class="space-y-4">
                    <div class="flex items-center gap-2 font-bold text-2xl">Pie.</div>
                    <p class="text-textMuted text-sm">Independent Senior Developer building high-end digital products.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-4 md:mb-8 uppercase text-xs tracking-widest">Navigation</h4>
                    <ul class="space-y-4 text-textMuted text-sm">
                        <li><a href="#about" class="hover:text-primary">Profile</a></li>
                        <li><a href="#education" class="hover:text-primary">Education</a></li>
                        <li><a href="#projects" class="hover:text-primary">Projects</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4 md:mb-8 uppercase text-xs tracking-widest">Services</h4>
                    <ul class="space-y-4 text-textMuted text-sm">
                        <li>Enterprise Web Apps</li>
                        <li>3D/WebGL Design</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4 md:mb-8 uppercase text-xs tracking-widest">Contact</h4>
                    <ul class="space-y-4 text-textMuted text-sm">
                        <li><a href="mailto:aditya@example.com" class="text-primary font-bold">aditya@example.com</a>
                        </li>
                        <li>+1 (123) 456-7890</li>
                    </ul>
                </div>
            </div>
            <div class="text-center pt-8 border-t border-borderMuted/10">
                <p class="text-textMuted text-xs tracking-widest">&copy; 2026 Pie. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        let lastScroll = 0;
        const navbar = document.getElementById("navbar");

        window.addEventListener("scroll", () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 50) {
                navbar.classList.add("shadow-lg", "bg-[#08050a]/90");
            } else {
                navbar.classList.remove("shadow-lg", "bg-[#08050a]/90");
            }
            if (currentScroll > lastScroll && currentScroll > 100) {
                navbar.classList.add("nav-hide");
            } else {
                navbar.classList.remove("nav-hide");
            }
            lastScroll = currentScroll;
        });
    </script>

    <script type="module">
        import createGlobe from 'https://cdn.skypack.dev/cobe';
        lucide.createIcons();
        let canvas = document.getElementById("cobe-canvas");
        let phi = 0;
        const globe = createGlobe(canvas, {
            devicePixelRatio: 2,
            width: 1000 * 2,
            height: 1000 * 2,
            phi: 0,
            theta: 0.15,
            dark: 1,
            diffuse: 1.2,
            mapSamples: 30000,
            mapBrightness: 18,
            baseColor: [1, 0.15, 0.25],
            markerColor: [1, 1, 1],
            glowColor: [0.3, 0.05, 0.1],
            markers: [],
            onRender: (state) => {
                state.phi = phi;
                phi += 0.005;
            }
        });
    </script>
</body>

</html>
