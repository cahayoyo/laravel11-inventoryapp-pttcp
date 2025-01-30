<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\IpaBaja;
use App\Models\Item;
use App\Models\ItemEntry;
use App\Models\ItemExit;
use App\Models\Product;
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
        $productCount = Product::count();
        // $ipaBajaCount = IpaBaja::count();
        $itemExitCount = ItemExit::count();
        $itemEntryCount = ItemEntry::count();
        $projects = Project::with(['ipabaja', 'client'])
            ->orderBy('deadline', 'asc')
            ->paginate(5);
        $itemEntries = ItemEntry::with(['item', 'vendor'])
            ->orderBy('entry_date', 'desc')
            ->paginate(5);
        $itemExits = ItemExit::with(['product', 'project', 'client'])
            ->orderBy('exit_date', 'desc')
            ->paginate(5);

        return view('pages.dashboard.index', compact('categoryCount', 'unitCount', 'itemCount', 'vendorCount', 'clientCount', 'projectCount', 'productCount', 'itemEntryCount', 'itemExits', 'itemExitCount', 'itemEntries', 'projects'));
    }
}
