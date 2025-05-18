<?php

namespace App\Repositories;

use App\DTOs\Worker\FilterDto;
use App\Models\Worker;
use App\Repositories\Interfaces\WorkerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class WorkerRepository implements WorkerRepositoryInterface
{
    public function getById(int $id): ?Worker
    {
        return Worker::query()->where('id', $id)->first();
    }

    public function getWorkers(?FilterDto $filterDto = null): Collection
    {
        return Worker::query()->filtered($filterDto)->get();
    }
}
