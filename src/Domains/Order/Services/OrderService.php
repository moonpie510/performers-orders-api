<?php

namespace Domains\Order\Services;

use App\Events\OrderStatusUpdatedEvent;
use App\Exceptions\OrderException;
use Domains\Order\DTOs\AssignWorkerDto;
use Domains\Order\Models\Order;
use Domains\Order\Repositories\OrderRepositoryInterface;
use Domains\Order\States\AppointedOrderStatus;
use Domains\Worker\Models\Worker;
use Domains\Worker\Repositories\WorkerRepositoryInterface;
use Illuminate\Support\Facades\DB;

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

        $worker = $this->workerRepository->getById($dto->workerId);

        if ($this->isExcludedOrderType($worker, $order)) {
            throw OrderException::excludedType();
        }

        DB::transaction(function () use ($order, $worker) {
            $order->status->transitionTo(new AppointedOrderStatus($order));

            $order->workers()->attach($worker->id, [
                'amount' => $order->amount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }

    private function isExcludedOrderType(Worker $worker, Order $order): bool
    {
        return $worker->excludedOrderTypes->contains($order->type_id);
    }

    public function updateStatus(Order $order, string $status): void
    {
        if (!$order->status->canBeChanged()) {
            throw OrderException::wrongStatusForUpdate();
        }

        $this->orderRepository->updateStatus($order, $status);

        OrderStatusUpdatedEvent::dispatch($order, $status);
    }
}
