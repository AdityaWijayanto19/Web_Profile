lucide.createIcons();

function showDeleteConfirm(technologyName, deleteUrl) {
    Swal.fire({
        title: 'Hapus Technology?',
        html: `Apakah anda yakin ingin menghapus <strong>${technologyName}</strong>?`,
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
    document.querySelectorAll('[data-delete-btn]').forEach(button => {
        button.addEventListener('click', function() {
            const technologyName = this.dataset.technologyName;
            const deleteUrl = this.dataset.deleteUrl;
            showDeleteConfirm(technologyName, deleteUrl);
        });
    });

    const searchInput = document.getElementById("search-tech");
    if (searchInput) {
        searchInput.addEventListener("keyup", function (e) {
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
    }
});
