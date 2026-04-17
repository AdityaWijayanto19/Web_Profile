lucide.createIcons();

const iconInput = document.getElementById("icon-input");
const iconPreview = document.getElementById("icon-preview");
const iconName = document.getElementById("icon-name");
const iconStatus = document.getElementById("icon-status");
let previewTimeout;

iconInput.addEventListener("input", function () {
    clearTimeout(previewTimeout);

    if (!this.value.trim()) {
        iconPreview.innerHTML = `<i data-lucide="help-circle" class="w-12 h-12 text-gray-600 mx-auto"></i>`;
        iconName.textContent = "Type icon name to preview";
        iconStatus.textContent = "";
        return;
    }

    iconStatus.textContent = "Loading...";
    iconStatus.style.color = "#888";

    previewTimeout = setTimeout(() => {
        const iconPath = this.value.toLowerCase().trim();
        const cdnUrl = `https://cdn.jsdelivr.net/npm/simple-icons@latest/icons/${iconPath}.svg`;

        fetch(cdnUrl, {
            method: "HEAD",
        })
            .then((response) => {
                if (response.ok) {
                    iconPreview.innerHTML = `<img src="${cdnUrl}" alt="${iconPath}" class="w-12 h-12 mx-auto" style="filter: invert(1);">`;
                    iconName.textContent = iconPath;
                    iconStatus.textContent = "Icon found";
                    iconStatus.style.color = "#730c1e";
                } else {
                    iconPreview.innerHTML = `<i data-lucide="alert-circle" class="w-12 h-12 text-red-600 mx-auto"></i>`;
                    iconName.textContent = iconPath;
                    iconStatus.textContent = "Icon not found";
                    iconStatus.style.color = "#ef4444";
                }
            })
            .catch(() => {
                iconPreview.innerHTML = `<i data-lucide="alert-circle" class="w-12 h-12 text-red-600 mx-auto"></i>`;
                iconName.textContent = iconPath;
                iconStatus.textContent = "Icon not found";
                iconStatus.style.color = "#ef4444";
            });
    }, 500);
});

if (iconInput.value) {
    iconInput.dispatchEvent(new Event("input"));
}
