

<?php $__env->startSection('title', 'Create Footer'); ?>
<?php $__env->startSection('page_title', 'Create Footer'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-2xl mx-auto px-4">
        <a href="<?php echo e(route('admin.footer.index')); ?>"
            class="inline-flex items-center gap-1 text-xs text-gray-400 hover:text-white mb-4 transition-colors">
            <i data-lucide="arrow-left" class="w-3 h-3"></i>
            Back
        </a>

        <div class="bg-[#1a151d] border border-white/5 rounded-sm p-6">
            <h2 class="text-lg font-semibold text-white mb-4">Add New Footer</h2>

            <form action="<?php echo e(route('admin.footer.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                <?php echo csrf_field(); ?>

                <!-- Nama Website -->
                <div>
                    <label for="nama_web" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">
                        Website Name
                    </label>
                    <input type="text" id="nama_web" name="nama_web" value="<?php echo e(old('nama_web')); ?>"
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
                        placeholder="Website description..." required><?php echo e(old('deskripsi')); ?></textarea>
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
                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>"
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
                    <input type="text" id="no_hp" name="no_hp" value="<?php echo e(old('no_hp')); ?>"
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
                    <input type="file" id="logo_path" name="logo_path" accept="image/*"
                        class="w-full px-3 py-2 bg-[#0a0808] border border-white/10 rounded-xs text-gray-400 text-sm focus:outline-none focus:border-[#730c1e] transition-colors">
                    <p class="text-gray-500 text-xs mt-1">Max 2MB. Format: JPEG, PNG, JPG, GIF, WebP</p>
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
                        <!-- Media items will be added here -->
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
                    <input type="number" id="urutan" name="urutan" value="<?php echo e(old('urutan', 0)); ?>" min="0"
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
                        Create Footer
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

            function renderMediaItem(index) {
                const tech = technologies[0] || {};
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

                item.querySelector('.remove-media').addEventListener('click', () => {
                    item.remove();
                    reorderMediaInputs();
                    lucide.createIcons();
                });

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
                lucide.createIcons();
            });

            // Initialize
            lucide.createIcons();
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/footer/create.blade.php ENDPATH**/ ?>