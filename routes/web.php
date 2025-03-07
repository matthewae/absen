<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SupervisorDashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\WorkProgressController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;

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

// Guest Routes
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Auth::routes(['verify' => true]);

// Supervisor Authentication Routes
Route::prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.submit');
});

// Supervisor Routes (No Auth Required)
Route::prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('/dashboard', [SupervisorDashboardController::class, 'index'])->name('dashboard');
    Route::put('/work-progress/{workProgress}/status', [SupervisorDashboardController::class, 'updateWorkProgressStatus'])
        ->name('work-progress.status');
});
Route::get('/super', [SupervisorDashboardController::class, 'index'])->name('super');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard Routes
    Route::get('/primary', function () { return view('primary'); })->name('primary');
    Route::get('/spvschedule', function () {
        $staffMembers = \App\Models\User::where('role', 'staff')->get();
        return view('SPVSchedule', compact('staffMembers'));
    })->name('spvschedule');
    Route::get('/home', [SupervisorDashboardController::class, 'index'])->name('home');

    // Attendance Routes
    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::post('/', [AttendanceController::class, 'store'])->name('store');
        Route::post('/checkout', [AttendanceController::class, 'store'])->name('checkout');
        Route::post('/leave', [AttendanceController::class, 'leave'])->name('leave');
    });
    Route::get('/attend', function () {
        $attend = \App\Models\Attendance::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->get();
        return view('attend', compact('attend'));
    })->name('attend');
    Route::get('/jdwl', function () {
        $attendances = \App\Models\Attendance::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->get();
        return view('jdwl', ['attendances' => $attendances]);
    })->name('jdwl');

    // Work Progress Routes
    Route::prefix('work-progress')->name('work-progress.')->group(function () {
        Route::get('/', function () { 
            $workProgresses = \App\Models\WorkProgress::where('user_id', auth()->id())
                ->latest()
                ->get();
            return view('work-progress', compact('workProgresses')); 
        })->name('index');
        Route::post('/', [WorkProgressController::class, 'store'])->name('store');
        Route::put('/{id}', [WorkProgressController::class, 'update'])->name('update');
        Route::delete('/{id}', [WorkProgressController::class, 'destroy'])->name('destroy');
    });

    // Profile Routes
    Route::get('/pro', function () { return view('pro'); })->name('pro');
    Route::get('/set', function () { return view('set', ['user' => auth()->user()]); })->name('set');
    Route::put('/profile/update-photo', [UserController::class, 'updatePhoto'])->name('profile.update-photo');
    Route::post('/update-email', [UserController::class, 'updateEmail'])->name('update.email');
    Route::post('/update-password', [PasswordController::class, 'update'])->name('password.update');
});
