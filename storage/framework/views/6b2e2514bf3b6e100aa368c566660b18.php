<?php $__env->startSection('title', 'Edit Footer'); ?>
<?php $__env->startSection('page_title', 'Edit Footer'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4">
        <div class="mb-6">
            <a href="<?php echo e(route('admin.footer.index')); ?>"
                class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-[#730c1e] transition-colors group">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                BACK TO FOOTER
            </a>
        </div>

        <div class="bg-[#1a151d] border border-white/5 rounded-sm p-6">
            <h2 class="text-lg font-semibold text-white mb-4">Edit Footer</h2>

            <form action="<?php echo e(route('admin.footer.update', $footer->id)); ?>" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Nama Website -->
                <div>
                    <label for="nama_web" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Website Name
                    </label>
                    <input type="text" id="nama_web" name="nama_web" value="<?php echo e(old('nama_web', $footer->nama_web)); ?>"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-sm placeholder-gray-600 focus:outline-none focus:border-[#730c1e] transition-colors"
                        placeholder="e.g., Pie Studio" required>
                    <?php $__errorArgs = ['nama_web'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Description
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-sm placeholder-gray-600 focus:outline-none focus:border-[#730c1e] transition-colors"
                        placeholder="Website description..." required><?php echo e(old('deskripsi', $footer->deskripsi)); ?></textarea>
                    <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Email
                    </label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email', $footer->email)); ?>"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-sm placeholder-gray-600 focus:outline-none focus:border-[#730c1e] transition-colors"
                        placeholder="contact@example.com">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- No HP -->
                <div>
                    <label for="no_hp" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Phone Number
                    </label>
                    <input type="text" id="no_hp" name="no_hp" value="<?php echo e(old('no_hp', $footer->no_hp)); ?>"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-sm placeholder-gray-600 focus:outline-none focus:border-[#730c1e] transition-colors"
                        placeholder="+62 81234567890">
                    <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Logo -->
                <div>
                    <label for="logo_path" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Logo
                    </label>
                    <?php if($footer->logo_path): ?>
                        <div class="mb-2">
                            <img src="<?php echo e(asset('storage/' . $footer->logo_path)); ?>" alt="Current logo"
                                class="w-16 h-16 rounded-xs object-cover border border-white/10">
                        </div>
                    <?php endif; ?>
                    <input type="file" id="logo_path" name="logo_path" accept="image/*"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-gray-400 text-sm focus:outline-none focus:border-[#730c1e] transition-colors">
                    <p class="text-gray-500 text-xs mt-1">Max 2MB. Format: JPEG, PNG, JPG, GIF, WebP. Leave empty to keep
                        current.</p>
                    <?php $__errorArgs = ['logo_path'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Media Sosial -->
                <div class="border-t border-white/5 pt-4">
                    <div class="flex justify-between items-center mb-3">
                        <label class="block text-xs font-semibold text-gray-300 uppercase tracking-wider">
                            Social Media
                        </label>
                        <button type="button" id="add-media-btn"
                            class="text-xs text-[#730c1e] hover:text-[#921126] font-semibold transition-colors">
                            + Add Social
                        </button>
                    </div>

                    <div id="media-container" class="space-y-2">
                        <?php $__empty_1 = true; $__currentLoopData = $footer->mediaSozials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="media-item flex gap-2 items-start">
                                <select name="media_sozials[<?php echo e($index); ?>][technology_id]"
                                    class="flex-1 px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-xs focus:outline-none focus:border-[#730c1e]"
                                    required>
                                    <option value="">Select Social Media</option>
                                    <?php $__currentLoopData = $technologies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tech->id); ?>"
                                            <?php echo e($tech->id == $media->technology_id ? 'selected' : ''); ?>>
                                            <?php echo e($tech->nama); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <input type="url" name="media_sozials[<?php echo e($index); ?>][url]"
                                    value="<?php echo e($media->url); ?>" placeholder="https://..."
                                    class="flex-1 px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-xs placeholder-gray-600 focus:outline-none focus:border-[#730c1e]"
                                    required>
                                <button type="button"
                                    class="remove-media px-2 py-2 hover:bg-red-600/20 text-gray-400 hover:text-red-400 rounded-xs transition-colors"
                                    title="Remove">
                                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>

                    <?php $__errorArgs = ['media_sozials'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Urutan -->
                <div>
                    <label for="urutan" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Order
                    </label>
                    <input type="number" id="urutan" name="urutan" value="<?php echo e(old('urutan', $footer->urutan)); ?>"
                        min="0"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-sm placeholder-gray-600 focus:outline-none focus:border-[#730c1e] transition-colors">
                    <?php $__errorArgs = ['urutan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Submit -->
                <div class="flex gap-2 pt-2">
                    <button type="submit"
                        class="flex-1 bg-[#730c1e] hover:bg-[#921126] text-white px-3 py-2 rounded-xs text-xs font-bold uppercase tracking-widest transition-colors">
                        Update Footer
                    </button>
                    <a href="<?php echo e(route('admin.footer.index')); ?>"
                        class="px-3 py-2 bg-white/5 hover:bg-white/10 text-gray-300 rounded-xs text-xs font-bold uppercase tracking-widest transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdn.jsdelivr.net/npm/lucide@latest"></script>
        <script>
            const technologies = <?php echo json_encode($technologies, 15, 512) ?>;
            const mediaContainer = document.getElementById('media-container');
            const addMediaBtn = document.getElementById('add-media-btn');

            function attachRemoveHandlers() {
                document.querySelectorAll('.remove-media').forEach(btn => {
                    btn.addEventListener('click', function() {
                        this.closest('.media-item').remove();
                        reorderMediaInputs();
                        lucide.createIcons();
                    });
                });
            }

            function renderMediaItem(index) {
                const item = document.createElement('div');
                item.className = 'media-item flex gap-2 items-start';
                item.innerHTML = `
                    <select name="media_sozials[${index}][technology_id]"
                        class="flex-1 px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-xs focus:outline-none focus:border-[#730c1e]" required>
                        <option value="">Select Social Media</option>
                        ${technologies.map(t => `<option value="${t.id}">${t.nama}</option>`).join('')}
                    </select>
                    <input type="url" name="media_sozials[${index}][url]" placeholder="https://..."
                        class="flex-1 px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-white text-xs placeholder-gray-600 focus:outline-none focus:border-[#730c1e]" required>
                    <button type="button" class="remove-media px-2 py-2 hover:bg-red-600/20 text-gray-400 hover:text-red-400 rounded-xs transition-colors" title="Remove">
                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                    </button>
                `;
                return item;
            }

            function reorderMediaInputs() {
                const items = mediaContainer.querySelectorAll('.media-item');
                items.forEach((item, index) => {
                    item.querySelectorAll('input, select').forEach(input => {
                        const name = input.getAttribute('name');
                        if (name) {
                            input.setAttribute('name', name.replace(/\[\d+\]/, `[${index}]`));
                        }
                    });
                });
            }

            addMediaBtn.addEventListener('click', () => {
                const items = mediaContainer.querySelectorAll('.media-item');
                const newItem = renderMediaItem(items.length);
                mediaContainer.appendChild(newItem);
                attachRemoveHandlers();
                lucide.createIcons();
            });

            // Initialize
            attachRemoveHandlers();
            lucide.createIcons();
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/footer/edit.blade.php ENDPATH**/ ?>