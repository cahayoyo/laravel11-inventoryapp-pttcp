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
        $itemEntryCount = ItemEntry::count();
        $itemExitCount = ItemExit::count();

        return view('pages.dashboard.index', compact('categoryCount', 'unitCount', 'itemCount', 'vendorCount', 'clientCount', 'projectCount', 'ipaBajaCount', 'itemEntryCount', 'itemExitCount'));
    }
}
