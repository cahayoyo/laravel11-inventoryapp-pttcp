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

        $descriptions = [
            'Pengadaan pipa PVC untuk proyek perluasan jaringan air bersih di wilayah timur',
            'Pembelian water meter untuk penggantian meter rusak pelanggan',
            'Restok material fitting pipa untuk maintenance rutin jaringan distribusi',
            'Pengadaan pompa submersible untuk sumur bor baru',
            'Pembelian valve hidran untuk penambahan titik hydrant',
            'Restok chemical treatment untuk pengolahan air',
            'Pengadaan flow meter untuk monitoring debit air',
            'Pembelian pressure gauge untuk pemantauan tekanan pipa',
            'Restok sambungan pipa untuk perbaikan kebocoran',
            'Pengadaan water tank untuk penampungan air treatment',
            'Pembelian filter cartridge untuk unit pengolahan air',
            'Restok pipa HDPE untuk proyek pemasangan jalur baru',
            'Pengadaan dosing pump untuk sistem klorinasi',
            'Pembelian water level sensor untuk monitoring reservoir',
            'Restok material bracket support untuk pemasangan pipa'
        ];

        $itemEntries = [];
        for ($i = 0; $i < 15; $i++) {
            $quantity = $faker->numberBetween(10, 500);
            $itemId = $faker->randomElement($itemIds);
            $item = DB::table('items')->find($itemId);
            $totalPrice = $faker->numberBetween(100000, 1000000);

            $itemEntries[] = [
                'reference_number' => 'TCP-IN-' . $faker->unique()->numberBetween(1000, 9999),
                'item_id' => $itemId,
                'vendor_id' => $faker->randomElement($vendorIds),
                'total_price' => $totalPrice,
                'payment' => $faker->randomElement($payments),
                'quantity' => $quantity,
                'entry_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'description' => $faker->randomElement($descriptions),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('item_entries')->insert($itemEntries);
    }
}
