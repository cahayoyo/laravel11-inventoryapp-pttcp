<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    public function index()
    {
        // Membuat query builder
        $clients = Client::query();

        // Cek apakah ada parameter search
        if (request('search')) {
            $clients->where('name', 'like', '%' . request('search') . '%');
        }

        // Eksekusi query dengan pagination
        $clients = $clients->paginate(15);

        // Kirim data ke view
        return view('pages.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('pages.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|unique:categories,name",
            "email" => "required|email|max:255|unique:users,email",
            "address" => "required",
            "phone" => "required|numeric|min:0",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ], [
            "name.required" => "Vendor Name Required",
            "name.unique" => "Vendor Name Already Exists",
            "email.required" => "Vendor Email Required",
            "email.unique" => "Vendor Email Already Exists",
            "address.required" => "Vendor Address Required",
            "phone.required" => "Vendor Phone Required",
            "phone.numeric" => "Vendor Phone must be Numeric",
            "image.image" => "File must be an image",
            "image.mimes" => "Image must be jpeg, png, jpg or gif format",
            "image.max" => "Image size cannot exceed 2MB"
        ]);

        $data = $request->all();

        // Handle image upload
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images/'), $imageName);
        //     $data['image'] = $imageName;
        // } else {
        //     $data['image'] = 'default.png'; // Default image
        // }

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
            $data['image'] = 'default.png';
        }

        $client = new Client();
        $client->fill($data);
        $client->save();

        return redirect('/clients')->with('success', 'Successfully Add Client');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('pages.clients.edit', ["client" => $client]);
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validated = $request->validate([
            "name" => "required",
            "email" => "required|email|max:255",
            "address" => "required",
            "phone" => "required|numeric|min:0",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ], [
            "name.required" => "Vendor Name Required",
            "email.required" => "Vendor Email Required",
            "address.required" => "Vendor Address Required",
            "phone.required" => "Vendor Phone Required",
            "phone.numeric" => "Vendor Phone must be Numeric",
            "image.image" => "File must be an image",
            "image.mimes" => "Image must be jpeg, png, jpg or gif format",
            "image.max" => "Image size cannot exceed 2MB"
        ]);

        $data = $request->all();
        // Handle image upload
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('images/' . $client->image);
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));
            $data['image'] = $imageName;
        } else {
            $data['image'] = $client->image;
        }

        $client->fill($data);
        $client->save();


        return redirect('/clients')->with('success', 'Successfully Edit Client');
    }

    public function delete($id)
    {
        try {
            $client = Client::findOrFail($id);
            // Hapus file gambar jika ada

            $client->delete();
            if ($client->image && Storage::disk('public')->exists('images/' . $client->image)) {
                Storage::disk('public')->delete('images/' . $client->image);
            }
            return redirect('/clients')->with('success', 'Successfully Delete Client');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect('/clients')->with('error', 'Cannot delete this Client because it is being used in project');
            }
            return redirect('/clients')->with('error', 'An error occurred while deleting the Client');
        }
    }
}
