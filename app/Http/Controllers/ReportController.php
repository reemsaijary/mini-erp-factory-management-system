<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Production;
use App\Models\Machine;
use App\Models\MachineMaintenance;
use App\Models\Employee;
use App\Models\Payroll;

class ReportController extends Controller
{
    public function index()
    {
        // Products
        $totalProducts = Product::count();

        // Orders
        $totalOrders = Order::count();
        $newOrders = Order::where('order_status', 'new')->count();
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $confirmedOrders = Order::where('order_status', 'confirmed')->count();

        // Production
        $totalProduction = Production::count();
        $waitingProduction = Production::where('production_status', 'waiting')->count();
        $inProduction = Production::where('production_status', 'in_production')->count();
        $completedProduction = Production::where('production_status', 'completed')->count();

        // Machines
        $totalMachines = Machine::count();
        $workingMachines = Machine::where('machine_status', 'working')->count();
        $maintenanceMachines = Machine::where('machine_status', 'under_maintenance')->count();
        $inactiveMachines = Machine::where('machine_status', 'inactive')->count();

        // Maintenance
        $totalMaintenance = MachineMaintenance::count();
        $pendingMaintenance = MachineMaintenance::where('status', 'pending')->count();
        $inProgressMaintenance = MachineMaintenance::where('status', 'in_progress')->count();
        $resolvedMaintenance = MachineMaintenance::where('status', 'resolved')->count();

        // Employees
        $totalEmployees = Employee::count();

        // Payroll
        $totalPayrollRecords = Payroll::count();

        return view('admin.reports.index', compact(
            'totalProducts',

            'totalOrders',
            'newOrders',
            'pendingOrders',
            'confirmedOrders',

            'totalProduction',
            'waitingProduction',
            'inProduction',
            'completedProduction',

            'totalMachines',
            'workingMachines',
            'maintenanceMachines',
            'inactiveMachines',

            'totalMaintenance',
            'pendingMaintenance',
            'inProgressMaintenance',
            'resolvedMaintenance',

            'totalEmployees',
            'totalPayrollRecords'
        ));
    }
}