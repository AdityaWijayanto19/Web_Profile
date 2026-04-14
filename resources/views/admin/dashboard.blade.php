@extends('layouts.app')

@section('title', 'FoxHR Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="grid grid-cols-12 gap-4 px-4">

    <!-- LEFT COLUMN -->
    <div class="col-span-12 lg:col-span-8 space-y-4">
        <!-- Banner -->
        <div class="bg-gradient-to-r from-black via-[#1a0f14] to-[#140f17] rounded-md p-6 relative flex items-center overflow-hidden min-h-[160px] shadow-sm">
            <div class="z-10 w-2/3">
                <h2 class="text-white text-2xl font-bold mb-1">Hello Yunnappie!</h2>
                <p class="text-gray-300 text-xs leading-relaxed">Consistency is the key to <span class="font-bold border-b border-gray-500">mastery</span>. Keep updating, keep growing, and keep inspiring.</p>
                <button class="mt-4 text-[10px] font-bold text-white border border-white/30 px-3 py-1.5 rounded-sm hover:bg-[#730c1e] hover:border-[#730c1e] hover:text-white transition-all uppercase tracking-tighter">Manage Now</button>
            </div>
            <div class="absolute -right-28 opacity-60 bottom-0 w-52 pointer-events-none">
                <img src="{{ asset('assets/images/Illustration-1.svg') }}" class="object-contain w-full h-full" alt="Programmer">
            </div>
        </div>

        <!-- STATS OVERVIEW -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            {{-- Satu blok stat --}}
            <div class="bg-[#1a0f14] p-4 rounded-md shadow-sm border border-white/5 hover:border-[#730c1e]/50 transition-all group">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-[#730c1e]/10 rounded text-[#730c1e] group-hover:bg-[#730c1e] group-hover:text-white transition-all">
                        <i data-lucide="folder-kanban" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest leading-none mb-1">Projects</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-xl font-bold text-white tracking-tighter">24</span>
                            <span class="text-[9px] text-gray-600 font-medium">Items</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Duplikat blok stat lainnya sesuai kebutuhan --}}
        </div>

        <!-- ENGAGEMENT STATS -->
        <div class="mt-6">
            <div class="flex items-center justify-between mb-3 px-1">
                <h3 class="text-[11px] font-black text-gray-500 uppercase tracking-[0.2em]">Engagement Stat <span class="text-[#730c1e]/50 ml-1">(Visitor Insights)</span></h3>
                <span class="text-[10px] text-gray-600 font-medium">Last 30 Days</span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-[#1a0f14] p-4 rounded-md border border-white/5 flex flex-col justify-between h-32 relative overflow-hidden group">
                    <div class="z-10">
                        <div class="flex justify-between items-start">
                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider">Total Visitors</p>
                            <span class="text-[9px] text-green-500 font-bold">+12%</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mt-1">1,284</h4>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-12 opacity-40 group-hover:opacity-80 transition-opacity">
                        <svg viewBox="0 0 100 30" class="w-full h-full"><path d="M0,25 Q15,25 25,15 T45,20 T65,10 T85,15 T100,5" fill="none" stroke="#730c1e" stroke-width="2" /></svg>
                    </div>
                </div>
                {{-- Duplikat item engagement lainnya --}}
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN -->
    <div class="col-span-12 lg:col-span-4 space-y-4">
        <!-- CALENDAR -->
        <div class="bg-[#1a0f14] rounded-lg p-4 shadow-xl text-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-sm tracking-tight">Calendar</h3>
                <div class="flex items-center gap-3">
                    <span id="calendar-month-year" class="text-[10px] font-black uppercase text-[#730c1e] tracking-widest"></span>
                    <div class="flex gap-1">
                        <button onclick="changeMonth(-1)" class="p-1 hover:bg-white/10 rounded"><i data-lucide="chevron-left" class="w-3 h-3"></i></button>
                        <button onclick="changeMonth(1)" class="p-1 hover:bg-white/10 rounded"><i data-lucide="chevron-right" class="w-3 h-3"></i></button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-7 gap-1 text-center text-[10px] font-bold text-gray-500 mb-2">
                <div>MO</div><div>TU</div><div>WE</div><div>TH</div><div>FR</div><div>SA</div><div>SU</div>
            </div>
            <div id="calendar-days" class="grid grid-cols-7 gap-1 text-center text-[11px]"></div>
        </div>

        <!-- PROFILE & CLOCK -->
        <div class="bg-[#1a0f14] rounded-lg shadow-xl overflow-hidden text-white">
            <div class="p-4 border-b">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <i data-lucide="user" class="w-11 h-11 rounded-lg bg-white/5 p-2"></i>
                        <div>
                            <h4 class="font-bold text-white text-sm">Yunnappie</h4>
                            <p class="text-[9px] text-[#730c1e] font-black uppercase tracking-widest">Undergraduate Student</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <button class="flex justify-center py-2 rounded-md bg-white/5 hover:text-[#730c1e]"><i data-lucide="phone" class="w-3.5 h-3.5"></i></button>
                    <button class="flex justify-center py-2 rounded-md bg-white/5 hover:text-[#730c1e]"><i data-lucide="mail" class="w-3.5 h-3.5"></i></button>
                    <button class="flex justify-center py-2 rounded-md bg-white/5 hover:text-[#730c1e]"><i data-lucide="message-square" class="w-3.5 h-3.5"></i></button>
                </div>
            </div>
            <div class="p-4 bg-white/[0.02]">
                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Digital Clock</span>
                <div class="flex items-baseline gap-1">
                    <h2 id="clock-main" class="text-4xl font-light tracking-tighter text-gray-200">00:00</h2>
                    <span id="clock-seconds" class="text-xl font-medium text-[#730c1e] tabular-nums">00</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @vite(['resources/js/dashboard.js'])
@endpush
