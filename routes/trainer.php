<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TrainerLoginController;
use App\Http\Controllers\Auth\DashBoardTrainerController;
use App\Http\Controllers\Auth\TrainerAttendanceController;

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
        Route::get('attendance/check-in/{calendar}', [TrainerAttendanceController::class, 'checkIn'])->name('trainer.attendance.check-in');
        Route::post('attendance/check-in/{calendar}', [TrainerAttendanceController::class, 'postCheckIn'])->name('trainer.attendance.post-check-in');
        Route::post('attendance/save', [TrainerAttendanceController::class, 'save'])->name('trainer.attendance.save');
        Route::get('attendance/edit/{id}', [TrainerAttendanceController::class, 'edit'])->name('trainer.attendance.edit');
        Route::post('attendance/update/{id}', [TrainerAttendanceController::class, 'update'])->name('trainer.attendance.update');
        Route::get('attendance/delete/{id}', [TrainerAttendanceController::class, 'delete'])->name('trainer.attendance.delete');
        Route::get('attendance/destroy/{id}', [TrainerAttendanceController::class, 'destroy'])->name('trainer.attendance.destroy');
    });
});