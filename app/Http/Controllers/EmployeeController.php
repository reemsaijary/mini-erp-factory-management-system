<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->get();

        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'phone'        => 'nullable|string|max:20',
            'basic_salary' => 'required|numeric|min:0',
            'status'       => 'required|in:active,inactive,on_leave',
            'email'        => 'required|email|unique:users,email',
            'role'         => 'required|in:admin,employee',
            'password'     => 'required|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($request) {
            $employee = Employee::create([
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'phone'        => $request->phone,
                'basic_salary' => $request->basic_salary,
                'status'       => $request->status,
            ]);

            User::create([
                'employee_id' => $employee->employee_id,
                'name'        => $employee->first_name . ' ' . $employee->last_name,
                'email'       => $request->email,
                'password'    => Hash::make($request->password),
                'role'        => $request->role,
            ]);
        });

        return redirect()->route('employees.index')
            ->with('success', 'Employee and user account created successfully.');
    }
}