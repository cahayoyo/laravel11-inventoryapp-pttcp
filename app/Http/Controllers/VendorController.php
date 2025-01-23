<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        // Membuat query builder
        $vendors = Vendor::query();

        // Cek apakah ada parameter search
        if (request('search')) {
            $vendors->where('name', 'like', '%' . request('search') . '%');
        }

        // Eksekusi query dengan pagination
        $vendors = $vendors->paginate(10);

        // Kirim data ke view
        return view('pages.vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('pages.vendors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|unique:vendors,name",
            "email" => "required|email|max:255|unique:vendors,email",
            "address" => "required",
            "phone" => "required|numeric|min:0"
        ], [
            "name.required" => "Vendor Name Required",
            "name.unique" => "Vendor Name Already Exists",
            "email.required" => "Vendor Email Required",
            "email.unique" => "Vendor Email Already Exists",
            "address.required" => "Vendor Address Required",
            "phone.required" => "Vendor Phone Required",
            "phone.numeric" => "Vendor Phone must be Numeric",
        ]);

        $vendor = new Vendor();
        $vendor->fill($request->all());
        $vendor->save();

        return redirect('/vendors')->with('success', 'Successfully Add Vendor');
    }

    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('pages.vendors.edit', ["vendor" => $vendor]);
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $validated = $request->validate([
            "name" => "required",
            "email" => "required|email|max:255",
            "address" => "required",
            "phone" => "required|numeric|min:0"
        ], [
            "name.required" => "Vendor Name Required",
            "email.required" => "Vendor Email Required",
            "address.required" => "Vendor Address Required",
            "phone.required" => "Vendor Phone Required",
            "phone.numeric" => "Vendor Phone must be Numeric",
        ]);

        $vendor->fill($request->all());;
        $vendor->save();

        return redirect('/vendors')->with('success', 'Successfully Edit Vendor');
    }

    public function delete($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect('/vendors')->with('success', 'Successfully Delete Vendor');
    }
}
