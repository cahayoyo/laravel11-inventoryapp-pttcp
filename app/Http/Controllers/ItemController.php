<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function index()
    {
        // Buat query builder
        $items = Item::query();

        // Cek apakah ada parameter search
        if (request('search')) {
            $items->where('name', 'like', '%' . request('search') . '%');
        }

        // Load relations untuk category dan unit
        $items = $items->with(['category', 'unit'])->paginate(10);

        // Kirim data ke view
        return view('pages.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();

        return view('pages.items.create', compact('categories', 'units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|unique:items,name",
            "code" => "required|unique:items,code",
            "stock" => "nullable|numeric|min:0",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "category_id" => "required|exists:categories,id",
            "unit_id" => "required|exists:units,id"
        ], [
            "name.required" => "Item Name Required",
            "name.unique" => "Item Name Already Exists",
            "code.required" => "Item Code Required",
            "code.unique" => "Item Code Already Exists",
            "stock.numeric" => "Stock must be a number",
            "stock.min" => "Stock cannot be negative",
            "category_id.required" => "Item Category Required",
            "category_id.exists" => "Selected category does not exist",
            "unit_id.required" => "Item Unit Required",
            "unit_id.exists" => "Selected unit does not exist",
            "image.image" => "File must be an image",
            "image.mimes" => "Image must be jpeg, png, jpg or gif format",
            "image.max" => "Image size cannot exceed 2MB"
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Pastikan folder exists
                if (!Storage::exists('public/images')) {
                    Storage::makeDirectory('public/images');
                }

                // Upload dengan Storage
                Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));

                $data['image'] = $imageName;

                Log::info('Upload attempt for: ' . $imageName);
            } catch (\Exception $e) {
                Log::error('Upload failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Image upload failed');
            }
        } else {
            $data['image'] = 'defaultitem.png';
        }

        $item = new Item();
        $item->fill($data);
        $item->save();

        return redirect('/items')->with('success', 'Successfully Add Item');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        $units = Unit::all();

        return view('pages.items.edit', compact('item', 'categories', 'units'));
    }

    public function update(Request $request, $id)
    {

        $item = Item::findOrFail($id);

        $validated = $request->validate([
            "name" => "required",
            "code" => "required",
            "stock" => "nullable|numeric|min:0",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "category_id" => "required|exists:categories,id",
            "unit_id" => "required|exists:units,id"
        ], [
            "name.required" => "Item Name Required",
            "code.required" => "Item Code Required",
            "stock.numeric" => "Stock must be a number",
            "stock.min" => "Stock cannot be negative",
            "category_id.required" => "Item Category Required",
            "category_id.exists" => "Selected category does not exist",
            "unit_id.required" => "Item Unit Required",
            "unit_id.exists" => "Selected unit does not exist",
            "image.image" => "File must be an image",
            "image.mimes" => "Image must be jpeg, png, jpg or gif format",
            "image.max" => "Image size cannot exceed 2MB"
        ]);

        $data = $request->all();
        // Handle image upload
        if ($request->hasFile('image')) {
            if ($item->image !== 'defaultitem.png') {
                Storage::disk('public')->delete('images/' . $item->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));
            $data['image'] = $imageName;
        } else {
            $data['image'] = $item->image;
        }

        $item->fill($data);
        $item->save();


        return redirect('/items')->with('success', 'Successfully Edit Item');
    }

    public function delete($id)
    {
        $item = Item::findOrFail($id); // Ambil item berdasarkan ID

        // Hapus file gambar jika ada
        if ($item->image && Storage::disk('public')->exists('images/' . $item->image)) {
            if ($item->image !== 'defaultitem.png') {
                Storage::disk('public')->delete('images/' . $item->image);
            }
        }

        $item->delete(); // Hapus item dari database

        return redirect('/items')->with('success', 'Successfully Delete Item');
    }
}
