<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Worker\FilterDto;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Collection;

interface WorkerRepositoryInterface
{
    public function getById(int $id): ?Worker;
    public function getWorkers(?FilterDto $filterDto = null): Collection;
}
