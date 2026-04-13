// resources/js/profile.js

// EXPOSE KE WINDOW BIAR BISA DIPANGGIL DARI HTML oninput
window.updatePreview = function(targetId, value) {
    const element = document.getElementById(targetId);
    if (element) {
        element.textContent = value;
        // Efek visual pas ngetik
        element.classList.add("opacity-50");
        setTimeout(() => element.classList.remove("opacity-50"), 50);
    }
}

// EXPOSE KE WINDOW BIAR BISA DIPANGGIL DARI HTML onchange
window.previewImage = function(event) {
    const reader = new FileReader();
    const file = event.target.files[0];

    if (file) {
        reader.onload = function () {
            const output = document.getElementById("preview-portrait");
            output.src = reader.result;
            output.classList.remove("grayscale", "opacity-40");
        };
        reader.readAsDataURL(file);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    // Inisialisasi Lucide Icons jika library-nya tersedia
    if (typeof lucide !== "undefined") {
        lucide.createIcons();
    }
});
