<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Employee;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //show orders
    public function index(Request $request)
    {
        $query = Order::with(['product', 'employee', 'productions'])
              ->orderBy('order_id', 'desc');
    //search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('product', function ($productQuery) use ($search) {
                    $productQuery->where('product_name', 'like', '%' . $search . '%');
                })->orWhereHas('employee', function ($employeeQuery) use ($search) {
                    $employeeQuery->where('first_name', 'like', '%' . $search . '%')
                                  ->orWhere('last_name', 'like', '%' . $search . '%');
                });
            });
        }

        //filter by status
        if ($request->filled('order_status')) {
            $query->where('order_status', $request->order_status);
        }
    // filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
    // filter by order date
        if ($request->filled('order_date')) {
            $query->whereDate('order_date', $request->order_date);
        }

        $orders = $query->orderBy('order_date', 'desc')
                        ->paginate(10)
                        ->appends($request->query());

        return view('admin.orders.index', compact('orders'));
    }
    //create order
    public function create()
    {
        $products = Product::orderBy('product_name')->get();
        $employees = Employee::orderBy('first_name')->get();

        return view('admin.orders.create', compact('products', 'employees'));
    }
    //save order records
    public function store(Request $request)
    {
        //check before saving
        $request->validate([
            'product_id'    => 'required|exists:products,product_id',
            'quantity'      => 'required|integer|min:1',
            'order_date'    => 'required|date',
            'due_date'      => 'required|date|after_or_equal:order_date',
            'priority'      => 'required|in:high,medium,low',
            'order_status'  => 'required|in:new,pending,confirmed',
        ]);
    //insert into DB
        Order::create([
            'product_id'   => $request->product_id,
            'created_by'   => auth()->user()->employee_id,
            'quantity'     => $request->quantity,
            'order_date'   => $request->order_date,
            'due_date'     => $request->due_date,
            'priority'     => $request->priority,
            'order_status' => $request->order_status,
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully.');
    }
    //open edit form
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $products = Product::orderBy('product_name')->get();
        $employees = Employee::orderBy('first_name')->get();

        return view('admin.orders.edit', compact('order', 'products', 'employees'));
    }
    //save edit records
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id'    => 'required|exists:products,product_id',
            'quantity'      => 'required|integer|min:1',
            'order_date'    => 'required|date',
            'due_date'      => 'required|date|after_or_equal:order_date',
            'priority'      => 'required|in:high,medium,low',
            'order_status'  => 'required|in:new,pending,confirmed',
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'product_id'   => $request->product_id,
            'quantity'     => $request->quantity,
            'order_date'   => $request->order_date,
            'due_date'     => $request->due_date,
            'priority'     => $request->priority,
            'order_status' => $request->order_status,
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully.');
    }
    //delete an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}