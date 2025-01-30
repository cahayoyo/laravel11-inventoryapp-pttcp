<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ItemExitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $productIds = range(1, 5);
        $clientIds = range(1, 10);
        $projectIds = range(1, 10);

        $itemExits = [];
        for ($i = 0; $i < 10; $i++) {
            $productId = $faker->randomElement($productIds);
            $product = DB::table('products')->find($productId);

            $quantity = $faker->numberBetween(1, 5);

            $itemExits[] = [
                'reference_number' => 'TCP-OUT-' . $faker->unique()->numberBetween(1000, 9999),
                'product_id' => $productId,
                'client_id' => $faker->randomElement($clientIds),
                'project_id' => $faker->randomElement($projectIds),
                'quantity' => $quantity,
                'exit_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'description' => $faker->optional()->sentence,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('item_exits')->insert($itemExits);
    }
}
