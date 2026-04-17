lucide.createIcons();
const imageInput = document.getElementById("image-input");
const previewImage = document.getElementById("preview-image");
const placeholder = document.getElementById("placeholder");

imageInput.addEventListener("change", function (e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            previewImage.src = event.target.result;
            previewImage.classList.remove("hidden");
            placeholder.classList.add("hidden");
        };
        reader.readAsDataURL(file);
    }
});
