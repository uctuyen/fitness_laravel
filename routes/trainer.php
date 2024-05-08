<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TrainerLoginController;
use App\Http\Controllers\Auth\DashBoardTrainerController;
use App\Http\Controllers\Auth\TrainerAttendanceController;
use App\Http\Controllers\Auth\TrainerCalendarController;

Route::prefix('trainer')->group(function () {
    Route::middleware(['auth:trainer'])->group(function () {
        Route::get('/', [TrainerLoginController::class, 'index'])->name('trainer.indexTrainer');
        Route::get('trainerLogout', [TrainerLoginController::class, 'trainerLogout'])->name('trainer.logout');
    });
    Route::post('login', [TrainerLoginController::class, 'login'])->name('trainer.login');
    Route::get('dashboardTrainer', [DashBoardTrainerController::class, 'dashboardTrainer'])->name('trainer.dashboardTrainer');

   Route::middleware(['auth:trainer'])->group(function () {
        Route::get('attendance', [TrainerAttendanceController::class, 'index'])->name('trainer.attendance');
        Route::get('attendance/create', [TrainerAttendanceController::class, 'create'])->name('trainer.attendance.create');
        Route::post('attendance/save', [TrainerAttendanceController::class, 'save'])->name('trainer.attendance.save');
        Route::get('attendance/edit/{id}', [TrainerAttendanceController::class, 'edit'])->name('trainer.attendance.edit');
        Route::post('attendance/update/{id}', [TrainerAttendanceController::class, 'update'])->name('trainer.attendance.update');
        Route::get('attendance/delete/{id}', [TrainerAttendanceController::class, 'delete'])->name('trainer.attendance.delete');
        Route::get('attendance/destroy/{id}', [TrainerAttendanceController::class, 'destroy'])->name('trainer.attendance.destroy');
    });
    Route::middleware(['auth:trainer'])->group(function () {
        Route::get('calendar/index', [TrainerCalendarController::class, 'index'])->name('calendar.index');
    });
});