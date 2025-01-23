<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemEntry;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemEntryController extends Controller
{
    public function index()
    {
        $itemEntries = ItemEntry::query();

        // Cek apakah ada parameter search
        if (request('search')) {
            $itemEntries->where('reference_number', 'like', '%' . request('search') . '%');
        }

        $itemEntries = $itemEntries->with(['item', 'vendor'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.item-entries.index', compact('itemEntries'));
    }

    public function create()
    {
        $items = Item::all();
        $vendors = Vendor::all();

        return view('pages.item-entries.create', compact('items', 'vendors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'vendor_id' => 'required|exists:vendors,id',
            'total_price' => 'required|numeric|min:0',
            'payment' => 'required|in:cash,transfer,check',
            'quantity' => 'required|numeric|min:0',
            'entry_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        DB::transaction(function () use ($validatedData, $request) {
            // Generate entry number (contoh sederhana)
            $validatedData['reference_number'] = 'TCP-IN-' . date('ymd') . '-' .
                ItemEntry::whereDate('created_at', today())->count() + 1;

            // Buat stock entry
            $itemEntry = ItemEntry::create($validatedData);

            // Update stok produk
            $item = Item::findOrFail($validatedData['item_id']);
            $item->increment('stock', $validatedData['quantity']);
        });

        return redirect('/item-entries')->with('success', 'Successfully created new item entry');
    }

    public function edit($id)
    {
        $itemEntry = ItemEntry::findOrFail($id);
        $items = Item::all();
        $vendors = Vendor::all();

        return view('pages.item-entries.edit', compact('itemEntry', 'items', 'vendors'));
    }

    public function update(Request $request, $id)
    {
        $itementry = ItemEntry::findOrFail($id);

        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'vendor_id' => 'required|exists:vendors,id',
            'total_price' => 'required|numeric|min:0',
            'payment' => 'required|in:cash,transfer,check',
            'quantity' => 'required|numeric|min:0',
            'entry_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        DB::transaction(function () use ($validatedData, $itementry) {
            // Cek apakah item_id berubah
            if ($itementry->item_id != $validatedData['item_id']) {
                // Mengembalikan stok dari entri lama
                $oldItem = Item::findOrFail($itementry->item_id);
                $oldItem->decrement('stock', $itementry->quantity);

                $newItem = Item::findOrFail($validatedData['item_id']);
                $newItem->increment('stock', $validatedData['quantity']);
            }
            // Jika item_id tidak berubah, hanya update stok berdasarkan kuantitas baru
            $item = Item::findOrFail($itementry->item_id);
            // Mengurangi stok untuk item yang sama dengan jumlah baru
            $item->decrement('stock', $itementry->quantity);  // Mengembalikan stok lama
            $item->increment('stock', $validatedData['quantity']);  // Mengurangi stok berdasarkan kuantitas baru
        });

        // DB::transaction(function () use ($validatedData, $itementry) {
        //     // Update stok produk
        //     $item = Item::findOrFail($validatedData['item_id']);
        //     // Kurangi stok dari entri lama
        //     $item->decrement('stock', $itementry->quantity);
        //     // Update stok item
        //     $item->increment('stock', $validatedData['quantity']);
        // });

        $itementry->fill($request->all());;
        $itementry->save();


        return redirect('/item-entries')->with('success', 'Successfully Edit Item Entry');
    }

    public function delete($id)
    {
        $itementry = ItemEntry::findOrFail($id); // Ambil item berdasarkan ID
        DB::transaction(function () use ($itementry) {
            // Update stok produk
            $item = Item::findOrFail($itementry['item_id']);
            // Kurangi stok dari entri lama
            $item->decrement('stock', $itementry->quantity);
        });

        $itementry->delete(); // Hapus item dari database

        return redirect('/item-entries')->with('success', 'Successfully Delete Item Entry');
    }
}
