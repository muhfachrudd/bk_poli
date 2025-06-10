<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pasien\JanjiPeriksaController;

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');

    // Janji Periksa resource routes
    Route::resource('janji-periksa', JanjiPeriksaController::class, [
        'as' => 'pasien'
    ])->except(['show']);
});
