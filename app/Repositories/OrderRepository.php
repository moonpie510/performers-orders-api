<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function getById(int $id): ?Order
    {
        return Order::query()->where('id', $id)->first();
    }
}
