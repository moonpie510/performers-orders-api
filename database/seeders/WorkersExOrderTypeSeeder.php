<?php

namespace Database\Seeders;

use Domains\Worker\Models\WorkersExOrderType;
use Illuminate\Database\Seeder;

class WorkersExOrderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkersExOrderType::factory()->count(10)->create();
    }
}
