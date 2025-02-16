<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'name' => 'Pembangunan SPAM IKK Lokasi IKK Selat Nasik Kabupaten Belitung',
                'project_value' => 7201591000,
                'location' => 'Bangka Belitung',
                'ipa_baja_id' => 1,
                'client_id' => 11,
                'status' => 'finished',
                'deadline' => Carbon::create(2017, 12, 31),
                'created_at' => Carbon::create(2017, 1, 1),
            ],
            [
                'name' => 'Peningkatan Kapasitas IPA Toboali Rindik Kabupaten Bangka Selatan',
                'project_value' => 2895750000,
                'location' => 'Bangka Belitung',
                'ipa_baja_id' => 2,
                'client_id' => 11,
                'status' => 'finished',
                'deadline' => Carbon::create(2018, 6, 30),
                'created_at' => Carbon::create(2017, 1, 2),
            ],
            [
                'name' => 'Pembangunan SPAM IKK Kawasan Perkotaan Tondano Selatan Kab .Minahasa',
                'project_value' => 8997100539,
                'location' => 'Tondano',
                'ipa_baja_id' => 2,
                'client_id' => 16,
                'status' => 'finished',
                'deadline' => Carbon::create(2019, 5, 15),
                'created_at' => Carbon::create(2017, 1, 3),
            ],
            [
                'name' => 'Pembangunan IPA Sijuk Kap . 20 L/d Untuk Mendukung KSPN Tanjung Kelayang Kab . Belitung',
                'project_value' => 12180358000,
                'location' => 'Bangka Belitung',
                'ipa_baja_id' => 2,
                'client_id' => 11,
                'status' => 'finished',
                'deadline' => Carbon::create(2019, 11, 20),
                'created_at' => Carbon::create(2017, 1, 4),
            ],
            [
                'name' => 'Pembangunan IPA Baja 10 det untuk SPAM IKK Renah Mendaluh Kab. Tanjung Jabung Barat (Sub Kontrak)',
                'project_value' => 11600000000,
                'location' => 'Jambi',
                'ipa_baja_id' => 1,
                'client_id' => 17,
                'status' => 'finished',
                'deadline' => Carbon::create(2019, 3, 30),
                'created_at' => Carbon::create(2017, 1, 5),
            ],
            [
                'name' => 'Peningkatan Kapasitas IPA Kap.30 L/ Det SPAM IKK Sungai Bengkal Kabupaten Tebo',
                'project_value' => 14205333000,
                'location' => 'Jambi',
                'ipa_baja_id' => 3,
                'client_id' => 17,
                'status' => 'finished',
                'deadline' => Carbon::create(2021, 3, 30),
                'created_at' => Carbon::create(2017, 1, 6),
            ],
            [
                'name' => 'Pembangunan IPA 50 LPD Labuhan Batu, Di Lokasi Proyek SPAM Bilah Hilir',
                'project_value' => 8449138000,
                'location' => 'Medan',
                'ipa_baja_id' => 5,
                'client_id' => 19,
                'status' => 'finished',
                'deadline' => Carbon::create(2022, 3, 30),
                'created_at' => Carbon::create(2017, 1, 7),
            ],
            [
                'name' => 'Pembangunan IPA 20 LPD, PDAM Sukabumi',
                'project_value' => 4235130000,
                'location' => 'Sukabumi',
                'ipa_baja_id' => 2,
                'client_id' => 20,
                'status' => 'ongoing',
                'deadline' => Carbon::create(2025, 3, 10),
                'created_at' => Carbon::now(),
            ]
        ];

        // Insert projects into the database
        foreach ($projects as $project) {
            DB::table('projects')->insert([
                'name' => $project['name'],
                'project_value' => $project['project_value'],
                'location' => $project['location'],
                'ipa_baja_id' => $project['ipa_baja_id'],
                'client_id' => $project['client_id'],
                'status' => $project['status'],
                'deadline' => $project['deadline'],
                'created_at' => $project['created_at'],
            ]);
        }
    }
}
