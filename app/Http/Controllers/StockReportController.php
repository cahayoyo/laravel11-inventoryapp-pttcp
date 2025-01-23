<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StockReportController extends Controller
{
    public function index(Request $request)
    {
        // Query untuk laporan stok
        $query = Item::with('unit', 'category')
            ->select('id', 'name', 'category_id', 'unit_id', 'stock')
            ->orderBy('stock', 'asc');

        // Filter berdasarkan kategori
        if ($request->has('category') && $request->input('category') !== '0') {
            $query->where('category_id', $request->input('category'));
        }

        // Filter stok kritis (misal di bawah 10)
        if ($request->has('kritical')) {
            $query->where('stock', '<=', 10);
        }

        $items = $query->get();

        // Ambil daftar kategori untuk filter
        $categories = \App\Models\Category::all();

        return view('pages.stock-reports.index', [
            'items' => $items,
            'categories' => $categories
        ]);
    }

    public function exportPDF(Request $request)
    {
        // Query yang sama dengan index
        $query = Item::with('unit', 'category')
            ->select('id', 'name', 'category_id', 'unit_id', 'stock')
            ->orderBy('stock', 'asc');

        if ($request->has('category') && $request->input('category') != 0) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->has('kritical')) {
            $query->where('stock', '<=', 10);
        }

        $items = $query->get();

        // Generate PDF
        $pdf = PDF::loadView('pages.stock-reports.stock-pdf', [
            'items' => $items,
            'title' => 'Stock Reports'
        ]);

        return $pdf->download('laporan_stok_' . date('Y-m-d') . '.pdf');
    }
}
