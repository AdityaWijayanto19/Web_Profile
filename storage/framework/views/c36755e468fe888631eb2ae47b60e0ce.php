<section id="projects" class="px-6 md:px-8 mt-12 md:mt-16">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
            <div class="relative">
                <span class="text-primary font-black uppercase tracking-[0.4em] text-[10px] mb-3 block italic">Verified
                    Showcase</span>
                <h2 class="text-4xl md:text-5xl font-bold tracking-tighter italic leading-none">
                    Portfolio <span class="text-white not-italic border-b-4 border-primary/40">Certifications</span>
                </h2>
            </div>
            <p class="text-textMuted max-w-md text-sm font-light leading-relaxed border-l-2 border-primary/20 pl-4">
                Professional projects crafted with modern technologies and creative solutions.
            </p>
        </div>

        <?php if($projects->count() > 0): ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <?php $__currentLoopData = $projects->slice(0, 8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group">
                        <div
                            class="project-img-container h-[150px] mb-3 relative overflow-hidden rounded-lg border border-white/10 shadow-lg">
                            <?php if($project->path_gambar): ?>
                                <img src="<?php echo e($project->hasImage() ? asset('storage/' . $project->path_gambar) : 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=800'); ?>"
                                    class="w-full h-full object-cover" alt="<?php echo e($project->judul); ?>">
                            <?php else: ?>
                                <div
                                    class="w-full h-full flex items-center justify-center bg-white/5 text-gray-700 italic text-[9px]">
                                    No Preview</div>
                            <?php endif; ?>
                            <div
                                class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <a href="<?php echo e($project->link_demo ?? '#'); ?>" target="_blank" rel="noopener noreferrer"
                                    class="bg-white text-black p-2 rounded-full"><i data-lucide="external-link"
                                        class="w-4 h-4"></i></a>
                            </div>
                        </div>
                        <h3 class="text-md font-bold mb-1 line-clamp-1"><?php echo e($project->judul); ?></h3>
                        <p class="text-textMuted text-sm mb-2 line-clamp-1"><?php echo e($project->deskripsi); ?></p>
                        <div class="flex gap-1.5 text-textMuted flex-wrap">
                            <?php $__currentLoopData = $project->teknologis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($tech->path_icon): ?>
                                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/<?php echo e($tech->path_icon); ?>.svg"
                                        alt="<?php echo e($tech->nama); ?>" title="<?php echo e($tech->nama); ?>"
                                        class="w-5 h-5 object-contain" style="filter: invert(0.2);" loading="lazy">
                                <?php else: ?>
                                    <span title="<?php echo e($tech->nama); ?>"
                                        class="text-[7px] bg-primary/20 px-1 py-0.5 rounded text-primary uppercase font-bold"><?php echo e(substr($tech->nama, 0, 1)); ?></span>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <?php if($projects->slice(8)->count() > 0): ?>
                <div id="projects-expanded-items"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 hidden">
                    <?php $__currentLoopData = $projects->slice(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="project-item group">
                            <div
                                class="project-img-container h-[150px] mb-3 relative overflow-hidden rounded-lg border border-white/10 shadow-lg">
                                <?php if($project->path_gambar): ?>
                                    <img src="<?php echo e($project->hasImage() ? asset('storage/' . $project->path_gambar) : 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=800'); ?>"
                                        class="w-full h-full object-cover" alt="<?php echo e($project->judul); ?>">
                                <?php else: ?>
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-white/5 text-gray-700 italic text-[9px]">
                                        No Preview</div>
                                <?php endif; ?>
                                <div
                                    class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <a href="<?php echo e($project->link_demo ?? '#'); ?>" target="_blank"
                                        rel="noopener noreferrer" class="bg-white text-black p-2 rounded-full"><i
                                            data-lucide="external-link" class="w-4 h-4"></i></a>
                                </div>
                            </div>
                            <h3 class="text-md font-bold mb-1 line-clamp-1"><?php echo e($project->judul); ?></h3>
                            <p class="text-textMuted text-sm mb-2 line-clamp-1"><?php echo e($project->deskripsi); ?></p>
                            <div class="flex gap-1.5 text-textMuted flex-wrap">
                                <?php $__currentLoopData = $project->teknologis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($tech->path_icon): ?>
                                        <img src="https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/<?php echo e($tech->path_icon); ?>.svg"
                                            alt="<?php echo e($tech->nama); ?>" title="<?php echo e($tech->nama); ?>"
                                            class="w-5 h-5 object-contain" style="filter: invert(0.2);" loading="lazy">
                                    <?php else: ?>
                                        <span title="<?php echo e($tech->nama); ?>"
                                            class="text-[7px] bg-primary/20 px-1 py-0.5 rounded text-primary uppercase font-bold"><?php echo e(substr($tech->nama, 0, 1)); ?></span>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="flex justify-center mt-6">
                    <button type="button" id="expand-projects-btn"
                        class="px-6 py-2.5 bg-primary/10 border border-primary text-primary hover:bg-primary hover:text-white transition-all duration-300 rounded-sm text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                        <span id="projects-expand-text">Show More Projects</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300"
                            id="projects-expand-icon"></i>
                    </button>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="text-center py-12">
                <p class="text-textMuted text-sm">No projects available at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/sections/projects.js']); ?>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/sections/projects.blade.php ENDPATH**/ ?>