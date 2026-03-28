<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//used for DB::transaction(..)
use Illuminate\Support\Facades\Hash;//used for hasg passwords

class EmployeeController extends Controller
{
    //show employees when user visits /employees
    public function index()
    {
        //load related user automatically and fetch all records
        $employees = Employee::with('user')->get();
    //send data to blade view
        return view('admin.employees.index', compact('employees'));
    }
    //called when visting /employees/create
    public function create()
    {
        return view('admin.employees.create');
    }
    // runs when form is submitted
    public function store(Request $request)
    {
        //check data before saving
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
    // run multiple DB operations safely 
    //and to make sure ALL operations succeed OR NONE of them happen
        DB::transaction(function () use ($request) {
            // insert into employees table
            $employee = Employee::create([
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'phone'        => $request->phone,
                'basic_salary' => $request->basic_salary,
                'status'       => $request->status,
            ]);
            // insert into user table
            User::create([
                'employee_id' => $employee->employee_id, //link user to employee
                'name'        => $employee->first_name . ' ' . $employee->last_name,
                'email'       => $request->email,
                'password'    => Hash::make($request->password),
                'role'        => $request->role,
            ]);
        });

        return redirect()->route('employees.index')
            ->with('success', 'Employee and user account created successfully.');
    }

    //give employee where id = URL value
    public function edit(Employee $employee)
{
    //loads the related user data
    $employee->load('user');
    //Sends employee data to the edit page
    return view('admin.employees.edit', compact('employee'));
}

    //recieves form data and employee object
public function update(Request $request, Employee $employee)
{
    $request->validate([
        'first_name'   => 'required|string|max:255',
        'last_name'    => 'required|string|max:255',
        'phone'        => 'nullable|string|max:20',
        'basic_salary' => 'required|numeric|min:0',
        'status'       => 'required|in:active,inactive,on_leave',
        'email'        => 'required|email|unique:users,email,' . ($employee->user->id ?? 'NULL'),
        'role'         => 'required|in:admin,employee',
        'password'     => 'nullable|string|min:8|confirmed',
    ]);
    // wrap everything safely
    DB::transaction(function () use ($request, $employee) {
        $employee->update([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'phone'        => $request->phone,
            'basic_salary' => $request->basic_salary,
            'status'       => $request->status,
        ]);
    //Store data temporarily before saving
        if ($employee->user) {
            $userData = [
                'name'  => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'role'  => $request->role,
            ];
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $employee->user->update($userData);
        }
    });

    return redirect()->route('employees.index')
        ->with('success', 'Employee updated successfully.');
}
}