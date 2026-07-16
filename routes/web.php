<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RegistrasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('registrasi')->name('registrasi.')->group(function () {
        Route::get('/', [RegistrasiController::class, 'index'])->name('index');
        Route::get('/masuk', [RegistrasiController::class, 'masuk'])->name('masuk');
        Route::post('/masuk', [RegistrasiController::class, 'storeMasuk'])->name('masuk.store');
        Route::get('/keluar', [RegistrasiController::class, 'keluar'])->name('keluar');
        Route::post('/keluar', [RegistrasiController::class, 'storeKeluar'])->name('keluar.store');
    });

    Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');
    Route::get('/dokumen/{dokumen}/edit', [DokumenController::class, 'edit'])->name('dokumen.edit');
    Route::put('/dokumen/{dokumen}', [DokumenController::class, 'update'])->name('dokumen.update');
    Route::delete('/dokumen/{dokumen}', [DokumenController::class, 'destroy'])->name('dokumen.destroy');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
    Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
});
