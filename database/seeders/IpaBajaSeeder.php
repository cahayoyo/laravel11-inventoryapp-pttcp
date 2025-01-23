<?php

namespace Database\Seeders;

use App\Models\IpaBaja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IpaBajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ipabajas = [
            ['name' => 'IPA Baja 10 Liter / Detik', 'image' => 'default.png'],
            ['name' => 'IPA Baja 20 Liter / Detik', 'image' => 'default.png'],
            ['name' => 'IPA Baja 30 Liter / Detik', 'image' => 'default.png'],
            ['name' => 'IPA Baja 40 Liter / Detik', 'image' => 'default.png'],
            ['name' => 'IPA Baja 50 Liter / Detik', 'image' => 'default.png',],

        ];

        foreach ($ipabajas as $ipabaja) {
            IpaBaja::create($ipabaja);
        }
    }
}
