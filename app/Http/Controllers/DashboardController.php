<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\IpaBaja;
use App\Models\Item;
use App\Models\ItemEntry;
use App\Models\ItemExit;
use App\Models\Project;
use App\Models\Unit;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categoryCount = Category::count();
        $unitCount = Unit::count();
        $itemCount = Item::count();
        $vendorCount = Vendor::count();
        $clientCount = Client::count();
        $projectCount = Project::count();
        $ipaBajaCount = IpaBaja::count();
        $itemExitCount = ItemExit::count();
        $itemEntryCount = ItemEntry::count();
        $itemEntries = ItemEntry::with(['item', 'vendor'])
            ->orderBy('entry_date', 'desc')
            ->paginate(5);
        $itemExits = ItemExit::with(['item', 'project', 'client'])
            ->orderBy('exit_date', 'desc')
            ->paginate(5);

        return view('pages.dashboard.index', compact('categoryCount', 'unitCount', 'itemCount', 'vendorCount', 'clientCount', 'projectCount', 'ipaBajaCount', 'itemEntryCount', 'itemExits', 'itemExitCount', 'itemEntries'));
    }
}
