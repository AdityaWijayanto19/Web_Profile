<!-- resources/views/components/confirm-modal.blade.php -->
<div x-data="{
        open: false,
        title: 'Apakah anda yakin?',
        message: 'Data yang dihapus tidak dapat dikembalikan.',
        formAction: '',
        openModal(data) {
            this.title = data.title || this.title;
            this.message = data.message || this.message;
            this.formAction = data.action;
            this.open = true;
        },
        submitForm() {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = this.formAction;

            // Tambahkan CSRF Token
            let csrfToken = document.querySelector('meta[name=&quot;csrf-token&quot;]').getAttribute('content');
            let csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;

            // Tambahkan Method DELETE
            let methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    }"
    @open-delete-modal.window="openModal($event.detail)"
    class="relative z-[100]"
    x-cloak>

    <!-- Backdrop -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm"></div>

    <!-- Modal Content -->
    <div x-show="open"
        class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                @click.away="open = false"
                class="relative transform overflow-hidden rounded-sm bg-[#1a161d] border border-white/10 p-8 text-left shadow-2xl transition-all w-full max-w-md">

                <div class="flex flex-col items-center text-center">
                    <!-- Icon Warning -->
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-600/10 mb-4 border border-red-600/20">
                        <i data-lucide="alert-triangle" class="w-8 h-8 text-red-500"></i>
                    </div>

                    <h3 class="text-lg font-bold text-white uppercase tracking-wider" x-text="title"></h3>
                    <div class="mt-2">
                        <p class="text-xs text-gray-400 uppercase tracking-widest leading-relaxed" x-text="message"></p>
                    </div>
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="button"
                        @click="open = false"
                        class="flex-1 px-4 py-3 bg-white/5 hover:bg-white/10 text-gray-300 text-[10px] font-bold uppercase tracking-widest rounded-sm transition-all border border-white/5">
                        Cancel
                    </button>
                    <button type="button"
                        @click="submitForm"
                        class="flex-1 px-4 py-3 bg-[#730c1e] hover:bg-[#921126] text-white text-[10px] font-bold uppercase tracking-widest rounded-sm transition-all shadow-lg shadow-red-900/20">
                        Hapus Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Inisialisasi Lucide icons setelah modal terbuka (opsional jika icons tidak muncul)
    window.addEventListener('open-delete-modal', () => {
        setTimeout(() => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }, 10);
    });
</script>
