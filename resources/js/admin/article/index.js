document.addEventListener("DOMContentLoaded", function () {
    // Tab switching
    const tabButtons = document.querySelectorAll(".tab-button");
    const tabContents = document.querySelectorAll(".tab-content");

    tabButtons.forEach((button) => {
        button.addEventListener("click", () => {
            // Remove active class from all buttons
            tabButtons.forEach((btn) => btn.classList.remove("active"));
            tabContents.forEach((content) => content.classList.add("hidden"));

            // Add active class to clicked button
            button.classList.add("active");
            const tabId = button.getAttribute("data-tab") + "-tab";
            document.getElementById(tabId).classList.remove("hidden");
        });
    });

    if (window.lucide) window.lucide.createIcons();
});
