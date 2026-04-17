
<div
    x-data="{
        show: false,
        title: '',
        message: '',
        type: 'warning',
        buttons: [],
        pendingAction: null,
    }"
    x-on:show-alert.window="
        show = true;
        title = $event.detail.title || 'Alert';
        message = $event.detail.message || '';
        type = $event.detail.type || 'warning';
        buttons = $event.detail.buttons || [];
    "
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
    style="display: none;"
    @click.self="show = false"
>
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>

    <!-- Modal Content -->
    <div class="relative bg-[#1a151d] border border-white/10 rounded-lg shadow-2xl max-w-md w-full"
         @click.stop
         x-transition:enter="transition ease-out duration-300 delay-100"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
    >
        <!-- Header -->
        <div class="px-6 pt-6 pb-3 border-b border-white/5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-lg font-bold text-white" x-text="title"></h2>
                </div>
                <button @click="show = false" class="text-gray-500 hover:text-white transition-colors flex-shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Content -->
        <div class="px-6 py-4">
            <p class="text-sm text-gray-300 leading-relaxed" x-text="message"></p>
        </div>

        <!-- Buttons -->
        <div class="px-6 pb-6 flex flex-col gap-2">
            <template x-for="(btn, index) in buttons" :key="index">
                <button
                    @click="
                        if (btn.action && typeof btn.action === 'function') {
                            btn.action();
                        }
                        show = false;
                    "
                    :class="{
                        'bg-[#2c974b] hover:bg-[#237a3d] text-white': btn.type === 'primary',
                        'bg-white/5 hover:bg-white/10 text-gray-300 border border-white/10': btn.type === 'secondary',
                        'bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20': btn.type === 'danger',
                    }"
                    class="w-full px-4 py-2.5 rounded-md font-semibold text-sm uppercase tracking-wider transition-all"
                    x-text="btn.label"
                ></button>
            </template>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:initialized', () => {
        Alpine.effect(() => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    });
</script>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/components/alert-pop-up.blade.php ENDPATH**/ ?>