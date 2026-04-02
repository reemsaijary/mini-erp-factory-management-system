<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MachineMaintenanceController;
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/employee/dashboard', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');
   
    //attendnace
    Route::get('/attendance', [AttendanceController::class, 'index'])
    ->middleware('role:admin')
    ->name('attendance.index');

    //payroll
    Route::get('/payroll', [PayrollController::class, 'index']) 
    ->middleware('role:admin')
    ->name('payroll.index');

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //employees
    Route::get('/employees', [EmployeeController::class, 'index'])
    ->middleware('role:admin')
    ->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])
    ->middleware('role:admin')
    ->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])
    ->middleware('role:admin')
    ->name('employees.store');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])
    ->middleware('role:admin')
    ->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])
    ->middleware('role:admin')
    ->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])
    ->middleware('role:admin')
    ->name('employees.destroy');

    //machines
    Route::get('/machines', [MachineController::class, 'index'])
    ->middleware('role:admin')
    ->name('machines.index');
    Route::get('/machines/create', [MachineController::class, 'create'])
    ->middleware('role:admin')
    ->name('machines.create');
    Route::post('/machines', [MachineController::class, 'store'])
    ->middleware('role:admin')
    ->name('machines.store');
    Route::get('/machines/{machine}/edit', [MachineController::class, 'edit'])
    ->middleware('role:admin')
    ->name('machines.edit');
    Route::put('/machines/{machine}', [MachineController::class, 'update'])
    ->middleware('role:admin')
    ->name('machines.update');
    Route::delete('/machines/{machine}', [MachineController::class, 'destroy'])
    ->middleware('role:admin')
    ->name('machines.destroy');
   
    //machine maintenance
    Route::get('/maintenance', [MachineMaintenanceController::class, 'index'])
    ->middleware('role:admin')
    ->name('maintenance.index');
    Route::get('/maintenance/create', [MachineMaintenanceController::class, 'create'])
    ->middleware('role:admin')
    ->name('maintenance.create');
    Route::post('/maintenance', [MachineMaintenanceController::class, 'store'])
    ->middleware('role:admin')
    ->name('maintenance.store');
    Route::get('/maintenance/{maintenance}/edit', [MachineMaintenanceController::class, 'edit'])
    ->middleware('role:admin')
    ->name('maintenance.edit');
    Route::put('/maintenance/{maintenance}', [MachineMaintenanceController::class, 'update'])
    ->middleware('role:admin')
    ->name('maintenance.update');
    Route::delete('/maintenance/{maintenance}', [MachineMaintenanceController::class, 'destroy'])
    ->middleware('role:admin')->name('maintenance.destroy');
    });


require __DIR__.'/auth.php';