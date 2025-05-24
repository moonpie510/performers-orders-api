<?php

namespace Database\Seeders;

use Domains\Order\Models\OrderWorker;
use Illuminate\Database\Seeder;

class OrderWorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderWorker::factory()->count(10)->create();
    }
}
