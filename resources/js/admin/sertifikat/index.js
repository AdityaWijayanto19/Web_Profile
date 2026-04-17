lucide.createIcons();

        function openEditor() {
            document.getElementById('editor-panel').classList.remove('translate-x-full');
        }

        function closeEditor() {
            document.getElementById('editor-panel').classList.add('translate-x-full');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const sertifikatsGrid = document.getElementById('sertifikatsGrid');
            const redirectUrl = sertifikatsGrid?.dataset.redirectUrl;

            const firstCard = sertifikatsGrid?.querySelector('[data-sertifikat-id]');
            const reorderUrl = firstCard?.dataset.reorderUrl;

            if (!sertifikatsGrid) return;

            let reorderTimeout;
            const debounceReorder = (callback, delay = 300) => {
                clearTimeout(reorderTimeout);
                reorderTimeout = setTimeout(callback, delay);
            };

            const sortable = Sortable.create(sertifikatsGrid, {
                animation: 150,
                ghostClass: 'opacity-50',
                dragClass: 'dragging',
                touchStartThreshold: 5,
                fallbackOnBody: true,
                forceFallback: false,

                onEnd: function(evt) {
                    const sertifikatElements = sertifikatsGrid.querySelectorAll('[data-sertifikat-id]');
                    const orderedIds = Array.from(sertifikatElements).map(el =>
                        parseInt(el.dataset.sertifikatId)
                    );

                    sertifikatsGrid.style.opacity = '0.6';
                    sertifikatsGrid.style.pointerEvents = 'none';

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
                                            message: 'Sertifikat berhasil diurutkan!',
                                            type: 'success'
                                        }
                                    }));
                                    setTimeout(() => {
                                        window.location.href = redirectUrl;
                                    }, 500);
                                }
                            })
                            .catch(error => {
                                console.error('Error reordering sertifikats:', error);
                                window.dispatchEvent(new CustomEvent('notify', {
                                    detail: {
                                        message: 'Gagal mengurutkan sertifikat. Silakan coba lagi.',
                                        type: 'error'
                                    }
                                }));
                                setTimeout(() => location.reload(), 1000);
                            })
                            .finally(() => {
                                sertifikatsGrid.style.opacity = '1';
                                sertifikatsGrid.style.pointerEvents = 'auto';
                            });
                    });
                }
            });
        });
