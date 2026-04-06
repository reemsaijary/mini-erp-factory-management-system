<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function employeeDashboard()
    {
        return view('employee.dashboard');
    }

    public function check()
    {
        return view('employee.check');
    }

    public function attendance()
    {
        return view('employee.attendance');
    }

    public function profile()
    {
        return view('employee.profile');
    }
}