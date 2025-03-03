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

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->group(function () {
    Route::get('/primary', function () { return view('pro'); })->name('primary');
    Route::get('/home', function () { return view('pro'); })->name('home');
    Route::get('/attendance', function () { return view('pro'); })->name('attendance.index');
    Route::get('/schedule', function () { return view('pro'); })->name('schedule');
    Route::get('/work-progress', function () { return view('pro'); })->name('work-progress');
    Route::post('/work-progress', [App\Http\Controllers\WorkProgressController::class, 'store'])->name('work-progress.store');
    Route::put('/work-progress/{id}', [App\Http\Controllers\WorkProgressController::class, 'update'])->name('work-progress.update');
    Route::delete('/work-progress/{id}', [App\Http\Controllers\WorkProgressController::class, 'destroy'])->name('work-progress.destroy');
    Route::get('/profile', function () { return view('pro'); })->name('profile.index');
    Route::get('/settings', function () { return view('pro'); })->name('settings');
    Route::get('/set', function () { return view('pro'); })->name('set');
});
