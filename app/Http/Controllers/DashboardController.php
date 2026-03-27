<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//Give the currently logged-in user

class DashboardController extends Controller
{
    //This is the main function used when user goes to /dashboard
    public function index()
    {
        $user = Auth::user();//Get the currently logged-in user from the database
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'employee') {
            return redirect()->route('employee.dashboard');
        }

        abort(403, 'Unauthorized role');
    }
//This function runs when user goes to /admin/dashboard

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
//Runs when user goes to /employee/dashboard

    public function employeeDashboard()
    {
        return view('employee.dashboard');
    }
}