{{-- resources/views/components/notification.blade.php --}}
<div
    x-data="{
        show: false,
        message: '',
        type: 'success',
        // Durasi alert muncul (milidetik)
        duration: 4000
    }"
    x-on:notify.window="
        show = true;
        message = $event.detail.message;
        type = $event.detail.type || 'success';
        // Reset timer jika ada notifikasi baru masuk
        clearTimeout($data.timeout);
        $data.timeout = setTimeout(() => show = false, duration);
    "
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-10"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-6 right-6 z-[9999] max-w-sm w-full pointer-events-none"
    style="display: none;"
>
    <div
        :class="{
            'border-green-500/50 bg-[#1a1c1a]/95 text-green-400': type === 'success',
            'border-red-500/50 bg-[#1c1a1a]/95 text-red-400': type === 'error',
            'border-yellow-500/50 bg-[#1c1c1a]/95 text-yellow-400': type === 'warning',
            'border-blue-500/50 bg-[#1a1c1c]/95 text-blue-400': type === 'info'
        }"
        class="pointer-events-auto mt-10 border backdrop-blur-md p-4 rounded-sm shadow-[0_10px_40px_rgba(0,0,0,0.5)]"
    >
        <div class="flex items-start gap-3">
            <!-- Icon Box -->
            <div class="flex-shrink-0 mt-0.5">
                <template x-if="type === 'success'">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                </template>
                <template x-if="type === 'error'">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                </template>
                <template x-if="type === 'warning'">
                    <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                </template>
            </div>

            <!-- Text Content -->
            <div class="flex-1">
                <p class="text-[10px] font-bold uppercase tracking-[0.15em] leading-tight" x-text="message"></p>
                <p class="text-[9px] opacity-60 mt-1 uppercase tracking-tighter">System Notification</p>
            </div>

            <!-- Close Button -->
            <button @click="show = false" class="text-gray-500 hover:text-white transition-colors">
                <i data-lucide="x" class="w-3.5 h-3.5"></i>
            </button>
        </div>

        <!-- Progress Bar (Optional, keren buat UX) -->
        <div class="absolute bottom-0 left-0 h-[2px] bg-current opacity-20 transition-all ease-linear"
             :style="'width: ' + (show ? '100%' : '0%') + '; transition-duration: ' + duration + 'ms'">
        </div>
    </div>
</div>

<script>
    // Inisialisasi ulang lucide setiap kali komponen Alpine me-render template
    document.addEventListener('alpine:initialized', () => {
        Alpine.effect(() => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    });
</script>
