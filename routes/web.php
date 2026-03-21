<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('filament.user.auth.login');
    return view('welcome');
})->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('/payslip/download', function () {
    $data = session('payload');
    $pdf = Pdf::loadView('payslip', $data);
    return $pdf->download('payslip.pdf');
});

Route::get('/invoice/download', function () {
    $data = session('payload');
    $pdf = Pdf::loadView('invoice', $data);
    return $pdf->download('invoice.pdf');
});

require __DIR__ . '/settings.php';
