<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\TrainerController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\MajorController;
use App\Http\Controllers\Backend\ClassController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\EquipmentController;
use App\Http\Controllers\Backend\CalendarController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Ajax\LocationController;
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

                /** actorrrrrrrrrrrrrrrrr *****************************************************/
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
    Route::get('index', [TrainerController::class, 'index'])->name('trainer.index')
    ->middleware('admin');
    Route::get('create', [TrainerController::class, 'create'])->name('trainer.create')
    ->middleware('admin');
    Route::post('save', [TrainerController::class, 'save'])->name('trainer.save')
    ->middleware('admin');
    Route::get('{id}/edit', [TrainerController::class, 'edit'])->where(['id' => '[0-9]+'])->name('trainer.edit')
    ->middleware('admin');
    Route::post('{id}/update', [TrainerController::class, 'update'])->where(['id'=>'[0-9]+'])->name('trainer.update')
    ->middleware('admin');
    Route::get('{id}/delete', [TrainerController::class, 'delete'])->where(['id'=>'[0-9]+'])->name('trainer.delete')
    ->middleware('admin');
    Route::delete('{id}/destroy', [TrainerController::class, 'destroy'])->where(['id'=>'[0-9]+'])->name('trainer.destroy')
    ->middleware('admin');
});   

Route::group(['prefix' => 'attendance'],function(){
    Route::get('index', [AttendanceController::class, 'index'])->name('attendance.index')
    ->middleware('admin');
    Route::get('create', [AttendanceController::class, 'create'])->name('attendance.create')
    ->middleware('admin');
    Route::post('save', [AttendanceController::class, 'save'])->name('attendance.save')
    ->middleware('admin');
    Route::get('{id}/edit', [AttendanceController::class, 'edit'])->where(['id' => '[0-9]+'])->name('attendance.edit')
    ->middleware('admin');
    Route::post('{id}/update', [AttendanceController::class, 'update'])->where(['id'=>'[0-9]+'])->name('attendance.update')
    ->middleware('admin');
    Route::get('{id}/delete', [AttendanceController::class, 'delete'])->where(['id'=>'[0-9]+'])->name('attendance.delete')
    ->middleware('admin');
    Route::delete('{id}/destroy', [AttendanceController::class, 'destroy'])->where(['id'=>'[0-9]+'])->name('attendance.destroy')
    ->middleware('admin');
});   
                        /** item *****************************************************/
                        /** major */
Route::group(['prefix' => 'major'],function(){
    Route::get('index', [MajorController::class, 'index'])->name('major.index')
    ->middleware('admin');
    Route::get('create', [MajorController::class, 'create'])->name('major.create')
    ->middleware('admin');
    Route::post('save', [MajorController::class, 'save'])->name('major.save')
    ->middleware('admin');
    Route::get('{id}/edit', [MajorController::class, 'edit'])->where(['id' => '[0-9]+'])->name('major.edit')
    ->middleware('admin');
    Route::post('{id}/update', [MajorController::class, 'update'])->where(['id'=>'[0-9]+'])->name('major.update')
    ->middleware('admin');
    Route::get('{id}/delete', [MajorController::class, 'delete'])->where(['id'=>'[0-9]+'])->name('major.delete')
    ->middleware('admin');
    Route::delete('{id}/destroy', [MajorController::class, 'destroy'])->where(['id'=>'[0-9]+'])->name('major.destroy')
    ->middleware('admin');
});
                        /** 'calendar */
Route::group(['prefix' => 'admin'],function(){
    Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar.index')
    ->middleware('admin');
    Route::post('save', [CalendarController::class, 'save'])->name('calendar.save')
    ->middleware('admin');
    Route::PATCH('update/{id}', [CalendarController::class, 'update'])->name('calendar.update')
    ->middleware('admin');
    Route::DELETE('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy')
    ->middleware('admin');
});
                        /** 'class */
Route::group(['prefix' => 'class'],function(){
    Route::get('index', [ClassController::class, 'index'])->name('class.index')
    ->middleware('admin');
    Route::get('create', [ClassController::class, 'create'])->name('class.create')
    ->middleware('admin');
    Route::post('save', [ClassController::class, 'save'])->name('class.save')
    ->middleware('admin');
    Route::get('{id}/edit', [ClassController::class, 'edit'])->where(['id' => '[0-9]+'])->name('class.edit')
    ->middleware('admin');
    Route::post('{id}/update', [ClassController::class, 'update'])->where(['id'=>'[0-9]+'])->name('class.update')
    ->middleware('admin');
    Route::get('{id}/delete', [ClassController::class, 'delete'])->where(['id'=>'[0-9]+'])->name('class.delete')
    ->middleware('admin');
    Route::delete('{id}/destroy', [ClassController::class, 'destroy'])->where(['id'=>'[0-9]+'])->name('class.destroy')
    ->middleware('admin');
});     
Route::group(['prefix' => 'room'],function(){
    Route::get('index', [RoomController::class, 'index'])->name('room.index')
    ->middleware('admin');
    Route::get('create', [RoomController::class, 'create'])->name('room.create')
    ->middleware('admin');
    Route::post('save', [RoomController::class, 'save'])->name('room.save')
    ->middleware('admin');
    Route::get('{id}/edit', [RoomController::class, 'edit'])->where(['id' => '[0-9]+'])->name('room.edit')
    ->middleware('admin');
    Route::post('{id}/update', [RoomController::class, 'update'])->where(['id'=>'[0-9]+'])->name('room.update')
    ->middleware('admin');
    Route::get('{id}/delete', [RoomController::class, 'delete'])->where(['id'=>'[0-9]+'])->name('room.delete')
    ->middleware('admin');
    Route::delete('{id}/destroy', [RoomController::class, 'destroy'])->where(['id'=>'[0-9]+'])->name('room.destroy')
    ->middleware('admin');
});                                                         
                             /** 'equipment */
Route::group(['prefix' => 'equipment'],function(){
    Route::get('index', [EquipmentController::class, 'index'])->name('equipment.index')
    ->middleware('admin');
    Route::get('create', [EquipmentController::class, 'create'])->name('equipment.create')
    ->middleware('admin');
    Route::post('save', [EquipmentController::class, 'save'])->name('equipment.save')
    ->middleware('admin');
    Route::get('{id}/edit', [EquipmentController::class, 'edit'])->where(['id' => '[0-9]+'])->name('equipment.edit')
    ->middleware('admin');
    Route::post('{id}/update', [EquipmentController::class, 'update'])->where(['id'=>'[0-9]+'])->name('equipment.update')
    ->middleware('admin');
    Route::get('{id}/delete', [EquipmentController::class, 'delete'])->where(['id'=>'[0-9]+'])->name('equipment.delete')
    ->middleware('admin');
    Route::delete('{id}/destroy', [EquipmentController::class, 'destroy'])->where(['id'=>'[0-9]+'])->name('equipment.destroy')
    ->middleware('admin');
});                        
                /**Ajax  */
Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.index')
->middleware('admin');

Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('login', [AuthController::class, 'login'])->name('auth.login')->middleware('login');;




