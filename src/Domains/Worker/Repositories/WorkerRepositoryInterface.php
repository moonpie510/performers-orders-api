<?php

namespace Domains\Worker\Repositories;

use Domains\Worker\DTOs\FilterWorkerDto;
use Domains\Worker\Models\Worker;
use Illuminate\Database\Eloquent\Collection;

interface WorkerRepositoryInterface
{
    public function getById(int $id): Worker;
    public function getWorkers(?FilterWorkerDto $filterDto = null): Collection;
}
