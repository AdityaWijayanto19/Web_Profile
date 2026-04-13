<?php $__env->startSection('title', 'Kelola Proyek'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Kelola Proyek</h1>
            <p class="text-gray-600 mt-2">Manage semua proyek dan teknologi yang digunakan</p>
        </div>
        <a href="<?php echo e(route('projects.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
            + Buat Proyek Baru
        </a>
    </div>

    <!-- Messages -->
    <?php if($message = Session::get('success')): ?>
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center" role="alert">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <?php echo e($message); ?>

        </div>
    <?php endif; ?>

    <?php if($message = Session::get('error')): ?>
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center" role="alert">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <?php echo e($message); ?>

        </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <?php if($proyeks->count() > 0): ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800">Urutan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800">Judul</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800">Teknologi</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-800">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__currentLoopData = $proyeks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyek): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-600 font-medium"><?php echo e($proyek->urutan); ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <?php if($proyek->path_gambar): ?>
                                            <img src="<?php echo e($proyek->getThumbnailUrl()); ?>" alt="<?php echo e($proyek->judul); ?>" class="w-10 h-10 rounded object-cover">
                                        <?php else: ?>
                                            <div class="w-10 h-10 rounded bg-gray-200 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"></path>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <p class="font-medium text-gray-900"><?php echo e($proyek->judul); ?></p>
                                            <p class="text-xs text-gray-500"><?php echo e(Str::limit($proyek->deskripsi, 50)); ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        <?php $__currentLoopData = $proyek->teknologis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded"><?php echo e($tech->nama); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if($proyek->status === 'published'): ?>
                                        <span class="inline-block bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">Published</span>
                                    <?php else: ?>
                                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex space-x-3">
                                        <a href="<?php echo e(route('projects.show', $proyek)); ?>" class="text-blue-600 hover:text-blue-800 font-medium">Lihat</a>
                                        <a href="<?php echo e(route('projects.edit', $proyek)); ?>" class="text-yellow-600 hover:text-yellow-800 font-medium">Edit</a>
                                        <form action="<?php echo e(route('projects.destroy', $proyek)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus proyek ini?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                <?php echo e($proyeks->links()); ?>

            </div>
        <?php else: ?>
            <div class="px-6 py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada proyek</h3>
                <p class="mt-2 text-gray-600">Mulai buat proyek pertama Anda dengan klik tombol di atas.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/project/index.blade.php ENDPATH**/ ?>