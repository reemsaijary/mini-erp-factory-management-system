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
   public function index(Request $request)//$request contains search input, role filter, status filter
{
    $query = Employee::with('user');// get employee and related user 

    if ($request->filled('search')) {//check if  the user type something in the search box

        $search = $request->search;//This stores the search text in a variable

        //$q is a temporary query builder used only inside this block
        //use($seacrh) --> make the $search variable available inside this function
        $query->where(function ($q) use ($search) {
            //find employees where first name contains the search text OR last name contains the search text
            $q->where('first_name', 'like', '%' . $search . '%')
              ->orWhere('last_name', 'like', '%' . $search . '%');
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('role')) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('role', $request->role);
        });
    }
    //paginate(8) Show only 8 employees per page
    //appends($request->query())-->Keeps the search/filter values while moving between pages
$employees = $query->orderBy('employee_id', 'asc')->paginate(8)->appends($request->query());
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
    // delete an employee
    public function destroy(Employee $employee)
{
    //delete operations are treated as one safe unit
    //If something fails-->rollback
    DB::transaction(function () use ($employee) {
        if ($employee->user) {
            $employee->user->delete(); //delete the login account first
        }

        $employee->delete();//then delete employee record
    });

    return redirect()->route('employees.index')
        ->with('success', 'Employee deleted successfully.');
}
}