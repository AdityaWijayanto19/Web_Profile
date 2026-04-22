document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        const expandBtn = document.getElementById('cert-expand-btn');

        if (!expandBtn) {
            console.warn('Certificate expand button not found');
            return;
        }

        let isExpanded = false;

        expandBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const items = document.querySelectorAll('.cert-item');
            const expandText = document.getElementById('cert-expand-text');
            const expandIcon = document.getElementById('cert-expand-icon');

            if (!items.length) {
                console.warn('No certificate items found');
                return;
            }

            isExpanded = !isExpanded;

            items.forEach((item) => {
                if (isExpanded) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });

            // Update button text
            if (expandText) {
                expandText.textContent = isExpanded ? 'Show Less' : 'View All Certificates';
            }

            // Update icon rotation with more reliable method
            if (expandIcon) {
                if (isExpanded) {
                    expandIcon.style.transform = 'rotate(180deg)';
                } else {
                    expandIcon.style.transform = 'rotate(0deg)';
                }
            }

            console.log('Certificate expand toggled:', isExpanded);
        });
    }, 100);
});
