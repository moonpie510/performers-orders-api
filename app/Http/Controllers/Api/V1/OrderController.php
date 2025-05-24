<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Domains\Order\DTOs\AssignWorkerDto;
use Domains\Order\DTOs\CreateOrderDto;
use Domains\Order\Models\Order;
use Domains\Order\Repositories\OrderRepositoryInterface;
use Domains\Order\Requests\AssignWorkerRequest;
use Domains\Order\Requests\CreateOrderRequest;
use Domains\Order\Requests\UpdateOrderStatusRequest;
use Domains\Order\Services\OrderService;
use Domains\User\Services\UserService;
use Illuminate\Http\JsonResponse;


class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
        private readonly UserService $userService,
        private readonly OrderRepositoryInterface $orderRepository,
    )
    {}

    public function store(CreateOrderRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->getAuthUser();
            $this->orderRepository->create(CreateOrderDto::fromRequest($request, $user->id));
            return $this->successResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function assignWorker(AssignWorkerRequest $request, Order $order): JsonResponse
    {
        try {
            $this->orderService->assignWorker(AssignWorkerDto::fromRequest($request));
            return $this->successResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function updateStatus(UpdateOrderStatusRequest $request, Order $order): JsonResponse
    {
        try {
            $this->orderService->updateStatus($order, $request->status);
            return $this->successResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
