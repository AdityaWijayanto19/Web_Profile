<nav id="navbar"
    class="fixed top-0 left-1/2 -translate-x-1/2 w-[calc(100%-2rem)] flex flex-col md:flex-row md:items-center justify-between px-6 md:px-12 py-4 border-b border-borderMuted/50 bg-[#08050a]/40 backdrop-blur-xl rounded-2xl z-[100]">

    <div class="flex items-center justify-between w-full md:w-auto">
        <a href="<?php echo e(route('landing')); ?>" class="flex items-center gap-2 font-bold text-lg">Pie.</a>

        <!-- BUTTON MOBILE -->
        <button id="menuBtn" class="md:hidden text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- MENU -->
    <div id="navMenu"
        class="hidden flex-col md:flex md:flex-row gap-4 md:gap-7 mt-4 md:mt-0 text-[13px] font-medium text-textMuted w-full md:w-auto">

        <a href="<?php echo e(route('landing')); ?>#about" class="nav-link block w-full text-white" data-section="about">Profile</a>
        <a href="<?php echo e(route('landing')); ?>#education" class="nav-link block w-full hover:text-white transition-colors"
            data-section="education">Education</a>
        <a href="<?php echo e(route('landing')); ?>#certificates" class="nav-link block w-full hover:text-white transition-colors"
            data-section="certificates">Certificates</a>
        <a href="<?php echo e(route('landing')); ?>#experience" class="nav-link block w-full hover:text-white transition-colors"
            data-section="experience">Experience</a>
        <a href="<?php echo e(route('landing')); ?>#projects" class="nav-link block w-full hover:text-white transition-colors"
            data-section="projects">Projects</a>
        <a href="<?php echo e(route('landing')); ?>#articles" class="nav-link block w-full hover:text-white transition-colors"
            data-section="articles">Articles</a>

    </div>
</nav>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {

    const menuBtn = document.getElementById('menuBtn');
    const navMenu = document.getElementById('navMenu');

    if (menuBtn && navMenu) {
        menuBtn.addEventListener('click', () => {
            navMenu.classList.toggle('hidden');
        });

        // auto close pas klik
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.add('hidden');
            });
        });
    }

});
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/partials/navbar.blade.php ENDPATH**/ ?>