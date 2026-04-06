<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return redirect()->route('filament.user.auth.login');
    return view('welcome');
})->name('home');

Route::get('/manifest.json', function () {
    return response()->json([
        'name' => config('app.name'),
        'short_name' => "GnK App",
        'start_url' => route('home'),
        'display' => 'standalone',
        'background_color' => '#ffffff',
        'theme_color' => '#0f172a',
        'icons' => [
            [
                'src' => asset('icons/android-chrome-192x192.png'),
                'sizes' => '192x192',
                'type' => 'image/png'
            ],
            [
                'src' => asset('icons/android-chrome-512x512.png'),
                'sizes' => '512x512',
                'type' => 'image/png'
            ],
            [
                'src' => asset('icons/favicon-16x16.png'),
                'sizes' => '16x16',
                'type' => 'image/png'
            ],
            [
                'src' => asset('icons/favicon-32x32.png'),
                'sizes' => '32x32',
                'type' => 'image/png'
            ],
            [
                'src' => asset('icons/apple-touch-icon.png'),
                'sizes' => '180x180',
                'type' => 'image/png'
            ],
        ],
        'screenshots' => [
            [
                'src' => asset('screenshots/screenshot-desktop.png'),
                'sizes' => '1280x601',
                'type' => 'image/png',
                'form_factor' => 'wide'
            ],
            [
                'src' => asset('screenshots/screenshot-mobile.png'),
                'sizes' => '376x601',
                'type' => 'image/png'
            ]
        ]
    ]);
})->name('manifest');;

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('/payslip/download', function () {
    $data = session('payload');
    $pdf = Pdf::loadView('payslip', $data);
    return $pdf->download('payslip.pdf');
})->name('payslip.download');

Route::get('/invoice/download', function () {
    $data = session('payload');
    $pdf = Pdf::loadView('invoice', $data);
    return $pdf->download('invoice.pdf');
})->name('invoice.download');

require __DIR__ . '/settings.php';