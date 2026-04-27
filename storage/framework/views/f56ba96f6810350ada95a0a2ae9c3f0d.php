<?php $__env->startSection('title', 'Edit Article Metadata'); ?>
<?php $__env->startSection('page_title', 'Edit Metadata'); ?>

<?php echo $__env->make('admin.article._metadata-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4">
        <a href="<?php echo e(route('article.index')); ?>" class="back-link">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to Articles
        </a>

        <div class="page-header mb-6">
            <h1 class="page-title">Edit Article Metadata</h1>
            <p class="page-subtitle">Update featured image and metadata for published article.</p>
        </div>

        <form method="POST" action="<?php echo e(route('article.update-metadata', $artikel->id)); ?>" class="form-container space-y-3">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <?php echo $__env->make('admin.article._metadata-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="button-group">
                <a href="<?php echo e(route('article.edit', $artikel->id)); ?>" class="btn btn-secondary">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    Edit Content
                </a>
                <button type="submit" class="btn btn-primary">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    Update Metadata
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/lucide@latest"></script>
    <script>
        window.artikelContent = <?php echo json_encode(json_decode($artikel->isi_konten, true) ?? ['blocks' => []]); ?>;
        lucide.createIcons();
    </script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/admin/article/publish.js']); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/article/edit-metadata.blade.php ENDPATH**/ ?>