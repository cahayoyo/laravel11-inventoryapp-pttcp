<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Material Konstruksi dan Komponen',
            'Bahan Kimia',
            'Polimer dan Koagulan',
            'Filter Media',
            'Komponen Elektrikal dan Mekanikal',
            'Komponen Sistem Sedimentasi',
            'Komponen Sistem Koagulasi dan Flokulasi',
            'Komponen Sistem Filtrasi',
            'Komponen Sistem Desinfeksi',
            'Peralatan Pengukuran dan Pengendalian'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
