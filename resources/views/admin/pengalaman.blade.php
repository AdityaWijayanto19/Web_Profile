@extends('layouts.app')

@section('title', 'Manage Journey - FoxHR')
@section('page_title', 'Experience Journey')

@push('styles')
<style>
    .sortable-ghost {
        opacity: 0.3;
        background-color: rgba(115, 12, 30, 0.2) !important;
    }

    /* Input sangat rapat */
    .table-input {
        background: transparent;
        border: 1px solid transparent;
        color: #d1d5db;
        width: 100%;
        padding: 2px 6px;
        border-radius: 2px;
        transition: all 0.2s;
    }
    .table-input:focus {
        outline: none;
        border-color: #730c1e;
        background: rgba(255, 255, 255, 0.03);
        color: white;
    }

    .btn-save {
        background-color: #730c1e;
        transition: all 0.3s ease;
    }
    .btn-save:hover {
        background-color: #921126;
    }

    /* Icon box lebih kecil & compact */
    .icon-preview-box {
        width: 28px;
        height: 28px;
        background: white;
        transform: rotate(-10deg);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Header Minimalis -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-bold text-white tracking-tight">Experience Timeline</h2>
            <p class="text-gray-500 text-[10px] uppercase tracking-widest">Wavy Section Content (Max 3)</p>
        </div>
        <div class="px-3 py-1 bg-white/5 border border-white/5 rounded-sm text-[9px] text-gray-400 uppercase font-bold">
            Live Editor
        </div>
    </div>

    <form action="#" method="POST">
        @csrf
        <div class="bg-[#1a151d] border border-white/5 rounded-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 bg-black/20 text-[9px] uppercase tracking-[0.2em] text-gray-500">
                        <th class="px-4 py-2 w-14 text-center">Step</th>
                        <th class="px-4 py-2 w-1/4">Title / Role</th>
                        <th class="px-4 py-2 w-1/4">Company & Year</th>
                        <th class="px-4 py-2">Brief Description</th>
                        <th class="px-4 py-2 w-20 text-center">Icon</th>
                    </tr>
                </thead>
                <tbody id="sortable-table">
                    <!-- Row 1 -->
                    <tr class="group border-b border-white/5 transition-colors hover:bg-white/[0.01]" data-id="1">
                        <td class="px-4 py-3 text-center relative">
                            <span class="row-number text-xl font-black text-gray-800 group-hover:opacity-0 transition-opacity">1</span>
                            <div class="drag-handle absolute inset-0 flex items-center justify-center text-gray-600 group-hover:text-[#730c1e] opacity-0 group-hover:opacity-100 transition-opacity cursor-grab active:cursor-grabbing">
                                <i data-lucide="grip-vertical" class="w-5 h-5"></i>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <input type="text" name="title[]" value="Frontend Intern" class="table-input font-bold text-[#730c1e] text-sm" placeholder="Title">
                        </td>
                        <td class="px-4 py-3">
                            <input type="text" name="company[]" value="Tech Studio Inc" class="table-input font-medium text-white text-[11px]" placeholder="Company">
                            <input type="text" name="year[]" value="2021" class="table-input text-gray-500 text-[10px]" placeholder="Year">
                        </td>
                        <td class="px-4 py-3">
                            <textarea name="desc[]" rows="1" class="table-input text-gray-400 text-[11px] resize-none overflow-hidden" placeholder="Desc...">Focus on mastering modern UI architecture.</textarea>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex flex-col items-center gap-1">
                                <div class="icon-preview-box shadow-sm">
                                    <i data-lucide="flag" class="w-3.5 h-3.5 text-[#730c1e]"></i>
                                </div>
                                <button type="button" class="text-[8px] text-gray-600 hover:text-white uppercase font-bold tracking-tighter">Edit</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="group border-b border-white/5 transition-colors hover:bg-white/[0.01]" data-id="2">
                        <td class="px-4 py-3 text-center relative">
                            <span class="row-number text-xl font-black text-gray-800 group-hover:opacity-0 transition-opacity">2</span>
                            <div class="drag-handle absolute inset-0 flex items-center justify-center text-gray-600 group-hover:text-[#730c1e] opacity-0 group-hover:opacity-100 transition-opacity cursor-grab active:cursor-grabbing">
                                <i data-lucide="grip-vertical" class="w-5 h-5"></i>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <input type="text" name="title[]" value="Junior Developer" class="table-input font-bold text-[#730c1e] text-sm" placeholder="Title">
                        </td>
                        <td class="px-4 py-3">
                            <input type="text" name="company[]" value="Cyber Nexus" class="table-input font-medium text-white text-[11px]" placeholder="Company">
                            <input type="text" name="year[]" value="2022" class="table-input text-gray-500 text-[10px]" placeholder="Year">
                        </td>
                        <td class="px-4 py-3">
                            <textarea name="desc[]" rows="1" class="table-input text-gray-400 text-[11px] resize-none overflow-hidden" placeholder="Desc...">Developing scalable React applications.</textarea>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex flex-col items-center gap-1">
                                <div class="icon-preview-box shadow-sm">
                                    <i data-lucide="bar-chart-3" class="w-3.5 h-3.5 text-[#730c1e]"></i>
                                </div>
                                <button type="button" class="text-[8px] text-gray-600 hover:text-white uppercase font-bold tracking-tighter">Edit</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr class="group border-b border-white/5 transition-colors hover:bg-white/[0.01]" data-id="3">
                        <td class="px-4 py-3 text-center relative">
                            <span class="row-number text-xl font-black text-gray-800 group-hover:opacity-0 transition-opacity">3</span>
                            <div class="drag-handle absolute inset-0 flex items-center justify-center text-gray-600 group-hover:text-[#730c1e] opacity-0 group-hover:opacity-100 transition-opacity cursor-grab active:cursor-grabbing">
                                <i data-lucide="grip-vertical" class="w-5 h-5"></i>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <input type="text" name="title[]" value="UI Engineer" class="table-input font-bold text-[#730c1e] text-sm" placeholder="Title">
                        </td>
                        <td class="px-4 py-3">
                            <input type="text" name="company[]" value="Freelance" class="table-input font-medium text-white text-[11px]" placeholder="Company">
                            <input type="text" name="year[]" value="2023 - Now" class="table-input text-gray-500 text-[10px]" placeholder="Year">
                        </td>
                        <td class="px-4 py-3">
                            <textarea name="desc[]" rows="1" class="table-input text-gray-400 text-[11px] resize-none overflow-hidden" placeholder="Desc...">Crafting immersive 3D experiences with Three.js.</textarea>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex flex-col items-center gap-1">
                                <div class="icon-preview-box shadow-sm">
                                    <i data-lucide="flag" class="w-3.5 h-3.5 text-[#730c1e]"></i>
                                </div>
                                <button type="button" class="text-[8px] text-gray-600 hover:text-white uppercase font-bold tracking-tighter">Edit</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Action Area Compact -->
        <div class="mt-4 flex justify-between items-center">
            <div class="text-[9px] text-gray-600 uppercase tracking-widest italic font-bold">
                * Order reflects timeline sequence
            </div>
            <button type="submit" class="btn-save text-white px-6 py-2 rounded-sm flex items-center gap-2 text-[10px] font-bold tracking-widest uppercase shadow-lg shadow-[#730c1e]/10">
                <i data-lucide="save" class="w-3.5 h-3.5"></i>
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const el = document.getElementById('sortable-table');
        Sortable.create(el, {
            animation: 200,
            handle: '.drag-handle',
            ghostClass: 'sortable-ghost',
            onEnd: function () {
                const rows = document.querySelectorAll('.row-number');
                rows.forEach((row, index) => {
                    row.innerText = index + 1;
                });
            },
        });
    });
</script>
@endpush
