<?php $__env->startSection('title', isset($proyek) && $proyek ? $proyek->judul : 'Detail Proyek'); ?>

<?php $__env->startSection('content'); ?>
<?php if(!isset($proyek) || !$proyek): ?>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-red-50 border border-red-200 rounded-lg p-6">
            <h2 class="text-lg font-bold text-red-800">Error</h2>
            <p class="text-red-700 mt-2">Proyek tidak ditemukan atau data tidak valid.</p>
            <a href="<?php echo e(route('projects.index')); ?>" class="inline-block mt-4 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                Kembali ke Daftar Proyek
            </a>
        </div>
    </div>
<?php else: ?>
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900"><?php echo e($proyek->judul ?? 'Tanpa Judul'); ?></h1>
            <p class="text-gray-600 mt-2">Detail proyek dan informasi terkait</p>
        </div>
        <div class="flex gap-3">
            <a href="<?php echo e(route('projects.edit', ['project' => $proyek->id ?? 1])); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                Edit Proyek
            </a>
            <a href="<?php echo e(route('projects.index')); ?>" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                Kembali
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-3 gap-6">
        <!-- Image Section -->
        <div class="col-span-1">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <?php if($proyek->path_gambar): ?>
                    <img src="<?php echo e(asset('storage/' . $proyek->path_gambar)); ?>" alt="<?php echo e($proyek->judul); ?>" class="w-full h-auto object-cover rounded-t-lg">
                <?php else: ?>
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-t-lg">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                <?php endif; ?>
                <div class="p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full <?php echo e($proyek->status === 'published' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800'); ?>">
                            <?php echo e(ucfirst($proyek->status ?? 'unknown')); ?>

                        </span>
                    </div>
                    <p class="text-gray-600 text-sm"><strong>Urutan:</strong> <?php echo e($proyek->urutan ?? '-'); ?></p>
                    <p class="text-gray-600 text-sm mt-1"><strong>Dibuat:</strong> <?php echo e($proyek->created_at ? $proyek->created_at->format('d M Y') : '-'); ?></p>
                    <p class="text-gray-600 text-sm mt-1"><strong>Diperbarui:</strong> <?php echo e($proyek->updated_at ? $proyek->updated_at->format('d M Y') : '-'); ?></p>
                </div>
            </div>
        </div>

        <!-- Details Section -->
        <div class="col-span-2">
            <!-- Description -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Deskripsi</h2>
                <p class="text-gray-700 leading-relaxed"><?php echo e($proyek->deskripsi ?? 'Tidak ada deskripsi'); ?></p>
            </div>

            <!-- Links -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Link & Referensi</h2>
                <div class="space-y-3">
                    <?php if($proyek->link_demo): ?>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM15.657 14.243a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM11 17a1 1 0 102 0v-1a1 1 0 10-2 0v1zM5.757 15.657a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707zM5 10a1 1 0 01-1-1V8a1 1 0 012 0v1a1 1 0 01-1 1zM5.757 5.757a1 1 0 000-1.414L5.05 5.05a1 1 0 10-1.414 1.414l.707.707z"></path>
                            </svg>
                            <div>
                                <p class="text-gray-700 font-semibold">Demo</p>
                                <a href="<?php echo e($proyek->link_demo); ?>" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:text-blue-800 break-all"><?php echo e($proyek->link_demo); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($proyek->link_repo): ?>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-700 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm3.5 4a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-gray-700 font-semibold">Repository</p>
                                <a href="<?php echo e($proyek->link_repo); ?>" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:text-blue-800 break-all"><?php echo e($proyek->link_repo); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(!$proyek->link_demo && !$proyek->link_repo): ?>
                        <p class="text-gray-600">Tidak ada link yang tersedia untuk proyek ini.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Technologies -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Teknologi yang Digunakan</h2>
                <?php if($proyek->teknologis && $proyek->teknologis->count() > 0): ?>
                    <div class="flex flex-wrap gap-3">
                        <?php $__currentLoopData = $proyek->teknologis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-lg">
                                <?php if($tech->path_icon): ?>
                                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/<?php echo e($tech->path_icon); ?>.svg" alt="<?php echo e($tech->nama); ?>" class="w-5 h-5" style="filter: invert(0.2);" loading="lazy">
                                <?php endif; ?>
                                <span class="text-gray-700 font-semibold"><?php echo e($tech->nama); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-600">Tidak ada teknologi yang terdaftar untuk proyek ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="mt-8 bg-red-50 border border-red-200 rounded-lg p-6">
        <h3 class="text-lg font-bold text-red-800 mb-4">Zona Berbahaya</h3>
        <form action="<?php echo e(route('projects.destroy', ['project' => $proyek->id ?? 1])); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini? Tindakan ini tidak dapat dibatalkan.')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                Hapus Proyek
            </button>
        </form>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/project/show.blade.php ENDPATH**/ ?>