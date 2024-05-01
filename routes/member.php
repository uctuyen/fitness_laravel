<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MemberLoginController;
use App\Http\Controllers\Auth\DashBoardMemberController;

Route::prefix('member')->group(function () {
    Route::middleware(['auth:member'])->group(function () {
        Route::get('/', [MemberLoginController::class, 'index'])->name('member.indexMember');
        Route::get('memberLogout', [MemberLoginController::class, 'memberLogout'])->name('member.logout');
    });
    Route::post('login', [MemberLoginController::class, 'login'])->name('member.login');
    Route::get('dashboardMember', [DashBoardMemberController::class, 'dashboardMember'])->name('member.dashboardMember');

});