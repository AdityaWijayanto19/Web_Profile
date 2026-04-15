<?php $__env->startSection('title', 'Add New Technology - Pie'); ?>
<?php $__env->startSection('page_title', 'Add New Technology'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl px-4 mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <a href="<?php echo e(route('technologies.index')); ?>"
                class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-[#730c1e] transition-colors group">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                BACK TO TECHNOLOGIES
            </a>
        </div>

        <form action="<?php echo e(route('technologies.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="space-y-6">
                <!-- FORM CARD -->
                <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden shadow-2xl">
                    <div class="p-5 border-b border-white/5 bg-black/20">
                        <h3 class="text-white text-sm font-semibold flex items-center gap-2">
                            <i data-lucide="plus-circle" class="w-4 h-4 text-[#730c1e]"></i>
                            Technology Information
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Technology Name -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Technology
                                Name</label>
                            <input type="text" name="nama" placeholder="e.g. React, Laravel, PostgreSQL"
                                value="<?php echo e(old('nama')); ?>"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-xs text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Icon Selection -->
                        <div class="space-y-3">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Simple Icons Icon
                                Name</label>
                            <div class="space-y-2">
                                <input type="text" name="path_icon" id="icon-input"
                                    placeholder="e.g. react, laravel, ubuntu, python" value="<?php echo e(old('path_icon')); ?>"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all text-sm <?php $__errorArgs = ['path_icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <?php $__errorArgs = ['path_icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-xs text-red-500"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Live Preview -->
                            <div
                                class="bg-black/40 border border-white/5 rounded-sm p-4 flex items-center justify-center min-h-24">
                                <div class="text-center">
                                    <div id="icon-preview" class="mb-3">
                                        <i data-lucide="help-circle" class="w-12 h-12 text-gray-600 mx-auto"></i>
                                    </div>
                                    <p id="icon-name" class="text-xs text-gray-500">Type icon name to preview</p>
                                    <p id="icon-status" class="text-[9px] text-gray-600 mt-1"></p>
                                </div>
                            </div>

                            <!-- Icon Reference Link -->
                            <p class="text-[9px] text-gray-500 italic space-y-1">
                            <div>Browse icons at <a href="https://simpleicons.org/" target="_blank"
                                    class="text-[#730c1e] hover:underline">simpleicons.org</a></div>
                            <div>Use the exact name (lowercase, e.g. "react", "laravel", "ubuntu")</div>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <a href="<?php echo e(route('technologies.index')); ?>"
                        class="flex items-center justify-center bg-white/5 hover:bg-white/10 text-gray-400 py-3 rounded-sm text-[11px] font-bold transition-all border border-white/5 uppercase tracking-widest">
                        CANCEL
                    </a>
                    <button type="submit"
                        class="w-full bg-[#730c1e] hover:bg-[#911226] text-white py-3 rounded-sm text-[11px] font-bold tracking-[0.3em] transition-all active:scale-[0.98] shadow-lg shadow-[#730c1e]/20">
                        PUBLISH CREDENTIAL
                    </button>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        lucide.createIcons();

        const iconInput = document.getElementById('icon-input');
        const iconPreview = document.getElementById('icon-preview');
        const iconName = document.getElementById('icon-name');
        const iconStatus = document.getElementById('icon-status');
        let previewTimeout;

        iconInput.addEventListener('input', function() {
            clearTimeout(previewTimeout);

            if (!this.value.trim()) {
                iconPreview.innerHTML = `<i data-lucide="help-circle" class="w-12 h-12 text-gray-600 mx-auto"></i>`;
                iconName.textContent = 'Type icon name to preview';
                iconStatus.textContent = '';
                return;
            }

            iconStatus.textContent = 'Loading...';
            iconStatus.style.color = '#888';

            previewTimeout = setTimeout(() => {
                const iconPath = this.value.toLowerCase().trim();
                const cdnUrl = `https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/${iconPath}.svg`;

                // Try to fetch the icon
                fetch(cdnUrl, {
                        method: 'HEAD'
                    })
                    .then(response => {
                        if (response.ok) {
                            iconPreview.innerHTML =
                                `<img src="${cdnUrl}" alt="${iconPath}" class="w-12 h-12 mx-auto" style="filter: invert(1);">`;
                            iconName.textContent = iconPath;
                            iconStatus.textContent = '✓ Icon found';
                            iconStatus.style.color = '#730c1e';
                        } else {
                            iconPreview.innerHTML =
                                `<i data-lucide="alert-circle" class="w-12 h-12 text-red-600 mx-auto"></i>`;
                            iconName.textContent = iconPath;
                            iconStatus.textContent = '✗ Icon not found';
                            iconStatus.style.color = '#ef4444';
                        }
                    })
                    .catch(() => {
                        iconPreview.innerHTML =
                            `<i data-lucide="alert-circle" class="w-12 h-12 text-red-600 mx-auto"></i>`;
                        iconName.textContent = iconPath;
                        iconStatus.textContent = '✗ Icon not found';
                        iconStatus.style.color = '#ef4444';
                    });
            }, 500);
        });

        // Trigger on page load if icon was pre-filled
        if (iconInput.value) {
            iconInput.dispatchEvent(new Event('input'));
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/technology/create.blade.php ENDPATH**/ ?>