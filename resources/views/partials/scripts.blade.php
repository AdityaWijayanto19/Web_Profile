<script>
    let lastScroll = 0;
    const navbar = document.getElementById("navbar");

    window.addEventListener("scroll", () => {
        const currentScroll = window.pageYOffset;
        if (currentScroll > 50) {
            navbar.classList.add("shadow-lg", "bg-[#08050a]/90");
        } else {
            navbar.classList.remove("shadow-lg", "bg-[#08050a]/90");
        }
        if (currentScroll > lastScroll && currentScroll > 100) {
            navbar.classList.add("nav-hide");
        } else {
            navbar.classList.remove("nav-hide");
        }
        lastScroll = currentScroll;
    });
</script>

<script type="module">
    import createGlobe from 'https://cdn.skypack.dev/cobe';
    lucide.createIcons();
    let canvas = document.getElementById("cobe-canvas");
    if (canvas) {
        let phi = 0;
        const globe = createGlobe(canvas, {
            devicePixelRatio: 2,
            width: 1000 * 2,
            height: 1000 * 2,
            phi: 0,
            theta: 0.15,
            dark: 1,
            diffuse: 1.2,
            mapSamples: 30000,
            mapBrightness: 18,
            baseColor: [1, 0.15, 0.25],
            markerColor: [1, 1, 1],
            glowColor: [0.3, 0.05, 0.1],
            markers: [],
            onRender: (state) => {
                state.phi = phi;
                phi += 0.005;
            }
        });
    }
</script>
