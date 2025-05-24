<?php

namespace Domains\Order\Repositories;

use Domains\Order\DTOs\CreateOrderDto;
use Domains\Order\Models\Order;

interface OrderRepositoryInterface
{
    public function getById(int $id): Order;
    public function create(CreateOrderDto $dto): Order;
    public function updateStatus(Order $order, string $status): Order;
}
