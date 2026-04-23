window.updatePreview = function (targetId, value) {
    const element = document.getElementById(targetId);
    if (element) {
        element.textContent = value;
        element.classList.add("opacity-50");
        setTimeout(() => element.classList.remove("opacity-50"), 50);
    }
};

window.previewImage = function (event) {
    const reader = new FileReader();
    const file = event.target.files[0];

    if (file) {
        reader.onload = function () {
            const output = document.getElementById("preview-portrait");
            const placeholder = document.getElementById("no-preview");

            if (!output) {
                return;
            }

            output.src = reader.result;
            output.classList.remove("hidden");
            output.classList.remove("grayscale", "opacity-40");

            if (placeholder) {
                placeholder.classList.add("hidden");
            }
        };
        reader.readAsDataURL(file);
    }
};

document.addEventListener("DOMContentLoaded", () => {
    if (typeof lucide !== "undefined") {
        lucide.createIcons();
    }
});
