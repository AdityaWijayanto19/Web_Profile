<?php $__env->startSection('title', 'Certifications'); ?>
<?php $__env->startSection('page_title', 'Certifications Manager'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .btn-primary {
            background-color: #730c1e;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #921126;
            transform: translateY(-1px);
        }

        .sortable-ghost {
            opacity: 0.3;
            border: 2px dashed #730c1e;
        }

        .sortable-drag {
            cursor: grabbing !important;
            transform: scale(1.02);
        }

        .cert-thumb {
            aspect-ratio: 16 / 9;
            border-radius: 2px;
            overflow: hidden;
            background: #0f0d11;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .dragging {
            opacity: 0.5;
        }

        #sertifikatsGrid {
            transition: opacity 0.2s ease, pointer-events 0.2s ease;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4">

        <div class="flex justify-between items-end mb-8 border-b border-white/5 pb-6">
            <div>
                <h2 class="text-xl font-bold text-white tracking-tight">Certifications</h2>
                <p class="text-gray-500 text-[11px] mt-1 uppercase tracking-tighter">Manage and reorder your professional
                    credentials.</p>
            </div>
            <a href="<?php echo e(route('sertifikats.create')); ?>"
                class="btn-primary text-white px-4 py-2 rounded-sm flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                Add New
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12" id="sertifikatsGrid"
            data-redirect-url="<?php echo e(route('sertifikats.index')); ?>">

            <?php $__empty_1 = true; $__currentLoopData = $sertifikats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sertifikat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="group cursor-grab active:cursor-grabbing" data-sertifikat-id="<?php echo e($sertifikat->id); ?>"
                    data-reorder-url="<?php echo e(route('sertifikats.reorder')); ?>">
                    <div class="cert-thumb relative mb-4">
                        <?php if($sertifikat->path_gambar): ?>
                            <img src="<?php echo e(asset('storage/' . $sertifikat->path_gambar)); ?>"
                                alt="<?php echo e($sertifikat->nama_sertifikat); ?>"
                                class="w-full h-full object-cover group-hover:opacity-100 transition-all duration-500">
                        <?php else: ?>
                            <div
                                class="w-full h-full flex items-center justify-center bg-white/5 text-gray-700 italic text-[10px]">
                                No Preview</div>
                        <?php endif; ?>

                        <div
                            class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3 z-10">
                            <a href="<?php echo e(route('sertifikats.edit', $sertifikat)); ?>"
                                class="p-2.5 bg-white/10 hover:bg-blue-600 rounded-sm text-white transition-colors">
                                <i data-lucide="edit-3" class="w-4.5 h-4.5"></i>
                            </a>
                            <form action="<?php echo e(route('sertifikats.destroy', $sertifikat)); ?>" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                                <?php echo csrf_field(); ?>
                                <button type="button"
                                    @click="$dispatch('open-delete-modal', {
        title: 'Hapus Sertifikat?',
        message: 'Apakah anda yakin ingin menghapus <?php echo e(addslashes($sertifikat->nama_sertifikat)); ?>?',
        action: '<?php echo e(route('sertifikats.destroy', $sertifikat)); ?>'
    })"
                                    class="p-2.5 bg-white/10 hover:bg-red-600 rounded-sm text-white transition-colors">
                                    <i data-lucide="trash-2" class="w-4.5 h-4.5"></i>
                                </button>
                            </form>
                        </div>

                        <div class="absolute top-2 right-2 z-10">
                            <div class="px-2 py-1 bg-[#730c1e] rounded-sm">
                                <span class="text-[9px] font-bold text-white"><?php echo e($sertifikat->tahun); ?></span>
                            </div>
                        </div>

                        <div class="absolute bottom-3 left-3 z-10">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-black/50 backdrop-blur-md flex items-center justify-center rounded-sm border border-white/10 text-white font-mono text-[9px] transition-all duration-300"
                                    data-sequence>
                                    <?php echo e(str_pad($sertifikat->urutan, 2, '0', STR_PAD_LEFT)); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-0.5 space-y-1">
                        <a href="<?php echo e(route('sertifikats.show', $sertifikat)); ?>"
                            class="text-sm font-bold text-white uppercase tracking-wider truncate hover:text-[#730c1e] transition-colors line-clamp-1">
                            <?php echo e($sertifikat->nama_sertifikat); ?>

                        </a>
                        <p class="text-[11px] text-gray-500 font-medium uppercase mt-0.5 line-clamp-1">
                            <?php echo e($sertifikat->penerbit); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full py-16 text-center">
                    <i data-lucide="inbox" class="w-16 h-16 text-gray-600 mx-auto mb-4"></i>
                    <p class="text-gray-500 text-[11px] uppercase tracking-widest">No certifications yet.</p>
                </div>
            <?php endif; ?>

        </div>

        <div class="mt-16 py-8 border-t border-white/5">
            <?php echo e($sertifikats->links('partials.pagination')); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/admin/sertifikat/index.js']); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/sertifikat/index.blade.php ENDPATH**/ ?>