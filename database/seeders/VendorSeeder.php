<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $vendorNames = [
            'PT Tirta Baru Sejahtera',
            'CV Mitra Air Mandiri',
            'PT Aqua Konstruksi Indonesia',
            'CV Sarana Pengolahan Air',
            'PT Hidrolik Teknik Utama',
            'CV Sumber Air Prima',
            'PT Instalasi Air Nusantara',
            'CV Teknologi Pengolahan Air',
            'PT Distribusi Air Profesional',
            'CV Solusi Infrastruktur Air'
        ];

        foreach ($vendorNames as $name) {
            DB::table('vendors')->insert([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@example.com',
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
