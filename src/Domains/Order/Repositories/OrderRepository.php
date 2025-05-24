<?php

namespace Domains\Order\Repositories;

use App\Exceptions\OrderException;
use Domains\Order\DTOs\CreateOrderDto;
use Domains\Order\Enums\OrderStatusEnum;
use Domains\Order\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function getById(int $id): Order
    {
        $order = Order::query()->where('id', $id)->first();

        if (!$order) {
            throw OrderException::notFound();
        }

        return $order;
    }

    public function create(CreateOrderDto $dto): Order
    {
        return Order::query()->create([
            'type_id' => $dto->typeId,
            'partnership_id' => $dto->partnershipId,
            'user_id' => $dto->userId,
            'description' => $dto->description,
            'date' => $dto->date,
            'address' => $dto->address,
            'amount' => $dto->amount,
            'status' => OrderStatusEnum::Created->value,
        ]);
    }

    public function updateStatus(Order $order, string $status): Order
    {
        $order->update(['status' => $status]);

        return $order;
    }
}
