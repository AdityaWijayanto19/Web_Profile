<?php $__env->startSection('title', 'Edit Education - FoxHR'); ?>
<?php $__env->startSection('page_title', 'Edit Education'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-[1200px]">
    <!-- Breadcrumb -->
    <div class="mb-6 flex justify-between items-center">
        <a href="#" class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-[#730c1e] transition-colors group">
            <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
            BACK TO LIST
        </a>
        <span class="text-[10px] text-gray-600 font-mono tracking-widest uppercase bg-white/5 px-3 py-1 rounded-sm border border-white/5">
            Entry ID: <span class="text-[#730c1e]">#0821</span>
        </span>
    </div>

    <!-- Form menggunakan Method PUT untuk Update -->
    <form action="<?php echo e(route('pendidikans.update', $pendidikan->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- LEFT COLUMN: FORM UTAMA (8/12) -->
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden shadow-2xl">
                    <div class="p-5 border-b border-white/5 bg-black/20">
                        <h3 class="text-white text-sm font-semibold flex items-center gap-2">
                            <i data-lucide="edit-3" class="w-4 h-4 text-[#730c1e]"></i>
                            Modify Education Entry
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <!-- Period Start -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Start Year</label>
                                <input type="text" name="start_year" value="<?php echo e(explode(' - ', $pendidikan->periode)[0] ?? ''); ?>"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all text-sm font-medium">
                            </div>
                            <!-- Period End -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">End Year / Status</label>
                                <input type="text" name="end_year" value="<?php echo e(explode(' - ', $pendidikan->periode)[1] ?? ''); ?>"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all text-sm font-medium">
                            </div>
                        </div>

                        <!-- Degree / Major -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Degree & Major</label>
                            <input type="text" name="degree" value="<?php echo e($pendidikan->gelar); ?>"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all text-sm font-medium">
                        </div>

                        <!-- Institution Name -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Institution / University</label>
                            <input type="text" name="institution" value="<?php echo e($pendidikan->instansi); ?>"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all text-sm font-medium">
                        </div>

                        <!-- Description -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Short Description</label>
                            <textarea name="description" rows="6"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-3 text-white outline-none focus:border-[#730c1e] transition-all resize-none text-sm leading-relaxed font-light"><?php echo e($pendidikan->keterangan); ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- FORM ACTIONS -->
                <div class="flex items-center justify-between p-5 bg-[#1a151d] border border-white/5 rounded-sm shadow-xl">
                    <!-- Tombol Delete Terpisah -->
                    <button type="button" class="flex items-center gap-2 text-[10px] font-bold text-red-900/60 hover:text-red-500 transition-all uppercase tracking-widest group">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5 group-hover:scale-110 transition-transform"></i>
                        Delete Entry
                    </button>

                    <div class="flex gap-4">
                        <button type="button" class="text-xs font-bold text-gray-500 hover:text-white transition-colors uppercase tracking-widest px-4">
                            Cancel
                        </button>
                        <button type="submit" class="bg-[#730c1e] hover:bg-[#8e1227] text-white px-8 py-3 rounded-sm text-xs font-bold transition-all shadow-lg shadow-[#730c1e]/10 flex items-center gap-2">
                            <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                            UPDATE CHANGES
                        </button>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: SIDEBAR (4/12) -->
            <div class="lg:col-span-4 space-y-6">

                <!-- PUBLISH & CONFIG CARD -->
                <div class="bg-[#1a151d] border border-white/5 rounded-sm p-6 shadow-xl">
                    <h4 class="text-white text-[11px] font-bold uppercase tracking-widest mb-6 pb-2 border-b border-white/5 flex items-center gap-2">
                        <i data-lucide="toggle-right" class="w-3.5 h-3.5 text-gray-500"></i> Settings
                    </h4>

                    <div class="space-y-6">
                        <!-- Visibility Toggle -->
                        <div class="flex items-center justify-between bg-black/20 p-3 rounded-sm border border-white/5">
                            <div>
                                <p class="text-xs text-white font-medium">Public Status</p>
                                <p class="text-[9px] text-gray-500 italic">Toggle visibility</p>
                            </div>
                            <div class="relative inline-flex h-5 w-9 items-center justify-center">
                                <input type="checkbox" class="peer sr-only" id="visibility" checked />
                                <label for="visibility" class="h-5 w-9 cursor-pointer rounded-full bg-gray-800 transition-colors peer-checked:bg-[#730c1e]"></label>
                                <span class="pointer-events-none absolute left-1 h-3 w-3 rounded-full bg-white transition-all peer-checked:left-5"></span>
                            </div>
                        </div>

                        <!-- Alignment Selection -->
                        <div class="space-y-3">
                            <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Timeline Alignment</label>
                            <div class="grid grid-cols-2 gap-2">
                                <label class="cursor-pointer group">
                                    <input type="radio" name="pos" class="peer sr-only" checked />
                                    <div class="text-center py-2 text-[10px] border border-white/5 bg-black/40 text-gray-500 peer-checked:border-[#730c1e] peer-checked:text-white transition-all rounded-sm uppercase font-black">LEFT</div>
                                </label>
                                <label class="cursor-pointer group">
                                    <input type="radio" name="pos" class="peer sr-only" />
                                    <div class="text-center py-2 text-[10px] border border-white/5 bg-black/40 text-gray-500 peer-checked:border-[#730c1e] peer-checked:text-white transition-all rounded-sm uppercase font-black">RIGHT</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INFO CARD: LOG HISTORY -->
                <div class="bg-[#1a151d] border border-white/5 rounded-sm p-6 overflow-hidden relative">
                    <!-- Background Decoration -->
                    <div class="absolute -right-4 -bottom-4 opacity-[0.03]">
                        <i data-lucide="clock" class="w-24 h-24 text-white"></i>
                    </div>

                    <h4 class="text-white text-[11px] font-bold uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i data-lucide="history" class="w-3.5 h-3.5 text-[#730c1e]"></i> Record History
                    </h4>

                    <div class="space-y-4 relative z-10">
                        <div class="flex flex-col gap-1 border-l-2 border-[#730c1e]/30 pl-4">
                            <p class="text-[9px] text-gray-500 uppercase font-bold tracking-tighter">Created At</p>
                            <p class="text-xs text-gray-300">August 12, 2023 - 14:30</p>
                        </div>
                        <div class="flex flex-col gap-1 border-l-2 border-gray-800 pl-4">
                            <p class="text-[9px] text-gray-500 uppercase font-bold tracking-tighter">Last Update</p>
                            <p class="text-xs text-gray-300">September 05, 2023 - 09:12</p>
                        </div>
                        <div class="flex flex-col gap-1 border-l-2 border-gray-800 pl-4">
                            <p class="text-[9px] text-gray-500 uppercase font-bold tracking-tighter">Author</p>
                            <p class="text-xs text-gray-300">System Administrator</p>
                        </div>
                    </div>
                </div>

                <!-- STATUS BANNER -->
                <div class="p-4 bg-green-950/20 border border-green-900/30 rounded-sm flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    <p class="text-[10px] text-green-500/80 uppercase font-bold tracking-[0.1em]">Verified Content</p>
                </div>

            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/edukasi/edit.blade.php ENDPATH**/ ?>