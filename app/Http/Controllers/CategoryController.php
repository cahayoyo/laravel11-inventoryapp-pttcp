<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Membuat query builder
        $categories = Category::query();

        // Cek apakah ada parameter search
        if (request('search')) {
            $categories->where('name', 'like', '%' . request('search') . '%');
        }

        // Eksekusi query dengan pagination
        $categories = $categories->paginate(10);

        // Kirim data ke view
        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|unique:categories,name",
        ], [
            "name.required" => "Category Name Required",
            "name.unique" => "Category Name Already Exists"
        ]);

        $category = new Category();
        $category->fill($request->all());
        $category->save();

        return redirect('/categories')->with('success', 'Successfully Add Category');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.categories.edit', ["category" => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            "name" => "required|unique:categories,name",
        ], [
            "name.required" => "Category Name Required",
            "name.unique" => "Category Name Already Exists"
        ]);

        $category->fill($request->all());;
        $category->save();

        return redirect('/categories')->with('success', 'Successfully Edit Category');
    }

    public function delete($id)
    {
        try {
            Category::destroy($id);
            return redirect('/categories')->with('success', 'Successfully Delete Category');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect('/categories')->with('error', 'Cannot delete this category because it is being used in items');
            }
            return redirect('/categories')->with('error', 'An error occurred while deleting the category');
        }
    }
}
