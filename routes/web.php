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
    Route::get('/primary', function () { return view('primary'); })->name('primary');
    // Route::get('/home', function () { return view('pro'); })->name('home');
    Route::get('/attend', function () {
    $attend = \App\Models\Attendance::where('user_id', auth()->id())
        ->orderBy('date', 'desc')
        ->get();
    return view('attend', compact('attend'));
})->name('attend');
    Route::post('/attendance', [App\Http\Controllers\AttendanceController::class, 'store'])->name('attendance.store');
    Route::post('/attendance/checkout', [App\Http\Controllers\AttendanceController::class, 'store'])->name('attendance.checkout');
    Route::post('/attendance/leave', [App\Http\Controllers\AttendanceController::class, 'leave'])->name('attendance.leave');
    Route::get('/jdwl', function () {
        $attendances = \App\Models\Attendance::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->get();
        return view('jdwl', ['attendances' => $attendances]);
    })->name('jdwl');
    Route::get('/work-progress', function () { 
        $workProgress = \App\Models\WorkProgress::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('work-progress', ['workProgress' => $workProgress]); 
    })->name('work-progress');
    Route::post('/work-progress', [App\Http\Controllers\WorkProgressController::class, 'store'])->name('work-progress.store');
    Route::put('/work-progress/{id}', [App\Http\Controllers\WorkProgressController::class, 'update'])->name('work-progress.update');
    Route::delete('/work-progress/{id}', [App\Http\Controllers\WorkProgressController::class, 'destroy'])->name('work-progress.destroy');
    Route::get('/pro', function () { return view('pro'); })->name('pro');
    // Route::get('/settings', function () { return view('set'); })->name('set');
    Route::get('/set', function () { return view('set', ['user' => auth()->user()]); })->name('set');
    Route::post('/update-email', [App\Http\Controllers\UserController::class, 'updateEmail'])->name('update.email');
    Route::post('/update-password', [App\Http\Controllers\PasswordController::class, 'update'])->name('password.update');
});
