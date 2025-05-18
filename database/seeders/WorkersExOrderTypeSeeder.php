<?php

namespace Database\Seeders;

use App\Models\WorkersExOrderType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
