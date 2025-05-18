<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\Worker\FilterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Worker\FilterWorkerRequest;
use App\Http\Resources\WorkerResource;
use App\Repositories\WorkerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class WorkerController extends Controller
{
    public function __construct(
        private readonly WorkerRepository $workerRepository
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
}
