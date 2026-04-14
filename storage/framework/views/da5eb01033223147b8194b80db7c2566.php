<?php $__env->startSection('title', 'Add Education - FoxHR'); ?>
<?php $__env->startSection('page_title', 'Add New Education'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-[1200px]"> <!-- Dipersempit agar tidak terlalu lebar -->
    <!-- Breadcrumb -->
    <div class="mb-6">
        <a href="#" class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-[#730c1e] transition-colors group">
            <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
            BACK TO LIST
        </a>
    </div>

    <form action="<?php echo e(route('pendidikans.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- LEFT COLUMN: FORM UTAMA (8/12) -->
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-[#1a151d] border border-white/5 rounded-sm overflow-hidden shadow-2xl">
                    <div class="p-5 border-b border-white/5 bg-black/20">
                        <h3 class="text-white text-sm font-semibold flex items-center gap-2">
                            <i data-lucide="graduation-cap" class="w-4 h-4 text-[#730c1e]"></i>
                            Education Details
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <!-- Period Start -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Start Year</label>
                                <input type="text" name="start_year" placeholder="e.g. 2016"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm">
                            </div>
                            <!-- Period End -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">End Year / Status</label>
                                <input type="text" name="end_year" placeholder="e.g. 2020 or Present"
                                    class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm">
                            </div>
                        </div>

                        <!-- Degree / Major -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Degree & Major</label>
                            <input type="text" name="degree" placeholder="e.g. Bachelor of Software Engineering"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm">
                        </div>

                        <!-- Institution Name -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Institution / University</label>
                            <input type="text" name="institution" placeholder="e.g. Stanford University"
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-2.5 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 text-sm">
                        </div>

                        <!-- Description -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.1em]">Short Description</label>
                            <textarea name="description" rows="5" placeholder="Explain your focus or achievements..."
                                class="w-full bg-black/40 border border-white/10 rounded-sm px-4 py-3 text-white outline-none focus:border-[#730c1e] transition-all placeholder:text-gray-800 resize-none text-sm leading-relaxed"></textarea>
                        </div>
                    </div>
                </div>

                <!-- FORM ACTIONS (Save button pindah ke sini) -->
                <div class="flex items-center justify-between p-6 bg-[#1a151d] border border-white/5 rounded-sm shadow-xl">
                    <button type="button" class="text-xs font-bold text-gray-500 hover:text-white transition-colors uppercase tracking-widest">
                        Discard Changes
                    </button>
                    <div class="flex gap-4">
                        <button type="submit" class="bg-[#730c1e] hover:bg-[#8e1227] text-white px-8 py-3 rounded-sm text-xs font-bold transition-all shadow-lg shadow-[#730c1e]/10 flex items-center gap-2">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            SAVE EDUCATION DATA
                        </button>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: SIDEBAR (4/12) -->
            <div class="lg:col-span-4 space-y-6">

                <!-- PUBLISH & CONFIG CARD -->
                <div class="bg-[#1a151d] border border-white/5 rounded-sm p-6 shadow-xl">
                    <h4 class="text-white text-[11px] font-bold uppercase tracking-widest mb-6 pb-2 border-b border-white/5 flex items-center gap-2">
                        <i data-lucide="settings-2" class="w-3.5 h-3.5 text-gray-500"></i> Configuration
                    </h4>

                    <div class="space-y-6">
                        <!-- Visibility Toggle -->
                        <div class="flex items-center justify-between bg-black/20 p-3 rounded-sm border border-white/5">
                            <div>
                                <p class="text-xs text-white font-medium">Public Status</p>
                                <p class="text-[9px] text-gray-500 italic">Visible on portfolio</p>
                            </div>
                            <div class="relative inline-flex h-5 w-9 items-center justify-center">
                                <input type="checkbox" class="peer sr-only" id="visibility" checked />
                                <label for="visibility" class="h-5 w-9 cursor-pointer rounded-full bg-gray-800 transition-colors peer-checked:bg-[#730c1e]"></label>
                                <span class="pointer-events-none absolute left-1 h-3 w-3 rounded-full bg-white transition-all peer-checked:left-5"></span>
                            </div>
                        </div>

                        <!-- Alignment Selection -->
                        <div class="space-y-3">
                            <label class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Timeline Side</label>
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

                <!-- REPLACEMENT CARD: CONTENT GUIDELINES -->
                <div class="bg-[#1a151d] border border-white/5 rounded-sm p-6">
                    <h4 class="text-white text-[11px] font-bold uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i data-lucide="info" class="w-3.5 h-3.5 text-[#730c1e]"></i> Content Tips
                    </h4>

                    <ul class="space-y-4">
                        <li class="flex gap-3">
                            <div class="w-5 h-5 rounded bg-[#730c1e]/10 border border-[#730c1e]/20 flex items-center justify-center flex-shrink-0">
                                <span class="text-[10px] text-[#730c1e] font-bold">1</span>
                            </div>
                            <p class="text-[11px] text-gray-400 leading-relaxed">Gunakan format <span class="text-gray-200">"Present"</span> untuk pendidikan yang sedang ditempuh.</p>
                        </li>
                        <li class="flex gap-3">
                            <div class="w-5 h-5 rounded bg-[#730c1e]/10 border border-[#730c1e]/20 flex items-center justify-center flex-shrink-0">
                                <span class="text-[10px] text-[#730c1e] font-bold">2</span>
                            </div>
                            <p class="text-[11px] text-gray-400 leading-relaxed">Sebutkan fokus studi atau pencapaian utama di bagian deskripsi untuk nilai tambah.</p>
                        </li>
                        <li class="flex gap-3">
                            <div class="w-5 h-5 rounded bg-[#730c1e]/10 border border-[#730c1e]/20 flex items-center justify-center flex-shrink-0">
                                <span class="text-[10px] text-[#730c1e] font-bold">3</span>
                            </div>
                            <p class="text-[11px] text-gray-400 leading-relaxed">Pengaturan <span class="text-gray-200">Timeline Side</span> akan menentukan posisi kartu pada alur visual website.</p>
                        </li>
                    </ul>
                </div>

                <!-- META INFO -->
                <div class="p-4 border border-dashed border-white/5 rounded-sm">
                    <div class="flex justify-between text-[10px] text-gray-600 uppercase tracking-tighter">
                        <span>Created By</span>
                        <span class="text-gray-400">Admin_Fox</span>
                    </div>
                    <div class="flex justify-between text-[10px] text-gray-600 uppercase tracking-tighter mt-2">
                        <span>Last Updated</span>
                        <span class="text-gray-400">Just Now</span>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/edukasi/create.blade.php ENDPATH**/ ?>