<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            UnitSeeder::class,
            ItemSeeder::class,
            ProductSeeder::class,
            VendorSeeder::class,
            ClientSeeder::class,
            IpaBajaSeeder::class,
            ProjectSeeder::class,
            ItemEntrySeeder::class,
            ItemExitSeeder::class
        ]);
    }
}
