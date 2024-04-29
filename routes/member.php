<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MemberLoginController;

Route::prefix('member')->group(function () {
    Route::middleware(['auth:member'])->group(function () {
        Route::get('/', [MemberLoginController::class, 'index'])->name('member.index');
        Route::get('logout', [MemberLoginController::class, 'logout'])->name('member.logout');
    });
    Route::get('login', [MemberLoginController::class, 'login'])->name('member.login');
});