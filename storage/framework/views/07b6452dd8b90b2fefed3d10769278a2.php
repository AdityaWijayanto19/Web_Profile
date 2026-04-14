<?php $__env->startSection('title', 'Modify Certification - Preview Mode'); ?>
<?php $__env->startSection('page_title', 'Update Credential'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <!-- HEADER NAV -->
    <div class="flex justify-between items-center mb-6">
        <a href="<?php echo e(route('sertifikats.index')); ?>" class="flex items-center gap-2 text-[10px] font-bold tracking-widest text-gray-500 hover:text-white transition-colors">
            <i data-lucide="arrow-left-right" class="w-3 h-3 text-[#730c1e]"></i> SWITCH TO LIST
        </a>
        <div class="flex items-center gap-2">
            <span class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">ID: <?php echo e(str_pad($sertifikat->id, 4, '0', STR_PAD_LEFT)); ?></span>
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
        </div>
    </div>

    <form action="<?php echo e(route('sertifikats.update', $sertifikat)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- LEFT: FORM -->
            <div class="lg:col-span-7 space-y-4">
                <div class="bg-[#1a151e] border border-[#730c1e]/20 p-6 rounded-sm shadow-2xl relative overflow-hidden">
                    <!-- Subtle Glow Effect -->
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#730c1e]/5 blur-[50px] rounded-full"></div>

                    <h3 class="text-xs font-bold text-white uppercase tracking-widest mb-6 flex justify-between items-center relative z-10">
                        Configuration
                        <i data-lucide="settings-2" class="w-3.5 h-3.5 text-[#730c1e]"></i>
                    </h3>

                    <div class="space-y-5 relative z-10">
                        <div>
                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-wider">Certification Name</label>
                            <input type="text" name="nama_sertifikat"
                                class="w-full bg-black/60 border border-white/5 rounded-sm px-4 py-2.5 text-white text-xs focus:border-[#730c1e] outline-none transition-all font-medium <?php $__errorArgs = ['nama_sertifikat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('nama_sertifikat', $sertifikat->nama_sertifikat)); ?>">
                            <?php $__errorArgs = ['nama_sertifikat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-[9px] text-red-400 mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-wider">Publisher/Organization</label>
                            <input type="text" name="penerbit"
                                class="w-full bg-black/60 border border-white/5 rounded-sm px-4 py-2.5 text-white text-xs focus:border-[#730c1e] outline-none transition-all font-medium <?php $__errorArgs = ['penerbit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('penerbit', $sertifikat->penerbit)); ?>">
                            <?php $__errorArgs = ['penerbit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-[9px] text-red-400 mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-wider">Year Obtained</label>
                            <input type="number" name="tahun" min="1900" max="<?php echo e(date('Y')); ?>"
                                class="w-full bg-black/60 border border-white/5 rounded-sm px-4 py-2.5 text-white text-xs focus:border-[#730c1e] outline-none transition-all font-medium <?php $__errorArgs = ['tahun'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('tahun', $sertifikat->tahun)); ?>">
                            <?php $__errorArgs = ['tahun'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-[9px] text-red-400 mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-wider">Credential ID (Optional)</label>
                            <input type="text" name="id_kredensial"
                                class="w-full bg-black/60 border border-white/5 rounded-sm px-4 py-2.5 text-white text-xs focus:border-[#730c1e] outline-none transition-all font-medium <?php $__errorArgs = ['id_kredensial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('id_kredensial', $sertifikat->id_kredensial)); ?>">
                            <?php $__errorArgs = ['id_kredensial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-[9px] text-red-400 mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-wider">Credential Link (Optional)</label>
                            <input type="url" name="link_kredensial"
                                class="w-full bg-black/60 border border-white/5 rounded-sm px-4 py-2.5 text-white text-xs focus:border-[#730c1e] outline-none transition-all font-medium <?php $__errorArgs = ['link_kredensial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('link_kredensial', $sertifikat->link_kredensial)); ?>">
                            <?php $__errorArgs = ['link_kredensial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-[9px] text-red-400 mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-wider">Description (Optional)</label>
                            <textarea name="deskripsi"
                                class="w-full bg-black/60 border border-white/5 rounded-sm px-4 py-2.5 text-white text-xs focus:border-[#730c1e] outline-none transition-all font-medium <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                rows="3"><?php echo e(old('deskripsi', $sertifikat->deskripsi)); ?></textarea>
                            <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-[9px] text-red-400 mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <button type="submit" class="bg-[#730c1e] hover:bg-[#911226] text-white py-3 rounded-sm text-[11px] font-bold tracking-[0.3em] transition-all active:scale-95 shadow-lg shadow-[#730c1e]/10">
                        SAVE CHANGES
                    </button>
                    <a href="<?php echo e(route('sertifikats.index')); ?>" class="flex items-center justify-center bg-white/5 hover:bg-white/10 text-gray-400 py-3 rounded-sm text-[11px] font-bold transition-all border border-white/5 uppercase tracking-widest">
                        CANCEL
                    </a>
                </div>
            </div>

            <!-- RIGHT: CURRENT STATE PREVIEW -->
            <div class="lg:col-span-5 space-y-4">
                <div class="bg-[#1a151e] border border-white/5 p-5 rounded-sm shadow-xl">
                    <span class="text-[9px] text-gray-600 font-bold uppercase tracking-[0.2em] mb-4 block">Live Modification Preview</span>

                    <!-- MOCKUP CARD -->
                    <div class="relative aspect-video rounded-sm overflow-hidden shadow-2xl border border-white/10 bg-black group">
                        <!-- Current Image Background -->
                        <div id="mock-bg" class="absolute inset-0 bg-cover bg-center transition-all duration-700 opacity-60"
                             <?php if($sertifikat->path_gambar): ?>
                                 style="background-image: url('<?php echo e(asset('storage/' . $sertifikat->path_gambar)); ?>')"
                             <?php else: ?>
                                 style="background-image: url('https://images.unsplash.com/photo-1614850523296-d8c1af93d400?q=80&w=600')"
                             <?php endif; ?>></div>

                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>

                        <!-- Content on Card -->
                        <div class="absolute bottom-4 left-4 flex items-center gap-3">
                            <div id="mock-icon-bg" class="w-9 h-9 bg-[#730c1e] flex items-center justify-center rounded-sm shadow-xl shadow-[#730c1e]/30">
                                <i data-lucide="certificate" id="mock-icon" class="w-4 h-4 text-white"></i>
                            </div>
                            <div class="space-y-0.5">
                                <h4 id="mock-title" class="text-[11px] font-bold text-white uppercase leading-none tracking-tight"><?php echo e($sertifikat->nama_sertifikat); ?></h4>
                                <p id="mock-subtitle" class="text-[9px] text-gray-400 font-medium uppercase tracking-tighter"><?php echo e($sertifikat->penerbit); ?></p>
                            </div>
                        </div>

                        <!-- Upload Image -->
                        <label class="absolute top-2 right-2 p-2 bg-black/60 rounded-sm border border-white/10 cursor-pointer hover:bg-[#730c1e] transition-all opacity-0 group-hover:opacity-100 backdrop-blur-sm">
                            <i data-lucide="camera" class="w-3.5 h-3.5 text-white"></i>
                            <input type="file" name="path_gambar" id="image-input" class="hidden" accept="image/*">
                        </label>
                    </div>

                    <!-- Information Alert Box -->
                    <div class="mt-5 p-3 bg-[#730c1e]/5 border-l-2 border-[#730c1e] rounded-sm">
                        <p class="text-[9px] text-gray-400 leading-relaxed italic uppercase tracking-tighter flex items-start gap-2">
                            <i data-lucide="info" class="w-3 h-3 text-[#730c1e] shrink-0 mt-0.5"></i>
                            Modification mode active. Preview represents the final layout on the public interface.
                        </p>
                    </div>
                </div>

                <!-- QUICK TIPS CARD -->
                <div class="bg-black/40 border border-white/5 p-4 rounded-sm">
                   <h5 class="text-[9px] text-gray-500 font-bold uppercase mb-2 tracking-widest">Asset Standard</h5>
                   <ul class="text-[8px] text-gray-600 space-y-1 uppercase font-medium">
                       <li class="flex items-center gap-2"><div class="w-1 h-1 bg-[#730c1e]"></div> Ratio: 16:9 Landscape</li>
                       <li class="flex items-center gap-2"><div class="w-1 h-1 bg-[#730c1e]"></div> Max File: 5MB (WebP Preferred)</li>
                   </ul>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Initialize Icons
    lucide.createIcons();

    // Real Input Interactivity
    const mockTitle = document.getElementById('mock-title');
    const mockSubtitle = document.getElementById('mock-subtitle');
    const mockBg = document.getElementById('mock-bg');

    // Update Title Live
    document.querySelector('input[name="nama_sertifikat"]').addEventListener('input', (e) => {
        mockTitle.innerText = e.target.value || 'CERTIFICATION';
    });

    // Update Subtitle Live
    document.querySelector('input[name="penerbit"]').addEventListener('input', (e) => {
        mockSubtitle.innerText = e.target.value || 'PUBLISHER';
    });

    // Update Image Live
    document.getElementById('image-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                mockBg.style.backgroundImage = `url('${event.target.result}')`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/sertifikat/edit.blade.php ENDPATH**/ ?>