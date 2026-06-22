<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\ActivityLogController;

// Redirect root ke dashboard atau login
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Auth routes (dari Breeze)
require __DIR__ . '/auth.php';

// Routes yang butuh login
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Routes untuk Admin & Petugas
    Route::middleware(['petugas'])->group(function () {
        Route::resource('buku', BukuController::class);
        Route::resource('anggota', AnggotaController::class)->parameters([
            'anggota' => 'anggota'
        ]);
        Route::resource('peminjaman', PeminjamanController::class);
        Route::resource('pengembalian', PengembalianController::class);
        Route::resource('denda', DendaController::class);
        Route::post('/denda/{denda}/bayar', [DendaController::class, 'bayar'])->name('denda.bayar');
    });

    // Routes khusus Admin saja
    Route::middleware(['admin'])->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::get('/activity-log', [ActivityLogController::class, 'index'])
            ->name('activity-log.index');
    });

});