<?php

use App\Http\Controllers\Dokter\ObatController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\JanjiPeriksaController;
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

     Route::resource('janji_periksa', JanjiPeriksaController::class, [
        'as' => 'dokter'
    ])->except(['show']);

    // Tambah route khusus untuk form dan simpan hasil periksa
    Route::get('janji-periksa/{id}/periksa', [JanjiPeriksaController::class, 'periksaForm'])->name('dokter.janji-periksa.periksa');
    Route::post('janji-periksa/{id}/periksa', [JanjiPeriksaController::class, 'simpanPeriksa'])->name('dokter.janji-periksa.simpan-periksa');

    // Route untuk index janji periksa by dokter (akses utama)
    Route::get('janji-periksa', [JanjiPeriksaController::class, 'index'])->name('dokter.janji-periksa.index');
});
