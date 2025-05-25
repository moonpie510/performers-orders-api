<?php

namespace Domains\Order\States;

use Domains\Order\Enums\OrderStatusEnum;

class AppointedOrderStatus extends OrderStatus
{
    protected array $allowedTransitions = [
        CompletedOrderStatus::class
    ];

    public function canBeChanged(): bool
    {
        return true;
    }

    public function value(): string
    {
        return OrderStatusEnum::Appointed->value;
    }
}
