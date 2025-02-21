<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FormController::class, 'create'])->name('form');
Route::post('/', [FormController::class, 'store'])->name('form.store');
Route::get('/get-cities/{province_code}', [App\Http\Controllers\RegionController::class, 'getCities'])->name('cities');