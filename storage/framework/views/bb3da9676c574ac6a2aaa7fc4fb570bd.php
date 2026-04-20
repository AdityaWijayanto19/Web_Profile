<?php $__env->startSection('title', 'Hero Manager'); ?>
<?php $__env->startSection('page_title', 'Hero Section Manager'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .form-input-custom {
            background-color: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.2s;
        }

        .form-input-custom:focus {
            border-color: #730c1e;
            outline: none;
            background-color: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 0 1px #730c1e;
        }

        .card-custom {
            background: #1a151d;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: border 0.3s ease;
        }

        .card-custom:hover {
            border-color: rgba(115, 12, 30, 0.4);
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('hero-section.update')); ?>" method="POST" enctype="multipart/form-data"
        class="max-w-7xl mx-auto px-4 pb-10">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-12 lg:col-span-5 card-custom rounded-sm p-6 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 p-3 text-[8px] font-black text-[#730c1e] uppercase tracking-[0.2em] opacity-40">
                    Section 01 / Identity</div>

                <div class="mb-8 border-l-4 border-[#730c1e] pl-5 py-2">
                    <p class="text-[9px] text-gray-500 uppercase tracking-widest mb-1">Live Preview</p>
                    <h1 id="preview-first-name"
                        class="text-3xl font-bold text-white tracking-tighter leading-none uppercase">
                        <?php echo e($hero->nama_depan ?? 'ADITYA P.'); ?></h1>
                    <h1 id="preview-last-name"
                        class="text-3xl font-bold text-[#730c1e] italic tracking-tighter leading-none uppercase">
                        <?php echo e($hero->nama_belakang ?? 'WIJAYANTO'); ?></h1>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-gray-400">First Name &
                                Initial</label>
                            <input type="text" id="input-first-name" name="nama_depan"
                                value="<?php echo e($hero->nama_depan ?? 'ADITYA P.'); ?>"
                                oninput="updatePreview('preview-first-name', this.value)"
                                class="w-full form-input-custom rounded-sm px-4 py-2.5 text-xs">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Last Name</label>
                            <input type="text" id="input-last-name" name="nama_belakang"
                                value="<?php echo e($hero->nama_belakang ?? 'WIJAYANTO'); ?>"
                                oninput="updatePreview('preview-last-name', this.value)"
                                class="w-full form-input-custom rounded-sm px-4 py-2.5 text-xs">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-7 card-custom rounded-sm p-6 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 p-3 text-[8px] font-black text-[#730c1e] uppercase tracking-[0.2em] opacity-40">
                    Section 02 / Messaging</div>

                <div class="mb-8 min-h-[70px]">
                    <p class="text-[9px] text-gray-500 uppercase tracking-widest mb-1">Preview Headline & Bio</p>
                    <p id="preview-headline" class="text-xs uppercase tracking-[0.2em] text-white font-bold mb-2">
                        <?php echo e($hero->text_singkat ?? 'Undergraduate University of Brawijaya'); ?></p>
                    <p id="preview-bio"
                        class="text-[11px] text-gray-400 leading-relaxed italic border-t border-white/5 pt-2 max-w-md">
                        <?php echo e($hero->deskripsi ?? 'Crafting digital products...'); ?></p>
                </div>

                <div class="space-y-4">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Headline / Title</label>
                        <input type="text" id="input-headline" name="text_singkat"
                            value="<?php echo e($hero->text_singkat ?? 'Undergraduate University of Brawijaya'); ?>"
                            oninput="updatePreview('preview-headline', this.value)"
                            class="w-full form-input-custom rounded-sm px-4 py-2.5 text-xs">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Short Biography</label>
                        <textarea id="input-bio" name="deskripsi" rows="3" oninput="updatePreview('preview-bio', this.value)"
                            class="w-full form-input-custom rounded-sm px-4 py-2.5 text-xs leading-relaxed resize-none"><?php echo e($hero->deskripsi ?? 'Crafting digital products with immersive aesthetics since 2016.'); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="col-span-12 card-custom rounded-sm overflow-hidden relative">
                <div
                    class="absolute top-0 right-0 p-3 text-[8px] font-black text-[#730c1e] uppercase tracking-[0.2em] opacity-40 z-10">
                    Section 03 / Assets & CTA</div>

                <div class="grid grid-cols-12">

                    <div class="col-span-12 md:col-span-8 p-8 border-b md:border-b-0 md:border-r border-white/5">
                        <div class="max-w-md space-y-6">
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-bold uppercase tracking-wider text-gray-400 flex items-center gap-2">
                                    <i data-lucide="link" class="w-3 h-3"></i> Destination Link (CV/Contact)
                                </label>
                                <input type="text" name="link_cv" value="<?php echo e($hero->link_cv ?? '#contact'); ?>"
                                    class="w-full form-input-custom rounded-sm px-4 py-2.5 text-xs font-mono">
                            </div>

                            <div class="pt-4">
                                <p class="text-[9px] text-gray-500 uppercase tracking-widest mb-3">Button Preview</p>
                                <div
                                    class="px-10 py-3 bg-white text-black text-[10px] font-black uppercase tracking-[0.2em] inline-block rounded-sm shadow-lg shadow-white/5">
                                    Get in Touch
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-4 bg-black/20 p-8 flex flex-col items-center justify-center">
                        <div class="relative group">
                            <div class="w-40 h-52 border border-white/10 rounded-sm overflow-hidden bg-[#110e13] relative">
                                <?php if($hero->path_foto): ?>
                                    <img id="preview-portrait" src="<?php echo e(asset('storage/' . $hero->path_foto)); ?>"
                                        class="w-full h-full object-cover grayscale transition-all duration-500 group-hover:grayscale-0 group-hover:scale-105">
                                <?php else: ?>
                                    <div id="no-preview"
                                        class="w-full h-full flex items-center justify-center text-[10px] text-gray-600 italic uppercase tracking-tighter">
                                        No Preview</div>
                                    <img id="preview-portrait" src=""
                                        class="hidden w-full h-full object-cover grayscale">
                                <?php endif; ?>

                                <label for="portrait"
                                    class="absolute inset-0 flex flex-col items-center justify-center bg-black/80 opacity-0 group-hover:opacity-100 cursor-pointer transition-all">
                                    <i data-lucide="camera" class="w-6 h-6 text-white mb-2"></i>
                                    <span class="text-[9px] font-black text-white uppercase tracking-widest">Update
                                        Photo</span>
                                </label>
                            </div>
                            <input type="file" id="portrait" name="path_foto" class="hidden"
                                onchange="previewImage(event)">
                            <p class="mt-3 text-[8px] text-center text-gray-500 uppercase tracking-widest font-medium">
                                Recommended: 4:5 Aspect Ratio</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit"
            class="btn-push w-full mt-8 flex gap-2 bg-[#730c1e] hover:bg-[#921126] hover:translate-y-0.5 justify-center items-center card-custom p-4 rounded-sm bottom-6 z-20 shadow-2xl">
            <i data-lucide="check" class="w-4 h-4"></i>
            Submit Changes
        </button>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/profile.js']); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/profile.blade.php ENDPATH**/ ?>