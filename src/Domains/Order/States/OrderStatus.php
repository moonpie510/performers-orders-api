<?php

namespace Domains\Order\States;

use App\Exceptions\OrderException;
use Domains\Order\Enums\OrderStatusEnum;
use Domains\Order\Models\Order;

abstract class OrderStatus
{
    protected array $allowedTransitions = [];

    public function __construct(
        protected Order $order
    )
    {}

    abstract public function canBeChanged(): bool;

    abstract public function value(): string;

    public function transitionTo(OrderStatus $newStatus): void
    {
        if (!$this->canBeChanged()) {
            throw OrderException::wrongStatusForUpdate();
        }

        if (!in_array(get_class($newStatus), $this->allowedTransitions)) {
            throw OrderException::cantChangeStatusTo($this->value(), $newStatus->value());
        }

        $this->order->update(['status' => $newStatus->value()]);
    }
}
