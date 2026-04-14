<?php $__env->startSection('title', $sertifikat->nama_sertifikat . ' - Certificate'); ?>
<?php $__env->startSection('page_title', 'Certificate Details'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .btn-outline {
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .btn-danger-soft {
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
            transition: all 0.3s ease;
        }

        .btn-danger-soft:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        .meta-label {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #4b5563;
            margin-bottom: 0.5rem;
            display: block;
        }

        .cert-thumb {
            aspect-ratio: 16 / 9;
            border-radius: 2px;
            overflow: hidden;
            background: #0f0d11;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4">

        <!-- HEADER -->
        <div class="flex justify-between items-end mb-12 border-b border-white/5 pb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h2 class="text-3xl font-black text-white tracking-tighter uppercase italic"><?php echo e($sertifikat->nama_sertifikat); ?></h2>
                </div>
                <p class="text-[11px] text-gray-500 uppercase tracking-[0.2em] font-bold"><?php echo e($sertifikat->penerbit); ?> • <?php echo e($sertifikat->tahun); ?></p>
            </div>

            <div class="flex gap-3">
                <a href="<?php echo e(route('sertifikats.edit', $sertifikat)); ?>" class="flex items-center gap-2 px-4 py-2 bg-[#730c1e] hover:bg-[#911226] text-white rounded-sm text-[10px] font-bold uppercase tracking-widest transition-all">
                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                    Edit
                </a>
                <a href="<?php echo e(route('sertifikats.index')); ?>" class="btn-outline flex items-center gap-2 px-4 py-2 text-white rounded-sm text-[10px] font-bold uppercase tracking-widest">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    Back
                </a>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">

            <!-- FEATURED IMAGE -->
            <div class="lg:col-span-2">
                <div class="cert-thumb relative mb-6 shadow-2xl">
                    <?php if($sertifikat->path_gambar): ?>
                        <img src="<?php echo e(asset('storage/' . $sertifikat->path_gambar)); ?>"
                             alt="<?php echo e($sertifikat->nama_sertifikat); ?>"
                             class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-[#730c1e] to-black flex items-center justify-center">
                            <i data-lucide="certificate" class="w-24 h-24 text-white/20"></i>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- DETAILS PANEL -->
                <div class="bg-[#1a151e] border border-white/5 p-6 rounded-sm shadow-xl space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <span class="meta-label">Publisher</span>
                            <p class="text-white font-medium text-sm"><?php echo e($sertifikat->penerbit); ?></p>
                        </div>

                        <div>
                            <span class="meta-label">Year Obtained</span>
                            <p class="text-white font-medium text-sm"><?php echo e($sertifikat->tahun); ?></p>
                        </div>
                    </div>

                    <?php if($sertifikat->id_kredensial): ?>
                        <div>
                            <span class="meta-label">Credential ID</span>
                            <p class="text-white font-medium text-sm font-mono bg-black/40 px-3 py-2 rounded-sm border border-white/5"><?php echo e($sertifikat->id_kredensial); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if($sertifikat->link_kredensial): ?>
                        <div>
                            <span class="meta-label">Credential Link</span>
                            <a href="<?php echo e($sertifikat->link_kredensial); ?>" target="_blank" class="text-[#730c1e] hover:text-[#911226] font-medium text-sm flex items-center gap-2 transition-colors">
                                <?php echo e($sertifikat->link_kredensial); ?>

                                <i data-lucide="external-link" class="w-3 h-3"></i>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if($sertifikat->deskripsi): ?>
                        <div>
                            <span class="meta-label">Description</span>
                            <p class="text-gray-400 text-sm leading-relaxed"><?php echo e($sertifikat->deskripsi); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-2 gap-3 pt-6 border-t border-white/5">
                        <div>
                            <span class="meta-label">Created At</span>
                            <p class="text-gray-500 text-xs"><?php echo e($sertifikat->created_at->format('M d, Y H:i')); ?></p>
                        </div>
                        <div>
                            <span class="meta-label">Last Updated</span>
                            <p class="text-gray-500 text-xs"><?php echo e($sertifikat->updated_at->format('M d, Y H:i')); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SIDEBAR: ACTIONS & INFO -->
            <div class="space-y-6">
                <!-- QUICK ACTIONS -->
                <div class="bg-[#1a151e] border border-white/5 p-6 rounded-sm shadow-xl">
                    <h3 class="text-xs text-white font-bold uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i data-lucide="zap" class="w-3.5 h-3.5 text-[#730c1e]"></i>
                        Quick Actions
                    </h3>

                    <div class="space-y-3">
                        <a href="<?php echo e(route('sertifikats.edit', $sertifikat)); ?>" class="w-full flex items-center gap-2 px-4 py-2 bg-[#730c1e] hover:bg-[#911226] text-white rounded-sm text-[10px] font-bold uppercase tracking-widest transition-all">
                            <i data-lucide="edit-3" class="w-3 h-3"></i>
                            Edit Certificate
                        </a>

                        <form action="<?php echo e(route('sertifikats.destroy', $sertifikat)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this certificate? This action cannot be undone.');" style="display: inline-block; width: 100%;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-danger-soft w-full flex items-center gap-2 px-4 py-2 rounded-sm text-[10px] font-bold uppercase tracking-widest transition-all">
                                <i data-lucide="trash-2" class="w-3 h-3"></i>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <!-- METADATA INFO -->
                <div class="bg-[#1a151e] border border-white/5 p-6 rounded-sm shadow-xl">
                    <h3 class="text-xs text-white font-bold uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i data-lucide="info" class="w-3.5 h-3.5 text-[#730c1e]"></i>
                        Metadata
                    </h3>

                    <div class="space-y-3 text-[9px]">
                        <div class="flex justify-between items-center pb-3 border-b border-white/5">
                            <span class="text-gray-500 uppercase">ID</span>
                            <span class="text-white font-mono font-bold"><?php echo e(str_pad($sertifikat->id, 4, '0', STR_PAD_LEFT)); ?></span>
                        </div>

                        <div class="flex justify-between items-center pb-3 border-b border-white/5">
                            <span class="text-gray-500 uppercase">Status</span>
                            <span class="px-2 py-0.5 bg-green-500/20 text-green-300 rounded-sm font-bold">Active</span>
                        </div>

                        <div class="flex justify-between items-center pb-3 border-b border-white/5">
                            <span class="text-gray-500 uppercase">Has Image</span>
                            <span class="text-white"><?php echo e($sertifikat->path_gambar ? 'Yes' : 'No'); ?></span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 uppercase">Credentials Link</span>
                            <span class="text-white"><?php echo e($sertifikat->link_kredensial ? 'Yes' : 'No'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- ASSET INFO -->
                <div class="bg-black/40 border border-white/5 p-4 rounded-sm">
                   <h5 class="text-[9px] text-gray-500 font-bold uppercase mb-3 tracking-widest">Asset Info</h5>
                   <ul class="text-[8px] text-gray-600 space-y-2 uppercase font-medium">
                       <?php if($sertifikat->path_gambar): ?>
                           <li class="flex items-center gap-2">
                               <div class="w-1 h-1 bg-[#730c1e]"></div>
                               Image: WebP Format
                           </li>
                       <?php endif; ?>
                       <li class="flex items-center gap-2">
                           <div class="w-1 h-1 bg-[#730c1e]"></div>
                           Created: <?php echo e($sertifikat->created_at->diffForHumans()); ?>

                       </li>
                   </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    lucide.createIcons();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/sertifikat/show.blade.php ENDPATH**/ ?>