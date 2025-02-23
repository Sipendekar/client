<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PredictionController;

// Tambahkan route GET untuk halaman utama
Route::get('/', [FormController::class, 'index'])->name('form');
Route::post('/save-prediction', [FormController::class, 'create'])->name('form.prediction');
Route::post('/store', [FormController::class, 'store'])->name('form.store');
Route::get('/get-cities/{province_code}', [App\Http\Controllers\RegionController::class, 'getCities'])->name('cities');
Route::post('/save-prediction', [PredictionController::class, 'store']);