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
            'Instalasi Pengolahan Air Baja',
            'Pipa Distribusi Air',
            'Tangki Penyimpanan Air',
            'Pompa Air',
            'Valve dan Fitting',
            'Peralatan Pengolahan Air Limbah',
            'Panel Kontrol Elektrik',
            'Aksesoris Instalasi Air',
            'Filter Air Industri',
            'Sistem Pemurnian Air',
            'Perangkat Kontrol Kualitas Air',
            'Komponen Struktur Hidrolik'
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
