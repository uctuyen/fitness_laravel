<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TrainerLoginController;
use App\Http\Controllers\Auth\DashBoardTrainerController;

Route::prefix('trainer')->group(function () {
    Route::middleware(['auth:trainer'])->group(function () {
        Route::get('/', [TrainerLoginController::class, 'indexTrainer'])->name('trainer.indexTrainer');
        Route::get('trainerLogout', [TrainerLoginController::class, 'trainerLogout'])->name('trainer.logout');
    });
    Route::post('login', [TrainerLoginController::class, 'login'])->name('trainer.login');
    Route::get('dashboardTrainer', [DashBoardTrainerController::class, 'dashboardTrainer'])->name('trainer.dashboardTrainer');

    Route::group(['prefix' => 'attendance'],function(){
        Route::get('index', [TrainerAttendanceController::class, 'index'])->name('attendance.index')
        ->middleware('admin');
        Route::get('create', [TrainerAttendanceController::class, 'create'])->name('attendance.create')
        ->middleware('admin');
        Route::post('save', [TrainerAttendanceController::class, 'save'])->name('attendance.save')
        ->middleware('admin');
        Route::get('{id}/edit', [TrainerAttendanceController::class, 'edit'])->where(['id' => '[0-9]+'])->name('attendance.edit')
        ->middleware('admin');
        Route::post('{id}/update', [TrainerAttendanceController::class, 'update'])->where(['id'=>'[0-9]+'])->name('attendance.update')
        ->middleware('admin');
        Route::get('{id}/delete', [TrainerAttendanceController::class, 'delete'])->where(['id'=>'[0-9]+'])->name('attendance.delete')
        ->middleware('admin');
        Route::delete('{id}/destroy', [TrainerAttendanceController::class, 'destroy'])->where(['id'=>'[0-9]+'])->name('attendance.destroy')
        ->middleware('admin');
    }); 
});