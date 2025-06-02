<?php

use App\Http\Controllers\Dokter\ObatController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');
    
    Route::resource('obat', ObatController::class, [
        'as' => 'dokter'
    ])->except(['show']);
});