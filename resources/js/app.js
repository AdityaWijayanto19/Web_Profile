import "./bootstrap";

window.addEventListener("resize", () => {
    if (window.innerWidth >= 768) {
        document.body.classList.remove("sidebar-open");
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const html = document.documentElement; 
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    const navItems = document.querySelectorAll(".nav-item");
    let tooltipEl = null;

    function createTooltip() {
        if (!tooltipEl) {
            tooltipEl = document.createElement("div");
            tooltipEl.className = "sidebar-tooltip-fixed";
            document.body.appendChild(tooltipEl);
        }
        return tooltipEl;
    }

    navItems.forEach((item) => {
        item.addEventListener("mouseenter", function () {
            if (
                !document.documentElement.classList.contains(
                    "sidebar-collapsed",
                )
            ) {
                return;
            }

            const tooltip = createTooltip();
            const rect = this.getBoundingClientRect();
            const icon = this.getAttribute("data-tooltip-icon");
            const name = this.getAttribute("data-tooltip-name");
            const desc = this.getAttribute("data-tooltip-desc");

            tooltip.innerHTML = `
                        <div class="relative flex items-center h-8 bg-[#1a151c]/95 backdrop-blur-md border border-white/10 px-3 rounded-md shadow-[0_10px_40px_rgba(0,0,0,0.6)] whitespace-nowrap ml-2 transition-all duration-300">

                            <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-2 h-2 bg-[#1a151c] border-l border-b border-white/10 rotate-45"></div>

                            <span class="text-white font-semibold italic text-[10px] tracking-[0.15em] leading-none">
                                ${name}
                            </span>

                            <div class="absolute inset-x-0 top-0 h-[1px] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
                        </div>
                    `;

            tooltip.style.position = "fixed";
            tooltip.style.left = rect.right + 8 + "px";
            tooltip.style.top = rect.top + rect.height / 2 - 20 + "px";
            tooltip.style.zIndex = "9999";
            tooltip.style.opacity = "1";
            tooltip.style.visibility = "visible";
            tooltip.style.pointerEvents = "auto";
            tooltip.style.transition = "all 0.2s ease";

            if (window.lucide) {
                window.lucide.createIcons();
            }
        });

        item.addEventListener("mouseleave", function () {
            if (tooltipEl) {
                tooltipEl.style.opacity = "0";
                tooltipEl.style.visibility = "hidden";
                tooltipEl.style.pointerEvents = "none";
            }
        });
    });

    const handleToggle = () => {
        const isMobile = window.innerWidth < 768;

        if (isMobile) {
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
