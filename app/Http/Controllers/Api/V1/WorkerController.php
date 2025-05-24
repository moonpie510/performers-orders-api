<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Domains\Worker\DTOs\FilterWorkerDto;
use Domains\Worker\Repositories\WorkerRepositoryInterface;
use Domains\Worker\Requests\FilterWorkerRequest;
use Domains\Worker\Resources\WorkerResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class WorkerController extends Controller
{
    public function __construct(
        private readonly WorkerRepositoryInterface $workerRepository,
    )
    {}

    public function index(FilterWorkerRequest $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $workers = $this->workerRepository->getWorkers(FilterWorkerDto::fromRequest($request));
            return WorkerResource::collection($workers);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function login(int $id): JsonResponse
    {
        try {
            $worker = $this->workerRepository->getById($id);
            return $this->successResponse(['token' => $worker->createToken('worker_token')->accessToken]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
