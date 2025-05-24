<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PartnershipSeeder::class,
            UserSeeder::class,
            OrderTypeSeeder::class,
            WorkerSeeder::class,
            OrderSeeder::class,
            WorkersExOrderTypeSeeder::class,
            OrderWorkerSeeder::class
        ]);
    }
}
