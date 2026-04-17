 if (window.lucide) {
            window.lucide.createIcons();
        }

 document.addEventListener('DOMContentLoaded', function() {
            const el = document.getElementById('sortable-table');
            const table = el?.closest('table');
            const reorderUrl = table?.dataset.reorderUrl;
            const redirectUrl = table?.dataset.redirectUrl;
            let isSaving = false;

            const sortable = Sortable.create(el, {
                animation: 150,
                handle: '.drag-handle',
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                onEnd: function(evt) {
                    const order = Array.from(el.querySelectorAll('tr[data-id]'))
                        .map(tr => parseInt(tr.dataset.id))
                        .filter(id => !isNaN(id));

                    if (order.length === 0) {
                        return;
                    }

                    saveOrderWithAjax(order);
                },
            });

            function saveOrderWithAjax(ids) {
                if (isSaving) {
                    return;
                }
                isSaving = true;

                const payload = { ids: ids };

                fetch(reorderUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        if (data.data && Array.isArray(data.data)) {
                            data.data.forEach(item => {
                                const row = el.querySelector(`tr[data-id="${item.id}"]`);
                                if (row) {
                                    const rowNumber = row.querySelector('.row-number');
                                    if (rowNumber) {
                                        rowNumber.innerText = item.urutan;
                                    }
                                }
                            });
                        }

                        window.dispatchEvent(new CustomEvent('notify', {
                            detail: {
                                message: 'Urutan edukasi berhasil diperbarui!',
                                type: 'success'
                            }
                        }));
                    } else {
                        throw new Error(data.message || 'Unknown error from server');
                    }
                })
                .catch(error => {
                    const errorMessage = error.message || 'Gagal menyimpan urutan';
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: {
                            message: 'Gagal menyimpan urutan: ' + errorMessage,
                            type: 'error'
                        }
                    }));
                })
                .finally(() => {
                    isSaving = false;
                });
            }
        });
