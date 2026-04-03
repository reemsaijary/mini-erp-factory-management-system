<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\Order;
use App\Models\Machine;
use App\Models\Employee;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    //show productions list
    public function index(Request $request)
    {
        $query = Production::with(['order', 'machine', 'employee'])
                   ->orderBy('production_id', 'desc');

        if ($request->filled('status')) {
            $query->where('production_status', $request->status);
        }

        $productions = $query->orderBy('start_date', 'desc')->paginate(10);

        return view('admin.production.index', compact('productions'));
    }
    //create order to production
public function create(Request $request)
{
    $orders = Order::whereDoesntHave('productions')
                   ->with('product')
                   ->get();

    $machines = Machine::all();
    $employees = Employee::all();

    $selectedOrderId = $request->order_id;

    return view('admin.production.create', compact(
        'orders',
        'machines',
        'employees',
        'selectedOrderId'
    ));
}
    //save records
   public function store(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,order_id',
        'machine_id' => 'required|exists:machines,machine_id',
        'employee_id' => 'required|exists:employees,employee_id',
        'start_date' => 'required|date|after_or_equal:2000-01-01|before_or_equal:2100-12-31',
        'end_date' => 'nullable|date|after_or_equal:start_date|before_or_equal:2100-12-31',
        'production_status' => 'required|in:waiting,in_production,completed',
    ]);

    Production::create([
        'order_id' => $request->order_id,
        'machine_id' => $request->machine_id,
        'employee_id' => $request->employee_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'production_status' => $request->production_status,
    ]);

    return redirect()->route('production.index')
        ->with('success', 'Production created successfully');
}
    //edit
    public function edit($id)
    {
        $production = Production::findOrFail($id);
        $orders = Order::all();
        $machines = Machine::all();
        $employees = Employee::all();

        return view('admin.production.edit', compact('production', 'orders', 'machines', 'employees'));
    }
    //save updated records
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'machine_id' => 'required|exists:machines,machine_id',
            'employee_id' => 'required|exists:employees,employee_id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'production_status' => 'required|in:waiting,in_production,completed',
        ]);

        $production = Production::findOrFail($id);
        $production->update($request->all());

        return redirect()->route('production.index')
            ->with('success', 'Production updated successfully');
    }
    //show details
    public function show($id)
{
    $production = Production::with(['order.product', 'machine', 'employee'])->findOrFail($id);

    return view('admin.production.show', compact('production'));
}
    //delete 
    public function destroy($id)
    {
        $production = Production::findOrFail($id);
        $production->delete();

        return redirect()->route('production.index')
            ->with('success', 'Production deleted successfully');
    }
}