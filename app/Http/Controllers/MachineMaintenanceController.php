<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Machine;
use App\Models\MachineMaintenance;
use Illuminate\Http\Request;

class MachineMaintenanceController extends Controller
{
    //shows all maintenance records
    public function index(Request $request)
    {
        $query = MachineMaintenance::with(['machine', 'employee']);
    //search 
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('machine', function ($machineQuery) use ($search) {
                    $machineQuery->where('machine_name', 'like', '%' . $search . '%')
                                 ->orWhere('machine_type', 'like', '%' . $search . '%');
                })->orWhereHas('employee', function ($employeeQuery) use ($search) {
                    $employeeQuery->where('first_name', 'like', '%' . $search . '%')
                                  ->orWhere('last_name', 'like', '%' . $search . '%');
                });
            });
        }
    // filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    //filter by report date
        if ($request->filled('report_date')) {
            $query->whereDate('report_date', $request->report_date);
        }

        $maintenanceRecords = $query->orderBy('report_date', 'desc')
                                    ->paginate(10)
                                    ->appends($request->query());

        return view('admin.maintenance.index', compact('maintenanceRecords'));
    }
    //opens form page
    public function create()
    {
        //Get data for dropdowns
        $machines = Machine::orderBy('machine_name')->get();
        $employees = Employee::orderBy('first_name')->get();

        return view('admin.maintenance.create', compact('machines', 'employees'));
    }
    //save new records, handles form submission
    public function store(Request $request)
    {
        //check input before saving
        $request->validate([
            'machine_id'   => 'required|exists:machines,machine_id',
            'reported_by'  => 'required|exists:employees,employee_id',
            'description'  => 'required|string',
            'report_date'  => 'required|date',
            'status'       => 'required|in:pending,in_progress,resolved',
        ]);
    //Insert into database
        MachineMaintenance::create([
            'machine_id'  => $request->machine_id,
            'reported_by' => $request->reported_by,
            'description' => $request->description,
            'report_date' => $request->report_date,
            'status'      => $request->status,
        ]);

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance record created successfully.');
    }
    //Receives ID from URL
   public function edit($id)
    {
    $maintenance = MachineMaintenance::findOrFail($id);
    $machines = Machine::orderBy('machine_name')->get();
    $employees = Employee::orderBy('first_name')->get();

    return view('admin.maintenance.edit', compact('maintenance', 'machines', 'employees'));
}
    //handles edit form
    public function update(Request $request, $id)
{
    $request->validate([
        'machine_id'   => 'required|exists:machines,machine_id',
        'reported_by'  => 'required|exists:employees,employee_id',
        'description'  => 'required|string',
        'report_date'  => 'required|date',
        'status'       => 'required|in:pending,in_progress,resolved',
    ]);

    $maintenance = MachineMaintenance::findOrFail($id);

    $maintenance->update([
        'machine_id'  => $request->machine_id,
        'reported_by' => $request->reported_by,
        'description' => $request->description,
        'report_date' => $request->report_date,
        'status'      => $request->status,
    ]);

    return redirect()->route('maintenance.index')
        ->with('success', 'Maintenance record updated successfully.');
}
    //delete record
   public function destroy($id)
{
    $maintenance = MachineMaintenance::findOrFail($id);
    $maintenance->delete();

    return redirect()->route('maintenance.index')
        ->with('success', 'Maintenance record deleted successfully.');
}
}