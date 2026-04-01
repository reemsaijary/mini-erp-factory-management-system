<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{
     //show machines when user visits /machines
    public function index(Request $request)//$request contains search input, role filter, status filter
    {
        $query = Machine::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('machine_name', 'like', '%' . $search . '%')
                  ->orWhere('machine_type', 'like', '%' . $search . '%');
        }

        if ($request->filled('machine_status')) {
            $query->where('machine_status', $request->machine_status);
        }

        $machines = $query->orderBy('machine_id', 'asc')
                          ->paginate(10)
                          ->appends($request->query());

        return view('admin.machines.index', compact('machines'));
    }
    //create machine 
    public function create()
    {
        return view('admin.machines.create');
    }
    //store machine records
    public function store(Request $request)
    {
        $request->validate([
            'machine_name'   => 'required|string|max:255',
            'machine_type'   => 'required|string|max:255',
            'purchase_date'  => 'nullable|date',
            'machine_status' => 'required|in:working,under_maintenance,inactive',
        ]);

        Machine::create([
            'machine_name'   => $request->machine_name,
            'machine_type'   => $request->machine_type,
            'purchase_date'  => $request->purchase_date,
            'machine_status' => $request->machine_status,
        ]);

        return redirect()->route('machines.index')
            ->with('success', 'Machine created successfully.');
    }
    //edit machine
    public function edit(Machine $machine)
    {
        return view('admin.machines.edit', compact('machine'));
    }
    //update machine
    public function update(Request $request, Machine $machine)
    {
        $request->validate([
            'machine_name'   => 'required|string|max:255',
            'machine_type'   => 'required|string|max:255',
            'purchase_date'  => 'nullable|date',
            'machine_status' => 'required|in:working,under_maintenance,inactive',
        ]);

        $machine->update([
            'machine_name'   => $request->machine_name,
            'machine_type'   => $request->machine_type,
            'purchase_date'  => $request->purchase_date,
            'machine_status' => $request->machine_status,
        ]);

        return redirect()->route('machines.index')
            ->with('success', 'Machine updated successfully.');
    }
    //delete machine
    public function destroy(Machine $machine)
    {
        $machine->delete();

        return redirect()->route('machines.index')
            ->with('success', 'Machine deleted successfully.');
    }
}