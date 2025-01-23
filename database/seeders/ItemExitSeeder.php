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

        $itemIds = range(1, 10);
        $clientIds = range(1, 10);
        $projectIds = range(1, 10);

        $itemExits = [];
        for ($i = 0; $i < 10; $i++) {
            $itemId = $faker->randomElement($itemIds);
            $item = DB::table('items')->find($itemId);

            $quantity = $faker->numberBetween(1, $item->stock);

            $itemExits[] = [
                'reference_number' => 'TCP-OUT-' . $faker->unique()->numberBetween(1000, 9999),
                'item_id' => $itemId,
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
