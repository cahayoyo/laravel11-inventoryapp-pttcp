<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // Material Konstruksi dan Komponen
            ['name' => 'Baja', 'category_id' => 1, 'unit_id' => 1, 'code' => 'ITEM-0001', 'stock' => 100, 'image' => 'baja.png'],
            ['name' => 'Pipa PVC', 'category_id' => 1, 'unit_id' => 2, 'code' => 'ITEM-0002', 'stock' => 200, 'image' => 'pipapvc.png'],
            ['name' => 'Kawat Baja', 'category_id' => 1, 'unit_id' => 1, 'code' => 'ITEM-0003', 'stock' => 150, 'image' => 'kawatbaja.png'],
            ['name' => 'Pelat Logam', 'category_id' => 1, 'unit_id' => 1, 'code' => 'ITEM-0004', 'stock' => 50, 'image' => 'pelatlogam.png'],

            // Bahan Kimia
            ['name' => 'Aluminium Sulfate', 'category_id' => 2, 'unit_id' => 5, 'code' => 'ITEM-0005', 'stock' => 500, 'image' => 'alumuniumsulfat.png'],
            ['name' => 'Polyaluminium Chloride', 'category_id' => 2, 'unit_id' => 5, 'code' => 'ITEM-0006', 'stock' => 300, 'image' => 'chloride.png'],

            // Polimer dan Koagulan
            ['name' => 'Cationic Polymers', 'category_id' => 3, 'unit_id' => 5, 'code' => 'ITEM-0007', 'stock' => 200, 'image' => 'polymer.png'],

            // Filter Media
            ['name' => 'Pasir Silika', 'category_id' => 4, 'unit_id' => 3, 'code' => 'ITEM-0008', 'stock' => 1000, 'image' => 'pasirsilika.png'],
            ['name' => 'Karbon Aktif', 'category_id' => 4, 'unit_id' => 5, 'code' => 'ITEM-0009', 'stock' => 300, 'image' => 'karbonaktif.png'],
            ['name' => 'Kerikil', 'category_id' => 4, 'unit_id' => 3, 'code' => 'ITEM-0010', 'stock' => 500, 'image' => 'kerikil.png'],

            // Komponen Elektrikal dan Mekanikal
            ['name' => 'Pompa Lumpur', 'category_id' => 5, 'unit_id' => 9, 'code' => 'ITEM-0011', 'stock' => 30, 'image' => 'pompalumpur.png'],
            ['name' => 'Motor Penggerak', 'category_id' => 5, 'unit_id' => 9, 'code' => 'ITEM-0012', 'stock' => 15, 'image' => 'motorpenggerak.png'],
            ['name' => 'Panel Kontrol', 'category_id' => 5, 'unit_id' => 9, 'code' => 'ITEM-0013', 'stock' => 10, 'image' => 'panelkontrol.png'],

            // Komponen Sistem Sedimentasi
            ['name' => 'Tube Settler', 'category_id' => 6, 'unit_id' => 8, 'code' => 'ITEM-0014', 'stock' => 50, 'image' => 'tubesettler.png'],
            ['name' => 'Sedimentator', 'category_id' => 6, 'unit_id' => 2, 'code' => 'ITEM-0015', 'stock' => 10, 'image' => 'sedimentator.png'],

            // Komponen Sistem Koagulasi dan Flokulasi
            ['name' => 'Pompa Koagulan', 'category_id' => 7, 'unit_id' => 9, 'code' => 'ITEM-0016', 'stock' => 20, 'image' => 'pompakoagulan.png'],
            ['name' => 'Reactor Tank', 'category_id' => 7, 'unit_id' => 2, 'code' => 'ITEM-0017', 'stock' => 5, 'image' => 'tangkikoagulasi.png'],

            // Komponen Sistem Filtrasi
            ['name' => 'Filter Sand', 'category_id' => 8, 'unit_id' => 3, 'code' => 'ITEM-0018', 'stock' => 700, 'image' => 'filtersand.png'],
            ['name' => 'Backwash Valve', 'category_id' => 8, 'unit_id' => 9, 'code' => 'ITEM-0019', 'stock' => 50, 'image' => 'backwashvalve.png'],

            // Komponen Sistem Desinfeksi
            ['name' => 'UV Lamp', 'category_id' => 9, 'unit_id' => 9, 'code' => 'ITEM-0020', 'stock' => 40, 'image' => 'uvlamp.png'],
            ['name' => 'Ozone Generator', 'category_id' => 9, 'unit_id' => 9, 'code' => 'ITEM-0021', 'stock' => 10, 'image' => 'ozonegenerator.png'],

            // Peralatan Pengukuran dan Pengendalian
            ['name' => 'pH Meter', 'category_id' => 10, 'unit_id' => 11, 'code' => 'ITEM-0022', 'stock' => 15, 'image' => 'phmeter.png'],
            ['name' => 'Flow Meter', 'category_id' => 10, 'unit_id' => 11, 'code' => 'ITEM-0023', 'stock' => 10, 'image' => 'flowmeter.png'],
        ];

        // Insert items into the database
        foreach ($items as $item) {
            DB::table('items')->insert([
                'name' => $item['name'],
                'category_id' => $item['category_id'],
                'unit_id' => $item['unit_id'],
                'code' => $item['code'],
                'stock' => $item['stock'],
                'image' => $item['image'],
            ]);
        }
    }
}
