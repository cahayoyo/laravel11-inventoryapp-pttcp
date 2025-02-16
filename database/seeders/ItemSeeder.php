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
            ['name' => 'Baja (Material untuk Tangki)', 'category_id' => 1, 'unit_id' => 1, 'code' => 'ITEM-0001', 'stock' => 100, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Pipa PVC (Saluran Air)', 'category_id' => 1, 'unit_id' => 2, 'code' => 'ITEM-0002', 'stock' => 200, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Kawat Baja (Penguat Struktur)', 'category_id' => 1, 'unit_id' => 1, 'code' => 'ITEM-0003', 'stock' => 150, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Pelat Logam (Untuk Baffle)', 'category_id' => 1, 'unit_id' => 1, 'code' => 'ITEM-0004', 'stock' => 50, 'image' => 'LogoTCPBiru.png'],

            // Bahan Kimia
            ['name' => 'Aluminium Sulfate (Alum)', 'category_id' => 2, 'unit_id' => 5, 'code' => 'ITEM-0005', 'stock' => 500, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Polyaluminium Chloride (PAC)', 'category_id' => 2, 'unit_id' => 5, 'code' => 'ITEM-0006', 'stock' => 300, 'image' => 'LogoTCPBiru.png'],

            // Polimer dan Koagulan
            ['name' => 'Cationic Polymers', 'category_id' => 3, 'unit_id' => 5, 'code' => 'ITEM-0007', 'stock' => 200, 'image' => 'LogoTCPBiru.png'],

            // Filter Media
            ['name' => 'Pasir Silika', 'category_id' => 4, 'unit_id' => 3, 'code' => 'ITEM-0008', 'stock' => 1000, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Karbon Aktif', 'category_id' => 4, 'unit_id' => 5, 'code' => 'ITEM-0009', 'stock' => 300, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Kerikil', 'category_id' => 4, 'unit_id' => 3, 'code' => 'ITEM-0010', 'stock' => 500, 'image' => 'LogoTCPBiru.png'],

            // Komponen Elektrikal dan Mekanikal
            ['name' => 'Pompa Lumpur (Sludge Pump)', 'category_id' => 5, 'unit_id' => 9, 'code' => 'ITEM-0011', 'stock' => 30, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Motor Penggerak', 'category_id' => 5, 'unit_id' => 9, 'code' => 'ITEM-0012', 'stock' => 15, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Panel Kontrol (Control Panel)', 'category_id' => 5, 'unit_id' => 9, 'code' => 'ITEM-0013', 'stock' => 10, 'image' => 'LogoTCPBiru.png'],

            // Komponen Sistem Sedimentasi
            ['name' => 'Tube Settler', 'category_id' => 6, 'unit_id' => 8, 'code' => 'ITEM-0014', 'stock' => 50, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Sedimentator (Tangki Pengendapan)', 'category_id' => 6, 'unit_id' => 2, 'code' => 'ITEM-0015', 'stock' => 10, 'image' => 'LogoTCPBiru.png'],

            // Komponen Sistem Koagulasi dan Flokulasi
            ['name' => 'Pompa Koagulan (Chemical Dosing Pump)', 'category_id' => 7, 'unit_id' => 9, 'code' => 'ITEM-0016', 'stock' => 20, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Reactor Tank (Tangki Koagulasi)', 'category_id' => 7, 'unit_id' => 2, 'code' => 'ITEM-0017', 'stock' => 5, 'image' => 'LogoTCPBiru.png'],

            // Komponen Sistem Filtrasi
            ['name' => 'Filter Sand (Pasir Filtrasi)', 'category_id' => 8, 'unit_id' => 3, 'code' => 'ITEM-0018', 'stock' => 700, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Backwash Valve (Katup Pencucian Kembali)', 'category_id' => 8, 'unit_id' => 9, 'code' => 'ITEM-0019', 'stock' => 50, 'image' => 'LogoTCPBiru.png'],

            // Komponen Sistem Desinfeksi
            ['name' => 'UV Lamp (Lampu UV)', 'category_id' => 9, 'unit_id' => 9, 'code' => 'ITEM-0020', 'stock' => 40, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Ozone Generator (Generator Ozon)', 'category_id' => 9, 'unit_id' => 9, 'code' => 'ITEM-0021', 'stock' => 10, 'image' => 'LogoTCPBiru.png'],

            // Peralatan Pengukuran dan Pengendalian
            ['name' => 'pH Meter', 'category_id' => 10, 'unit_id' => 11, 'code' => 'ITEM-0022', 'stock' => 15, 'image' => 'LogoTCPBiru.png'],
            ['name' => 'Flow Meter', 'category_id' => 10, 'unit_id' => 11, 'code' => 'ITEM-0023', 'stock' => 10, 'image' => 'LogoTCPBiru.png'],
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
