<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = range(1, 8);
        $units = range(1, 10);

        for ($i = 1; $i <= 15; $i++) {
            DB::table('items')->insert([
                'name' => $this->generateItemName(),
                'code' => 'ITEM-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'price' => $faker->randomFloat(2, 100, 10000),
                'stock' => $faker->numberBetween(10, 500),
                'image' => 'LogoTCPBiru.png',
                'category_id' => $faker->randomElement($categories),
                'unit_id' => $faker->randomElement($units),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    private function generateItemName()
    {
        $waterTreatmentItems = [
            'Pipa Stainless Steel',
            'Pompa Submersible',
            'Filter Karbon Aktif',
            'Tangki Tekan',
            'Valve Kontrol',
            'Sensor Kualitas Air',
            'Manifold Distribusi',
            'Membrane RO',
            'Fitting Sambungan',
            'Instalasi Pengolahan Air'
        ];

        return $waterTreatmentItems[array_rand($waterTreatmentItems)];
    }
}
