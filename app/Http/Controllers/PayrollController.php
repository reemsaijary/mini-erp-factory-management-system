<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{

    //  Display payroll records 
    public function index(Request $request)
    {
        $query = Payroll::with('employee');

        // Search by employee first name or last name
        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%');
            });
        }

        // Filter by month
        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payrollRecords = $query->orderBy('year', 'desc')
                                ->orderBy('month', 'desc')
                                ->paginate(5)
                                ->appends($request->query());

        return view('admin.payroll.index', compact('payrollRecords'));
    }

     // Show payroll creation form.
    public function create()
    {
        $employees = Employee::all();

        return view('admin.payroll.create', compact('employees'));
    }

    // Store a new payroll record.
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'month'       => 'required|integer|min:1|max:12',
            'year'        => 'required|integer',
            'bonus'       => 'nullable|numeric|min:0',
            'deductions'  => 'nullable|numeric|min:0',
            'status'      => 'required|in:paid,unpaid',
        ]);

        // Get selected employee
        $employee = Employee::findOrFail($request->employee_id);

        // Get salary values
        $basicSalary = $employee->basic_salary;
        $bonus = $request->bonus ?? 0;
        $deductions = $request->deductions ?? 0;

        // Calculate net salary
        $netSalary = $basicSalary + $bonus - $deductions;

        // Create payroll record
        Payroll::create([
            'employee_id'  => $employee->employee_id,
            'month'        => $request->month,
            'year'         => $request->year,
            'basic_salary' => $basicSalary,
            'bonus'        => $bonus,
            'deductions'   => $deductions,
            'overtime'     => 0, // not used for now
            'net_salary'   => $netSalary,
            'status'       => $request->status,
        ]);

        return redirect()
            ->route('payroll.index')
            ->with('success', 'Payroll created successfully.');
    }

    
    // Show edit form for a payroll record.
     
    public function edit(Payroll $payroll)
    {
        return view('admin.payroll.edit', compact('payroll'));
    }

    // Update payroll bonus, deductions, and status
    public function update(Request $request, Payroll $payroll)
    {
        $request->validate([
            'bonus'      => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'status'     => 'required|in:paid,unpaid',
        ]);

        $bonus = $request->bonus ?? 0;
        $deductions = $request->deductions ?? 0;

        // Recalculate net salary
        $netSalary = $payroll->basic_salary + $bonus - $deductions;

        // Update payroll record
        $payroll->update([
            'bonus'      => $bonus,
            'deductions' => $deductions,
            'net_salary' => $netSalary,
            'status'     => $request->status,
        ]);

        return redirect()
            ->route('payroll.index')
            ->with('success', 'Payroll updated successfully.');
    }
}