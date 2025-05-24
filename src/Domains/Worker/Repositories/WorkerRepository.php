<?php

namespace Domains\Worker\Repositories;

use App\Exceptions\WorkerException;
use Domains\Worker\DTOs\FilterWorkerDto;
use Domains\Worker\Models\Worker;
use Illuminate\Database\Eloquent\Collection;

class WorkerRepository implements WorkerRepositoryInterface
{
    public function getById(int $id): Worker
    {
        $worker = Worker::query()->where('id', $id)->first();

        if (!$worker) {
            throw WorkerException::notFound();
        }

        return $worker;
    }

    public function getWorkers(?FilterWorkerDto $filterDto = null): Collection
    {
        return Worker::query()->filtered($filterDto)->get();
    }
}
