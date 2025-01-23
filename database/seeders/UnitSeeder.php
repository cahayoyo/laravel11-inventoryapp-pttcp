<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            'Meter (m)',
            'Kilogram (kg)',
            'Liter (L)',
            'Unit',
            'Set',
            'Pcs',
            'Roll',
            'Kubik (m³)',
            'Milimeter (mm)',
            'Centimeter (cm)',
            'Kiloliter (kL)',
            'Ton',
        ];

        foreach ($units as $unit) {
            DB::table('units')->insert([
                'name' => $unit,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
