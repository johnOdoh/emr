<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">

        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <meta name="theme-color" content="#000000">
        <!-- iOS support -->
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta name="apple-mobile-web-app-title" content="GnK App">
        <link rel="apple-touch-icon" href="{{ asset('icons/apple-touch-icon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <!-- Styles -->
        <style>
            html, body {
                height: 100%;
                margin: 0;
                background-color: #141e3d; /* Deep navy background */
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                font-family: Arial, sans-serif;
            }

            .center-image {
                max-width: 300px; /* Adjust size as needed */
                width: 100%;
                height: auto;
                margin-bottom: 40px;
            }

            .install-btn {
                background-color: #ffffff;
                color: #141e3d;
                border: none;
                padding: 15px 40px;
                font-size: 18px;
                font-weight: bold;
                border-radius: 8px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 10px;
                transition: all 0.3s ease;
            }

            .install-btn:hover {
                background-color: #141e3d;
                color: #ffffff;
                border: 2px solid #ffffff;
            }

            .install-btn i {
                font-size: 20px;
            }

            .hidden {
                display: none;
            }

            .guide-box {
                font-size: 14px;
                color: #333;
                background-color: #f3f4f6;
                padding: 12px;
                border-radius: 8px;
                text-align: left;
                max-width: 300px;
            }

            .guide-box ol {
                margin-left: 20px;
            }

            /* Spinner */
            .spinner {
                border: 3px solid #f3f3f3;
                border-top: 3px solid #141e3d;
                border-radius: 50%;
                width: 18px;
                height: 18px;
                animation: spin 1s linear infinite;
                display: none;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            .loading .spinner {
                display: inline-block;
            }

            .loading .loading-text {
                display: inline-block;
            }
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="center-image">

        <button id="installBtn" class="install-btn hidden">
            <i class="fa fa-download"></i> Install App
        </button>
        <button class="install-btn loading" id="loadingBtn">
            <div class="spinner"></div>
            <span class="loading-text">Loading...</span>
        </button>

        <!-- iOS guide -->
        <div id="iosGuide" class="hidden guide-box">
            <p class="font-medium mb-2">Install on iPhone:</p>
            <ol class="list-decimal space-y-1">
                <li>Tap the <strong>Share</strong> button</li>
                <li>Select <strong>Add to Home Screen</strong></li>
            </ol>
        </div>

        <!-- macOS guide -->
        <div id="macGuide" class="hidden guide-box">
            <p class="font-medium mb-2">Install on Mac:</p>
            <ol class="list-decimal space-y-1">
                <li>Click the <strong>Share</strong> button</li>
                <li>Select <strong>Add to Dock</strong></li>
            </ol>
        </div>

        <script>
            let deferredPrompt;

            const installBtn = document.getElementById('installBtn');
            const loadingBtn = document.getElementById('loadingBtn');
            const iosGuide = document.getElementById('iosGuide');
            const macGuide = document.getElementById('macGuide');
            const unsupportedText = document.getElementById('unsupportedText');

            // --- DEVICE DETECTION ---
            const ua = navigator.userAgent.toLowerCase();

            const isIOS = /iphone|ipad|ipod/.test(ua);
            const isMacOS = /macintosh/.test(ua);
            const isSafari = ua.includes('safari') && !ua.includes('chrome');
            const isTouchDevice = 'ontouchend' in document;

            // Fix iPad pretending to be Mac
            const isRealIOS = isIOS || (isMacOS && isTouchDevice);
            const isMacSafari = isMacOS && isSafari && !isTouchDevice;

            const isStandalone =
                window.matchMedia('(display-mode: standalone)').matches ||
                window.matchMedia('(display-mode: fullscreen)').matches ||
                window.navigator.standalone === true;

            // --- SERVICE WORKER ---
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/service-worker.js')
                    .then(() => {
                        console.log('SW registered');
                    });

                    // Prevent infinite reload loop
                    if (!sessionStorage.getItem('sw-refreshed')) {

                        navigator.serviceWorker.addEventListener('controllerchange', () => {
                            sessionStorage.setItem('sw-refreshed', 'true');
                            window.location.reload();
                        });

                    }
                });
            }

            // --- ANDROID INSTALL PROMPT ---
            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                deferredPrompt = e;

                installBtn.classList.remove('hidden');
                loadingBtn.classList.add('hidden');
            });

            installBtn.addEventListener('click', async () => {
                if (!deferredPrompt) return;

                deferredPrompt.prompt();

                const { outcome } = await deferredPrompt.userChoice;

                if (outcome === 'accepted') {
                    installBtn.classList.add('hidden');
                    loadingBtn.classList.remove('hidden');
                    continueToApp();
                }

                deferredPrompt = null;
            });

            // PAGE LOAD LOGIC
            window.addEventListener('load', () => {

                // Already installed → skip page
                if (isStandalone) {
                    continueToApp();
                    return;
                }

                // iOS
                if (isRealIOS) {
                    loadingBtn.classList.add('hidden');
                    iosGuide.classList.remove('hidden');
                    return;
                }

                // macOS Safari
                if (isMacSafari) {
                    loadingBtn.classList.add('hidden');
                    macGuide.classList.remove('hidden');
                    return;
                }

                // Unsupported browsers fallback
                setTimeout(() => {
                    if (!deferredPrompt) {
                        continueToApp();
                    }
                }, 5000);
            });

            function continueToApp() {
                window.location.href = "{{ route('filament.user.auth.login') }}";
            }
        </script>

    </body>
</html>
