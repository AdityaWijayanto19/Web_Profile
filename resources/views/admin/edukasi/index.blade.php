@extends('layouts.app')

@section('title', 'Education Management - FoxHR')
@section('page_title', 'Education Management')

@push('styles')
<style>
    /* Styling khusus untuk row yang sedang ditarik */
    .sortable-ghost {
        opacity: 0.4;
        background-color: rgba(115, 12, 30, 0.3) !important;
    }
    .sortable-chosen {
        background-color: rgba(255, 255, 255, 0.05);
    }
    .btn-primary {
        background-color: #730c1e;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #921126;
        transform: translateY(-1px);
    }
</style>
@endpush

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header Section -->
    <div class="flex justify-between items-end mb-6">
        <div>
            <h2 class="text-xl font-semibold text-white">Educational Root</h2>
            <p class="text-gray-400 text-xs mt-1">Manage your educational background and timeline order.</p>
        </div>
        <a href="{{ route('pendidikans.create') }}" class="btn-primary text-white px-4 py-2 rounded-sm flex items-center gap-2 text-xs font-medium">
            <i data-lucide="plus" class="w-4 h-4"></i>
            ADD NEW EDUCATION
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-white/5 bg-black/20">
                    <th class="px-4 py-3 font-medium text-gray-400 w-12 text-center">#</th>
                    <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Period</th>
                    <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Degree & Major</th>
                    <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider">Description</th>
                    <th class="px-4 py-3 font-medium text-gray-400 text-xs uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="sortable-table">
                @forelse($pendidikans as $index => $pendidikan)
                <tr class="group border-b border-white/5 transition-colors duration-200 hover:bg-white/[0.02]" data-id="{{ $pendidikan->id }}">
                    <td class="px-4 py-4 text-center relative">
                        <span class="row-number text-gray-500 group-hover:opacity-0 transition-opacity">{{ $index + 1 }}</span>
                        <div class="drag-handle absolute inset-0 flex items-center justify-center text-gray-600 group-hover:text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-grab active:cursor-grabbing">
                            <i data-lucide="grip-vertical" class="w-5 h-5"></i>
                        </div>
                    </td>
                    <td class="px-4 py-4 font-mono text-[#730c1e]">{{ $pendidikan->periode }}</td>
                    <td class="px-4 py-4">
                        <div class="text-white font-medium">{{ $pendidikan->gelar }}</div>
                        <div class="text-gray-500 text-xs mt-0.5">{{ $pendidikan->instansi }}</div>
                    </td>
                    <td class="px-4 py-4">
                        <p class="text-gray-400 line-clamp-1 max-w-xs text-xs">{{ $pendidikan->keterangan }}</p>
                    </td>
                    <td class="px-4 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('pendidikans.edit', $pendidikan->id) }}" class="p-1.5 hover:bg-white/10 rounded text-gray-400 hover:text-white transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('pendidikans.destroy', $pendidikan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 hover:bg-red-900/20 rounded text-gray-400 hover:text-red-500 transition-colors border-0 bg-transparent cursor-pointer">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">Tidak ada data pendidikan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 flex justify-between items-center text-xs text-gray-500 italic">
        <p>* Drag the <span class="inline-block"><i data-lucide="grip-vertical" class="w-3 h-3 inline"></i></span> icon to reorder positions.</p>
        <p>Total: 2 entries</p>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const el = document.getElementById('sortable-table');

        // Inisialisasi SortableJS
        const sortable = Sortable.create(el, {
            animation: 150,
            handle: '.drag-handle', // Drag handle selector
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            onEnd: function (evt) {
                // Update nomor urut di tampilan setelah drag selesai
                updateRowNumbers();

                // Ambil data ID sesuai urutan baru
                const order = Array.from(el.querySelectorAll('tr')).map(tr => tr.dataset.id);
                console.log('New Order ID list:', order);

                // SINI NANTI TEMPAT AJAX BACKEND (Next Step)
                // updateOrderOnServer(order);
            },
        });

        // Fungsi untuk reset nomor urut di kolom pertama
        function updateRowNumbers() {
            const rows = document.querySelectorAll('.row-number');
            rows.forEach((row, index) => {
                row.innerText = index + 1;
            });
        }
    });
</script>
@endpush
