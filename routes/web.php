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
    Route::get('/primary', [App\Http\Controllers\HomeController::class, 'index'])->name('primary');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/schedule', function () { return view('jdwl'); })->name('schedule');
    Route::get('/work-progress', [App\Http\Controllers\WorkProgressController::class, 'index'])->name('work-progress');
    Route::post('/work-progress', [App\Http\Controllers\WorkProgressController::class, 'store'])->name('work-progress.store');
    Route::put('/work-progress/{id}', [App\Http\Controllers\WorkProgressController::class, 'update'])->name('work-progress.update');
    Route::delete('/work-progress/{id}', [App\Http\Controllers\WorkProgressController::class, 'destroy'])->name('work-progress.destroy');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
    Route::get('/set', function () { return view('set'); })->name('set');
});
