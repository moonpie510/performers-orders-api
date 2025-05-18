<?php

namespace App\DTOs\Order;

use App\Enums\OrderStatus;
use Illuminate\Http\Request;

readonly class CreateOrderDto
{
    private function __construct(
        public int $typeId,
        public int $partnershipId,
        public int $userId,
        public string $description,
        public string $date,
        public string $address,
        public int $amount,
        public string $status
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            typeId: $request->type_id,
            partnershipId: $request->partnership_id,
            userId: $request->user_id,
            description: $request->description,
            date: $request->date,
            address: $request->address,
            amount: $request->amount,
            status: OrderStatus::Created->value
        );
    }
}
