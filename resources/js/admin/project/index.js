 // Initialize Lucide Icons
        if (window.lucide) {
            window.lucide.createIcons();
        }

        function showDeleteConfirm(projectName, deleteUrl) {
            Swal.fire({
                title: 'Hapus Project?',
                html: `Apakah anda yakin ingin menghapus <strong>${projectName}</strong>?`,
                icon: 'warning',
                background: '#1a161d',
                color: '#fff',
                confirmButtonColor: '#730c1e',
                cancelButtonColor: '#333',
                confirmButtonText: 'Hapus Data',
                cancelButtonText: 'Batal',
                showCancelButton: true,
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;

                    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    let csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;

                    let methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const projectsGrid = document.getElementById('projectsGrid');
            const redirectUrl = projectsGrid?.dataset.redirectUrl;

            const firstCard = projectsGrid?.querySelector('[data-project-id]');
            const reorderUrl = firstCard?.dataset.reorderUrl;

            if (!projectsGrid) return;

            // Setup delete buttons
            document.querySelectorAll('[data-delete-btn]').forEach(button => {
                button.addEventListener('click', function() {
                    const projectName = this.dataset.projectName;
                    const deleteUrl = this.dataset.deleteUrl;
                    showDeleteConfirm(projectName, deleteUrl);
                });
            });

            let reorderTimeout;
            const debounceReorder = (callback, delay = 300) => {
                clearTimeout(reorderTimeout);
                reorderTimeout = setTimeout(callback, delay);
            };

            const sortable = Sortable.create(projectsGrid, {
                animation: 150,
                ghostClass: 'opacity-50',
                dragClass: 'dragging',
                touchStartThreshold: 5,
                fallbackOnBody: true,
                forceFallback: false,

                onEnd: function(evt) {
                    const projectElements = projectsGrid.querySelectorAll('[data-project-id]');
                    const orderedIds = Array.from(projectElements).map(el =>
                        parseInt(el.dataset.projectId)
                    );

                    projectsGrid.style.opacity = '0.6';
                    projectsGrid.style.pointerEvents = 'none';

                    debounceReorder(() => {
                        fetch(reorderUrl, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]')?.getAttribute(
                                        'content') || '',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    ids: orderedIds
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(
                                        `HTTP error! status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    window.dispatchEvent(new CustomEvent('notify', {
                                        detail: {
                                            message: 'Projects reordered successfully!',
                                            type: 'success'
                                        }
                                    }));
                                    setTimeout(() => {
                                        window.location.href = redirectUrl;
                                    }, 500);
                                }
                            })
                            .catch(error => {
                                console.error('Error reordering projects:', error);
                                window.dispatchEvent(new CustomEvent('notify', {
                                    detail: {
                                        message: 'Failed to reorder projects. Please try again.',
                                        type: 'error'
                                    }
                                }));
                                setTimeout(() => location.reload(), 1000);
                            })
                            .finally(() => {
                                projectsGrid.style.opacity = '1';
                                projectsGrid.style.pointerEvents = 'auto';
                            });
                    });
                }
            });
        });
