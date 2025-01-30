<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Koagulator', 'stock' => 10, 'unit_id' => 12],
            ['name' => 'Flukolator', 'stock' => 10, 'unit_id' => 12],
            ['name' => 'Sedimentator', 'stock' => 10, 'unit_id' => 12],
            ['name' => 'Filtrator', 'stock' => 10, 'unit_id' => 12],
            ['name' => 'Tube Settler', 'stock' => 10, 'unit_id' => 12],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
