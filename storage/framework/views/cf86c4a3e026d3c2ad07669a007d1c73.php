<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-base pt-20 pb-20">
    <div class="max-w-4xl mx-auto px-6 md:px-8">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="<?php echo e(route('landing')); ?>"
                class="inline-flex items-center gap-2 text-sm text-primary hover:text-white transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Home
            </a>
        </div>

        <!-- Article Header -->
        <div class="space-y-6 mb-12">
            <!-- Article Title -->
            <div class="space-y-4">
                <h1 class="text-5xl md:text-6xl font-bold leading-tight tracking-tighter bg-gradient-to-r from-white via-white to-white/80 bg-clip-text text-transparent">
                    <?php echo e($artikel->judul); ?>

                </h1>

                <!-- Article Meta -->
                <div class="flex flex-wrap items-center gap-4 text-sm text-textMuted/80 font-medium">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span><?php echo e($artikel->tanggal_rilis ? $artikel->tanggal_rilis->format('M d, Y') : 'N/A'); ?></span>
                    </div>
                    <div class="w-1 h-1 rounded-full bg-primary"></div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        <span><?php echo e($artikel->menit_baca ?? '5'); ?> min read</span>
                    </div>
                </div>

                <!-- Meta Description -->
                <?php if($artikel->meta_description): ?>
                    <p class="text-lg text-white/80 leading-relaxed max-w-3xl">
                        <?php echo e($artikel->meta_description); ?>

                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Article Content (Editor.js blocks) -->
        <div class="prose prose-invert max-w-none space-y-6">
            <?php if($artikelContent && isset($artikelContent['blocks']) && count($artikelContent['blocks']) > 0): ?>
                <?php $__currentLoopData = $artikelContent['blocks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if($block['type'] === 'paragraph' && isset($block['data']['text'])): ?>
                        <p class="text-white/80 leading-relaxed text-lg">
                            <?php echo nl2br(e($block['data']['text'])); ?>

                        </p>
                    <?php endif; ?>

                    
                    <?php if($block['type'] === 'heading' && isset($block['data']['text'])): ?>
                        <?php
                            $level = $block['data']['level'] ?? 2;
                            $headingClass = match($level) {
                                1 => 'text-4xl font-bold',
                                2 => 'text-3xl font-bold',
                                3 => 'text-2xl font-bold',
                                4 => 'text-xl font-bold',
                                default => 'text-lg font-bold'
                            };
                        ?>
                        <h<?php echo e($level); ?> class="text-white <?php echo e($headingClass); ?> mt-8 mb-4">
                            <?php echo nl2br(e($block['data']['text'])); ?>

                        </h<?php echo e($level); ?>>
                    <?php endif; ?>

                    
                    <?php if($block['type'] === 'list' && isset($block['data']['items'])): ?>
                        <?php
                            $style = $block['data']['style'] ?? 'unordered';
                        ?>
                        <?php if($style === 'ordered'): ?>
                            <ol class="list-decimal list-inside text-white/80 space-y-2">
                                <?php $__currentLoopData = $block['data']['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="ml-4">
                                        <?php if(is_array($item)): ?>
                                            <?php echo nl2br(e($item['content'] ?? '')); ?>

                                        <?php else: ?>
                                            <?php echo nl2br(e($item)); ?>

                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>
                        <?php else: ?>
                            <ul class="list-disc list-inside text-white/80 space-y-2">
                                <?php $__currentLoopData = $block['data']['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="ml-4">
                                        <?php if(is_array($item)): ?>
                                            <?php echo nl2br(e($item['content'] ?? '')); ?>

                                        <?php else: ?>
                                            <?php echo nl2br(e($item)); ?>

                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>

                    
                    <?php if($block['type'] === 'image' && isset($block['data']['file']['url'])): ?>
                        <figure class="my-8">
                            <img src="<?php echo e($block['data']['file']['url']); ?>"
                                class="w-full rounded-lg border border-white/10 shadow-lg"
                                alt="<?php echo e($block['data']['caption'] ?? 'Article image'); ?>"
                                loading="lazy">
                            <?php if(isset($block['data']['caption']) && $block['data']['caption']): ?>
                                <figcaption class="text-center text-sm text-textMuted/60 mt-3 italic">
                                    <?php echo e($block['data']['caption']); ?>

                                </figcaption>
                            <?php endif; ?>
                        </figure>
                    <?php endif; ?>

                    
                    <?php if($block['type'] === 'quote' && isset($block['data']['text'])): ?>
                        <blockquote class="border-l-4 border-primary pl-6 py-2 my-6 text-white/80 italic">
                            <?php echo nl2br(e($block['data']['text'])); ?>

                            <?php if(isset($block['data']['caption'])): ?>
                                <footer class="text-sm text-textMuted mt-2 not-italic">
                                    — <?php echo e($block['data']['caption']); ?>

                                </footer>
                            <?php endif; ?>
                        </blockquote>
                    <?php endif; ?>

                    
                    <?php if($block['type'] === 'code' && isset($block['data']['code'])): ?>
                        <pre class="bg-black/50 border border-white/10 rounded-lg p-4 overflow-x-auto my-6">
                            <code class="text-green-400 text-sm font-mono"><?php echo nl2br(e($block['data']['code'])); ?></code>
                        </pre>
                    <?php endif; ?>

                    
                    <?php if($block['type'] === 'delimiter'): ?>
                        <hr class="border-t border-white/10 my-8">
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p class="text-white/60 text-center py-12">Konten artikel tidak tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        if (window.lucide) {
            window.lucide.createIcons();
        }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/article/show.blade.php ENDPATH**/ ?>