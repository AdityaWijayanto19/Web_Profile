<?php $__env->startSection('content'); ?>
    <style>
        .macbook-wrapper {
            position: relative;
            width: 100%;
            z-index: 20;
        }

        .screen-container {
            position: absolute;
            top: 7.5%;
            left: 12.1%;
            right: 12.1%;
            bottom: 14.2%;
            overflow: hidden;
            z-index: 25;
            padding: 7.2%;
        }

        .screen-container-bg {
            position: absolute;
            top: 14.7%;
            left: 20%;
            width: 60%;
            height: 70%;
            background-color: #000000;
            border-radius: 2px;
            z-index: 10;
        }

        .screen-content {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: top center;
        }

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <main class="relative z-10 pt-20">
        <section class="px-6 pb-20 max-w-6xl mx-auto">
            <div class="reveal mb-8">
                <a href="<?php echo e(route('landing')); ?>"
                    class="inline-flex items-center gap-2 text-sm text-primary hover:text-white transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Back to Home
                </a>
            </div>

            <div class="mt-12 grid lg:grid-cols-12 gap-10 lg:gap-16 items-start">

                <div class="lg:col-span-5 space-y-12 order-2 lg:order-1">
                    <div class="reveal">
                        <div class="flex items-center gap-4 mb-6">
                            <div>
                                <h1 class="text-4xl lg:text-5xl font-black italic tracking-tighter leading-none">
                                    <?php echo e($project->judul); ?>

                                </h1>
                            </div>
                        </div>
                        <p class="text-textMuted text-base font-light leading-relaxed">
                            <?php echo e($project->deskripsi); ?>

                        </p>
                    </div>

                    <div class="reveal space-y-10" style="transition-delay: 150ms;">
                        <div class="space-y-4">
                            <h2 class="text-sm font-black italic tracking-[0.3em] uppercase text-primary">Tech Stack
                            </h2>
                            <div class="flex gap-4 text-textMuted items-center flex-wrap">
                                <?php $__empty_1 = true; $__currentLoopData = $project->teknologis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php if($tech->path_icon): ?>
                                        <img src="https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/<?php echo e($tech->path_icon); ?>.svg"
                                            class="w-8 h-8 transition-all hover:grayscale-0 grayscale"
                                            alt="<?php echo e($tech->nama); ?>" title="<?php echo e($tech->nama); ?>"
                                            style="filter: invert(0.3) brightness(1.1);">
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="reveal pt-4" style="transition-delay: 300ms;">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <?php if($project->link_demo): ?>
                                <a href="<?php echo e($project->link_demo); ?>" target="_blank" rel="noopener noreferrer"
                                    class="px-8 py-3 bg-primary text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-sm shadow-lg hover:shadow-primary/40 hover:-translate-y-0.5 transition-all text-center">
                                    Live Preview
                                </a>
                            <?php endif; ?>
                            <?php if($project->link_repo): ?>
                                <a href="<?php echo e($project->link_repo); ?>" target="_blank" rel="noopener noreferrer"
                                    class="px-8 py-3 glass-card text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-sm hover:bg-white/5 transition-all text-center">
                                    Source Code
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 reveal order-1 lg:order-2 lg:sticky lg:top-24">
                    <div class="macbook-wrapper lg:scale-110 origin-top lg:origin-center">
                        <div class="screen-container-bg"></div>
                        <img src="<?php echo e(asset('assets/images/MacBoook.png')); ?>"
                            class="relative z-30 w-full drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)]" alt="Mockup">
                        <div class="screen-container z-20">
                            <?php if($project->path_gambar): ?>
                                <img src="<?php echo e(asset('storage/' . $project->path_gambar)); ?>" class="screen-content"
                                    alt="<?php echo e($project->judul); ?>">
                            <?php else: ?>
                                <div
                                    class="w-full h-full flex items-center justify-center bg-white/5 text-gray-700 italic text-[9px]">
                                    No Preview</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/project/show.blade.php ENDPATH**/ ?>