<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\Order\AssignWorkerDto;
use App\DTOs\Order\CreateOrderDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\AssignWorkerRequest;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderStatusRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;


class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService
    )
    {}

    public function store(CreateOrderRequest $request): JsonResponse
    {
        try {
            $this->orderService->createOrder(CreateOrderDto::fromRequest($request));
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
