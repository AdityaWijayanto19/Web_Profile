import "./bootstrap";

window.addEventListener("resize", () => {
    if (window.innerWidth >= 768) {
        document.body.classList.remove("sidebar-open");
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const html = document.documentElement; // Gunakan HTML agar sinkron dengan script di head
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    const handleToggle = () => {
        const isMobile = window.innerWidth < 768;

        if (isMobile) {
            // Untuk mobile kita tetap pakai body agar tidak bentrok dengan logic desktop
            document.body.classList.toggle("sidebar-open");
            if (sidebarOverlay) {
                sidebarOverlay.classList.toggle("hidden");
            }
        } else {
            const isCollapsed = html.classList.toggle("sidebar-collapsed");
            localStorage.setItem("sidebar-collapsed", isCollapsed);
        }
    };

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", handleToggle);
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener("click", handleToggle);
    }

    if (window.lucide) {
        window.lucide.createIcons();
    }

    if (window.innerWidth >= 768) {
        document.body.classList.remove("sidebar-open");
    }
});
