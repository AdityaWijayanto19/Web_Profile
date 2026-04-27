@extends('layouts.admin')

@section('title', 'Add Education')
@section('page_title', 'Add New Education')

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <div class="mb-6">
            <a href="{{ route('pendidikans.index') }}"
                class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-[#730c1e] transition-colors group">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                BACK TO LIST
            </a>
        </div>

        <form action="{{ route('pendidikans.store') }}" method="POST">
            @csrf
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden shadow-2xl">
                    <div class="p-5 border-b border-white/5 bg-black/20">
                        <h3 class="text-white text-sm font-semibold flex items-center gap-2">
                            <i data-lucide="graduation-cap" class="w-4 h-4 text-[#730c1e]"></i>
                            Education Details
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Start
                                    Year</label>
                                <input type="text" name="start_year" placeholder="e.g. 2016"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">End Year /
                                    Status</label>
                                <input type="text" name="end_year" placeholder="e.g. 2020 or Present"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Degree &
                                Major</label>
                            <input type="text" name="degree" placeholder="e.g. Bachelor of Software Engineering"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Institution /
                                University</label>
                            <input type="text" name="institution" placeholder="e.g. Stanford University"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Short
                                Description</label>
                            <textarea name="description" rows="5" placeholder="Explain your focus or achievements..."
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-3 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 resize-none text-sm leading-relaxed"></textarea>
                        </div>

                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Urutan saat ini:
                            {{ $newOrder }}</label>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('pendidikans.index') }}"
                        class="flex items-center justify-center bg-white/5 hover:bg-white/10 text-gray-400 py-3 rounded-sm text-[11px] font-bold transition-all border border-white/5 uppercase tracking-widest">
                        CANCEL
                    </a>
                    <button type="submit"
                        class="w-full bg-[#730c1e] hover:bg-[#911226] text-white py-3 rounded-sm text-[11px] font-bold tracking-[0.3em] transition-all active:scale-[0.98] shadow-lg shadow-[#730c1e]/20">
                        UPDATE EDUCATION
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
