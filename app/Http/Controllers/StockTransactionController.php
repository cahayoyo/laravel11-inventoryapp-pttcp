<?php

namespace App\Http\Controllers;

use App\Models\ItemEntry;
use App\Models\ItemExit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{
    public function index(Request $request)
    {
        $entriesQuery = ItemEntry::with(['item.unit', 'item.category', 'vendor'])
            ->select('reference_number', 'item_id', 'vendor_id', 'quantity', 'entry_date as date', 'description')
            ->orderBy('entry_date', 'desc');

        $exitsQuery = ItemExit::with(['product.unit', 'client', 'project'])
            ->select('reference_number', 'product_id', 'client_id', 'project_id', 'quantity', 'exit_date as date', 'description')
            ->orderBy('exit_date', 'desc');

        $type = $request->input('type', '');
        if ($type === 'in') {
            $transactions = $entriesQuery->get()->map(function ($entry) {
                return $this->formatEntryData($entry);
            });
        } elseif ($type === 'out') {
            $transactions = $exitsQuery->get()->map(function ($exit) {
                return $this->formatExitData($exit);
            });
        } else {
            $entries = $entriesQuery->get()->map(function ($entry) {
                return $this->formatEntryData($entry);
            });

            $exits = $exitsQuery->get()->map(function ($exit) {
                return $this->formatExitData($exit);
            });

            $transactions = $entries->concat($exits)->sortByDesc('date');
        }

        return view('pages.stock-transactions.index', [
            'transactions' => $transactions,
            'categories' => \App\Models\Category::all()
        ]);
    }

    public function exportPDF(Request $request)
    {
        // Query untuk transaksi masuk (entries)
        $entriesQuery = ItemEntry::with(['item.unit', 'item.category', 'vendor'])
            ->select('reference_number', 'item_id', 'vendor_id', 'quantity', 'entry_date as date', 'description')
            ->orderBy('entry_date', 'desc');

        // Query untuk transaksi keluar (exits) dengan relasi product dan unit saja
        $exitsQuery = ItemExit::with(['product.unit', 'client', 'project'])
            ->select('reference_number', 'product_id', 'client_id', 'project_id', 'quantity', 'exit_date as date', 'description')
            ->orderBy('exit_date', 'desc');

        // Filter berdasarkan tipe transaksi
        $type = $request->input('type', '');
        if ($type === 'in') {
            $transactions = $entriesQuery->get()->map(function ($entry) {
                return $this->formatEntryData($entry);
            });
        } elseif ($type === 'out') {
            $transactions = $exitsQuery->get()->map(function ($exit) {
                return $this->formatExitData($exit);
            });
        } else {
            $entries = $entriesQuery->get()->map(function ($entry) {
                return $this->formatEntryData($entry);
            });

            $exits = $exitsQuery->get()->map(function ($exit) {
                return $this->formatExitData($exit);
            });

            $transactions = $entries->concat($exits)->sortByDesc('date');
        }

        $pdf = Pdf::loadView('pages.stock-transactions.report-pdf', [
            'transactions' => $transactions,
            'title' => 'Stock Transaction Reports',
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'type' => $type
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan_transaksi_' . date('Y-m-d') . '.pdf');
    }
    private function formatEntryData($entry)
    {
        return [
            'date' => $entry->date,
            'type' => 'in',
            'reference' => $entry->reference_number,
            'item' => $entry->item,
            'quantity' => $entry->quantity,
            'description' => $entry->description,
            'vendor' => $entry->vendor,
            'client' => null,
            'project' => null
        ];
    }

    private function formatExitData($exit)
    {
        return [
            'date' => $exit->date,
            'type' => 'out',
            'reference' => $exit->reference_number,
            'item' => $exit->product,
            'quantity' => $exit->quantity,
            'description' => $exit->description,
            'vendor' => null,
            'client' => $exit->client,
            'project' => $exit->project
        ];
    }
}
