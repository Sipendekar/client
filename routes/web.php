<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

// Tambahkan route GET untuk halaman utama
Route::get('/', [FormController::class, 'create'])->name('form.create');
Route::get('/report', [FormController::class, 'index'])->name('form');
Route::get('/user', [FormController::class, 'index2'])->name('form.index2');
Route::post('/store', [FormController::class, 'store'])->name('form.store');
Route::get('/get-cities/{province_code}', [App\Http\Controllers\RegionController::class, 'getCities'])->name('cities');