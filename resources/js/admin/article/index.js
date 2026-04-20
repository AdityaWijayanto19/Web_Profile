function showDeleteConfirm(articleTitle, deleteUrl) {
    Swal.fire({
        title: 'Hapus Artikel?',
        html: `Apakah anda yakin ingin menghapus <strong>${articleTitle}</strong>?`,
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

document.addEventListener("DOMContentLoaded", function () {
    // Setup delete buttons
    document.querySelectorAll('[data-delete-btn]').forEach(button => {
        button.addEventListener('click', function() {
            const articleTitle = this.dataset.articleTitle;
            const deleteUrl = this.dataset.deleteUrl;
            showDeleteConfirm(articleTitle, deleteUrl);
        });
    });

    const tabButtons = document.querySelectorAll(".tab-button");
    const tabContents = document.querySelectorAll(".tab-content");

    tabButtons.forEach((button) => {
        button.addEventListener("click", () => {

            tabButtons.forEach((btn) => btn.classList.remove("active"));
            tabContents.forEach((content) => content.classList.add("hidden"));

            button.classList.add("active");
            const tabId = button.getAttribute("data-tab") + "-tab";
            document.getElementById(tabId).classList.remove("hidden");
        });
    });

    if (window.lucide) window.lucide.createIcons();
});
