<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ItemEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $payments = ['cash', 'transfer', 'check'];
        $itemIds = range(1, 10);
        $vendorIds = range(1, 10);

        $itemEntries = [];
        for ($i = 0; $i < 10; $i++) {
            $quantity = $faker->numberBetween(10, 500);
            $itemId = $faker->randomElement($itemIds);
            $item = DB::table('items')->find($itemId);
            $totalPrice = $quantity * $item->price;

            $itemEntries[] = [
                'reference_number' => 'TCP-IN-' . $faker->unique()->numberBetween(1000, 9999),
                'item_id' => $itemId,
                'vendor_id' => $faker->randomElement($vendorIds),
                'total_price' => $totalPrice,
                'payment' => $faker->randomElement($payments),
                'quantity' => $quantity,
                'entry_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'description' => $faker->optional()->sentence,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('item_entries')->insert($itemEntries);
    }
}
