<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TrainerLoginController;

Route::prefix('trainer')->group(function () {
    Route::middleware(['auth:trainer'])->group(function () {
        Route::get('/', [TrainerLoginController::class, 'index'])->name('trainer.index');
        Route::get('logout', [TrainerLoginController::class, 'logout'])->name('trainer.logout');
    });
    Route::get('login', [TrainerLoginController::class, 'login'])->name('trainer.login');
});