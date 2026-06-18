<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index');

    Route::post('/attendance/clockin', [AttendanceController::class, 'clockIn'])
        ->name('attendance.clockin');

    Route::post('/attendance/clockout', [AttendanceController::class, 'clockOut'])
        ->name('attendance.clockout');

    Route::post('/attendance/break-start', [AttendanceController::class, 'breakStart'])
        ->name('attendance.breakStart');

    Route::post('/attendance/break-end', [AttendanceController::class, 'breakEnd'])
        ->name('attendance.breakEnd');

    Route::get('/attendance/monthly', [AttendanceController::class, 'monthly'])
        ->name('attendance.monthly');

    Route::get('/attendance/export-csv', [AttendanceController::class, 'exportCsv'])
        ->name('attendance.exportCsv');

Route::get('/attendance/admin', [AttendanceController::class, 'admin'])
    ->name('attendance.admin');

Route::get('/attendance/admin/users/{user}', [AttendanceController::class, 'adminUser'])
    ->name('attendance.adminUser');

});


require __DIR__.'/auth.php';
