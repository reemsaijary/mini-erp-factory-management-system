<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MachineMaintenanceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/employee/dashboard', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');

    //profile 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // admin only modules
    Route::middleware('role:admin')->group(function () {

        //ATTENDANCE 
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');

        //  PAYROLL 
        Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');

        //  EMPLOYEES 
        Route::resource('employees', EmployeeController::class);

        //  MACHINES 
        Route::resource('machines', MachineController::class);

        //  MACHINE MAINTENANCE 
        Route::resource('maintenance', MachineMaintenanceController::class);

        //  ORDERS 
        Route::resource('orders', OrderController::class);

        //  PRODUCTION 
        Route::resource('production', ProductionController::class);
        
        // PRODUCTS
        Route::resource('products', ProductController::class);

        //SETTINGS
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

        // REPORTS
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });//middleware('role:admin')

});//middleware(['auth'])

require __DIR__.'/auth.php';