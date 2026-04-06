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
    $totalEmployees = \App\Models\Employee::count();
    $totalOrders = \App\Models\Order::count();
    $totalProducts = \App\Models\Product::count();
    $totalMachines = \App\Models\Machine::count();
    $totalProduction = \App\Models\Production::count();
    $totalMaintenance = \App\Models\MachineMaintenance::count();

    return view('admin.dashboard', compact(
        'totalEmployees',
        'totalOrders',
        'totalProducts',
        'totalMachines',
        'totalProduction',
        'totalMaintenance'
    ));
}
    
}