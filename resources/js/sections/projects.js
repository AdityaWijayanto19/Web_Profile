document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        const expandBtn = document.getElementById('expand-projects-btn');

        if (!expandBtn) {
            console.warn('Projects expand button not found');
            return;
        }

        let isExpanded = false;

        expandBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const items = document.querySelectorAll('.project-item');
            const expandText = document.getElementById('projects-expand-text');
            const expandIcon = document.getElementById('projects-expand-icon');
            const expandedContainer = document.getElementById('projects-expanded-items');

            if (!items.length) {
                console.warn('No project items found');
                return;
            }

            isExpanded = !isExpanded;

            if (expandedContainer) {
                if (isExpanded) {
                    expandedContainer.classList.remove('hidden');
                } else {
                    expandedContainer.classList.add('hidden');
                }
            }

            // Update button text
            if (expandText) {
                expandText.textContent = isExpanded ? 'Show Less Projects' : 'Show More Projects';
            }

            // Update icon rotation
            if (expandIcon) {
                if (isExpanded) {
                    expandIcon.style.transform = 'rotate(180deg)';
                } else {
                    expandIcon.style.transform = 'rotate(0deg)';
                }
            }

            console.log('Projects expand toggled:', isExpanded);
        });
    }, 100);
});


