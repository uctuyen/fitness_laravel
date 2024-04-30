<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TrainerLoginController;
use App\Http\Controllers\Auth\DashBoardTrainerController;

Route::prefix('trainer')->group(function () {
    Route::middleware(['auth:trainer'])->group(function () {
        Route::get('/', [TrainerLoginController::class, 'indexTrainer'])->name('trainer.indexTrainer');
        Route::get('logout', [TrainerLoginController::class, 'logout'])->name('trainer.logout');
    });
    Route::post('login', [TrainerLoginController::class, 'login'])->name('trainer.login');
    Route::get('dashboardTrainer', [DashBoardTrainerController::class, 'dashboardTrainer'])->name('trainer.dashboardTrainer');
});