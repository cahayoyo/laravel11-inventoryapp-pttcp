<?php

namespace App\Http\Controllers;

use App\Models\IpaBaja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IpaBajaController extends Controller
{
    public function index()
    {
        // Buat query builder
        $ipaBajas = IpaBaja::query();

        // Cek apakah ada parameter search
        if (request('search')) {
            $ipaBajas->where('name', 'like', '%' . request('search') . '%');
        }

        // Eksekusi query dengan pagination
        $ipaBajas = $ipaBajas->paginate(10);

        // Kirim data ke view
        return view('pages.ipa-baja.index', compact('ipaBajas'));
    }

    public function create()
    {
        return view('pages.ipa-baja.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|unique:ipa_bajas,name",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ], [
            "name.required" => "IPA Baja Name Required",
            "name.unique" => "IPA Baja Name Already Exists",
            "image.image" => "File must be an image",
            "image.mimes" => "Image must be jpeg, png, jpg or gif format",
            "image.max" => "Image size cannot exceed 2MB"
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));
            $data['image'] = $imageName;
        } else {
            $data['image'] = 'default.png'; // Default image
        }

        $ipabaja = new IpaBaja();
        $ipabaja->fill($data);
        $ipabaja->save();


        return redirect('/ipabajas')->with('success', 'Successfully Add IPA Baja');
    }

    public function edit($id)
    {
        $ipaBaja = IpaBaja::findOrFail($id);
        return view('pages.ipa-baja.edit', ["ipaBaja" => $ipaBaja]);
    }

    public function update(Request $request, $id)
    {
        $ipabaja = IpaBaja::findOrFail($id);

        $validated = $request->validate([
            "name" => "required",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ], [
            "name.required" => "Vendor Name Required",
            "image.image" => "File must be an image",
            "image.mimes" => "Image must be jpeg, png, jpg or gif format",
            "image.max" => "Image size cannot exceed 2MB"
        ]);

        $data = $request->all();
        // Handle image upload
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('images/' . $ipabaja->image);
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));
            $data['image'] = $imageName;
        } else {
            $data['image'] = $ipabaja->image;
        }

        $ipabaja->fill($data);
        $ipabaja->save();


        return redirect('/ipabajas')->with('success', 'Successfully Edit IPA Baja');
    }

    public function delete($id)
    {
        try {
            $ipabaja = IpaBaja::findOrFail($id);
            // Hapus file gambar jika ada

            $ipabaja->delete();
            if ($ipabaja->image && Storage::disk('public')->exists('images/' . $ipabaja->image)) {
                Storage::disk('public')->delete('images/' . $ipabaja->image);
            }
            return redirect('/ipabajas')->with('success', 'Successfully Delete IPA Baja');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect('/ipabajas')->with('error', 'Cannot delete this IPA Baja because it is being used in items');
            }
            return redirect('/ipabajas')->with('error', 'An error occurred while deleting the IPA Baja');
        }
    }
}
