<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@triciptapatriot.site',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@triciptapatriot.site',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@triciptapatriot.site',
                'password' => Hash::make('password'),
                'role' => 'owner',
            ],
        ]);
    }
}
