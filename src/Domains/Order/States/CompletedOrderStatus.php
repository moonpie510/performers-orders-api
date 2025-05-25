<?php

namespace Domains\Order\States;

use Domains\Order\Enums\OrderStatusEnum;

class CompletedOrderStatus extends OrderStatus
{
    protected array $allowedTransitions = [];

    public function canBeChanged(): bool
    {
        return false;
    }

    public function value(): string
    {
        return OrderStatusEnum::Completed->value;
    }
}
