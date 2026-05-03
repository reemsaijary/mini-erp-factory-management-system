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
    // Summary totals
    $totalEmployees = \App\Models\Employee::count();
    $totalOrders = \App\Models\Order::count();
    $totalProducts = \App\Models\Product::count();
    $totalMachines = \App\Models\Machine::count();
    $totalProduction = \App\Models\Production::count();
    $totalMaintenance = \App\Models\MachineMaintenance::count();

    // Orders by status
    $ordersNew = \App\Models\Order::where('order_status', 'new')->count();
    $ordersPending = \App\Models\Order::where('order_status', 'pending')->count();
    $ordersConfirmed = \App\Models\Order::where('order_status', 'confirmed')->count();

    // Production by status
    $productionWaiting = \App\Models\Production::where('production_status', 'waiting')->count();
    $productionInProgress = \App\Models\Production::where('production_status', 'in_production')->count();
    $productionCompleted = \App\Models\Production::where('production_status', 'completed')->count();

    // Machines by status
    $machinesWorking = \App\Models\Machine::where('machine_status', 'working')->count();
    $machinesUnderMaintenance = \App\Models\Machine::where('machine_status', 'under_maintenance')->count();
    $machinesInactive = \App\Models\Machine::where('machine_status', 'inactive')->count();

    return view('admin.dashboard', compact(
        'totalEmployees',
        'totalOrders',
        'totalProducts',
        'totalMachines',
        'totalProduction',
        'totalMaintenance',

        'ordersNew',
        'ordersPending',
        'ordersConfirmed',

        'productionWaiting',
        'productionInProgress',
        'productionCompleted',

        'machinesWorking',
        'machinesUnderMaintenance',
        'machinesInactive'
    ));
}  
}