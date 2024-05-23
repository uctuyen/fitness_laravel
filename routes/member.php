<?php

use App\Http\Controllers\Auth\AttendanceController;
use App\Http\Controllers\Auth\DashBoardMemberController;
use App\Http\Controllers\Auth\MemberLoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('member')->group(function () {
    Route::middleware(['auth:member'])->group(function () {
        Route::get('/', [MemberLoginController::class, 'index'])->name('member.indexMember');
        Route::get('memberLogout', [MemberLoginController::class, 'memberLogout'])->name('member.logout');
    });
    Route::post('login', [MemberLoginController::class, 'login'])->name('member.login');
    Route::get('dashboardMember', [DashBoardMemberController::class, 'dashboardMember'])->name('member.dashboardMember');

    Route::resource('attendances', AttendanceController::class);
    Route::delete('attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
    Route::post('attendance/get-calendar-list', [AttendanceController::class, 'getCalendarList']);
});
