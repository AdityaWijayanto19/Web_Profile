document.addEventListener('DOMContentLoaded', () => {
    const expandBtn = document.getElementById('education-expand-btn');
    if (!expandBtn) return;

    let isExpanded = false;

    expandBtn.addEventListener('click', () => {
        const expandedItems = document.querySelectorAll('.education-expanded-item');
        const expandText = document.getElementById('expand-text');
        const expandIcon = document.getElementById('expand-icon');

        isExpanded = !isExpanded;

        expandedItems.forEach((item) => {
            if (isExpanded) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });

        // Update button text dan icon
        expandText.textContent = isExpanded ? 'Show Less' : 'View All Educations';
        expandIcon.style.transform = isExpanded ? 'rotate(180deg)' : 'rotate(0deg)';
    });
});



