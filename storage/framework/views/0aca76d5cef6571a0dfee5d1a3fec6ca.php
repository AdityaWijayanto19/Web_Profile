<?php $__env->startSection('title', 'Certifications - FoxHR'); ?>
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

    /* Efek Sortable */
    .sortable-ghost {
        opacity: 0.2;
        border: 2px dashed #730c1e;
    }

    .sortable-drag {
        cursor: grabbing !important;
        transform: scale(1.02);
    }

    /* Thumbnail Style - Mirip Project */
    .cert-thumb {
        aspect-ratio: 16 / 9;
        border-radius: 2px; /* rounded-sm sesuai request */
        overflow: hidden;
        background: #0f0d11;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto">

    <!-- Header Section (Identik dengan Project) -->
    <div class="flex justify-between items-end mb-8 border-b border-white/5 pb-6">
        <div>
            <h2 class="text-xl font-bold text-white tracking-tight">Certifications</h2>
            <p class="text-gray-500 text-[11px] mt-1 uppercase tracking-tighter">Manage and reorder your professional credentials.</p>
        </div>
        <a href="<?php echo e(route('sertifikats.create')); ?>" class="btn-primary text-white px-4 py-2 rounded-sm flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
            Add New
        </a>
    </div>

    <!-- Alert Messages -->
    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 rounded-sm text-[11px] font-medium uppercase tracking-widest flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 text-red-300 rounded-sm text-[11px] font-medium uppercase tracking-widest flex items-center gap-2">
            <i data-lucide="alert-circle" class="w-4 h-4"></i>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <!-- GRID 3 KOLOM (Mirip Project Index) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12" id="sortable-cards">

        <?php $__empty_1 = true; $__currentLoopData = $sertifikats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sertifikat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <!-- Sertifikat Card -->
            <div class="group cursor-grab active:cursor-grabbing" data-id="<?php echo e($sertifikat->id); ?>">
                <div class="cert-thumb relative mb-4">
                    <?php if($sertifikat->path_gambar): ?>
                        <img src="<?php echo e(asset('storage/' . $sertifikat->path_gambar)); ?>"
                             alt="<?php echo e($sertifikat->nama_sertifikat); ?>"
                             class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-all duration-500">
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-[#730c1e] to-black flex items-center justify-center">
                            <i data-lucide="certificate" class="w-12 h-12 text-white/30"></i>
                        </div>
                    <?php endif; ?>

                    <!-- Hover Overlay Buttons -->
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3 z-10">
                        <a href="<?php echo e(route('sertifikats.edit', $sertifikat)); ?>" class="p-2.5 bg-white/10 hover:bg-[#730c1e] rounded-sm text-white transition-colors">
                            <i data-lucide="edit-3" class="w-4.5 h-4.5"></i>
                        </a>
                        <form action="<?php echo e(route('sertifikats.destroy', $sertifikat)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="p-2.5 bg-white/10 hover:bg-red-600 rounded-sm text-white transition-colors">
                                <i data-lucide="trash-2" class="w-4.5 h-4.5"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Badge Icon (Tetap dipertahankan di pojok) -->
                    <div class="absolute bottom-2 left-2 z-10">
                        <div class="w-6 h-6 bg-[#730c1e] flex items-center justify-center rounded-sm">
                            <i data-lucide="check-circle" class="w-3.5 h-3.5 text-white"></i>
                        </div>
                    </div>

                    <!-- Year Badge -->
                    <div class="absolute top-2 right-2 z-10">
                        <div class="px-2 py-1 bg-[#730c1e] rounded-sm">
                            <span class="text-[9px] font-bold text-white"><?php echo e($sertifikat->tahun); ?></span>
                        </div>
                    </div>
                </div>

                <div class="px-0.5 space-y-1">
                    <a href="<?php echo e(route('sertifikats.show', $sertifikat)); ?>" class="text-sm font-bold text-white uppercase tracking-wider truncate hover:text-[#730c1e] transition-colors line-clamp-1">
                        <?php echo e($sertifikat->nama_sertifikat); ?>

                    </a>
                    <p class="text-[11px] text-gray-500 font-medium uppercase mt-0.5 line-clamp-1"><?php echo e($sertifikat->penerbit); ?></p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full py-16 text-center">
                <i data-lucide="inbox" class="w-16 h-16 text-gray-600 mx-auto mb-4"></i>
                <p class="text-gray-500 text-[11px] uppercase tracking-widest">No certifications yet.</p>
                <a href="<?php echo e(route('sertifikats.create')); ?>" class="mt-4 inline-block btn-primary text-white px-4 py-2 rounded-sm text-[10px] font-bold uppercase tracking-widest">
                    Create Your First Certificate
                </a>
            </div>
        <?php endif; ?>

    </div>

    <!-- Pagination -->
    <?php if($sertifikats->hasPages()): ?>
        <div class="mt-12 flex justify-center">
            <?php echo e($sertifikats->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    lucide.createIcons();

    function openEditor() {
        document.getElementById('editor-panel').classList.remove('translate-x-full');
    }

    function closeEditor() {
        document.getElementById('editor-panel').classList.add('translate-x-full');
    }

    const el = document.getElementById('sortable-cards');
    Sortable.create(el, {
        animation: 350,
        ghostClass: 'sortable-ghost',
        dragClass: 'sortable-drag'
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/sertifikat/index.blade.php ENDPATH**/ ?>