<?php $__env->startSection('title', 'Hero Manager - FoxHR'); ?>
<?php $__env->startSection('page_title', 'Hero Section Manager'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Custom Input Style agar senada dengan halaman lain */
    .form-input-custom {
        background-color: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        transition: all 0.2s;
    }
    .form-input-custom:focus {
        border-color: #730c1e;
        outline: none;
        background-color: rgba(255, 255, 255, 0.03);
    }
    .btn-push {
        background-color: #730c1e;
        box-shadow: 0 4px 15px rgba(115, 12, 30, 0.2);
    }
    .btn-push:hover {
        background-color: #921126;
        transform: translateY(-1px);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<form action="" method="POST" enctype="multipart/form-data" class="max-w-6xl mx-auto">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="grid grid-cols-12 gap-4">

        <!-- ELEMENT 1: IDENTITY -->
        <div class="col-span-12 lg:col-span-7 bg-[#1a151d] rounded-sm p-5 border border-white/5 relative shadow-sm">
            <div class="absolute top-3 right-4 text-[8px] font-black text-[#730c1e] uppercase tracking-widest opacity-60">Identity</div>

            <div class="mb-6 min-h-[80px] flex flex-col justify-center border-l-2 border-[#730c1e] pl-4">
                <h1 id="preview-first-name" class="text-3xl md:text-4xl font-bold text-white tracking-tighter leading-none uppercase">ADITYA P.</h1>
                <h1 id="preview-last-name" class="text-3xl md:text-4xl font-bold text-[#730c1e] italic tracking-tighter leading-none uppercase">WIJAYANTO</h1>
            </div>

            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-white/5">
                <div class="space-y-1.5">
                    <label class="text-[9px] font-bold uppercase tracking-widest text-gray-500">First Name & Initial</label>
                    <input type="text" id="input-first-name" name="first_name" value="ADITYA P."
                        oninput="updatePreview('preview-first-name', this.value)"
                        class="w-full form-input-custom rounded-sm px-3 py-2 text-xs">
                </div>
                <div class="space-y-1.5">
                    <label class="text-[9px] font-bold uppercase tracking-widest text-gray-500">Last Name</label>
                    <input type="text" id="input-last-name" name="last_name" value="WIJAYANTO"
                        oninput="updatePreview('preview-last-name', this.value)"
                        class="w-full form-input-custom rounded-sm px-3 py-2 text-xs">
                </div>
            </div>
        </div>

        <!-- ELEMENT 2: ECHO BACKGROUND -->
        <div class="col-span-12 lg:col-span-5 bg-[#1a151d] rounded-sm p-5 border border-white/5 flex flex-col justify-between relative shadow-sm">
            <div class="absolute top-3 right-4 text-[8px] font-black text-[#730c1e] uppercase tracking-widest opacity-60">Background</div>
            <div class="flex-1 flex items-center justify-center overflow-hidden py-4">
                <span id="preview-echo" class="text-4xl font-black text-white/[0.03] uppercase tracking-tighter select-none">CREATIVE</span>
            </div>
            <div class="space-y-1.5 pt-4 border-t border-white/5">
                <label class="text-[9px] font-bold uppercase tracking-widest text-gray-500">Echo Text</label>
                <input type="text" id="input-echo" name="echo_text" value="CREATIVE"
                    oninput="updatePreview('preview-echo', this.value)"
                    class="w-full form-input-custom rounded-sm px-3 py-2 text-xs">
            </div>
        </div>

        <!-- ELEMENT 3: COPYWRITING -->
        <div class="col-span-12 lg:col-span-8 bg-[#1a151d] rounded-sm p-5 border border-white/5 space-y-5 relative shadow-sm">
            <div class="absolute top-3 right-4 text-[8px] font-black text-[#730c1e] uppercase tracking-widest opacity-60">Copywriting</div>
            <div class="space-y-2 pb-4 border-b border-white/5">
                <p id="preview-headline" class="text-[10px] uppercase tracking-[0.3em] text-gray-400 font-bold">Undergraduate University of Brawijaya</p>
                <p id="preview-bio" class="text-xs text-gray-500 leading-relaxed max-w-xl italic">
                    Crafting <span class="text-white border-b border-[#730c1e]/40 font-medium">high-performance</span> digital products...
                </p>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div class="space-y-1.5">
                    <label class="text-[9px] font-bold uppercase tracking-widest text-gray-500">Headline</label>
                    <input type="text" id="input-headline" name="headline" value="Undergraduate University of Brawijaya"
                        oninput="updatePreview('preview-headline', this.value)"
                        class="w-full form-input-custom rounded-sm px-3 py-2 text-xs">
                </div>
                <div class="space-y-1.5">
                    <label class="text-[9px] font-bold uppercase tracking-widest text-gray-500">Biography</label>
                    <textarea id="input-bio" name="bio" rows="2"
                        oninput="updatePreview('preview-bio', this.value)"
                        class="w-full form-input-custom rounded-sm px-3 py-2 text-xs leading-relaxed">Crafting digital products with immersive aesthetics since 2016.</textarea>
                </div>
            </div>
        </div>

        <!-- ELEMENT 4: SYSTEM METRICS -->
        <div class="col-span-12 lg:col-span-4 bg-[#1a151d] rounded-sm p-5 border border-white/5 flex flex-col justify-between relative shadow-sm">
            <div class="absolute top-3 right-4 text-[8px] font-black text-[#730c1e] uppercase tracking-widest opacity-60">Metrics</div>
            <div class="flex items-center gap-6 py-2">
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-white tracking-tighter italic">0</h3>
                    <p class="text-[8px] uppercase tracking-widest text-gray-500 font-black">Years</p>
                </div>
                <div class="h-8 w-[1px] bg-white/5"></div>
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-white tracking-tighter italic">5+</h3>
                    <p class="text-[8px] uppercase tracking-widest text-gray-500 font-black">Projects</p>
                </div>
            </div>
            <div class="bg-black/20 p-3 rounded-sm border border-white/5 mt-4">
                <p class="text-[9px] text-gray-500 leading-relaxed italic">Values are synced from database.</p>
            </div>
        </div>

        <!-- ELEMENT 5: VISUAL & ACTION -->
        <div class="col-span-12 bg-[#1a151d] rounded-sm border border-white/5 overflow-hidden grid grid-cols-12 relative shadow-sm">
            <div class="col-span-12 md:col-span-8 p-6 flex flex-col justify-center space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-bold uppercase tracking-widest text-gray-500">Destination URL</label>
                        <input type="text" name="cta_link" value="#contact" class="w-full form-input-custom rounded-sm px-3 py-2 text-xs">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-bold uppercase tracking-widest text-gray-500">Button Label</label>
                        <input type="text" id="input-cta-label" name="cta_label" value="Get in Touch"
                            oninput="updatePreview('preview-cta-label', this.value)"
                            class="w-full form-input-custom rounded-sm px-3 py-2 text-xs">
                    </div>
                </div>
                <div id="preview-cta-label" class="px-8 py-3 bg-white text-black text-[10px] font-black uppercase tracking-widest inline-block rounded-sm w-max">
                    Get in Touch
                </div>
            </div>

            <div class="col-span-12 md:col-span-4 bg-black/40 p-6 flex flex-col items-center justify-center border-l border-white/5">
                <div class="relative group w-32 h-40 border border-dashed border-white/10 rounded-sm flex items-center justify-center overflow-hidden">
                    <img id="preview-portrait" src="<?php echo e(asset('assets/images/me.png')); ?>" class="w-full h-full object-cover grayscale opacity-40 group-hover:opacity-100 transition-all">
                    <label for="portrait" class="absolute inset-0 flex flex-col items-center justify-center bg-black/80 opacity-0 group-hover:opacity-100 cursor-pointer transition-all">
                        <i data-lucide="upload-cloud" class="w-6 h-6 text-white mb-1"></i>
                        <span class="text-[8px] font-bold text-white uppercase tracking-tighter">Replace</span>
                    </label>
                    <input type="file" id="portrait" name="portrait" class="hidden" onchange="previewImage(event)">
                </div>
            </div>
        </div>

    </div>

    <!-- ACTION BAR -->
    <div class="mt-6 flex justify-between items-center bg-[#1a151d] p-3 rounded-sm border border-white/5">
        <span class="text-[9px] text-gray-600 uppercase font-bold tracking-widest pl-2 italic">Ready for production</span>
        <button type="submit" class="btn-push text-white px-8 py-2.5 rounded-sm font-bold text-[10px] uppercase tracking-[0.2em] flex items-center gap-2 transition-all">
            <i data-lucide="zap" class="w-3.5 h-3.5"></i>
            Push to Production
        </button>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    lucide.createIcons();
    function updatePreview(id, val) {
        document.getElementById(id).innerText = val;
    }
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('preview-portrait').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/profile.blade.php ENDPATH**/ ?>