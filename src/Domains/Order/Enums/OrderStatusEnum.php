<?php

namespace Domains\Order\Enums;

use Domains\Order\Models\Order;
use Domains\Order\States\AppointedOrderStatus;
use Domains\Order\States\CompletedOrderStatus;
use Domains\Order\States\CreatedOrderStatus;
use Domains\Order\States\OrderStatus;

enum OrderStatusEnum: string
{
    case Created = 'Создан';
    case Appointed = 'Назначен исполнитель';
    case Completed = 'Завершен';

    public function createOrderStatus(Order $order): OrderStatus
    {
        return match($this) {
            OrderStatusEnum::Created => new CreatedOrderStatus($order),
            OrderStatusEnum::Appointed => new AppointedOrderStatus($order),
            OrderStatusEnum::Completed => new CompletedOrderStatus($order),
        };
    }
}
