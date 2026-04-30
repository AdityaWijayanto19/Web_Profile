<nav id="navbar"
    class="fixed top-0 left-1/2 -translate-x-1/2 w-[calc(100%-2rem)] flex flex-col md:flex-row md:items-center justify-between px-6 md:px-12 py-4 border-b border-borderMuted/50 bg-[#08050a]/40 backdrop-blur-xl rounded-2xl z-[100]">

    <div class="flex items-center justify-between w-full md:w-auto">
        <a href="{{ route('landing') }}" class="flex items-center gap-2 font-bold text-lg">Pie.</a>

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

        <a href="{{ route('landing') }}#about" class="nav-link block w-full hover:text-white transition-colors"
            data-section="about">Profil</a>
        <a href="{{ route('landing') }}#education" class="nav-link block w-full hover:text-white transition-colors"
            data-section="education">Pendidikan</a>
        <a href="{{ route('landing') }}#certificates" class="nav-link block w-full hover:text-white transition-colors"
            data-section="certificates">Sertifikat</a>
        <a href="{{ route('landing') }}#experience" class="nav-link block w-full hover:text-white transition-colors"
            data-section="experience">Pengalaman</a>
        <a href="{{ route('landing') }}#projects" class="nav-link block w-full hover:text-white transition-colors"
            data-section="projects">Proyek</a>
        <a href="{{ route('landing') }}#articles" class="nav-link block w-full hover:text-white transition-colors"
            data-section="articles">Artikel</a>

    </div>
</nav>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const menuBtn = document.getElementById('menuBtn');
    const navMenu = document.getElementById('navMenu');
    const navLinks = document.querySelectorAll('.nav-link');

    // Mobile menu toggle
    if (menuBtn && navMenu) {
        menuBtn.addEventListener('click', () => {
            navMenu.classList.toggle('hidden');
        });

        // auto close pas klik
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.add('hidden');
            });
        });
    }

    // Intersection Observer untuk detect active section
    const observerOptions = {
        root: null,
        rootMargin: '-50% 0px -50% 0px',
        threshold: 0
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const currentSection = entry.target.id;

                // Remove active dari semua
                navLinks.forEach(link => {
                    link.classList.remove('text-white');
                    link.classList.add('text-textMuted');
                });

                // Add active ke yang current
                const activeLink = document.querySelector(`[data-section="${currentSection}"]`);
                if (activeLink) {
                    activeLink.classList.remove('text-textMuted');
                    activeLink.classList.add('text-white');
                }
            }
        });
    }, observerOptions);

    // Observe semua sections
    const sections = document.querySelectorAll('[id^="about"], [id^="education"], [id^="certificates"], [id^="experience"], [id^="projects"], [id^="articles"]');
    sections.forEach(section => {
        observer.observe(section);
    });

    // Set initial active link (about section default)
    const aboutSection = document.getElementById('about');
    if (aboutSection) {
        const aboutLink = document.querySelector('[data-section="about"]');
        if (aboutLink) {
            aboutLink.classList.remove('text-textMuted');
            aboutLink.classList.add('text-white');
        }
    }

});
</script>
@endpush
