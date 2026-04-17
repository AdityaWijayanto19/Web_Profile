lucide.createIcons();

document.getElementById("search-tech").addEventListener("keyup", function (e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll(".divide-y > .grid");

    rows.forEach((row) => {
        const techName =
            row.querySelector(".col-span-4")?.textContent.toLowerCase() || "";
        const iconPath =
            row.querySelector(".col-span-3")?.textContent.toLowerCase() || "";

        const isMatch =
            techName.includes(searchTerm) || iconPath.includes(searchTerm);
        row.style.display = isMatch ? "" : "none";
    });
});
