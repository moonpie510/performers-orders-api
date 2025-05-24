<?php

namespace Domains\Order\DTOs;

use Domains\Order\Enums\OrderStatusEnum;
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

    public static function fromRequest(Request $request, int $userId): self
    {
        return new self(
            typeId: $request->type_id,
            partnershipId: $request->partnership_id,
            userId: $userId,
            description: $request->description,
            date: $request->date,
            address: $request->address,
            amount: $request->amount,
            status: OrderStatusEnum::Created->value
        );
    }
}
