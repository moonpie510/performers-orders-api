<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\Worker\FilterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Worker\FilterWorkerRequest;
use App\Http\Resources\WorkerResource;
use App\Repositories\WorkerRepository;
use App\Services\WorkerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class WorkerController extends Controller
{
    public function __construct(
        private readonly WorkerRepository $workerRepository,
        private readonly WorkerService $workerService
    )
    {}

    public function index(FilterWorkerRequest $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $workers = $this->workerRepository->getWorkers(FilterDto::fromRequest($request));
            return WorkerResource::collection($workers);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function login(int $id): JsonResponse
    {
        try {
            $worker = $this->workerService->login($id);
            return $this->successResponse(['token' => $worker->createToken('worker_token')->accessToken]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
