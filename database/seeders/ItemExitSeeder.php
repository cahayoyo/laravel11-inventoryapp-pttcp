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

        $productIds = range(1, 4);
        $clientIds = range(1, 19);
        $projectIds = range(1, 8);

        $descriptions = [
            // Sedimentator
            'Pengiriman unit sedimentator untuk instalasi WTP Kawasan Industri Timur',
            'Dropping sedimentator tank untuk pembangunan plant pengolahan air baru di Site A',
            'Supply unit sedimentator untuk upgrade kapasitas WTP Regional',
            'Pengiriman sedimentator sistem untuk proyek water treatment plant kota',

            // Filtrator
            'Pengiriman unit filtrasi untuk pembangunan WTP Zona 2',
            'Dropping sistem filtrator untuk upgrade plant pengolahan existing',
            'Supply unit filtrator untuk penggantian sistem filtrasi lama di WTP Utara',
            'Pengiriman filtration unit untuk plant baru kapasitas 50 L/s',

            // Koagulator
            'Pengiriman unit koagulator untuk instalasi water treatment baru',
            'Dropping rapid mixing unit untuk upgrade sistem koagulasi WTP Regional',
            'Supply koagulator tank untuk peningkatan kapasitas pengolahan air',
            'Pengiriman sistem koagulasi untuk pembangunan WTP Kawasan Industri',

            // Flokulator
            'Pengiriman unit flokulator untuk plant pengolahan air baru',
            'Dropping mechanical flocculation unit untuk WTP kapasitas 100 L/s',
            'Supply sistem flokulasi untuk upgrade pengolahan air existing',
            'Pengiriman flokulator tank untuk pembangunan water treatment plant'
        ];

        $itemExits = [];
        for ($i = 0; $i < 15; $i++) {
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
                'description' => $faker->randomElement($descriptions),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('item_exits')->insert($itemExits);
    }
}
