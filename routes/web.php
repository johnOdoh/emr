<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('test');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/payslip/download', function () {
    $data = session('payload');
    $pdf = Pdf::loadView('payslip', $data);
    return $pdf->download('payslip.pdf');
});


require __DIR__ . '/settings.php';
