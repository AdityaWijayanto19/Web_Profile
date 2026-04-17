lucide.createIcons();
const mockTitle = document.getElementById("mock-title");
const mockSubtitle = document.getElementById("mock-subtitle");
const mockBg = document.getElementById("mock-bg");

document.querySelector('input[name="nama_sertifikat"]').oninput = (e) =>
    (mockTitle.innerText = e.target.value || "CERTIFICATION");
document.querySelector('input[name="penerbit"]').oninput = (e) =>
    (mockSubtitle.innerText = e.target.value || "PUBLISHER");

document.getElementById("image-input").addEventListener("change", function (e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            mockBg.style.backgroundImage = `url('${event.target.result}')`;
        };
        reader.readAsDataURL(file);
    }
});
