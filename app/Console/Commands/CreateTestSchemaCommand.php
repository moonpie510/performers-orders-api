<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateTestSchemaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:create-schema';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создает схему для тестов';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::statement('CREATE SCHEMA IF NOT EXISTS skilla_test');
        $this->info('Схема skilla_test для тестов создана');
    }
}
