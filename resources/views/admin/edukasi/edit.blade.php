@extends('layouts.app')

@section('title', 'Edit Education')
@section('page_title', 'Edit Education')

@section('content')
    <div class="max-w-7xl mx-auto px-4">

        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('pendidikans.index') }}"
                class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-[#730c1e] transition-colors group">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                BACK TO EDUCATION
            </a>
            <div class="flex items-center gap-2">
                <span class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">ID:
                    {{ str_pad($pendidikan->id, 4, '0', STR_PAD_LEFT) }}</span>
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
            </div>
        </div>

        <form action="{{ route('pendidikans.update', $pendidikan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="lg:col-span-8 space-y-6">
                <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden shadow-2xl">
                    <div class="p-5 border-b border-white/5 bg-black/20">
                        <h3 class="text-white text-sm font-semibold flex items-center gap-2">
                            <i data-lucide="edit-3" class="w-4 h-4 text-[#730c1e]"></i>
                            Modify Education Entry
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Start
                                    Year</label>
                                <input type="text" name="start_year"
                                    value="{{ explode(' - ', $pendidikan->periode)[0] ?? '' }}"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all text-sm font-medium">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">End Year /
                                    Status</label>
                                <input type="text" name="end_year"
                                    value="{{ explode(' - ', $pendidikan->periode)[1] ?? '' }}"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all text-sm font-medium">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Degree &
                                Major</label>
                            <input type="text" name="degree" value="{{ $pendidikan->gelar }}"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all text-sm font-medium">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Institution /
                                University</label>
                            <input type="text" name="institution" value="{{ $pendidikan->instansi }}"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all text-sm font-medium">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Short
                                Description</label>
                            <textarea name="description" rows="6"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-3 text-white outline-none focus:border-[#730c1e] transition-all resize-none text-sm leading-relaxed font-light">{{ $pendidikan->keterangan }}</textarea>
                        </div>
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
