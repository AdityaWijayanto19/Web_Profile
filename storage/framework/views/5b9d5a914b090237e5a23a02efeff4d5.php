<?php if(session('error')): ?>
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm flex items-center gap-2">
        <i class="fa-solid fa-circle-xmark"></i> <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<?php if(session('success')): ?>
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i> <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/components/auth-alerts.blade.php ENDPATH**/ ?>