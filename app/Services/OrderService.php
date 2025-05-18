<?php

namespace App\Services;

use App\DTOs\Order\AssignWorkerDto;
use App\DTOs\Order\CreateOrderDto;
use App\Enums\OrderStatus;
use App\Events\OrderStatusUpdatedEvent;
use App\Exceptions\AuthException;
use App\Exceptions\OrderException;
use App\Exceptions\WorkerException;
use App\Models\Order;
use App\Models\Worker;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\WorkerRepositoryInterface;

readonly class OrderService
{
    public function __construct(
        private UserService $userService,
        private OrderRepositoryInterface $orderRepository,
        private WorkerRepositoryInterface $workerRepository,
    )
    {}

    public function createOrder(CreateOrderDto $dto): Order
    {
        $user = $this->userService->getAuthUser();

        if (!$user) {
            throw AuthException::notAuthorized();
        }

        return Order::query()->create([
            'type_id' => $dto->typeId,
            'partnership_id' => $dto->partnershipId,
            'user_id' => $dto->userId,
            'description' => $dto->description,
            'date' => $dto->date,
            'address' => $dto->address,
            'amount' => $dto->amount,
            'status' => OrderStatus::Created->value,
        ]);
    }

    public function assignWorker(AssignWorkerDto $dto): void
    {
        $order = $this->orderRepository->getById($dto->orderId);

        if (!$order) {
            throw OrderException::notFound();
        }

        if ($order->status !== OrderStatus::Created->value) {
            throw OrderException::wrongStatus();
        }

        $worker = $this->workerRepository->getById($dto->workerId);

        if (!$worker) {
            throw WorkerException::notFound();
        }

        if ($this->isExcludedOrderType($worker, $order)) {
            throw OrderException::excludedType();
        }

        $order->workers()->attach($worker->id, [
            'amount' => $order->amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $order->update(['status' => OrderStatus::Appointed->value]);
    }

    private function isExcludedOrderType(Worker $worker, Order $order): bool
    {
        return $worker->excludedOrderTypes->contains($order->type_id);
    }

    public function updateStatus(Order $order, string $status): void
    {
        $order->update(['status' => $status]);

        OrderStatusUpdatedEvent::dispatch($order, $status);
    }
}
