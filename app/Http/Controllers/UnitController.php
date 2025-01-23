<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        // Membuat query builder
        $units = Unit::query();

        // Cek apakah ada parameter search
        if (request('search')) {
            $units->where('name', 'like', '%' . request('search') . '%');
        }

        // Eksekusi query dengan pagination
        $units = $units->paginate(15);

        // Kirim data ke view
        return view('pages.units.index', compact('units'));
    }

    public function create()
    {
        return view('pages.units.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|unique:units,name",
        ], [
            "name.required" => "Unit Name Required",
            "name.unique" => "Unit Name Already Exists"
        ]);

        $unit = new Unit();
        $unit->fill($request->all());
        $unit->save();

        return redirect('/units')->with('success', 'Successfully Add Unit');
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('pages.units.edit', ["unit" => $unit]);
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        $validated = $request->validate([
            "name" => "required",
        ], [
            "name.required" => "Unit Name Required",
        ]);

        $unit->fill($request->all());;
        $unit->save();

        return redirect('/units')->with('success', 'Successfully Edit Unit');
    }

    public function delete($id)
    {
        try {
            Unit::destroy($id);
            return redirect('/units')->with('success', 'Successfully Delete Unit');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect('/units')->with('error', 'Cannot delete this unit because it is being used in items');
            }
            return redirect('/units')->with('error', 'An error occurred while deleting the unit');
        }
    }
}
