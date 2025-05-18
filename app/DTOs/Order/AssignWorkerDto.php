<?php

namespace App\DTOs\Order;

use App\Enums\OrderStatus;
use Illuminate\Http\Request;

readonly class AssignWorkerDto
{
    private function __construct(
        public int $workerId,
        public int $orderId,
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            workerId: $request->worker_id,
            orderId: $request->order_id,
        );
    }
}
