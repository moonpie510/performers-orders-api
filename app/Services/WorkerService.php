<?php

namespace App\Services;

use App\DTOs\User\LoginDto;
use App\DTOs\User\RegisterDto;
use App\Exceptions\AuthException;
use App\Exceptions\WorkerException;
use App\Models\User;
use App\Models\Worker;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\WorkerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class WorkerService
{
    public function __construct(
        private WorkerRepositoryInterface $workerRepository
    )
    {}

    public function login(int $id): Worker
    {
        $worker = $this->workerRepository->getById($id);

        if (!$worker) {
            throw WorkerException::notFound();
        }

        return $worker;
    }
}
