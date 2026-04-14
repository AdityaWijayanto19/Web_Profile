<?php $__env->startSection('title', 'Edit Certification'); ?>
<?php $__env->startSection('page_title', 'Edit Credential'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4">
        <!-- HEADER NAV -->
        <div class="flex justify-between items-center mb-6">
            <a href="<?php echo e(route('sertifikats.index')); ?>"
                class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-[#730c1e] transition-colors group">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                BACK TO CERTIFICATIONS
            </a>
            <div class="flex items-center gap-2">
                <span class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">ID:
                    <?php echo e(str_pad($sertifikat->id, 4, '0', STR_PAD_LEFT)); ?></span>
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
            </div>
        </div>

        <form action="<?php echo e(route('sertifikats.update', $sertifikat)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- LEFT: INPUT FIELDS -->
                <div class="lg:col-span-7 space-y-4">
                    <div class="bg-[#1a151e] border border-white/5 p-6 rounded-sm relative shadow-2xl">
                        <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-[#730c1e] to-transparent">
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label
                                    class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Certification
                                    Name</label>
                                <input type="text" name="nama_sertifikat" placeholder="e.g. GOOGLE CERTIFIED"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all <?php $__errorArgs = ['nama_sertifikat'];
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
                                <label
                                    class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Publisher/Organization</label>
                                <input type="text" name="penerbit" placeholder="e.g. Google, Meta, Microsoft"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all <?php $__errorArgs = ['penerbit'];
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
                                <label
                                    class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Year
                                    Obtained</label>
                                <input type="number" name="tahun" placeholder="e.g. 2024" min="1900"
                                    max="<?php echo e(date('Y')); ?>"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all <?php $__errorArgs = ['tahun'];
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
                                <label
                                    class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Credential
                                    ID (Optional)</label>
                                <input type="text" name="id_kredensial" placeholder="e.g. CERT-12345"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all <?php $__errorArgs = ['id_kredensial'];
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
                                <label
                                    class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Credential
                                    Link (Optional)</label>
                                <input type="url" name="link_kredensial"
                                    placeholder="https://credentials.example.com/cert/123"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all <?php $__errorArgs = ['link_kredensial'];
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
                                <label
                                    class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-widest">Description
                                    (Optional)</label>
                                <textarea name="deskripsi" placeholder="Add any additional details about this certification..."
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2 text-white text-xs focus:border-[#730c1e] outline-none transition-all <?php $__errorArgs = ['deskripsi'];
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
                        <a href="<?php echo e(route('sertifikats.index')); ?>"
                            class="flex items-center justify-center bg-white/5 hover:bg-white/10 text-gray-400 py-3 rounded-sm text-[11px] font-bold transition-all border border-white/5 uppercase tracking-widest">
                            CANCEL
                        </a>
                        <button type="submit"
                            class="bg-[#730c1e] hover:bg-[#911226] text-white py-3 rounded-sm text-[11px] font-bold tracking-[0.3em] transition-all active:scale-95 shadow-lg shadow-[#730c1e]/10">
                            SAVE CHANGES
                        </button>
                    </div>
                </div>

                <!-- RIGHT: PREVIEW & UPLOAD -->
                <div class="lg:col-span-5 space-y-4">
                    <div class="bg-[#1a151e] border border-white/5 p-4 rounded-sm shadow-xl">
                        <span class="text-[9px] text-gray-600 font-bold uppercase tracking-widest mb-3 block">Live Component
                            Preview</span>

                        <div class="relative aspect-video rounded-sm overflow-hidden border border-white/5 bg-black">
                            <div id="mock-bg"
                                class="absolute inset-0 bg-cover bg-center transition-all duration-700 opacity-60"
                                <?php if($sertifikat->path_gambar): ?> style="background-image: url('<?php echo e(asset('storage/' . $sertifikat->path_gambar)); ?>')"
                             <?php else: ?>
                                 style="background-image: url('https://images.unsplash.com/photo-1614850523296-d8c1af93d400?q=80&w=600')" <?php endif; ?>>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>

                            <div class="absolute bottom-3 left-3 flex items-center gap-2">
                                <div>
                                    <h4 id="mock-title" class="text-[10px] font-bold text-white uppercase tracking-tight">
                                        CERTIFICATION</h4>
                                    <p id="mock-subtitle" class="text-[8px] text-gray-400 uppercase">PUBLISHER</p>
                                </div>
                            </div>

                            <!-- Upload Overlay -->
                            <label
                                class="absolute inset-0 flex flex-col items-center justify-center bg-black/60 opacity-0 hover:opacity-100 transition-opacity cursor-pointer">
                                <i data-lucide="upload-cloud" class="w-6 h-6 text-white mb-1"></i>
                                <span class="text-[9px] font-bold text-white tracking-widest">REPLACE BG</span>
                                <input type="file" name="path_gambar" id="image-input" class="hidden" accept="image/*">
                            </label>
                        </div>
                        <p class="text-[9px] text-gray-500 mt-3 text-center italic">*Recommended: 800x500px dark themed
                            image</p>
                        <?php $__errorArgs = ['path_gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[9px] text-red-400 mt-2 text-center"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        lucide.createIcons();
        const mockTitle = document.getElementById('mock-title');
        const mockSubtitle = document.getElementById('mock-subtitle');
        const mockBg = document.getElementById('mock-bg');

        document.querySelector('input[name="nama_sertifikat"]').oninput = (e) => mockTitle.innerText = e.target.value ||
            'CERTIFICATION';
        document.querySelector('input[name="penerbit"]').oninput = (e) => mockSubtitle.innerText = e.target.value ||
            'PUBLISHER';

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