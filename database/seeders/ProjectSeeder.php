<?php

namespace Database\Seeders;

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
        $faker = Faker::create('id_ID');

        $statuses = ['ongoing', 'finished'];
        $ipaBajaIds = [1, 2, 3, 4, 5];
        $clientIds = range(1, 10);

        $projects = [];
        for ($i = 0; $i < 10; $i++) {
            $projects[] = [
                'name' => $faker->company . ' Water Treatment Project',
                'project_value' => $faker->numberBetween(100000000, 5000000000),
                'location' => $faker->city,
                'ipa_baja_id' => $faker->randomElement($ipaBajaIds),
                'client_id' => $faker->randomElement($clientIds),
                'status' => $faker->randomElement($statuses),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('projects')->insert($projects);
    }
}
