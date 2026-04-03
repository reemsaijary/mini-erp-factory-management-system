<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //view products when click \products
    public function index(Request $request)
    {
        $query = Product::query();
    //filter by search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', '%' . $search . '%')
                  ->orWhere('product_type', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $products = $query->orderBy('product_id', 'desc')
                          ->paginate(5)
                          ->appends($request->query());

        return view('admin.products.index', compact('products'));
    }
    //add product
    public function create()
    {
        return view('admin.products.create');
    }
    //save records about products
    public function store(Request $request)
    {
        //check before save
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_type' => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'unit_price'   => 'required|numeric|min:0',
        ]);
        //insert to DB
        Product::create([
            'product_name' => $request->product_name,
            'product_type' => $request->product_type,
            'description'  => $request->description,
            'unit_price'   => $request->unit_price,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }
    //show details
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
    }
    //edit product
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }
    //save updates of the record
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_type' => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'unit_price'   => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'product_name' => $request->product_name,
            'product_type' => $request->product_type,
            'description'  => $request->description,
            'unit_price'   => $request->unit_price,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }
    //delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}