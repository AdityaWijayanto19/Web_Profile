 lucide.createIcons();

        document.addEventListener('DOMContentLoaded', function() {
            const el = document.getElementById('sortable-table');
            const table = el.closest('table');
            const reorderUrl = table?.dataset.reorderUrl;
            let isSaving = false;

            Sortable.create(el, {
                animation: 200,
                handle: '.drag-handle',
                ghostClass: 'sortable-ghost',
                onEnd: function() {
                    updateRowNumbers();
                    updateUrutanValues();
                    saveOrderWithAjax();
                },
            });

            function updateRowNumbers() {
                const rows = document.querySelectorAll('.row-number');
                rows.forEach((row, index) => {
                    row.innerText = index + 1;
                });
            }

            function updateUrutanValues() {
                const rows = document.querySelectorAll('#sortable-table tr[data-id]');
                rows.forEach((row, index) => {
                    const urutanInput = row.querySelector('input[name*="[urutan]"]');
                    if (urutanInput) {
                        urutanInput.value = index + 1;
                    }
                });
            }

            function saveOrderWithAjax() {
                if (isSaving) return;
                isSaving = true;

                const rows = document.querySelectorAll('#sortable-table tr[data-id]');
                const ids = Array.from(rows).map(row => parseInt(row.dataset.id));

                fetch(reorderUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ ids: ids })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        window.dispatchEvent(new CustomEvent('notify', {
                            detail: {
                                message: 'Urutan pengalaman berhasil diperbarui!',
                                type: 'success'
                            }
                        }));
                    }
                })
                .catch(error => {
                    console.error('Error reordering pengalaman:', error);
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: {
                            message: 'Gagal menyimpan urutan. Silakan coba lagi.',
                            type: 'error'
                        }
                    }));
                })
                .finally(() => {
                    isSaving = false;
                });
            }
        });
