<?php

use App\Http\Controllers\Auth\DashBoardTrainerController;
use App\Http\Controllers\Auth\TrainerAttendanceController;
use App\Http\Controllers\Auth\TrainerCalendarController;
use App\Http\Controllers\Auth\TrainerLoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('trainer')->group(function () {
    Route::middleware(['auth:trainer'])->group(function () {
        Route::get('/', [TrainerLoginController::class, 'index'])->name('trainer.indexTrainer');
        Route::get('trainerLogout', [TrainerLoginController::class, 'trainerLogout'])->name('trainer.logout');
    });
    Route::post('login', [TrainerLoginController::class, 'login'])->name('trainer.login');
    Route::get('dashboardTrainer', [DashBoardTrainerController::class, 'dashboardTrainer'])->name('trainer.dashboardTrainer');

    Route::middleware(['auth:trainer'])->group(function () {
        Route::get('attendance', [TrainerAttendanceController::class, 'index'])->name('trainer.attendance');
        Route::get('attendance/check-in/{calendar}', [TrainerAttendanceController::class, 'checkIn'])->name('trainer.attendance.check-in');
        Route::post('attendance/check-in/{calendar}', [TrainerAttendanceController::class, 'postCheckIn'])->name('trainer.attendance.post-check-in');
    });
    Route::middleware(['auth:trainer'])->group(function () {
        Route::get('calendar/index', [TrainerCalendarController::class, 'index'])->name('trainer.calendar.index');
    });
});
