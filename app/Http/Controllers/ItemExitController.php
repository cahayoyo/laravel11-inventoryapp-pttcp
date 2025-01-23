<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Item;
use App\Models\ItemExit;
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

        $itemExits = $itemExits->with(['item', 'project', 'client'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.item-exits.index', compact('itemExits'));
    }

    public function create()
    {
        $items = Item::all();
        $projects = Project::all();
        $clients = Client::all();

        return view('pages.item-exits.create', compact('items', 'projects', 'clients'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'project_id' => 'required|exists:projects,id',
            'quantity' => 'required|numeric|min:0',
            'exit_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        DB::transaction(function () use ($validatedData, $request) {
            // Generate entry number (contoh sederhana)
            $validatedData['reference_number'] = 'TCP-OUT-' . date('ymd') . '-' .
                ItemExit::whereDate('created_at', today())->count() + 1;

            // Buat stock entry
            $itemExit = ItemExit::create($validatedData);

            // Update stok produk
            $item = Item::findOrFail($validatedData['item_id']);
            $item->decrement('stock', $validatedData['quantity']);
        });

        return redirect('/item-exits')->with('success', 'Successfully Add new item entry');
    }

    public function edit($id)
    {
        $itemExit = ItemExit::findOrFail($id);
        $items = Item::all();
        $projects = Project::all();
        $clients = Client::all();

        return view('pages.item-exits.edit', compact('itemExit', 'items', 'projects', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $itemExit = ItemExit::findOrFail($id);

        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'project_id' => 'required|exists:projects,id',
            'quantity' => 'required|numeric|min:0',
            'exit_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        DB::transaction(function () use ($validatedData, $itemExit) {
            // Cek apakah item_id berubah
            if ($itemExit->item_id != $validatedData['item_id']) {
                // Mengembalikan stok dari entri lama
                $oldItem = Item::findOrFail($itemExit->item_id);
                $oldItem->increment('stock', $itemExit->quantity);

                $newItem = Item::findOrFail($validatedData['item_id']);
                $newItem->decrement('stock', $validatedData['quantity']);
            }
            // Jika item_id tidak berubah, hanya update stok berdasarkan kuantitas baru
            $item = Item::findOrFail($itemExit->item_id);
            // Mengurangi stok untuk item yang sama dengan jumlah baru
            $item->increment('stock', $itemExit->quantity);  // Mengembalikan stok lama
            $item->decrement('stock', $validatedData['quantity']);  // Mengurangi stok berdasarkan kuantitas baru
        });

        $itemExit->fill($request->all());;
        $itemExit->save();


        return redirect('/item-exits')->with('success', 'Successfully Edit Item Exit');
    }

    public function delete($id)
    {
        $itemExit = ItemExit::findOrFail($id); // Ambil item berdasarkan ID
        DB::transaction(function () use ($itemExit) {
            // Update stok produk
            $item = Item::findOrFail($itemExit['item_id']);
            // Kurangi stok dari entri lama
            $item->increment('stock', $itemExit->quantity);
        });

        $itemExit->delete(); // Hapus item dari database

        return redirect('/item-exits')->with('success', 'Successfully Delete Item Entry');
    }
}
