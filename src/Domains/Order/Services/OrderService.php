<?php

namespace Domains\Order\Services;

use App\Events\OrderStatusUpdatedEvent;
use App\Exceptions\OrderException;
use Domains\Order\DTOs\AssignWorkerDto;
use Domains\Order\Enums\OrderStatusEnum;
use Domains\Order\Models\Order;
use Domains\Order\Repositories\OrderRepositoryInterface;
use Domains\Worker\Models\Worker;
use Domains\Worker\Repositories\WorkerRepositoryInterface;

readonly class OrderService
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private WorkerRepositoryInterface $workerRepository,
    )
    {}

    public function assignWorker(AssignWorkerDto $dto): void
    {
        $order = $this->orderRepository->getById($dto->orderId);

        if ($order->status !== OrderStatusEnum::Created->value) {
            throw OrderException::wrongStatus();
        }

        $worker = $this->workerRepository->getById($dto->workerId);

        if ($this->isExcludedOrderType($worker, $order)) {
            throw OrderException::excludedType();
        }

        $order->workers()->attach($worker->id, [
            'amount' => $order->amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $order->update(['status' => OrderStatusEnum::Appointed->value]);
    }

    private function isExcludedOrderType(Worker $worker, Order $order): bool
    {
        return $worker->excludedOrderTypes->contains($order->type_id);
    }

    public function updateStatus(Order $order, string $status): void
    {
        $this->orderRepository->updateStatus($order, $status);

        OrderStatusUpdatedEvent::dispatch($order, $status);
    }
}
