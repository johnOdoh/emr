<div
    x-data="pwaInstall()"
    x-init="init()"
    x-cloak
    class="text-center"
>
    <!-- ANDROID INSTALL BUTTON -->
    <template x-if="mode === 'android' && showInstall">
        <x-filament::button
            icon="heroicon-o-arrow-down-tray"
            x-on:click="install"
        >
            Install App
        </x-filament::button>
    </template>

    <!-- iOS INSTRUCTIONS -->
    <template x-if="mode === 'ios' && showInstall">
        <div class="text-sm text-gray-500 space-y-1">
            <p>Add this app to your home screen:</p>
            <p class="font-medium">
                Tap <strong>Share</strong> → <strong>Add to Home Screen</strong>
            </p>
        </div>
    </template>
</div>

<script>
function pwaInstall() {
    return {
        deferredPrompt: null,
        showInstall: false,
        mode: null, // android | ios | unsupported

        init() {
            const isStandalone = window.matchMedia('(display-mode: standalone)').matches;
            const isIOSStandalone = window.navigator.standalone === true;

            // Already installed → hide everything
            if (isStandalone || isIOSStandalone || localStorage.getItem('pwa-installed') === 'true') {
                return;
            }

            const userAgent = navigator.userAgent || navigator.vendor || window.opera;

            const isIOS = /iPhone|iPad|iPod/i.test(userAgent);
            const supportsSW = 'serviceWorker' in navigator;

            // ❌ Unsupported browsers
            if (!supportsSW) {
                this.mode = 'unsupported';
                return;
            }

            // 🍎 iOS
            if (isIOS) {
                this.mode = 'ios';
                this.showInstall = true;
                return;
            }

            // 🤖 Android / Desktop
            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                this.deferredPrompt = e;
                this.mode = 'android';

                // Optional delay (better UX)
                setTimeout(() => {
                    this.showInstall = true;
                }, 1000);
            });

            // When installed
            window.addEventListener('appinstalled', () => {
                this.showInstall = false;
                localStorage.setItem('pwa-installed', 'true');
            });
        },

        install() {
            if (!this.deferredPrompt) return;

            this.deferredPrompt.prompt();

            this.deferredPrompt.userChoice.then(() => {
                this.deferredPrompt = null;
            });
        }
    }
}
</script>
