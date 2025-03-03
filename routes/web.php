<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/work-progress', [App\Http\Controllers\WorkProgressController::class, 'index'])->name('work-progress');
    Route::post('/work-progress', [App\Http\Controllers\WorkProgressController::class, 'store'])->name('work-progress.store');
    Route::put('/work-progress/{id}', [App\Http\Controllers\WorkProgressController::class, 'update'])->name('work-progress.update');
    Route::delete('/work-progress/{id}', [App\Http\Controllers\WorkProgressController::class, 'destroy'])->name('work-progress.destroy');
});
