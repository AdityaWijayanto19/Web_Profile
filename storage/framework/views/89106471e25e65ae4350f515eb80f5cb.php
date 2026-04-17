<?php $__env->startSection('title', 'Manage Journey - FoxHR'); ?>
<?php $__env->startSection('page_title', 'Experience Journey'); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4">
        
        <div class="flex justify-between items-end mb-8 border-b border-white/5 pb-6">
            <div>
                <h2 class="text-xl font-bold text-white tracking-tight">Experience Timeline</h2>
                <p class="text-gray-500 text-[11px] mt-1 uppercase tracking-tighter">Wavy Section Content (Max 3)</p>
            </div>
        </div>

        <form action="<?php echo e(route('pengalaman.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="bg-[#1a151d] border border-white/5 rounded-sm">
                <table class="w-full text-left border-collapse" data-reorder-url="<?php echo e(route('pengalaman.reorder')); ?>">
                    <thead>
                        <tr class="border-b border-white/5 bg-black/20 text-[9px] uppercase tracking-[0.2em] text-gray-500">
                            <th class="px-4 py-2 w-14 text-center">Step</th>
                            <th class="px-4 py-2 w-1/4">Jabatan</th>
                            <th class="px-4 py-2">Keterangan</th>
                            <th class="px-4 py-2 w-20 text-center">Urutan</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-table">
                        <?php $__empty_1 = true; $__currentLoopData = $pengalamans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pengalaman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="group border-b border-white/5 transition-colors hover:bg-white/[0.01]"
                                data-id="<?php echo e($pengalaman->id); ?>">
                                <td class="px-4 py-3 text-center relative">
                                    <span
                                        class="row-number text-xl font-black text-gray-800 group-hover:opacity-0 transition-opacity"><?php echo e($index + 1); ?></span>
                                    <div
                                        class="drag-handle absolute inset-0 flex items-center justify-center text-gray-600 group-hover:text-[#730c1e] opacity-0 group-hover:opacity-100 transition-opacity cursor-grab active:cursor-grabbing">
                                        <i data-lucide="grip-vertical" class="w-5 h-5"></i>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <input type="text" name="pengalamans[<?php echo e($pengalaman->id); ?>][jabatan]"
                                        value="<?php echo e($pengalaman->jabatan); ?>"
                                        class="table-input font-bold text-[#730c1e] text-sm w-full" placeholder="Jabatan">
                                </td>
                                <td class="px-4 py-3">
                                    <textarea name="pengalamans[<?php echo e($pengalaman->id); ?>][keterangan]" rows="1"
                                        class="table-input text-gray-400 text-[11px] resize-none overflow-hidden w-full" placeholder="Keterangan"><?php echo e($pengalaman->keterangan); ?></textarea>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <input type="number" name="pengalamans[<?php echo e($pengalaman->id); ?>][urutan]"
                                        value="<?php echo e($pengalaman->urutan); ?>"
                                        class="table-input text-white text-sm w-full text-center" placeholder="Urutan"
                                        readonly>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Tidak ada data pengalaman
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Action Area -->
            <div class="mt-4 flex justify-between items-center">
                <div class="flex justify-center items-center text-xs text-gray-500 italic">
                    <p>* Drag the <span class="inline-block"><i data-lucide="grip-vertical"
                                class="w-3 h-3 inline"></i></span> icon to reorder positions (auto-save).</p>
                </div>
                <button type="submit"
                    class="btn-save text-white px-6 py-2 rounded-sm flex items-center gap-2 text-[10px] font-bold tracking-widest uppercase shadow-lg shadow-[#730c1e]/10">
                    <i data-lucide="save" class="w-3.5 h-3.5"></i>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/pengalaman.js']); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/pengalaman.blade.php ENDPATH**/ ?>