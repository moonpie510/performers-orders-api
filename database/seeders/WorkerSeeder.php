<?php

namespace Database\Seeders;

use Domains\Worker\Models\Worker;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Worker::factory()->count(10)->create();
    }
}
