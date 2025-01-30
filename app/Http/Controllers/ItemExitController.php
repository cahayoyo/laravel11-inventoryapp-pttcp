<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ItemExit;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemExitController extends Controller
{
    public function index()
    {
        $itemExits = ItemExit::query();

        // Cek apakah ada parameter search
        if (request('search')) {
            $itemExits->where('reference_number', 'like', '%' . request('search') . '%');
        }

        $itemExits = $itemExits->with(['product', 'project', 'client'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.item-exits.index', compact('itemExits'));
    }

    public function create()
    {
        $products = Product::all();
        $projects = Project::all();
        $clients = Client::all();

        return view('pages.item-exits.create', compact('products', 'projects', 'clients'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'client_id' => 'required|exists:clients,id',
            'project_id' => 'required|exists:projects,id',
            'quantity' => 'required|numeric|min:0',
            'exit_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        DB::transaction(function () use ($validatedData, $request) {
            // Generate entry number dengan 3 digit
            $dailyCount = ItemExit::whereDate('created_at', today())->count();
            $validatedData['reference_number'] = 'TCP-OUT-' . date('ymd') . '-' .
                str_pad($dailyCount + 1, 3, '0', STR_PAD_LEFT);

            // Buat stock entry
            $itemExit = ItemExit::create($validatedData);

            // Update stok produk
            $product = Product::findOrFail($validatedData['product_id']);
            $product->decrement('stock', $validatedData['quantity']);
        });

        return redirect('/item-exits')->with('success', 'Successfully Add new item entry');
    }

    public function edit($id)
    {
        $itemExit = ItemExit::findOrFail($id);
        $products = Product::all();
        $projects = Project::all();
        $clients = Client::all();

        return view('pages.item-exits.edit', compact('itemExit', 'products', 'projects', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $itemExit = ItemExit::findOrFail($id);

        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'client_id' => 'required|exists:clients,id',
            'project_id' => 'required|exists:projects,id',
            'quantity' => 'required|numeric|min:0',
            'exit_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        DB::transaction(function () use ($validatedData, $itemExit) {
            // Cek apakah item_id berubah
            if ($itemExit->product_id != $validatedData['product_id']) {
                // Mengembalikan stok dari entri lama
                $oldItem = Product::findOrFail($itemExit->product_id);
                $oldItem->increment('stock', $itemExit->quantity);

                $newItem = Product::findOrFail($validatedData['product_id']);
                $newItem->decrement('stock', $validatedData['quantity']);
            }
            // Jika item_id tidak berubah, hanya update stok berdasarkan kuantitas baru
            $product = Product::findOrFail($itemExit->product_id);
            // Mengurangi stok untuk item yang sama dengan jumlah baru
            $product->increment('stock', $itemExit->quantity);  // Mengembalikan stok lama
            $product->decrement('stock', $validatedData['quantity']);  // Mengurangi stok berdasarkan kuantitas baru
        });

        // Hapus reference_number agar tidak diubah
        unset($validatedData['reference_number']);

        $itemExit->fill($request->all());;
        $itemExit->save();


        return redirect('/item-exits')->with('success', 'Successfully Edit Item Exit');
    }

    public function delete($id)
    {
        $itemExit = ItemExit::findOrFail($id); // Ambil item berdasarkan ID
        DB::transaction(function () use ($itemExit) {
            // Update stok produk
            $product = Product::findOrFail($itemExit['product_id']);
            // Kurangi stok dari entri lama
            $product->increment('stock', $itemExit->quantity);
        });

        $itemExit->delete(); // Hapus item dari database

        return redirect('/item-exits')->with('success', 'Successfully Delete Item Entry');
    }
}
