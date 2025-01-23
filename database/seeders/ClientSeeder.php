<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $clientNames = [
            'Dinas PUPR Provinsi Jawa Barat',
            'Rumah Sakit Umum Daerah Bekasi',
            'Pemerintah Kota Bandung',
            'PDAM Tirta Raharja Kabupaten Bogor',
            'Universitas Padjadjaran',
            'RS Hasan Sadikin Bandung',
            'Pemkab Subang',
            'BPBD Provinsi Jawa Barat',
            'Universitas Pendidikan Indonesia',
            'Dinas Kesehatan Kota Bandung'
        ];

        foreach ($clientNames as $name) {
            DB::table('clients')->insert([
                'name' => $name,
                'email' => strtolower(str_replace([' ', 'Provinsi', 'Kota', 'Kabupaten'], ['.', '-', '', '-'], $name)) . '@jawabarat.go.id',
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'image' => 'LogoTCPMerah.png',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
