<section id="education" class="relative px-6 md:px-8 mt-4 pb-8 md:pb-12">
    <div class="max-w-4xl mx-auto text-center mb-2">
        <div class="flex items-center justify-center gap-2 mb-2">
            <span class="w-8 h-[1px] bg-primary"></span>
            <span class="text-primary text-xs font-medium tracking-widest uppercase">My Journey</span>
            <span class="w-8 h-[1px] bg-primary"></span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
            Education <span class="text-primary">section.</span>
        </h2>
    </div>

    <?php
        $totalItems = $educations?->count() ?? 0;
        $svgHeight = max(480, $totalItems * 220 + 200);
        $spacing = 220;
        $firstItemY = 100;
    ?>

    <div class="md:hidden flex flex-col gap-8 mt-10 relative">
        <div class="absolute left-4 top-0 bottom-0 w-[2px] bg-primary/40"></div>

        <?php $__empty_1 = true; $__currentLoopData = $educations ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="relative pl-10">
                <div class="absolute left-[9px] top-2 w-4 h-4 bg-primary rounded-full"></div>

                <div class="glass-card p-6 rounded-xl border-l-4 border-primary">
                    <span class="text-primary font-mono text-sm"><?php echo e($education->periode); ?></span>
                    <h3 class="text-xl font-bold mt-2 leading-tight"><?php echo e($education->gelar); ?></h3>
                    <p class="text-textMuted mt-2 text-sm"><?php echo e($education->instansi); ?></p>
                    <?php if($education->keterangan): ?>
                        <p class="text-textMuted mt-3 text-sm"><?php echo e($education->keterangan); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-center text-textMuted">No education data available</p>
        <?php endif; ?>
    </div>

    <div class="hidden md:block max-w-5xl mx-auto relative mt-2" style="min-height: <?php echo e($svgHeight); ?>px">

        <svg class="edu-svg-container" viewBox="0 0 800 <?php echo e($svgHeight); ?>" fill="none"
            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" style="height: <?php echo e($svgHeight); ?>px">

            <path d="M400 0V<?php echo e($svgHeight); ?>" stroke="#880808" stroke-width="2" stroke-dasharray="10 10" />

            <?php $__currentLoopData = $educations ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $itemY = $firstItemY + $index * $spacing;
                    $isLeft = $index % 2 === 0;

                    if ($isLeft) {
                        $pathD =
                            'M400 ' .
                            ($itemY + 50) .
                            'C400 ' .
                            ($itemY + 50) .
                            ' 400 ' .
                            ($itemY + 100) .
                            ' 300 ' .
                            ($itemY + 100) .
                            'H290';
                    } else {
                        $pathD =
                            'M400 ' .
                            ($itemY + 50) .
                            'C400 ' .
                            ($itemY + 50) .
                            ' 400 ' .
                            ($itemY + 100) .
                            ' 500 ' .
                            ($itemY + 100) .
                            'H650';
                    }
                ?>

                <path d="<?php echo e($pathD); ?>" stroke="#880808" stroke-width="2" stroke-opacity="0.5" />
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </svg>

        <?php $__currentLoopData = $educations ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $itemY = $firstItemY + $index * $spacing;
                $isLeft = $index % 2 === 0;

                $dotPosition = $isLeft ? 'md:-right-[15px]' : 'md:-left-[15px]';
                $borderClass = $isLeft ? 'border-l-4 border-l-primary' : 'border-r-4 border-r-primary';
                $textAlign = $isLeft ? '' : 'md:text-right';
            ?>

            <div class="absolute w-[40%] z-10"
                style="top: <?php echo e($itemY); ?>px; <?php echo e($isLeft ? 'left: 0' : 'right: 0'); ?>">

                <div class="glass-card p-8 rounded-xl <?php echo e($borderClass); ?> relative <?php echo e($textAlign); ?>">

                    <!-- dot -->
                    <div
                        class="absolute <?php echo e($dotPosition); ?> top-[87px] w-8 h-8 bg-base border-2 border-primary rounded-full flex items-center justify-center">
                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                    </div>

                    <span class="text-primary font-mono text-sm"><?php echo e($education->periode); ?></span>
                    <h3 class="text-2xl font-bold mt-2 leading-tight"><?php echo e($education->gelar); ?></h3>
                    <p class="text-textMuted mt-2 text-sm"><?php echo e($education->instansi); ?></p>

                    <?php if($education->keterangan): ?>
                        <p class="text-textMuted mt-4 text-sm"><?php echo e($education->keterangan); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/sections/education.blade.php ENDPATH**/ ?>