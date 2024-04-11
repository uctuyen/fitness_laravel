<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\TrainerController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Ajax\LocationController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')
->middleware('admin');

                /** employee */
Route::group(['prefix' => 'employee'],function(){
    Route::get('index', [EmployeeController::class, 'index'])->name('employee.index')
    ->middleware('admin');
    Route::get('create', [EmployeeController::class, 'create'])->name('employee.create')
    ->middleware('admin');
    Route::post('save', [EmployeeController::class, 'save'])->name('employee.save')
    ->middleware('admin');
    Route::get('{id}/edit', [EmployeeController::class, 'edit'])->where(['id' => '[0-9]+'])->name('employee.edit')
    ->middleware('admin');
    Route::post('{id}/update', [EmployeeController::class, 'update'])->where(['id'=>'[0-9]+'])->name('employee.update')
    ->middleware('admin');
    Route::get('{id}/delete', [EmployeeController::class, 'delete'])->where(['id'=>'[0-9]+'])->name('employee.delete')
    ->middleware('admin');
    Route::delete('{id}/destroy', [EmployeeController::class, 'destroy'])->where(['id'=>'[0-9]+'])->name('employee.destroy')
    ->middleware('admin');
});
                        /** member */
Route::group(['prefix' => 'member'],function(){
    Route::get('index', [memberController::class, 'index'])->name('member.index')
    ->middleware('admin');
    Route::get('create', [memberController::class, 'create'])->name('member.create')
    ->middleware('admin');
    Route::post('save', [memberController::class, 'save'])->name('member.save')
    ->middleware('admin');
    Route::get('{id}/edit', [memberController::class, 'edit'])->where(['id' => '[0-9]+'])->name('member.edit')
    ->middleware('admin');
    Route::post('{id}/update', [memberController::class, 'update'])->where(['id'=>'[0-9]+'])->name('member.update')
    ->middleware('admin');
    Route::get('{id}/delete', [memberController::class, 'delete'])->where(['id'=>'[0-9]+'])->name('member.delete')
    ->middleware('admin');
    Route::delete('{id}/destroy', [memberController::class, 'destroy'])->where(['id'=>'[0-9]+'])->name('member.destroy')
    ->middleware('admin');
});
                /** trainer */
Route::group(['prefix' => 'trainer'],function(){
    Route::get('index', [trainerController::class, 'index'])->name('trainer.index')
    ->middleware('admin');
    Route::get('create', [trainerController::class, 'create'])->name('trainer.create')
    ->middleware('admin');
    Route::post('save', [trainerController::class, 'save'])->name('trainer.save')
    ->middleware('admin');
    Route::get('{id}/edit', [trainerController::class, 'edit'])->where(['id' => '[0-9]+'])->name('trainer.edit')
    ->middleware('admin');
    Route::post('{id}/update', [trainerController::class, 'update'])->where(['id'=>'[0-9]+'])->name('trainer.update')
    ->middleware('admin');
    Route::get('{id}/delete', [trainerController::class, 'delete'])->where(['id'=>'[0-9]+'])->name('trainer.delete')
    ->middleware('admin');
    Route::delete('{id}/destroy', [trainerController::class, 'destroy'])->where(['id'=>'[0-9]+'])->name('trainer.destroy')
    ->middleware('admin');
});   

                /**Ajax  */
Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.index')
->middleware('admin');

Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('login', [AuthController::class, 'login'])->name('auth.login')->middleware('login');;
