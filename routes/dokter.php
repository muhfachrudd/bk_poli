<?php

use App\Http\Controllers\Dokter\ObatController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    // Resource routes Obat for Dokter
    Route::resource('obat', ObatController::class, [
        'as' => 'dokter'
    ])->except(['show']);

    // Resource routes Jadwal Periksa for Dokter
    Route::resource('jadwal', JadwalPeriksaController::class, [
        'as' => 'dokter'
    ])->except(['show']);
    
    // Custom route to toggle status of Jadwal Periksa
    Route::patch('jadwal/{jadwal}/toggle-status', [JadwalPeriksaController::class, 'toggleStatus'])->name('dokter.jadwal.toggle-status');
});
