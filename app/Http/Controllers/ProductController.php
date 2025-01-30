<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Buat query builder
        $products = Product::query();

        // Cek apakah ada parameter search
        if (request('search')) {
            $products->where('name', 'like', '%' . request('search') . '%');
        }

        // Load relations untuk unit
        $products = $products->with(['unit'])->paginate(10);

        // Kirim data ke view
        return view('pages.products.index', compact('products'));
    }

    public function create()
    {
        $units = Unit::all();

        return view('pages.products.create', compact('units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "unit_id" => "required|exists:units,id",
            "stock" => "required|numeric"
        ], [
            "name.required" => "Name Required",
            "unit_id.exists" => "Selected Unit does not exist",
        ]);


        $product = new Product();
        $product->fill($request->all());
        $product->save();

        return redirect('/products')->with('success', 'Successfully Add Product');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $units = Unit::all();

        return view('pages.products.edit', compact('product', 'units'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            "name" => "required",
            "unit_id" => "required|exists:units,id",
            "stock" => "required|numeric"
        ], [
            "name.required" => "Name Required",
            "unit_id.exists" => "Selected Unit does not exist",
        ]);

        $product->fill($request->all());;
        $product->save();

        return redirect('/products')->with('success', 'Successfully Edit Product');
    }

    public function delete($id)
    {
        try {
            Product::destroy($id);
            return redirect('/products')->with('success', 'Successfully Delete Product');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect('/products')->with('error', 'Cannot delete this product because it is being used in item_exit');
            }
            return redirect('/products')->with('error', 'An error occurred while deleting the product');
        }
    }
}
