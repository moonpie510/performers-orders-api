<?php

namespace Domains\Order\States;


use Domains\Order\Enums\OrderStatusEnum;

class CreatedOrderStatus extends OrderStatus
{
    protected array $allowedTransitions = [
        AppointedOrderStatus::class
    ];

    public function canBeChanged(): bool
    {
        return true;
    }

    public function value(): string
    {
        return OrderStatusEnum::Created->value;
    }
}
