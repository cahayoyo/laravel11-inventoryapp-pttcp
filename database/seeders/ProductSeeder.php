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
            ['name' => 'Koagulator', 'stock' => 5, 'unit_id' => 12],
            ['name' => 'Flokulator', 'stock' => 5, 'unit_id' => 12],
            ['name' => 'Sedimentator', 'stock' => 5, 'unit_id' => 12],
            ['name' => 'Filtrator', 'stock' => 5, 'unit_id' => 12],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
